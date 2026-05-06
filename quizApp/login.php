<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');

    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare(
        'SELECT * FROM users WHERE username = ?'
    );

    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if (
        $user &&
        password_verify(
            $password,
            $user['password_hash']
        )
    ) {

        $_SESSION['user_id'] = $user['id'];

        $_SESSION['username'] =
            $user['username'];

        header('Location: index.php');

        exit;

    } else {

        $error =
            'Invalid username or password.';
    }
}
?>

<!doctype html>
<html>
<head>
    <title>Login</title>

    <link
        rel="stylesheet"
        href="style.css"
    >
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">

    <h1>Login</h1>

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

        <button>
            Login
        </button>

    </form>

</div>

</body>
</html>