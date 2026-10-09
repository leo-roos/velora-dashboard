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

$scrollCards = [
    [
        "title" => "Recent Kicks",
        "icon" => "fa-light fa-user-xmark",
        "id" => "recentKicksList",
    ],
    [
        "title" => "Recent Bans",
        "icon" => "fa-light fa-gavel",
        "id" => "recentBansList",
    ],
    [
        "title" => "Active Community Service",
        "icon" => "fa-light fa-list-check",
        "id" => "communityServiceList",
    ],
    [
        "title" => "Recent Staff Actions",
        "icon" => "fa-light fa-shield-halved",
        "id" => "recentStaffActionsList",
    ],
];
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

            foreach ($scrollCards as $card) {
                renderScrollCard($card);
            }
            ?>

        </div>
    </div>
</div>

<script>
const cards = document.querySelectorAll(".stats .stat");
addDataUpdater(function() {
    cards.forEach(card => {
        const value = card.querySelector(".value");
        let content;
        let innerHTML;
        switch (card.id) {
            case "onlinePlayers":
                value.textContent = `${serverData.players.length} / ${serverData.serverSlots}`;
                break;
            case "onlineStaff":
                value.textContent = `${serverData.players.filter(p => p.staff == true).length}`;
                break;
            case "recentDisconnections":
                value.textContent = `${serverData.recentDisconnections.length}`;
                break;
            case "recentBans":
                value.textContent = `${serverData.recentBans.length}`;
                break;
            case "recentKicksList":
                content = card.querySelector(".content");
                innerHTML = "";
                serverData.recentKicks.forEach(player => {
                    innerHTML += `
                    <a href="players/${player.id}" class="item">${player.name} (${player.id})</a>
                    `;
                });
                if (content.innerHTML != innerHTML) {
                    content.innerHTML = innerHTML;
                }
                break;
            case "recentBansList":
                content = card.querySelector(".content");
                innerHTML = "";
                serverData.recentBans.forEach(player => {
                    innerHTML += `
                    <a href="players/${player.id}" class="item">${player.name} (${player.id})</a>
                    `;
                });
                if (content.innerHTML != innerHTML) {
                    content.innerHTML = innerHTML;
                }
                break;
            case "communityServiceList":
                content = card.querySelector(".content");
                innerHTML = "";
                serverData.activeCommunityService.forEach(player => {
                    innerHTML += `
                    <a href="players/${player.id}" class="item">${player.name} (${player.id})</a>
                    `;
                });
                if (content.innerHTML != innerHTML) {
                    content.innerHTML = innerHTML;
                }
                break;
            case "recentStaffActionsList":
                content = card.querySelector(".content");
                innerHTML = "";
                serverData.recentStaffActions.forEach(player => {
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