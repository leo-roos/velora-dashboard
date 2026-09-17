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

<div class="sidebar">
	<div class="server-info">
		<div class="logo">
			<img src="<?php echo BASE_URL . "/assets/images/logo.png" ?>" alt="logo">
		</div>
		<div class="name">
			Velora Dashboard
		</div>
	</div>
	<nav class="nagivation">
		<div class="item">
			<div class="icon"></div>
			<div class="label">Dashboard</div>
		</div>
		<div class="item">
			<div class="icon"></div>
			<div class="label">Analytics</div>
		</div>
		<div class="item">
			<div class="icon"></div>
			<div class="label">Players</div>
		</div>
		<div class="item">
			<div class="icon"></div>
			<div class="label">Logbook</div>
		</div>
		<div class="item">
			<div class="icon"></div>
			<div class="label">Settings</div>
		</div>
	</nav>
</div>
<main class="dashboard">
	
</main>

<?php
include __DIR__ . "/includes/footer.php";
?>