<?php
function isPalindrome(string $text): bool {
    $clean = preg_replace("/[^a-z0-9]/", "", strtolower($text));
    $left = 0;
    $right = strlen($clean) - 1;

    while ($left < $right) {
        if ($clean[$left] !== $clean[$right]) {
            return false;
        }
        $left++;
        $right--;
    }

    return true;
}

$samples = [
    "A man, a plan, a canal: Panama!",
    "racecar",
    "Hello, world!"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Problem 7 — Palindrome Checker</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            background-color: #0b111b;
            color: #e6edf7;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 48px 20px;
        }
        .container {
            width: 100%;
            max-width: 680px;
        }
        .header {
            text-align: center;
            margin-bottom: 28px;
        }
        .header h1 {
            margin: 0 0 6px;
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
        }
        .header p {
            margin: 0;
            font-size: 0.9rem;
            color: #8b9bb4;
        }
        .card {
            background-color: #111927;
            border: 1px solid #1e2a3d;
            border-radius: 10px;
            padding: 20px;
        }
        .result-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            background-color: #0d1420;
            border: 1px solid #192436;
            border-radius: 8px;
            padding: 14px 16px;
            margin-bottom: 12px;
            font-size: 0.95rem;
        }
        .result-row:last-child {
            margin-bottom: 0;
        }
        .sample-text {
            color: #d6e0f0;
        }
        .arrow {
            color: #6c7f99;
            margin: 0 8px;
        }
        .badge-true {
            color: #38bdf8;
            font-weight: 700;
        }
        .badge-false {
            color: #f87171;
            font-weight: 700;
        }
        .back-link {
            display: inline-block;
            margin-top: 18px;
            color: #4da3ff;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Palindrome Checker</h1>
            <p>Problem 7 &mdash; String &amp; Two-Pointer Logic</p>
        </div>

        <div class="card">
            <?php foreach ($samples as $sample): ?>
                <?php
                    $isPal = isPalindrome($sample);
                    $label = $isPal ? "true" : "false";
                    $cls = $isPal ? "badge-true" : "badge-false";
                ?>
                <div class="result-row">
                    <span class="sample-text"><?= htmlspecialchars($sample) ?></span>
                    <span>
                        <span class="arrow">&rarr;</span>
                        <strong class="<?= $cls ?>"><?= $label ?></strong>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>

        <a class="back-link" href="index.php">&larr; Back to PHP Exercises Hub</a>
    </div>
</body>
</html>