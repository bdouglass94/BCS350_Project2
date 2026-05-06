<?php
require_once __DIR__ . '/auth.php';
require_login();
?>

<!doctype html>
<html>
<head>
    <title>Start Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">
    <h1>Start Quiz</h1>

    <p>Select how many questions you want for your quiz.</p>

    <form method="get" action="quiz.php">
        <label for="count">Number of Questions</label>

        <select name="count" id="count">
            <option value="10" selected>10 Questions</option>
            <option value="20">20 Questions</option>
        </select>

        <br><br>

        <button type="submit">Start Quiz</button>
    </form>
</div>

</body>
</html>
