async function setServerData() {
    const url = new URL("http://localhost:5173/velora-dashboard/api/server/");

    const res = await fetch(url.toString());
    const data = await res.json();

    if (res.ok == false) {
        window.location.href = "http://localhost:5173/velora-dashboard/login"
    }

    serverData = data;
    dataUpdateFunctions.forEach(func => {
        func();
    });

    console.log(data);
}

document.addEventListener("DOMContentLoaded", async function() {
    dataUpdateFunctions.forEach(func => {
        func();
    });
	setServerData();
    var intervalID = window.setInterval(setServerData, 1000);
})