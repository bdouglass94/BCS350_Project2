<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

require_login();

$questions =
    $_SESSION['quiz_questions'] ?? [];

$answers =
    $_POST['answers'] ?? [];

$score = 0;

$total = count($questions);

foreach ($questions as $i => $q) {

    $correct =
        strtoupper($q['answer']);

    $userAnswer =
        strtoupper($answers[$i] ?? '');

    if ($userAnswer === $correct) {
        $score++;
    }
}

$percentage =
    $total > 0
        ? ($score / $total) * 100
        : 0;

$timeTaken = 0;

if (isset($_SESSION['quiz_started_at'])) {
    $timeTaken =
        time() - $_SESSION['quiz_started_at'];
}

$stmt = $pdo->prepare(
    'INSERT INTO quiz_attempts
    (user_id, score, total_questions, percentage, time_taken)
    VALUES (?, ?, ?, ?, ?)'
);

$stmt->execute([
    current_user_id(),
    $score,
    $total,
    $percentage,
    $timeTaken
]);

unset($_SESSION['quiz_questions']);
unset($_SESSION['quiz_started_at']);
?>

<!doctype html>
<html>
<head>

    <title>Quiz Results</title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">

    <h1>Quiz Results</h1>

    <p>
        You scored
        <strong>
            <?= $score ?>
        </strong>
        out of
        <strong>
            <?= $total ?>
        </strong>
    </p>

    <p>
        Percentage:
        <strong>
            <?= number_format($percentage, 2) ?>%
        </strong>
    </p>

    <p>
        Time Taken:
        <strong>
            <?= floor($timeTaken / 60) ?>m
            <?= $timeTaken % 60 ?>s
        </strong>
    </p>

    <br>

<div class="results-buttons">

    <a class="btn" href="start.php">
        Replay Quiz
    </a>

    <a class="btn" href="leaderboard.php">
        View Leaderboard
    </a>

    <a class="btn" href="profile.php">
        View Past Scores
    </a>

    <a class="btn" href="logout.php">
        Exit
    </a>

</div>

</div>

</body>
</html>