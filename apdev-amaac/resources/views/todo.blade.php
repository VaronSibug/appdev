<?php
session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Add new task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task']) && !empty($_POST['task'])) {
    $task = htmlspecialchars($_POST['task']);
    array_push($_SESSION['tasks'], $task);
}

// Mark task as completed
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete']) && isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['tasks'][$index])) {
        $_SESSION['tasks'][$index] = '[Completed] ' . $_SESSION['tasks'][$index];
    }
}

// Delete task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['tasks'][$index])) {
        array_splice($_SESSION['tasks'], $index, 1);

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Todo List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #todo-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .completed {
            text-decoration: line-through;
            color: #888;
        }

        .add-form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div  ><a href="/">🏠Home</a></p>
<div id="todo-container">
    <h2>Todo List</h2>

    <ul id="todo-list">
        <?php
        foreach ($_SESSION['tasks'] as $index => $task) {
            echo "<li class='" . (strpos($task, '[Completed]') === 0 ? 'completed' : '') . "'>$task
                <form method='post' style='margin-left: 10px;'>
                    <input type='hidden' name='index' value='$index'>
                    <button type='submit' name='delete'>Delete</button>
                    <button type='submit' name='complete'>Complete</button>
                </form>
            </li>";
           
        }
        ?>
   
    </ul>
   
    <div class="add-form">
        <label for="task">New Task:</label>
        <form method="post">
            <input type="text" id="task" name="task" required>
            <button type="submit">Add</butt >
          
           
            
        
                