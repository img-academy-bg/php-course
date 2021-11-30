<?php

namespace Img\Repository;

use Img\Database\Database;
use Img\Model\ModelInterface;
use Img\Exception\NoTableException;

/**
 * Description of AbstractRepository
 *
 * @author ksavc
 */
abstract class AbstractRepository
{
    
    protected Database $db;
    
    protected string $table = '';


    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    public function fetchBy(string $columnName, $columnValue): array
    {
        $this->verifyTable();
        $sql = sprintf("SELECT * FROM %s WHERE %s = :%s", $this->table, $columnName, $columnName);
        $result = (array) $this->db->query($sql, [$columnName => $columnValue]);
        $objects = [];
        foreach ($result as $row) {
            $objects[] = $this->createObjectFromRow($row);
        }
        return $objects;
    }
    
    abstract public function createObjectFromRow(array $row): ModelInterface;
    
    public function save(ModelInterface $model): bool
    {
        if ($model->getPrimaryKeyValue()) {
            return $this->update($model);
        } else {
            return $this->insert($model);
        }
    }
    
    protected function insert(ModelInterface $model): bool
    {
        $this->verifyTable();
        $values = $model->getValues();
        $columns = [];
        $params = [];
        foreach (array_keys($values) as $columnName) {
            $columns[] = $columnName;
            $params[] = ':' . $columnName;
        }
        
        $sql = sprintf("INSERT INTO %s(%s) VALUES(%s)", $this->table, implode(',', $columns), implode(',', $params));
        return (bool) $this->db->exec($sql, $values);
    }
    
    protected function update(ModelInterface $model): bool
    {
        $this->verifyTable();
        $values = $model->getValues();
        unset($values[$model->getPrimaryKeyName()]);
        $updateValues = []; // [ColumnName = :ColumnName, ...]
        foreach (array_keys($values) as $columnName) {
            $updateValues[] = $columnName . ' = :' . $columnName;
        }
        $values['PK'] = $model->getPrimaryKeyValue();
        $sql = sprintf("UPDATE %s SET %s WHERE %s = :PK", $this->table, $updateValues, $model->getPrimaryKeyName());
        return (bool) $this->db->exec($sql, $values);
    }
    
    public function delete(ModelInterface $model)
    {
        $this->verifyTable();
        $sql = sprintf("DELETE FROM %s WHERE %s = :PK", $this->table, $model->getPrimaryKeyName());
        return (bool) $this->db->exec($sql, ['PK' => $model->getPrimaryKeyValue()]);
    }
    
    protected function verifyTable()
    {
        if (!$this->table || !is_string($this->table)) {
            throw new NoTableException('No tabled defined for ' . static::class);
        }
    }
}
