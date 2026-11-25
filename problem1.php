<?php
$result = "";
$value = "";
$unit = "c_to_f";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $value = trim($_POST["temperature"] ?? "");
    $unit = $_POST["unit"] ?? "c_to_f";

    if ($value === "" || !is_numeric($value)) {
        $result = "❌ Please enter a valid number.";
    } else {
        $num = (float) $value;
        if ($unit === "c_to_f") {
            $converted = ($num * 9 / 5) + 32;
            $result = "✅ {$num}°C = " . number_format($converted, 2) . "°F";
        } elseif ($unit === "f_to_c") {
            $converted = ($num - 32) * 5 / 9;
            $result = "✅ {$num}°F = " . number_format($converted, 2) . "°C";
        } else {
            $result = "❌ Invalid unit selected.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperature Converter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Temperature Converter</h3>
    <form method="post">
        <input type="text" name="temperature" placeholder="Enter value" value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>">
        <select name="unit">
            <option value="c_to_f" <?= $unit === "c_to_f" ? "selected" : "" ?>>Celsius → Fahrenheit</option>
            <option value="f_to_c" <?= $unit === "f_to_c" ? "selected" : "" ?>>Fahrenheit → Celsius</option>
        </select>
        <button type="submit">Convert</button>
    </form>
    <?php if ($result !== ""): ?>
        <p><?= htmlspecialchars($result, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
</body>
</html>