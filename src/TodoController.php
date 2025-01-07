<?php
// src/TodoController.php
require_once 'TodoModel.php';

class TodoController {
    private $todoModel;

    public function __construct() {
        $this->todoModel = new TodoModel();
        $this->todoModel->createTable();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
            $this->todoModel->addTask($_POST['task']);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }

        if (isset($_GET['delete'])) {
            $this->todoModel->deleteTask($_GET['delete']);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }

        if(isset($_GET['complete'])){
            $this->todoModel->completeTask($_GET['complete']);
            header('Location: '. $_SERVER['PHP_SELF']);
            exit;
        }

        return $this->todoModel->getAllTasks();
    }
}
?>
