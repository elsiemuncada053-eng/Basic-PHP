<?php
$n = null;
$warning = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $raw = trim($_POST["number"] ?? "");
    $parsed = filter_var($raw, FILTER_VALIDATE_INT);

    if ($parsed === false) {
        $error = "Please enter a valid whole number.";
    } elseif ($parsed > 12) {
        $warning = "Number is greater than 12 — please enter a number 12 or lower.";
    } else {
        $n = $parsed;
    }
}
?>
<?php
$n = null;
$warning = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $raw = trim($_POST["number"] ?? "");
    $parsed = filter_var($raw, FILTER_VALIDATE_INT);

    if ($parsed === false) {
        $error = "Please enter a valid whole number.";
    } elseif ($parsed > 12) {
        $warning = "Number is greater than 12 - please enter a number 12 or lower.";
    } else {
        $n = $parsed;
    }
}
?>
<?php
$n = null;
$warning = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $raw = trim($_POST["number"] ?? "");
    $parsed = filter_var($raw, FILTER_VALIDATE_INT);

    if ($parsed === false) {
        $error = "Please enter a valid whole number.";
    } elseif ($parsed > 12) {
        $warning = "Number is greater than 12 — please enter a number 12 or lower.";
    } else {
        $n = $parsed;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Multiplication Table Generator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Multiplication Table Generator (1-10)</h3>
    <form method="post">
        Enter a number (max 12):
        <input type="number" name="number" value="<?= $n !== null ? (int)$n : "" ?>" required>
        <button type="submit">Generate Table</button>
    </form>

    <?php if ($error !== ""): ?>
        <p style="color:red">❌ <?= htmlspecialchars($error) ?></p>
    <?php elseif ($warning !== ""): ?>
        <p style="color:darkorange">⚠️ <?= htmlspecialchars($warning) ?></p>
    <?php elseif ($n !== null): ?>
        <h4>Multiplication Table for <?= (int)$n ?></h4>
        <table>
            <thead>
                <tr>
                    <th>Expression</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                <tr>
                    <td><?= (int)$n ?> x <?= $i ?></td>
                    <td><?= (int)$n * $i ?></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>