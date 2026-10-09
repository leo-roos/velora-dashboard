<?php
require __DIR__ . "/config.php";
require __DIR__ . "/functions.php";

session_start();

if (!isset($_SESSION['discord_data'])) {
	header("Location: " . BASE_URL . "/login");
}

include __DIR__ . "/includes/head.php";
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

$serverData = file_get_contents("http://localhost:5173/velora-dashboard/api/server/");
$serverData = json_decode($serverData);
?>

<script>
	const _serverData = <?php echo var_export(json_encode($serverData)); ?>

	let serverData;
	if (_serverData) {
		serverData = JSON.parse(_serverData);
	}

	const dataUpdateFunctions = [];
	function addDataUpdater(func) {
		dataUpdateFunctions.push(func);
	}
</script>

<div id="container">
	<?php include_once __DIR__ . '/includes/sidebar.php'; ?>
	<main class="dashboard">
		<?php
			include_once __DIR__ . '/includes/dashboard/header.php';
			echo '<div class="content ' . ($page['url'] == "/" ? "main" : $page['url']) . '">';
			include_once __DIR__ . '/includes/dashboard/' . $page['page'];
			echo '</div>';
		?>
	</main>
</div>

<script src="<?php echo BASE_URL . '/assets/script/main.js?v=' . filemtime($_SERVER['DOCUMENT_ROOT'] . parse_url(BASE_URL, PHP_URL_PATH) . '/assets/script/main.js'); ?>"></script>

<?php
include __DIR__ . "/includes/footer.php";
?>