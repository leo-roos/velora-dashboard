<div class="header">
    <div class="left">
        <i class="fa-light fa-table-columns"></i>
        <div class="breadcrumbs">
            <a href="<?php echo BASE_URL . "/" ?>">Dashboard</a>
            <?php
                if ($currentPage != "/") {
                    if (isset($page["parentPage"])) {
                        echo '<a href="'. BASE_URL . '/?page='. $currentPage . '" class="breadcrumb">';
                    } else {
                        echo '<a class="breadcrumb">';
                    }
                    echo $page['title'];
                    echo '</a>';
                }
                if (isset($page["parentPage"])) {
                    echo '<a class="breadcrumb">';
                    echo $page["parentPage"];
                    echo '</a>';
                }
            ?>
        </div>
    </div>
    <div class="right">
        <div class="online">
            <i class="fa-solid fa-globe"></i>
            <div class="value">
                <?php echo htmlspecialchars(count($serverData->players)) ?> / <?php echo htmlspecialchars($serverData->serverSlots) ?>
            </div>
        </div>
    </div>
</div>

<script>
const onlinePlayers = document.querySelector(".header .right .online .value");
addDataUpdater(function() {
    const newTextContent = `${serverData.players.length} / ${serverData.serverSlots}`;
    if (onlinePlayers.textContent != newTextContent) {
        onlinePlayers.textContent = newTextContent;
    }
});
</script>