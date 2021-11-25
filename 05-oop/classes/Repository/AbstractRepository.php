<?php

namespace Img\Repository;

use Img\Database\Database;

/**
 * Description of AbstractRepository
 *
 * @author ksavc
 */
abstract class AbstractRepository
{
    
    protected Database $db;
    
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    public function save($model)
    {
        // ...
    }
    
    protected function insert()
    {
        // ...
    }
    
    protected function update()
    {
        // ...
    }
    
    public function delete()
    {
        // ...
    }
}
