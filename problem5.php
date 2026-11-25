<?php
$rows = 5;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputRows = filter_var($_POST["rows"] ?? "", FILTER_VALIDATE_INT);
    if ($inputRows !== false && $inputRows >= 1 && $inputRows <= 50) {
        $rows = $inputRows;
    }
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <h3>Number Pattern Printer</h3>
    <form method="post">
        Enter number of rows: <input type="number" name="rows" min="1" max="50" value="<?= (int)$rows ?>">
        <button type="submit">Generate</button>
    </form>
    <pre><?php
for ($i = 1; $i <= $rows; $i++) {
    $line = [];
    for ($j = 1; $j <= $i; $j++) {
        $line[] = $j;
    }
    echo implode(" ", $line) . "\n";
}
?></pre>
</body>
</html>