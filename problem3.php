<?php
function countWords(string $text): array {
    $text = strtolower($text);
    $text = preg_replace("/[^a-z0-9\s]+/", " ", $text);
    $words = preg_split("/\s+/", trim($text), -1, PREG_SPLIT_NO_EMPTY);

    $counts = [];
    foreach ($words as $word) {
        $counts[$word] = ($counts[$word] ?? 0) + 1;
    }

    ksort($counts, SORT_STRING);
    return $counts;
}

$results = [];
$inputText = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputText = $_POST["paragraph"] ?? "";
    $results = countWords($inputText);
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <h3>Word Frequency Counter</h3>
    <form method="post">
        <textarea name="paragraph" rows="5" cols="50" placeholder="Type your text here..."><?= htmlspecialchars($inputText) ?></textarea><br>
        <button type="submit">Count Words</button>
    </form>
    <h4>Results:</h4>
    <ul>
        <?php foreach ($results as $word => $count): ?>
            <li><strong><?= htmlspecialchars($word) ?></strong>: <?= (int)$count ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>