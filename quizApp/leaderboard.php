<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

$stmt = $pdo->query(
    'SELECT
        u.username,
        MAX(a.percentage) AS best_percentage,
        MAX(a.score) AS best_score,
        MAX(a.total_questions) AS total_questions,
        MIN(a.time_taken) AS fastest_time
     FROM quiz_attempts a
     JOIN users u ON a.user_id = u.id
     GROUP BY u.id, u.username
     ORDER BY best_percentage DESC, fastest_time ASC
     LIMIT 10'
);

$leaders = $stmt->fetchAll();
?>

<!doctype html>
<html>
<head>
    <title>Leaderboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">
    <h1>Top 10 Leaderboard</h1>

    <table>
        <tr>
            <th>Rank</th>
            <th>User</th>
            <th>Best %</th>
            <th>Best Score</th>
            <th>Fastest Time</th>
        </tr>

        <?php foreach ($leaders as $i => $l): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($l['username']) ?></td>
                <td><?= number_format($l['best_percentage'], 2) ?>%</td>
                <td><?= $l['best_score'] ?>/<?= $l['total_questions'] ?></td>
                <td><?= (int)$l['fastest_time'] ?> sec</td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>