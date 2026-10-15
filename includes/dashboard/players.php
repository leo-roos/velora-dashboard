<div class="hero">
    <div class="title">Players Dashboard</div>
</div>

<input class="search" type="search" name="search" id="search" placeholder="player name" required autocomplete="off">

<div class="content" id="players">
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
    <a href="players/1" class="item">Leo (1)</a>
</div>

<script>
let searchValue = "";
document.addEventListener("DOMContentLoaded", function() {
    const search = document.querySelector("input.search");
    search.addEventListener("input", function(data) {
        searchValue = search.value;
        updatePlayers();
    })
})

const content = document.querySelector(".content#players");
function updatePlayers() {
    let innerHTML = "";
    serverData.players
        .filter((player) => {
            const search = searchValue.toLowerCase();
            return (
                player.name.toLowerCase().includes(search) || 
                player.id.toString().includes(search)
            );
        })
        .forEach((player) => {
        innerHTML += `
            <a href="players/${player.id}" class="item">${player.name} (${player.id})</a>
        `;
    });
    if (innerHTML == "") {
        innerHTML = `<div class="no-content">No players was found with the search: "${searchValue}"</div>`;
    }
    if (content.innerHTML != innerHTML) {
        content.innerHTML = innerHTML;
    }
}

addDataUpdater(function() {
    updatePlayers();
})
</script>