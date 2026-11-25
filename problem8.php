<?php
$error = "";
$daysBetween = null;
$startInput = "";
$endInput = "";

function parseStrictDate(string $dateStr): ?DateTimeImmutable {
    $dt = DateTimeImmutable::createFromFormat("!Y-m-d", trim($dateStr));
    $errors = DateTimeImmutable::getLastErrors();
    if (!$dt || ($errors && ($errors["warning_count"] > 0 || $errors["error_count"] > 0))) {
        return null;
    }
    return $dt;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $startInput = trim($_POST["start_date"] ?? "");
    $endInput = trim($_POST["end_date"] ?? "");

    $startDate = parseStrictDate($startInput);
    $endDate = parseStrictDate($endInput);

    if (!$startDate || !$endDate) {
        $error = "Please enter valid dates in YYYY-MM-DD format.";
    } elseif ($endDate < $startDate) {
        $error = "End date cannot be earlier than start date.";
    } else {
        $daysBetween = $startDate->diff($endDate)->days;
    }
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <h3>Days Between Two Dates</h3>
    <form method="post">
        <p>
            Start Date (YYYY-MM-DD):
            <input type="text" name="start_date" placeholder="2026-01-01" value="<?= htmlspecialchars($startInput) ?>">
        </p>
        <p>
            End Date (YYYY-MM-DD):
            <input type="text" name="end_date" placeholder="2026-12-31" value="<?= htmlspecialchars($endInput) ?>">
        </p>
        <button type="submit">Calculate Days</button>
    </form>

    <?php if ($error !== ""): ?>
        <p style="color:red">âŒ <?= htmlspecialchars($error) ?></p>
    <?php elseif ($daysBetween !== null): ?>
        <p>âœ… Days between <?= htmlspecialchars($startInput) ?> and <?= htmlspecialchars($endInput) ?>: <strong><?= (int)$daysBetween ?></strong></p>
    <?php endif; ?>
</body>
</html>