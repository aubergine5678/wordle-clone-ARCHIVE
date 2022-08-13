function sleep(milliseconds) {return new Promise(resolve => setTimeout(resolve, milliseconds));}

function sendGameResults(gameMode, username, attempts, time) {
    let url = "";                   // Leaderboard service URL
    gameMode = "game" + gameMode;   // Convert gameMode to correct format
    const xhr = new XMLHttpRequest();

    // Check if all fields are filled
    if (gameMode == "" || username == "" || attempts == "" || time == "") {
        console.log("One or more of the parameters empty, not sending results.");
        return false;
    }

    // Create game object
    let game = {
        gamemode: gameMode,
        username: username,
        attempts: attempts,
        time: time
    }

    xhr.open("POST", url);
    xhr.send(JSON.stringify(game));

    xhr.onerror = function() {
        console.log("Network error occurred: " + xhr.status)
        return false;
    }

    xhr.onload = function() {
        if (xhr.status == 201) {
            console.log("Results sent");
            return true;
        } else {
            console.log("Error sending results: " + xhr.status);
            return false;
        }
    }
}

async function getGameResults(gamemode) {
    let url = "";       // Leaderboard service URL
    const response = await fetch(url);
    var results = await response.json();
    sleep(1000);

    let filteredResults = results.filter(function(result) {
        return result.gamemode == gamemode;
    });

    filteredResults.sort((a, b) => {
        return a.id - b.id;
    });

    filteredResults.sort((a, b) => {
        return a.attempts - b.attempts;
    });

    filteredResults.sort((a, b) => {
        return a.time - b.time;
    });

    // ------------------------------------------
    let data = filteredResults;

    const llist = document.getElementById("l-list");
    llist.replaceChildren();

    // #forLoopOfDoom
    for (var i = 0; i < 21; i++) {
        var Lusername = data[i].username;
        var Lattempts = data[i].attempts;
        var Ltime = data[i].time;

        const li = document.createElement("li");
        li.setAttribute("id", "l-item");

        const h2 = document.createElement("h2");
        h2.setAttribute("id", "l-name");

        const div = document.createElement("div");
        div.setAttribute("id", "l-stats");

        const attempts = document.createElement("small");
        attempts.setAttribute("id", "l-guesses");

        const time = document.createElement("small");
        time.setAttribute("id", "l-time");

        div.appendChild(time);
        div.appendChild(attempts);
        li.appendChild(h2);
        li.appendChild(div);

        llist.appendChild(li);

        h2.textContent = Lusername;
        attempts.innerHTML = Lattempts;

        if (Ltime < 60) {
            var min = "00";
        } else if (Math.floor(Ltime/60) < 10) {
            var min = "0" + Math.floor(Ltime/60);
        } else {
            var min = Math.floor(Ltime/60);
        }

        if (Ltime%60 < 10) {
            var sec = "0" + (Ltime % 60);
        } else if ((Ltime % 60) == 0) {
            var sec = "00";
        } else {
            var sec = (Ltime % 60);
        }

        var timeFormatted = min + ":" + sec;
        time.innerHTML = timeFormatted;
    }
}