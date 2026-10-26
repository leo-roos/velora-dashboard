<?php
$isFromServer = $_SERVER['REMOTE_ADDR'] === $_SERVER['SERVER_ADDR'] || $_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1';
if (!$isFromServer) {
    session_start();
    if (!isset($_SESSION['discord_data'])) {
        http_response_code(401);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(["error" => "Unauthorized", "message" => "Du måste vara inloggad."]);
        exit();
    }
}

require __DIR__ . "/../../../config.php";
$cacheFile = __DIR__ . "/../../../cache/apidata.json";

if (file_exists($cacheFile)) {
    $cacheData = file_get_contents($cacheFile);
}

$data = json_decode(file_get_contents("php://input"));
$action = $data->action;
$playerId = $data->playerId;

header('Content-Type: application/json; charset=utf-8');
if ($action == "modify-account") {
    $type = $data->type;
    $value = $data->value;

    $url = "https://fivem.lajo.dev/velora/api/action";

    $options = [
        "http" => [
            "method" => "POST",
            "header" =>
                "Authorization: Bearer " . API_KEY . "\r\n" .
                "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n",
            "content" => json_encode($data),
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response);

    print_r($result);
}