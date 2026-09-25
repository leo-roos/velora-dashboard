<?php
require __DIR__ . "/../config.php";
require __DIR__ . "/../functions.php";

session_start();
?>

<?php
include __DIR__ . "/../includes/header.php";
?>

<div class="login">
    <a href="<?php echo $authorize_url; ?>">Logga in med Discord</a>
    
</div>

<?php
include __DIR__ . "/../includes/footer.php";
?>