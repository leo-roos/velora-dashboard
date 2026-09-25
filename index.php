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
			<a href="<?php echo BASE_URL . "/" ?>" class="item">
				<i class="fa-solid fa-chart-pie"></i>
				<div class="label">Dashboard</div>
			</a>
			<a href="<?php echo BASE_URL . "/?page=analytics" ?>" class="item">
				<i class="fa-solid fa-chart-line network"></i>
				<div class="label">Analytics</div>
			</a>
			<a href="<?php echo BASE_URL . "/?page=players" ?>" class="item">
				<i class="fa-solid fa-users"></i>
				<div class="label">Players</div>
			</a>
			<a href="<?php echo BASE_URL . "/?page=logbook" ?>" class="item">
				<i class="fa-solid fa-book-open"></i>
				<div class="label">Logbook</div>
			</a>
			<a href="<?php echo BASE_URL . "/?page=settings" ?>" class="item">
				<i class="fa-solid fa-sliders"></i>
				<div class="label">Settings</div>
			</a>
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
			$page = $_GET['page'] ?? "main";
			include_once(__DIR__ . "/includes/dashboard/" . $page . ".php");
		?>
	</main>
</div>

<?php
include __DIR__ . "/includes/footer.php";
?>

<?php
// header("Refresh: 1");
?>