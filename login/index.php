<?php
require __DIR__ . "/../config.php";

session_start();

if (isset($_SESSION['valid_till'])) {
	if ($_SESSION['valid_till'] > time()) {
		header("Location: http://localhost:5173/velora-dashboard/");
		exit();
	}
	else {
		$data = [
			'client_id' => OAUTH2_CLIENT_ID,
			'client_secret' => OAUTH2_CLIENT_SECRET,
			'grant_type'    => 'refresh_token',
        	'refresh_token' => $_SESSION['refresh_token'],
		];

		$url = "https://discord.com/api/oauth2/token";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
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
			header("Location: http://localhost:5173/velora-dashboard/");
			exit();
		}
	}
}

$params = [
	'client_id' => OAUTH2_CLIENT_ID,
	'redirect_uri' => REDIRECT_URL,
	'response_type' => 'code',
	'scope' => 'identify email'
];

$authorize_url = 'https://discord.com/api/oauth2/authorize?' . http_build_query($params);

if (!isset($_GET['code'])) {
    header("Location: $authorize_url");
    exit();
}

$code = $_GET['code'];
$url = "https://discord.com/api/oauth2/token";
$data = array(
	"client_id" => OAUTH2_CLIENT_ID,
	"client_secret" => OAUTH2_CLIENT_SECRET,
	"grant_type" => "authorization_code",
	"code" => $code,
	"redirect_uri" => REDIRECT_URL
);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
$results = json_decode($response, true);
$_SESSION['access_token'] = $results['access_token'];
$_SESSION['refresh_token'] = $results['refresh_token'];

print_r($results);

if (!isset($results['access_token'])) {
    // Handle error or expired code
    session_unset();
    session_destroy();
    header("Location: $authorize_url");
    exit();
}

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
$_SESSION['discrim'] = $resultsUser['discriminator'] ?? '0';
$_SESSION['user_id'] = $resultsUser['id'];
$_SESSION['user_avatar'] = $resultsUser['avatar'];
$_SESSION['valid_till'] = time() + $results['expires_in'];

header("Location: http://localhost:5173/velora-dashboard/");
?>