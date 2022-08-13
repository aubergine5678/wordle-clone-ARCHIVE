var header = document.getElementById("l-head");
var icon = '<i class="fa-solid fa-trophy"></i>';
var tabs = [
    document.getElementById("five-tab"),
    document.getElementById("seven-tab")
];

var current = "five-tab";

tabs.forEach(function(item){
    item.addEventListener("click", function(){
        tabs.forEach(function(item2){
            item2.classList.remove("active");
            item2.classList.add("in-active");
            item.classList.add("active")
            item.classList.remove("in-active")
            current = item.id;
        });
        loadTable();
    })
})

document.getElementById("l-button").addEventListener("click", function(){
    document.getElementById("leaderboard").style.display = "block";
    loadTable();
});

document.getElementById("l-close").addEventListener("click", function(){
    document.getElementById("leaderboard").style.display = "none";
});

function loadTable(){
    if (current == "five-tab"){
        header.innerHTML = icon + "  Fives Ranking  " + icon;
        getGameResults("game5");
    } else if (current == "seven-tab"){
        header.innerHTML = icon + "  Sevens Ranking  " + icon;
        getGameResults("game7")
    }
}