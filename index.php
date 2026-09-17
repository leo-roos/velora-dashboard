<?php
require __DIR__ . "/config.php";
require __DIR__ . "/functions.php";

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velora Dashboard</title>
</head>
<body>
	<a href="<?php echo $authorize_url; ?>">Logga in med Discord</a>

    <?php
		if (!isset($_SESSION['user'])) {
	?>
		<!-- elements shown when not logged in -->
	<?php
		}
		else {
    ?>
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
		}
		?>
</body>
</html>