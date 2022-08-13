//JavaScript from this line down to 19 work for the Tutorial popup only
window.addEventListener("load", function() {
    document.querySelector(".popup").style.display = "block";
    if(!this.localStorage.getItem("tutorial")){
            document.querySelector(".tutorial").style.display = "block";
            localStorage.setItem("tutorial", "true");
    }
});

document.querySelector("#tutorial-btn").addEventListener("click", function() {
    document.querySelector(".tutorial").style.display = "none";
});

document.getElementById("tutorial").addEventListener("click", function(){
    document.querySelector(".tutorial").style.display = "block";
})

document.getElementById("message-close").addEventListener("click", function(){
    message.style.display = "none";
});

//JavaScript from this line down to 39 work for every other popup

document.querySelector("#popup-btn").addEventListener("click", function() {
    document.querySelector(".popup").style.display = "none";
});

document.getElementById("popup").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "block";
})

document.getElementById("message-close").addEventListener("click", function(){
    message.style.display = "none";
});



