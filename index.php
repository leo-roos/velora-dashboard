<?php
require __DIR__ . "/config.php";

session_start();

if (!isset($_SESSION['user'])) {
	header("Location: " . BASE_URL . "/login");
}
include __DIR__ . "/includes/header.php";

$navigation = [
	[
		'title' => "Dashboard",
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
	'online' => 10,
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
				<!-- <img src="<?php echo BASE_URL . "/assets/images/logo.png" ?>" alt="logo"> -->
				<div class="text">
					<?php
						echo $_SESSION['user']['global_name'][0];
					?>
				</div>
			</div>
			<div class="name">
				<?php
					echo $_SESSION['user']['global_name'];
				?>
			</div>
		</div>
	</div>
	<main class="dashboard">
		<?php
			include_once __DIR__ . '/includes/dashboard/header.php';
			echo '<div class="content">';
			include_once __DIR__ . '/includes/dashboard/' . $page['page'];
			echo '</div>';
		?>
	</main>
</div>

<?php
include __DIR__ . "/includes/footer.php";
?>