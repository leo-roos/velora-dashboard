<?php
require __DIR__ . "/../config.php";

session_start();
?>

<?php
include __DIR__ . "/../includes/header.php";
?>

<a href="<?php echo $authorize_url; ?>">Logga in med Discord</a>

<?php
include __DIR__ . "/../includes/footer.php";
?>