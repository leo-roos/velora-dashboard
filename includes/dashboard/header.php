<div class="header">
    <div class="left">
        <i class="fa-light fa-table-columns"></i>
        <div class="breadcrumbs">
            <a href="<?php echo BASE_URL . "/" ?>">Dashboard</a>
            <?php
                if ($currentPage != "/") {
                    echo '<a class="breadcrumb">';
                    // echo '<a href="'. BASE_URL . '/?page='. $currentPage . '" class="breadcrumb">';
                    echo $page['title'];
                    echo '</a>';
                }
            ?>
        </div>
    </div>
    <div class="right">
        <div class="online">
            <i class="fa-solid fa-globe"></i>
            <div class="value">
                <?php echo $serverData["online"] ?> / <?php echo $serverData["serverSlots"] ?>
            </div>
        </div>
    </div>
</div>