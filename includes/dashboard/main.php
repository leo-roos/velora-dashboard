<?php
$stats = [
    [
        "title" => "Online Players",
        "icon" => "fa-light fa-users",
        "id" => "onlinePlayers",
    ],
    [
        "title" => "Online Staff",
        "icon" => "fa-light fa-screen-users",
        "id" => "onlineStaff",
    ],
    [
        "title" => "Recent Disconnections (1 hour)",
        "icon" => "fa-light fa-user-xmark",
        "id" => "recentDisconnections",
    ],
    [
        "title" => "Recent Bans (24 hours)",
        "icon" => "fa-light fa-users-slash",
        "id" => "recentBans",
    ]
];

function renderCard($data) {
    extract($data);
    include __DIR__ . '/../components/card.php';
}
function renderScrollCard($data) {
    extract($data);
    include __DIR__ . '/../components/card-scroll.php';
}
?>

<div class="hero">
    <div class="welcome">
        Welcome, <?php echo htmlspecialchars($_SESSION['discord_data']['global_name']) ?>!
    </div>
    <div class="overview">
        Quick overview
        <div class="stats">
            <?php 
            foreach ($stats as $key => $value) {
                renderCard($value);
            }

            renderScrollCard([
                "title" => "Online Players",
                "icon" => "fa-light fa-users",
                "id" => "testPlayers",
            ]);
            ?>
            
        </div>
    </div>
</div>

<script>
const cards = document.querySelectorAll(".stats .stat");
addDataUpdater(function() {
    cards.forEach(card => {
        const value = card.querySelector(".value");
        switch (card.id) {
            case "onlinePlayers":
                value.textContent = `${serverData.onlinePlayers} / ${serverData.serverSlots}`;
                break;
            case "onlineStaff":
                value.textContent = `${serverData.onlineStaff}`;
                break;
            case "recentDisconnections":
                value.textContent = `${serverData.recentDisconnections}`;
                break;
            case "recentBans":
                value.textContent = `${serverData.recentBans}`;
                break;
            case "testPlayers":
                const content = card.querySelector(".content");
                let innerHTML = "";
                serverData.players.forEach(player => {
                    innerHTML += `
                    <a href="players/${player.id}" class="item">${player.name} (${player.id})</a>
                    `;
                });
                if (content.innerHTML != innerHTML) {
                    content.innerHTML = innerHTML;
                }
                break;
            default:
                break;
        }
    });
});
</script>