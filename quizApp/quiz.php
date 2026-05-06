<?php
require_once __DIR__ . '/auth.php';
require_login();

$questions = json_decode(
    file_get_contents(__DIR__ . '/questions.json'),
    true
);

$count = isset($_GET['count']) ? (int) $_GET['count'] : 10;

if ($count !== 10 && $count !== 20) {
    $count = 10;
}

shuffle($questions);

$selected = array_slice($questions, 0, $count);

$_SESSION['quiz_questions'] = $selected;
$_SESSION['quiz_started_at'] = time();
$timeLimit = 10 * 60;
?>

<!doctype html>
<html>
<head>
    <title>Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">

    <h1>Quiz</h1>

    <div class="timer">
        Time Left:
        <span id="time">10:00</span>
    </div>

    <form
        id="quizForm"
        method="post"
        action="results.php"
    >

        <?php foreach ($selected as $i => $q): ?>

            <div class="question-card">

                <h3>
                    <?= ($i + 1) . '. ' .
                    htmlspecialchars($q['question']) ?>
                </h3>

<?php foreach (['A', 'B', 'C', 'D'] as $letter): ?>

    <label class="answer-choice">

        <input
            type="radio"
            name="answers[<?= $i ?>]"
            value="<?= $letter ?>"
            required
        >

        <span>
            <?= $letter ?>.
            <?= htmlspecialchars($q[$letter]) ?>
        </span>

    </label>

<?php endforeach; ?>

            </div>

            <br>

        <?php endforeach; ?>

        <button type="submit">
            Submit Quiz
        </button>

    </form>

</div>

<script>

let time = <?= $timeLimit ?>;

const display =
    document.getElementById('time');

const form =
    document.getElementById('quizForm');

function updateTimer() {

    const minutes =
        Math.floor(time / 60);

    const seconds =
        time % 60;

    display.textContent =
        `${minutes}:${seconds
            .toString()
            .padStart(2, '0')}`;
}

updateTimer();

const timer = setInterval(() => {

    time--;

    updateTimer();

    if (time <= 0) {

        clearInterval(timer);

        const unanswered =
            document.querySelectorAll(
                'input[type="radio"]:required'
            );

        unanswered.forEach(input => {
            input.required = false;
        });

        form.submit();
    }

}, 1000);

</script>

</body>
</html>
