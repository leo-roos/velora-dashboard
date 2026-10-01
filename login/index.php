<?php
require __DIR__ . "/../config.php";
require __DIR__ . "/../functions.php";

session_start();
?>

<?php
include __DIR__ . "/../includes/header.php";
?>

<div class="login">
    <form action="../api/login" method="post">
        <label for="username">Användarnamn / E-mail</label>
        <input type="text" name="username" required>
        
        <label for="password">Lösenord</label>
        <input type="password" name="password" required>

        <button type="submit">Logga in</button>

        <div class="discord-login">
            <a href="<?php echo $authorize_url; ?>">Logga in med Discord</a>        
        </div>
    </form>
</div>

<?php
include __DIR__ . "/../includes/footer.php";
?>