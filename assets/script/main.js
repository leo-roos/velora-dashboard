document.addEventListener("DOMContentLoaded", async function() {
	async function setServerData() {
        const url = new URL("http://localhost:5173/velora-dashboard/api/server/");

        if (serverData?.version) {
            url.searchParams.append("version", serverData.version);
        }

		const res = await fetch(url.toString());
		const data = await res.json();
        serverData = data;
        dataUpdateFunctions.forEach(func => {
            func();
        });

        console.log(data);
	}
	
    setServerData();
    var intervalID = window.setInterval(setServerData, 500);
})