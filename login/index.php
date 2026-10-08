<?php
require __DIR__ . "/../config.php";
require __DIR__ . "/../functions.php";

session_start();
?>

<?php
include __DIR__ . "/includes/head.php";
?>

<div class="login">
    <form action="../api/login/" method="post">
        <div class="discord-login">
            <a href="<?php echo htmlspecialchars($authorize_url); ?>">
                Logga in med Discord
            </a>
        </div>
    </form>
</div>

<?php
include __DIR__ . "/../includes/footer.php";
?>