<?php
header('Content-Type: application/json; charset=utf-8');

$isFromServer = $_SERVER['REMOTE_ADDR'] === $_SERVER['SERVER_ADDR'] || $_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1';
if (!$isFromServer) {
    session_start();
    if (!isset($_SESSION['discord_data'])) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized", "message" => "Du måste vara inloggad."]);
        exit();
    }
}

require __DIR__ . "/../../config.php";

$cacheData = file_get_contents(__DIR__ . "/../../cache/apidata.json");

// exit();

$url = "https://fivem.lajo.dev/velora/api/data?version=1";

$options = [
    "http" => [
        "method" => "GET",
        "header" => "Authorization: Bearer " . API_KEY . "\r\n" .
                    // "Content-Type: application/json\r\n" .
                    "Accept: application/json, text/plain\r\n"
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

if ($response === false) {
    http_response_code(404);
    echo "";
    exit();
} else {
    http_response_code(200);
    echo $response;
}

// $data = [
//     "serverSlots" => 64,

//     "players" => [
//         [
//             "name" => "Leo",
//             "id" => 1,
//             "staff" => true,
//             "character" => [
//                 "first-name" => "Leo",
//                 "last-name" => "Andersson",
//             ],
//         ],
//     ],
//     "recentKicks" => [
//         [
//             "name" => "Leo",
//             "id" => 1,
//             "staff" => true,
//         ],
//     ],
//     "recentBans" => [
//         [
//             "name" => "Leo",
//             "id" => 1,
//             "staff" => true,
//         ],
//     ],
//     "recentDisconnections" => [
//         [
//             "name" => "Leo",
//             "id" => 1,
//             "staff" => true,
//         ],
//     ],
//     "activeCommunityService" => [
//         [
//             "name" => "Leo",
//             "id" => 1,
//             "staff" => true,
//         ],
//     ],
//     "recentStaffActions" => [
//         [
//             "name" => "Leo",
//             "id" => 1,
//             "staff" => true,
//         ],
//     ],
// ];

// http_response_code(200);
// echo json_encode($data);
?>