<div class="sidebar">
    <div class="server-info">
        <div class="logo">
            <!-- <img src="<?php echo BASE_URL . "/assets/images/logo.png" ?>" alt="logo"> -->
            <div class="text">V</div>
        </div>
        <div class="name">
            Velora Dashboard
        </div>
    </div>
    <nav class="navigation">
        <?php foreach (array_filter(NAVIGATION, function($value) { return !($value['hidden'] ?? false); }) as $item): ?>
            <a href="<?php echo BASE_URL . ($item["url"] != "/" ? "/?page=" .  $item["url"] : "/"); ?>" class="item <?= $item['url'] === $currentPage ? 'active' : '' ?>">
                <i class="<?php echo $item["icon"]; ?>"></i>
                <div class="label"><?php echo $item["title"]; ?></div>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="loggedin">
        <div class="logo">
            <?php
                $avatarUrl = null;
                $avatarHash = $_SESSION['discord_data']['avatar'];
                if (!empty($avatarHash)) {
                    $format = (strpos($avatarHash, 'a_') === 0) ? 'gif' : 'png';
                    
                    $avatarUrl = "https://cdn.discordapp.com/avatars/{$_SESSION['discord_data']["id"]}/{$avatarHash}.{$format}?size=1024";
                }

                if (isset($avatarUrl)) {
                    echo "<img src='{$avatarUrl}' alt=logo>";
                } else {
                    echo '<div class="text">' . htmlspecialchars($_SESSION['discord_data']['global_name'][0]) . '</div>';
                }
            ?>
        </div>
        <div class="name">
            <?php
                echo htmlspecialchars($_SESSION['discord_data']['global_name']);
            ?>
        </div>
    </div>
</div>