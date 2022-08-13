// -------------------------------------------------------
// Main game code. 
// This wasn't written by me, that'w why it's so ugly
// -------------------------------------------------------

var grid = document.getElementsByClassName("cells");
var message = document.getElementById("message");
var keys = document.getElementsByClassName("keys");
var timer = document.getElementById("timer");
var valid = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
var gridClass = [];
var line = false; // true if the row is complete
var data;
var toFind;
var wordLength = grid.length / 6;
var nav_state = false;
var formActive = false; // not typing process
var time = 1;
var startTimer = false;
var guesses = 0;
var theme = "normal";
var correct = "green";
var present = "yellow";
var wrong = "grey";
var won = false;

// Set the username variable based on the contents of the meta tag useing jQuery
let username = $("meta[name='username']").attr("username");

// Set gamemode variable same as for username above
let gameMode = $("meta[name='gameMode']").attr("gamemode");

fetch(wordLength + "letters.txt")
    .then(r => r.text())
    .then(t => save(t))

function save(t) {
    data = t.split("\n");
    for (var i = 0; i < data.length; i++) {
        data[i] = data[i].trim();
    }
    toFind = data[Math.floor(Math.random() * data.length)];

    if (wordLength == 5) {
        fetch("5letters_pick.txt")
            .then(r => r.text())
            .then(t => find(t))
    }
}

function find(t) {
    var d = t.split("\n");
    for (var i = 0; i < d.length; i++) { d[i] = d[i].trim(); }
    toFind = d[Math.floor(Math.random() * d.length)];
}

// converts the divs to class elements
for (let i = 0; i < grid.length; i++) {
    id = grid[i].id;
    col = id.split("-")[1];
    row = id.split("-")[0];
    gridClass[i] = new Cell(grid[i], col, row, "", "default");
}

function myKeyPress(e) {
    if (formActive == false) { keyInput(e); }
}

function keyInput(e) {
    var key;

    if (Number.isInteger(e)) { key = e; } // mobile 
    else if (e == "enter") { key = 13 } else if (e == "del") { key = 8 } // js
    else if (window.event) { key = e.keyCode; } // IE
    else if (e.which) { key = e.which; } // Netscape/Firefox/Opera


    message.style.display = "none";

    if (key == 13 && line == true) { // if enter
        var word = "";
        for (var cell of gridClass) { word += cell.content; }
        if (data.includes(word)) {
            guesses++;
            checkMatch(word);
            line = false; // start on new line
            gridClass.splice(0, wordLength); // remove the completed line
        }

    } else if (key == 8) { // if backspace

        reverseGrid = gridClass.slice();
        reverseGrid.reverse(); // make reverse copy of array

        for (var cell of reverseGrid) { // iterate trough the reverse copy
            if (cell.content != "") {
                cell.content = "";
                cell.div.innerHTML = "";
                if (cell.col == wordLength) { line = false; }
                highlight(cell);
                break;
            }
        }

    } else if (!won) {
        key = String.fromCharCode(key).toLowerCase(); // convert to lowercase string

        if (valid.includes(key)) { // if a key is pressed display it
            startTimer = true;
            for (var cell of gridClass) {
                if (cell.content == "" && line == false) {
                    cell.content = key;
                    cell.div.innerHTML = key.toUpperCase();
                    if (cell.col == wordLength) { line = true; }
                    highlight(cell);
                    break;
                }
            }
        }
    }
}

function checkMatch(word) {
    var chars = word.split("");
    var finding = toFind.split("");
    var matches = 0;

    for (var i = 0; i < chars.length; i++) {
        if (finding.includes(chars[i])) { // if there is a letter match

            if (finding[i] == chars[i]) { // if in the same position
                gridClass[i].state = "matched";
                gridClass[i].div.style.backgroundColor = correct;
                document.getElementById(gridClass[i].content.toUpperCase()).style.backgroundColor = correct;
                matches++;
            } else {
                gridClass[i].state = "found";
                gridClass[i].div.style.backgroundColor = present;
                document.getElementById(gridClass[i].content.toUpperCase()).style.backgroundColor = present;
            }
        } else {
            gridClass[i].state = "missing";
            gridClass[i].div.style.backgroundColor = wrong;
            document.getElementById(gridClass[i].content.toUpperCase()).style.backgroundColor = wrong;
        }
    }
    if (matches == chars.length) {
        startTimer = false;

        // Send results if user is logged in
        if (username != null) {
            sendGameResults(gameMode, username, guesses, time);
        } else {
            showMessage("Not logged in", "results not saved", "red");
        }

        won = true;
        showMessage("you won!!!", toFind.toUpperCase(), "linear-gradient(135deg, rgba(0, 255, 0, 0.8), rgba(0, 255, 0, 0.7))");
    }

    if (guesses == 6 && startTimer) {
        showMessage("you lost", toFind.toUpperCase(), "linear-gradient(135deg, rgba(255, 0, 0, 0.8), rgba(255, 0, 0, 0.7))");
        startTimer = false;
    }

}

function highlight(selected) {
    selected.div.classList.toggle("selected");
}

function showMessage(txt, wordle, color) {
    var url = '<a target="_blank" href="https://dictionary.cambridge.org/dictionary/english/' + wordle + '">';
    var link = url + '<i class="fa-solid fa-arrow-up-right-from-square"></i></a>';
    document.getElementById("title").innerHTML = txt.toUpperCase();
    document.getElementById("wordle").innerHTML = wordle + "  " + link;
    document.getElementById("m-time").innerHTML = timer.innerHTML;
    document.getElementById("m-guesses").innerHTML = guesses;
    message.style.background = color;
    message.style.display = "block";
}

var navbar = function(e) {
    nav_obj = document.getElementById("header-right")

    nav_obj.classList.toggle("hide");
    e.classList.toggle("burger-shape")

    nav_state != nav_state;
}

for (key of keys) {
    key.addEventListener("click", function() {

        var input = this.innerHTML.toLowerCase()
        var to_return = input.charCodeAt(0);

        if (input == "enter" || input == "del") { to_return = input; }
        keyInput(to_return);
    });
}

setInterval(updateTimer, 1000);

function updateTimer() {
    if (startTimer) {
        var minutes = Math.floor(time / 60);
        var seconds = time % 60;
        if (seconds < 10) { seconds = "0" + seconds; }
        timer.innerHTML = minutes + ":" + seconds;
        time++;
    }
}

document.getElementById("theme").addEventListener("click", function() {
    var r = document.querySelector(":root");

    if (theme == "normal") {
        theme = "dark";
        correct = "green";
        present = "yellow";
        wrong = "grey";
        r.style.setProperty("--back-color", "black");
        r.style.setProperty("--front-color", "darkgrey");
        r.style.setProperty("--glass", "linear-gradient(135deg, rgba(105, 105, 105, 0.8), rgba(105, 105, 105, 0.7))");
        r.style.setProperty("--present", present);
        r.style.setProperty("--correct", correct);
        r.style.setProperty("--wrong", wrong);
        document.getElementById("theme").style.color = "darkgrey";
        document.getElementById("tutorial").style.color = "darkgrey";
    } else if (theme == "dark") {
        theme = "contrast";
        correct = "orange";
        present = "skyblue";
        wrong = "rgb(255,228,218)";
        r.style.setProperty("--back-color", "white");
        r.style.setProperty("--front-color", "darkgrey");
        r.style.setProperty("--glass", "linear-gradient(135deg, rgba(103, 128, 168, 0.8), rgba(103, 128, 168, 0.7))");
        document.getElementById("theme").style.color = "black";
        document.getElementById("tutorial").style.color = "black";
        r.style.setProperty("--present", present);
        r.style.setProperty("--correct", correct);
        r.style.setProperty("--wrong", wrong);
    } else if (theme == "contrast") {
        theme = "normal";
        correct = "green";
        present = "yellow";
        wrong = "grey";
        r.style.setProperty("--back-color", "dodgerblue");
        r.style.setProperty("--front-color", "rgba(255, 255, 255, 0.8)");
        r.style.setProperty("--glass", "linear-gradient(135deg, rgba(37, 56, 141, 0.8), rgba(37, 56, 141, 0.7))");
        r.style.setProperty("--present", present);
        r.style.setProperty("--correct", correct);
        r.style.setProperty("--wrong", wrong);
        document.getElementById("theme").style.color = "black";
        document.getElementById("tutorial").style.color = "black";

    }

});