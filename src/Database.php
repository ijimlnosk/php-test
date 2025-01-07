<?php 
class Database {
    private static $instance = null;
    private $pdo;
    private function __construct() {
        $this->pdo = new PDO("sqlite:todo.db", "","");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public function getPDO() {
        return $this->pdo;
    }
}
?>