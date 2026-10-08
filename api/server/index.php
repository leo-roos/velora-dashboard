<?php
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

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>