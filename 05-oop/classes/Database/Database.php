<?php

namespace Img\Database;

use \PDO;

// 05-oop/classes/Database/Database.php

/**
 * Клас за работа с БД
 *
 * @author ksavc
 */
class Database {
    
    /**
     * 
     * @var PDO
     */
    private PDO $pdo;
    
    public function __construct(
        string $host,
        string $user, 
        string $pass, 
        string $dbname
    ) {
        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
        // Създаваме обект от клас PDO от глобалния namespace:
        $this->pdo = new PDO($dsn, $user, $pass);
    }
    
    /**
     * Метод, който изпълнява SQL заявка и връща резултата
     * 
     * @param string $sql
     * @param array $params [Optional] Default empty array
     * @return array|null
     */
    public function query(string $sql, array $params = []): ?array
    {
        $stmt = $this->executeStatement($sql, $params);
        if ($stmt->rowCount()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return null;
    }
    
    /**
     * Метод, който изпълнява SQL заявка и връща брой засегнати редове
     * 
     * @param string $sql
     * @param array $params [Optional] Default empty array
     * @return int
     */
    public function exec(string $sql, array $params = []): int
    {
        $stmt = $this->executeStatement($sql, $params);
        return $stmt->rowCount();
    }
    
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
    
    private function executeStatement(string $sql, array $params)
    {
        $stmt = $this->pdo->prepare($sql);
        // [] == false
        if ($params) {
            foreach ($params as $name => $value) {
                $stmt->bindValue(':'.$name, $value);
            }
        }
        $stmt->execute();
        
        return $stmt;
    }
}
