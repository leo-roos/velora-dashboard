<?php
$stats = [
    [
        "title" => "Online Players",
        "icon" => "fa-light fa-users",
        "value" => "{$serverData["online"]["all"]} / {$serverData["serverSlots"]}",
    ],
    [
        "title" => "Online Staff",
        "icon" => "fa-light fa-screen-users",
        "value" => 5,
    ],
    [
        "title" => "Recent Disconnections (1 hour)",
        "icon" => "fa-light fa-user-xmark",
        "value" => 124,
    ],
    [
        "title" => "Recent Bans (24 hours)",
        "icon" => "fa-light fa-users-slash",
        "value" => 2,
    ]
];

function renderCard($data) {
    extract($data);
    include __DIR__ . '/../components/card.php';
}
?>

<div class="hero">
    <div class="welcome">
        Welcome, <?php echo htmlspecialchars($_SESSION['discord_data']['global_name']) ?>!
    </div>
    <div class="overview">
        Quick overview
        <div class="stats">
            <?php foreach ($stats as $key => $value) {
                renderCard($value);
            }
            ?>
        </div>
    </div>
</div>