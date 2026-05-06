<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

$confirmPassword =
    $_POST['confirm_password'] ?? '';

$hasUpper = preg_match('/[A-Z]/', $password);
$hasNumber = preg_match('/[0-9]/', $password);
$hasSymbol = preg_match('/[\W]/', $password);

if (
    $username === '' ||
    strlen($password) < 8 ||
    !$hasUpper ||
    !$hasNumber ||
    !$hasSymbol
) {

    $error =
        'Password must be at least 8 characters and include at least 1 uppercase letter, 1 number, and 1 symbol.';

} elseif ($password !== $confirmPassword) {

    $error =
        'Passwords do not match.';
}
     else {
        try {
            $stmt = $pdo->prepare(
                'INSERT INTO users (username, password_hash)
                 VALUES (?, ?)'
            );

            $stmt->execute([
                $username,
                password_hash($password, PASSWORD_DEFAULT)
            ]);

            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['username'] = $username;

            header('Location: index.php');
            exit;

        } catch (PDOException $e) {
            $error = 'Username already exists.';
        }
    }
}
?>

<!doctype html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">
    <h1>Sign Up</h1>

      <p class="warning">
    This is a student project website. DO NOT USE real usernames / passwords you would normally use on other websites.
</p>

    <?php if ($error): ?>
        <p class="error">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endif; ?>

    <form method="post">
        <input
            name="username"
            placeholder="Username"
            required
        >

        <input
            name="password"
            type="password"
            placeholder="Password"
            required
        >
        
        <input
    name="confirm_password"
    type="password"
    placeholder="Verify Password"
    required
>

        <button>Create Account</button>
    </form>
</div>

</body>
</html>
