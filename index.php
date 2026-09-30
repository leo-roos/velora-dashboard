<?php
require __DIR__ . "/config.php";

session_start();

if (!isset($_SESSION['user'])) {
	header("Location: " . BASE_URL . "/login");
}
include __DIR__ . "/includes/header.php";
include __DIR__ . "/config.nav.php";

$currentPage = $_GET['page'] ?? '/';
$page;

foreach (NAVIGATION as $item) {
	if ($item['url'] === $currentPage) {
		$page = $item;
		break;
	}
}

if (!isset($page) || !is_array($page)) {
    $page = NAVIGATION[0];
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