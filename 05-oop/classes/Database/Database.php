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
     * @return array|null
     */
    public function query(string $sql): ?array
    {
        $stmt = $this->pdo->query($sql);
        if ($stmt->rowCount()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return null;
    }
    
    /**
     * Метод, който изпълнява SQL заявка и връща брой засегнати редове
     * 
     * @param string $sql
     * @return int
     */
    public function exec(string $sql): int
    {
        return $this->pdo->exec($sql);
    }
}
