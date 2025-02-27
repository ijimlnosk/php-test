<?php
// public/index.php
require_once '../src/TodoController.php';

$todoController = new TodoController();
$todos = $todoController->handleRequest();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Todo List</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans text-gray-800">
    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold text-center text-center mb-6">PHP Todo List</h1>
        <!-- 할 일 추가 폼 -->
        <form action="" method="POST" class="flex mb-4">
            <input type="text" name="task" placeholder="새로운 할 일을 입력하세요" required class="flex-grow p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="p-2 text-white bg-blue-500 rounded-r-md hover:bg-blue-600">추가</button>
        </form>
        
        <!-- 할 일 목록 -->
        <ul>
            <?php foreach ($todos as $todo): ?>
                <li class="flex justify-between items-center p-4 mb-2 bg-gray-50 border border-gray-200 rounded-md">
                    <span class="text-lg"><?= htmlspecialchars($todo['task']) ?></span>
                    <div>
                        <?php if(!$todo['completed']):?>
                            <a href="?complete=<?= $todo['id'] ?>" class="text-green-500 hover:text-green-700">완료</a>
                            <?php else: ?>
                                <span class="text-green-500">완료됨</span>
                            <?php endif;?>
                        <a href="?delete=<?= $todo['id'] ?>" class="text-red-500 hover:text-red-700">삭제</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
