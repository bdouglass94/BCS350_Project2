<?php require_once __DIR__ . '/auth.php'; ?>

<nav class="nav">

    <div class="nav-left">

        <a href="index.php">
            Home
        </a>

        <a href="leaderboard.php">
            Leaderboard
        </a>

        <?php if (current_user_id()): ?>

            <a href="profile.php">
                Profile
            </a>

        <?php else: ?>

            <a href="login.php">
                Login
            </a>

            <a href="signup.php">
                Sign Up
            </a>

        <?php endif; ?>

    </div>

    <?php if (current_user_id()): ?>

        <div class="nav-right">

            <a href="logout.php">
                Logout
            </a>

        </div>

    <?php endif; ?>

</nav>