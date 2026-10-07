<?php
$URL_TITLE = "Sidan hittades inte (404)";

include __DIR__ . "/includes/header.php";
http_response_code(404);
?>

<div id="error-404">
    <h1>404 - Hoppsan, här var det tomt!</h1>
    <p>Sidan du letar efter finns inte på den här servern.</p>
    <a href="<?php echo BASE_URL . "/" ?>">Tillbaka till projektets startsida</a>
</div>
