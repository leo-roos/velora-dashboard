<div class="hero">
    <div class="welcome">
        Welcome, <?php echo htmlspecialchars($_SESSION['user']['global_name']) ?>!
    </div>
    <div class="overview">
        Quick overview
        <div class="stats">
            <div class="stat">
                <div class="top">
                    <i class="fa-light fa-users"></i>
                    <div class="title">
                        Online Players
                    </div>
                </div>
                <div class="value">
                    <?php echo $serverData["online"]["all"] ?> / <?php echo $serverData["serverSlots"] ?>
                </div>
            </div>
            <div class="stat">
                <div class="top">
                    <i class="fa-light fa-screen-users"></i>
                    <div class="title">
                        Online Staff
                    </div>
                </div>
                <div class="value">
                    5
                </div>
            </div>
            <div class="stat">
                <div class="top">
                    <i class="fa-light fa-user-xmark"></i>
                    <div class="title">
                        Recent Disconnections (1 hour)
                    </div>
                </div>
                <div class="value">
                    124
                </div>
            </div>
            <div class="stat">
                <div class="top">
                    <i class="fa-light fa-users-slash"></i>
                    <div class="title">
                        Recent Bans (24 hours)
                    </div>
                </div>
                <div class="value">
                    <?php echo $serverData["online"]["all"] ?> / <?php echo $serverData["serverSlots"] ?>
                </div>
            </div>
        </div>
    </div>
</div>