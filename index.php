<?php
require __DIR__ . "/config.php";

session_start();

if (!isset($_SESSION['user'])) {
	header("Location: " . BASE_URL . "/login");
}
include __DIR__ . "/includes/header.php";

$navigation = [
	[
		'title' => "Overview",
		'url'   => "/",
		'page' => "main.php",
		'icon'  => "fa-light fa-table-columns",
	],
	[
		'title' => "Analytics",
		'url'   => "analytics",
		'page' => "analytics.php",
		'icon'  => "fa-light fa-chart-line network",
	],
	[
		'title' => "Players",
		'url'   => "players",
		'page' => "players.php",
		'icon'  => "fa-light fa-users",
	],
	[
		'title' => "Logbook",
		'url'   => "logbook",
		'page' => "logbook.php",
		'icon'  => "fa-light fa-book-open",
	],
	[
		'title' => "Settings",
		'url'   => "settings",
		'page' => "settings.php",
		'icon'  => "fa-light fa-sliders",
	]
];

$currentPage = $_GET['page'] ?? '/';
$page = 'main.php';

foreach ($navigation as $item) {
	if ($item['url'] === $currentPage) {
		$page = $item;
		break;
	}
}

$serverData = [ // mock server data
	'serverSlots' => 64,
	'online' => [
		'all' => 10,
		'staff' => 2,
	],
]

?>

<div id="container">
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
			<?php foreach ($navigation as $item): ?>
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
					$avatarHash = $_SESSION['user']['avatar'];
					if (!empty($avatarHash)) {
						$format = (strpos($avatarHash, 'a_') === 0) ? 'gif' : 'png';
						
						$avatarUrl = "https://cdn.discordapp.com/avatars/{$_SESSION['user']["id"]}/{$avatarHash}.{$format}?size=1024";
					}

					if (isset($avatarUrl)) {
						echo "<img src='{$avatarUrl}' alt=logo>";
					} else {
						echo '<div class="text">' . htmlspecialchars($_SESSION['user']['global_name'][0]) . '</div>';
					}
				?>
			</div>
			<div class="name">
				<?php
					echo htmlspecialchars($_SESSION['user']['global_name']);
				?>
			</div>
		</div>
	</div>
	<main class="dashboard">
		<?php
			include_once __DIR__ . '/includes/dashboard/header.php';
			echo '<div class="content ' . ($page['url'] == "/" ? "main" : $page['url']) . '">';
			include_once __DIR__ . '/includes/dashboard/' . $page['page'];
			echo '</div>';
		?>
	</main>
</div>

<?php
include __DIR__ . "/includes/footer.php";
?>