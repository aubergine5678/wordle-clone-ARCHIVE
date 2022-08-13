var password = document.getElementById("password")
var newPassword = document.getElementById("new-password")
var confirmPassword = document.getElementById("confirm-password")

document.getElementById("log-in").addEventListener("click", function() {
    document.getElementById("register-bg").classList.toggle("slide");
    formActive = !formActive;
})

document.getElementById("form-close").addEventListener("click", function() {
    document.getElementById("register-bg").classList.toggle("slide");
    formActive = !formActive;
})

function switch_form() {
    document.getElementsByClassName("register")[0].classList.toggle("hideMe");
    document.getElementsByClassName("log-in")[0].classList.toggle("hideMe");
}

function show_password() {
    if (password.type == "password") { password.type = "text" } else { password.type = "password" }
}

function show_new_password() {
    if (newPassword.type == "password") { newPassword.type = "text" } else { newPassword.type = "password" }
}

function show_confirm_password() {
    if (confirmPassword.type == "password") { confirmPassword.type = "text" } else { confirmPassword.type = "password" }
}