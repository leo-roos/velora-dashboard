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
    "serverSlots" => 64,

    "players" => [
        [
            "name" => "Leo",
            "id" => 1,
            "staff" => true,
            "character" => [
                "first-name" => "Leo",
                "last-name" => "Andersson",
            ],
        ],
    ],
    "recentKicks" => [
        [
            "name" => "Leo",
            "id" => 1,
            "staff" => true,
        ],
    ],
    "recentBans" => [
        [
            "name" => "Leo",
            "id" => 1,
            "staff" => true,
        ],
    ],
    "recentDisconnections" => [
        [
            "name" => "Leo",
            "id" => 1,
            "staff" => true,
        ],
    ],
    "activeCommunityService" => [
        [
            "name" => "Leo",
            "id" => 1,
            "staff" => true,
        ],
    ],
    "recentStaffActions" => [
        [
            "name" => "Leo",
            "id" => 1,
            "staff" => true,
        ],
    ],
];

http_response_code(200);
echo json_encode($data);
?>