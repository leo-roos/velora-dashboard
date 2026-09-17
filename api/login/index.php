<?php
require __DIR__ . "/../../config.php";

session_start();

if (isset($_SESSION['valid_till'])) {
	if ($_SESSION['valid_till'] > time()) {
		header("Location: " . BASE_URL . "/");
		exit();
	}
	else {
		$params = [
			'client_id' => OAUTH2_CLIENT_ID,
			'client_secret' => OAUTH2_CLIENT_SECRET,
			'grant_type'    => 'refresh_token',
        	'refresh_token' => $_SESSION['refresh_token'],
		];

		$url = "https://discord.com/api/oauth2/token";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($curl);
		$results = json_decode($response, true);
		if (isset($results['access_token'])) {
			$_SESSION['access_token'] = $results['access_token'];
			$_SESSION['refresh_token'] = $results['refresh_token'];
			$_SESSION['valid_till'] = time() + $results['expires_in'];
		}
		else {
			session_unset();
			session_destroy();
			header("Location: " . BASE_URL . "/");
			exit();
		}
	}
}

function generateAuthorizeURL() {
	$params = [
		'client_id' => OAUTH2_CLIENT_ID,
		'redirect_uri' => REDIRECT_URL,
		'response_type' => 'code',
		'scope' => 'identify email guilds.join'
	];

	return 'https://discord.com/api/oauth2/authorize?' . http_build_query($params);
}

$authorize_url = generateAuthorizeURL();

if (!isset($_GET['code'])) {
    header("Location: $authorize_url");
    exit();
}


$code = $_GET['code'];
$url = "https://discord.com/api/oauth2/token";
$params = array(
	"client_id" => OAUTH2_CLIENT_ID,
	"client_secret" => OAUTH2_CLIENT_SECRET,
	"grant_type" => "authorization_code",
	"code" => $code,
	"redirect_uri" => REDIRECT_URL
);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
$results = json_decode($response, true);
$_SESSION['access_token'] = $results['access_token'];
$_SESSION['refresh_token'] = $results['refresh_token'];

if (!isset($results['access_token'])) {
    // Handle error or expired code
    session_unset();
    session_destroy();
    header("Location: $authorize_url");
    exit();
}

// Use the access token to get user information
$urlUsers = "https://discord.com/api/users/@me";
$headersUser = array('Content-Type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $_SESSION['access_token']);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $urlUsers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headersUser);
$responseUser = curl_exec($curl);
$resultsUser = json_decode($responseUser, true);
$_SESSION['user'] = $resultsUser;
$_SESSION['username'] = $resultsUser['username'];
$_SESSION['discriminator'] = $resultsUser['discriminator'] ?? '0';
$_SESSION['user_id'] = $resultsUser['id'];
$_SESSION['user_avatar'] = $resultsUser['avatar'];
$_SESSION['valid_till'] = time() + $results['expires_in'];


// Add the user to the Discord server using the bot token
// $urlUser = "https://discord.com/api/v10/guilds/" . DISCORD_GUILD_ID . "/members/" . $_SESSION['user_id'];
// $data = [
// 	'access_token' => $_SESSION['access_token']
// ];

// $ch = curl_init($urlUser);
// curl_setopt_array($ch, [
// 	CURLOPT_CUSTOMREQUEST  => 'PUT', 
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_POSTFIELDS     => json_encode($data),
// 	CURLOPT_HTTPHEADER     => [
// 		"Authorization: Bot " . BOT_TOKEN, // Det är boten som utför handlingen
// 		"Content-Type: application/json"
// 	]
// ]);

// $response = curl_exec($ch);
// $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// if ($httpCode !== 201 && $httpCode !== 204) {
// 	echo("Misslyckades att lägga till användare. HTTP-kod: $httpCode. Svar: " . $response);
// 	exit();
// }


// Open a DM channel with the user
// $ch = curl_init("https://discord.com/api/v10/users/@me/channels");
// curl_setopt_array($ch, [
// 	CURLOPT_POST           => true,
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_POSTFIELDS     => json_encode(['recipient_id' => $_SESSION['user_id']]),
// 	CURLOPT_HTTPHEADER     => [
// 		"Authorization: Bot " . BOT_TOKEN,
// 		"Content-Type: application/json"
// 	]
// ]);

// $response = json_decode(curl_exec($ch), true);

// if (!isset($response['id'])) {
// 	echo ("Kunde inte öppna DM-kanal. Delar botten och användaren en server?");
// 	exit();
// }

// Send a message to the user in the DM channel
// $channelId = $response['id'];
// $ch = curl_init("https://discord.com/api/v10/channels/$channelId/messages");
// curl_setopt_array($ch, [
// 	CURLOPT_POST           => true,
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_POSTFIELDS     => json_encode(['content' => "Detta är ett automatiskt meddelande från Velora Dashboard. Du har loggat in med Discord och har nu tillgång till dashboarden."]),
// 	CURLOPT_HTTPHEADER     => [
// 		"Authorization: Bot " . BOT_TOKEN,
// 		"Content-Type: application/json"
// 	]
// ]);
// curl_exec($ch);

header("Location: " . BASE_URL . "/");
?>