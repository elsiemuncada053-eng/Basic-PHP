<?php
$errors = [];
$successMessage = "";
$data = [
    "name" => "",
    "email" => "",
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data["name"] = trim((string) ($_POST["name"] ?? ""));
    $data["email"] = trim((string) ($_POST["email"] ?? ""));
    $password = (string) ($_POST["password"] ?? "");

    if (mb_strlen($data["name"]) < 3) {
        $errors["name"] = "Name must be at least 3 characters.";
    }

    if ($data["email"] === "" || filter_var($data["email"], FILTER_VALIDATE_EMAIL) === false) {
        $errors["email"] = "Please enter a valid email address.";
    }

    if (mb_strlen($password) < 8) {
        $errors["password"] = "Password must be at least 8 characters.";
    }

    if (empty($errors)) {
        // Hash passwords with password_hash($password, PASSWORD_DEFAULT) before saving to a DB
        $successMessage = "✅ Registration Successful!";
        $data = ["name" => "", "email" => ""];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Registration Form</h3>

    <?php if ($successMessage !== ""): ?>
        <p class="message success"><?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="message error">
            <?php foreach ($errors as $err): ?>
                <p>❌ <?= htmlspecialchars($err, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <p>
            <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($data["name"], ENT_QUOTES, 'UTF-8') ?>"></label>
        </p>
        <p>
            <label>Email: <input type="text" name="email" value="<?= htmlspecialchars($data["email"], ENT_QUOTES, 'UTF-8') ?>"></label>
        </p>
        <p>
            <label>Password: <input type="password" name="password"></label>
        </p>
        <button type="submit">Register</button>
    </form>
</body>
</html>