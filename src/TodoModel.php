<?php
// src/TodoModel.php
require_once 'Database.php';

class TodoModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getPDO();
    }

    public function createTable() {

            $this->db->exec("CREATE TABLE IF NOT EXISTS todos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            task TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            completed BOOLEAN DEFAULT 0
        )");
    }

    public function addTask($task) {
        $stmt = $this->db->prepare("INSERT INTO todos (task) VALUES (:task)");
        $stmt->bindParam(':task', $task);
        $stmt->execute();
    }

    public function deleteTask($id) {
        $stmt = $this->db->prepare("DELETE FROM todos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function completeTask($id) {
        $stmt = $this->db->prepare('UPDATE todos SET completed = 1 WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getAllTasks() {
        $stmt = $this->db->query("SELECT * FROM todos ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
