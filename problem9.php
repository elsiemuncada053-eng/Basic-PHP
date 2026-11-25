<?php
session_start();

if (!isset($_SESSION["todos"])) {
    $_SESSION["todos"] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    if ($action === "add") {
        $title = trim($_POST["task"] ?? "");
        if ($title !== "") {
            $_SESSION["todos"][] = [
                "id" => uniqid("task_", true),
                "title" => $title,
                "completed" => false
            ];
        }
    } elseif ($action === "toggle") {
        $id = $_POST["id"] ?? "";
        foreach ($_SESSION["todos"] as &$todo) {
            if ($todo["id"] === $id) {
                $todo["completed"] = !$todo["completed"];
                break;
            }
        }
        unset($todo);
    } elseif ($action === "delete") {
        $id = $_POST["id"] ?? "";
        $_SESSION["todos"] = array_values(array_filter(
            $_SESSION["todos"],
            fn($todo) => $todo["id"] !== $id
        ));
    }

    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Problem 9 — Session To-Do List</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .todo-container {
            max-width: 600px;
            margin: 40px auto;
        }
        .todo-list {
            list-style: none;
            padding: 0;
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .todo-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #111927;
            border: 1px solid #1e2a3d;
            border-radius: 8px;
            padding: 12px 14px;
        }
        .todo-title {
            flex: 1;
            word-break: break-word;
            color: #e6edf7;
        }
        .todo-title.done {
            text-decoration: line-through;
            color: #6c7f99;
        }
        .todo-actions {
            display: flex;
            gap: 8px;
            flex-shrink: 0;
        }
        .todo-actions form {
            display: inline;
            margin: 0;
        }
        .todo-actions button {
            width: auto !important;
            padding: 6px 12px !important;
            font-size: 0.85rem;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn-delete {
            background: #2a1419 !important;
            border: 1px solid #5c2430 !important;
            color: #f87171 !important;
        }
    </style>
</head>
<body>
    <div class="todo-container">
        <h3>Session To-Do List</h3>

        <form method="post">
            <input type="hidden" name="action" value="add">
            <input type="text" name="task" placeholder="New task..." required>
            <button type="submit">Add Task</button>
        </form>

        <ul class="todo-list">
            <?php foreach ($_SESSION["todos"] as $todo): ?>
                <li class="todo-item">
                    <span class="todo-title <?= $todo["completed"] ? "done" : "" ?>">
                        <?= htmlspecialchars($todo["title"]) ?>
                    </span>

                    <div class="todo-actions">
                        <form method="post">
                            <input type="hidden" name="action" value="toggle">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($todo["id"]) ?>">
                            <button type="submit"><?= $todo["completed"] ? "Undo" : "Complete" ?></button>
                        </form>

                        <form method="post">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($todo["id"]) ?>">
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>