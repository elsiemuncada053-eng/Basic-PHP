<?php
function getGrade($score): string {
    if ($score === "" || $score === null || !is_numeric($score)) {
        return "Invalid input";
    }
    $num = (float)$score;
    if ($num < 0 || $num > 100) {
        return "Invalid score — must be 0–100";
    }
    if ($num >= 90) return "A";
    if ($num >= 80) return "B";
    if ($num >= 70) return "C";
    if ($num >= 60) return "D";
    return "F";
}

$output = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $rawScore = trim($_POST["score"] ?? "");
    $output = "Score: {$rawScore} → Grade: " . getGrade($rawScore);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Grade Calculator</h3>
    <form method="post">
        <input type="number" name="score" step="any" min="0" max="100" placeholder="Enter score 0–100">
        <button type="submit">Get Grade</button>
    </form>
    <p><?= htmlspecialchars($output) ?></p>
</body>
</html>