<?php
require __DIR__ . "/config.php";

session_start();

if (!isset($_SESSION['user'])) {
	header("Location: " . BASE_URL . "/login");
}
?>


<?php
include __DIR__ . "/includes/header.php";
?>

<a href="<?php echo "" . BASE_URL . "/logout" ?>">Logout</a>

<h2> User Details :</h2>
<p> Name : <?php echo $_SESSION['username'] . '#' . $_SESSION['discriminator']; ?></p>
<p> ID : <?php echo $_SESSION['user_id']; ?></p>
<?php
	if (isset($_SESSION['email'])) {
		echo '<p> Email: ' . $_SESSION['email'] . '</p>';
	}
?>

<p> Profile Picture : <img src="https://cdn.discordapp.com/avatars/<?php $extention = is_animated($_SESSION['user_avatar']);
																	echo $_SESSION['user_id'] . "/" . $_SESSION['user_avatar'] . $extention; ?>" /></p>
<br>
<h2>User Response :</h2>
<div class="response-block">
	<p><?php echo json_encode($_SESSION['user']); ?></p>
</div>

<?php
include __DIR__ . "/includes/footer.php";
?>