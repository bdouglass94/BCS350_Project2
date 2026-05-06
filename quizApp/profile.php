<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_login();
$stmt = $pdo->prepare('SELECT * FROM quiz_attempts WHERE user_id = ? ORDER BY created_at DESC');
$stmt->execute([current_user_id()]);
$attempts = $stmt->fetchAll();
?>
<!doctype html><html><head><title>Profile</title><link rel="stylesheet" href="style.css"></head><body><?php include 'nav.php'; ?>
<div class="container"><h1><?= htmlspecialchars(current_username()) ?>'s Profile</h1><h2>Play History</h2>
<table><tr><th>Date</th><th>Score</th><th>Percentage</th><th>Time</th></tr>
<?php foreach ($attempts as $a): ?><tr><td><?= htmlspecialchars($a['created_at']) ?></td><td><?= $a['score'] ?>/<?= $a['total_questions'] ?></td><td><?= $a['percentage'] ?>%</td><td><?= (int)$a['time_taken'] ?> sec</td></tr><?php endforeach; ?>
</table></div></body></html>
