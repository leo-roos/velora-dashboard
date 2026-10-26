<?php
require __DIR__ . "/../../../config.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "Method Not Allowed"]);
    exit();
}

$headers = getallheaders();
$authorization = $headers["Authorization"] ?? '';
$cacheFile = __DIR__ . "/../../../cache/apidata.json";

if ($authorization != ("Bearer " . API_KEY)) {
    exit();
}

$rawPayload = file_get_contents('php://input');
$payload = json_decode($rawPayload, true);

if (isset($payload)) {
    $data = $payload["data"];
    if (!isset($data)) {
        exit();
    }

    if (file_exists($cacheFile)) {
        $cacheData = file_get_contents($cacheFile);
        $cacheData = json_decode($cacheData, true);
    }
    if ((int) $data["version"] <= (int) $cacheData["version"]) {
        http_response_code(200);
        echo json_encode(["status" => "skipped", "message" => "Server is already up to date with this version."]);
        exit();
    }

    file_put_contents($cacheFile, json_encode($data));
}

?>