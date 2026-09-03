<?php
require __DIR__ . "/config.php";
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
    <?php
    $params = [
        'client_id' => OAUTH2_CLIENT_ID,
        'redirect_uri' => REDIRECT_URL,
        'response_type' => 'code',
        'scope' => 'identify email guilds.join'
    ];

    $authorize_url = 'https://discord.com/api/oauth2/authorize?' . http_build_query($params);

	function is_animated($avatar)
	{
		$ext = substr($avatar, 0, 2);
		if ($ext == "a_")
		{
			return ".gif";
		}
		else
		{
			return ".png";
		}
	}

    ?>

	<a href="<?php echo $authorize_url; ?>">Logga in med Discord</a>
    <?php
		if (!isset($_SESSION['user'])) {
            ?>
            <?php
		}
		else {
    ?>
			<h2> User Details :</h2>
			<p> Name : <?php echo $_SESSION['username'] . '#' . $_SESSION['discrim']; ?></p>
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