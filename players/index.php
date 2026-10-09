<?php
require __DIR__ . "/../config.php";
require __DIR__ . "/../functions.php";

session_start();

if (!isset($_SESSION['discord_data'])) {
	header("Location: " . BASE_URL . "/login");
}

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (preg_match('#^/velora-dashboard/players/([0-9]+)$#', $requestUri, $matches)) {
    $playerValue = $matches[1];
}

if (!isset($playerValue)) {
	header("Location: " . BASE_URL . "/?page=players");
    exit();
}

include __DIR__ . "/../includes/head.php";
include __DIR__ . "/../config.nav.php";

$currentPage;
$page;

$serverData = file_get_contents("http://localhost:5173/velora-dashboard/api/server/");
$serverData = json_decode($serverData);

foreach ($serverData->players as $key => $value) {
    if ($value->id == $playerValue) {
        $playerData = $value;
    }
}

if (!isset($playerData)) {
	header("Location: " . BASE_URL . "/?page=players");
    exit();
}

foreach (NAVIGATION as $item) {
	if ($item['url'] === "players") {
        $currentPage = $item["url"];
		$page = $item;
        $page["parentPage"] = $playerData->id;
		break;
	}
}
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
    <?php include_once __DIR__ . '/../includes/sidebar.php'; ?>
    <main class="dashboard">
        <?php include_once __DIR__ . '/../includes/dashboard/header.php'; ?>

        <div class="content <?php echo htmlspecialchars($page['url'] == "/" ? "main" : $page['url']) ?>">
            <?php echo $playerData->name ?> (ID: <?php echo $playerData->id ?>)
        </div>
    </main>
</div>