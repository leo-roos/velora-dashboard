<?php
require __DIR__ . "/../config.php";
require __DIR__ . "/../functions.php";

session_start();
?>

<?php
include __DIR__ . "/../includes/header.php";
?>

<div class="login">
    <form action="../api/login/" method="post">
        <div class="discord-login">
            <a href="<?php echo htmlspecialchars($authorize_url); ?>">
                Länka discord
            </a>
        </div>
    </form>
</div>

<?php
include __DIR__ . "/../includes/footer.php";
?>