<?php
$host = 'sql306.infinityfree.com';
$db   = 'if0_41848325_quiz_app';
$user = 'if0_41848325';
$pass = 'coBY1kJSMB7FXxR';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    die('Database connection failed. Check db.php');
}
?>
