<?php
require_once __DIR__ . '/auth.php';
?>

<!doctype html>
<html>
<head>
    <title>Quiz App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">

    <h1>Quiz App</h1>

    <p>
        Test your knowledge with randomized quiz questions.
    </p>

    <?php if (current_user_id()): ?>

        <a class="btn" href="start.php">
            Start Quiz
        </a>

    <?php else: ?>

        <a class="btn" href="login.php">
            Login
        </a>

        <a class="btn" href="signup.php">
            Sign Up
        </a>

    <?php endif; ?>

</div>

</body>
</html>
