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
let playerData;
if (_serverData) {
    serverData = JSON.parse(_serverData);
    playerData = serverData.players.find((p) => p.id == <?php echo $playerData->id; ?>);
}

const dataUpdateFunctions = [];

function addDataUpdater(func) {
    dataUpdateFunctions.push(func);
}

addDataUpdater(function() {
    playerData = serverData.players.find((p) => p.id == <?php echo $playerData->id; ?>);
})
</script>

<div id="container">
    <?php include_once __DIR__ . '/../includes/sidebar.php'; ?>
    <main class="dashboard">
        <?php include_once __DIR__ . '/../includes/dashboard/header.php'; ?>

        <div class="content player">
            <div class="filters">
                <button class="filter active">
                    Overview
                </button>
                <button class="filter">
                    Inventory
                </button>
                <button class="filter">
                    Vehicles
                </button>
                <button class="filter">
                    Identifiers
                </button>
            </div>

            <div class="title"></div>

            <div class="page-container">
                <div class="info">
                    <div class="left">
                        <img class="profile"
                            src="https://cdn.discordapp.com/avatars/485097247420317708/c7714d4a467ce699f5d07e719f1e0813.png?size=1024">
                    </div>
                    <div class="right">
                        <div class="name"><?php echo htmlspecialchars($playerData->name) ?></div>
                        <div class="id">Player Id: <?php echo htmlspecialchars($playerData->id) ?></div>
                    </div>
                </div>

                <div class="page" id="overview">
                    <div class="row column-3">
                        <?php renderCard([
                            "id" => "account-cash",
                            "title" => "Cash",
                            "icon" => "fa-light fa-wallet",
                            "inputs" => [
                                [
                                    "title" => "",
                                    "type" => "number",
                                    "min" => 0,
                                    "default" => $playerData->accounts->money->value
                                ]
                            ],
                        ]) ?>
                        <script>
                            let changeDetected = false;
                            const accountCash = document.querySelector(".stat#account-cash");
                            const accountCashForm = accountCash.querySelector(".value form");
                            const accountCashInputs = accountCashForm.querySelectorAll(".inputs .input input");
                            const accountCashSave = accountCashForm.querySelector(".save button");

                            function checkChange(input) {
                                if (input.value == "") {
                                    changeDetected = false;
                                    input.classList.remove("changes")
                                    accountCashSave.classList.remove("changes")
                                    return
                                }
                                if (input.value != playerData.accounts.money.value) {
                                    if (!changeDetected) {
                                        changeDetected = true;
                                        input.classList.add("changes")
                                        accountCashSave.classList.add("changes")
                                    }
                                } else {
                                    changeDetected = false;
                                    input.classList.remove("changes")
                                    accountCashSave.classList.remove("changes")
                                }
                            }
                            accountCashInputs.forEach(input => {
                                input.addEventListener("input", function(event) {
                                    checkChange(input);
                                })
                            });
                            accountCashForm.addEventListener("submit", async function(event) {
                                event.preventDefault();
                                if (!changeDetected) return;
                                const url = new URL("http://localhost:5173/velora-dashboard/api/server/action/");
                                const response = await fetch(url, {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                    },
                                    body: JSON.stringify({
                                        action: "modify-account",
                                        playerId: playerData.id,
                                        type: "money",
                                        value: accountCashInputs[0].value,
                                    }),
                                });
                                const text = await response.text();
                                console.log("Response body:", text);
                                setServerData();
                                accountCashForm.reset();
                            })

                            addDataUpdater(function() {
                                console.log("aaaaa")
                                accountCashInputs.forEach(input => {
                                    if (input.id == "account-cash-input") {
                                        input.placeholder = playerData.accounts.money.value
                                    }
                                    checkChange(input);
                                });
                            })
                        </script>
                        <!-- <div class="stat">
                            <div class="top">
                                <i class="fa-light fa-wallet"></i>
                                <div class="title">Cash</div>
                            </div>
                            <div class="value">$12,500</div>
                        </div> -->
                        <!-- <div class="stat">
                            <div class="top">
                                <i class="fa-light fa-bank"></i>
                                <div class="title">Bank</div>
                            </div>
                            <div class="value">$12,500</div>
                        </div>
                        <div class="stat">
                            <div class="top">
                                <i class="fa-light fa-money-bill-wheat"></i>
                                <div class="title">Dirty Money</div>
                            </div>
                            <div class="value">$12,500</div>
                        </div> -->
                    </div>
                    <!-- <div class="row column-2">
                        <div class="stat">
                            <div class="top">
                                <i class="fa-light fa-briefcase"></i>
                                <div class="title">Job</div>
                            </div>
                            <div class="value">Police (police) - Rookie (6)</div>
                        </div>
                        <div class="stat">
                            <div class="top">
                                <i class="fa-light fa-masks-theater"></i>
                                <div class="title">Gang</div>
                            </div>
                            <div class="value">Bloods (bloods) - Recruit (1)</div>
                        </div>
                    </div>
                    <div class="row column-1">
                        <div class="stat">
                            <div class="top">
                                <i class="fa-light fa-address-card"></i>
                                <div class="title">Character Name</div>
                            </div>
                            <div class="value">Leo Andersson</div>
                        </div>
                    </div> -->
                </div>
                <div class="page" id="inventory"></div>
                <div class="page" id="vehicles"></div>
                <div class="page" id="identifiers"></div>
            </div>
        </div>
    </main>
</div>

<script>
let activeFilter = "overview";
const pageTitle = document.querySelector(".content.player .title");
const filters = document.querySelectorAll(".content.player .filters .filter");
const pages = document.querySelectorAll(".content.player .page");
filters.forEach(filter => {
    filter.id = filter.textContent.trim().toLowerCase();

    filter.addEventListener("click", function() {
        document.querySelector(`.filters .filter#${activeFilter}`).classList.remove("active");
        document.querySelector(`.page#${activeFilter}`).classList.remove("active");
        console.log(document.querySelector(`.filters .filter#${activeFilter}`))
        activeFilter = filter.id;
        filter.classList.add("active");
        document.querySelector(`.page#${activeFilter}`).classList.add("active");
        pageTitle.textContent = filter.textContent;
    })
});
pages.forEach(page => {
    if (page.id == activeFilter) {
        page.classList.add("active")
    }
});
pageTitle.textContent = document.querySelector(`.filters .filter#${activeFilter}`).textContent;
</script>

<script src="<?php echo BASE_URL . '/assets/script/main.js?v=' . filemtime($_SERVER['DOCUMENT_ROOT'] . parse_url(BASE_URL, PHP_URL_PATH) . '/assets/script/main.js'); ?>"></script>