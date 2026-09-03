<?php
require __DIR__ . "/../config.php";

session_start();

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
curl_close($curl);
$results = json_decode($response, true);
$_SESSION['access_token'] = $results['access_token'];

if (!isset($_SESSION['access_token'])) {
	echo "Failed to get access_token";
	return;
}

$urlUsers = "https://discord.com/api/users/@me";
$headers = array('Content-Type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $_SESSION['access_token']);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $urlUsers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($curl);
curl_close($curl);
$results = json_decode($response, true);
$_SESSION['user'] = $results;
$_SESSION['username'] = $results['username'];
$_SESSION['discrim'] = $results['discriminator'];
$_SESSION['user_id'] = $results['id'];
$_SESSION['user_avatar'] = $results['avatar'];
# Fetching email 
if ($email == True) {
	$_SESSION['email'] = $results['email'];
}

header("Location: http://localhost:5173/velora-dashboard/");
?>