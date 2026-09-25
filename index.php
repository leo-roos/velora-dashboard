<?php
require __DIR__ . "/config.php";

session_start();

if (!isset($_SESSION['user'])) {
	header("Location: " . BASE_URL . "/login");
}
?>

<?php
include __DIR__ . "/includes/header.php";
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
			<?php
				$navigation = [
					[
						'title' => "Dashboard",
						'url'   => "/",
						'icon'  => "fa-light fa-table-columns",
					],
					[
						'title' => "Analytics",
						'url'   => "/?page=analytics",
						'icon'  => "fa-light fa-chart-line network",
					],
					[
						'title' => "Players",
						'url'   => "/?page=players",
						'icon'  => "fa-light fa-users",
					],
					[
						'title' => "Logbook",
						'url'   => "/?page=logbook",
						'icon'  => "fa-light fa-book-open",
					],
					[
						'title' => "Settings",
						'url'   => "/?page=settings",
						'icon'  => "fa-light fa-sliders",
					]
				];
			?>

			<?php foreach ($navigation as $item): ?>
				<a href="<?php echo BASE_URL . $item["url"]; ?>" class="item">
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
			$pages = [
				'main' => 'main.php',
				'analytics' => 'analytics.php',
				'players' => 'players.php',
				'logbook' => 'logbook.php',
				'settings' => 'settings.php',
			];

			$page = $_GET['page'] ?? 'main';

			if (!isset($pages[$page])) {
				$page = 'main';
				// header('Location: '. BASE_URL . '/404.php');
			}

			include_once __DIR__ . '/includes/dashboard/header.php';
			echo '<div class="content">';
			include_once __DIR__ . '/includes/dashboard/' . $pages[$page];
			echo '</div>';
		?>
	</main>
</div>

<?php
include __DIR__ . "/includes/footer.php";
?>

<?php
// header("Refresh: 1");
?>