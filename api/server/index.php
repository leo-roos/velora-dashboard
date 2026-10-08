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

$data = [
    "onlinePlayers" => 5,
    "onlineStaff" => 2,
    "serverSlots" => 64,
    "recentDisconnections" => 124,
    "recentBans" => 2,

    "players" => [
        [
            "name" => "Leo",
            "id" => 1,
            "character" => [
                "first-name" => "Leo",
                "last-name" => "Andersson",
            ],
        ]
    ]
];

http_response_code(200);
echo json_encode($data);
?>