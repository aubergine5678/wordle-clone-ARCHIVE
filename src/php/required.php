<?php

// ---------------------------------------------------------------------
// THIS FILE REQUIRED ON EVERY PAGE
// ---------------------------------------------------------------------

// Start session
session_start();

// Set the default timezone
date_default_timezone_set('UTC');

if (!isset($_SESSION['loginStatus'])) { $_SESSION['loginStatus'] = false;}

// SESSION VARIABLES:
// - $_SESSION['loginStatus'] (boolean)
// - $_SESSION['userId'] (int)
// - $_SESSION['userName'] (string)

// Connect to the database
$DBhost = "";           // Database hostname
$DBname = "";           // Database name
$DBuser = "";           // Database username
$DBpass = "";           // Database password

$connection = new mysqli($DBhost, $DBuser, $DBpass, $DBname);
if ($connection->connect_error) {
    die("Database connection failed: " . $connection->connect_error);
}

// Required extra functions:

// Function to show pop-up message
// supported types: "error", "success", ""
function showPopup($popupTitle, $popupText, $popupType) {include "popup.php";}

// Function to log in - must be called from the index.php page only, otherwise it breaks :(
function loginValidate($connection) {
    if (!isset($_POST["username"]) || !isset($_POST["password"])) {
        // Username or password is blank
        showPopup("Error Logging In", "Username or password blank", "error");
    } else {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $pwQuery = mysqli_query($connection, "SELECT id, password FROM users WHERE username = \"" . $username . "\";");
        $row = mysqli_fetch_array($pwQuery);
        $pw_hash = $row[1];

        if (password_verify($_POST["password"], $pw_hash)) {
            $_SESSION["loginStatus"] = TRUE;
            $_SESSION["username"] = $username;
            $_SESSION["uid"] = $row[0];
            showPopup("Logged In", "Welcome back, $username", "success");
            // Redirect to the main page after being logged in
            header("refresh: 1; url = index.php");
        } else {
            // Username or password incorrect
            showPopup("Error Logging In", "Username or password incorrect", "error");
        }
    }
}

// Function to register a new user - same as above; has to be called from index.php
// Please ignore how ugly this is...
function register($connection) {
    if (!isset($_POST["username"]) || !isset($_POST["forename"]) || !isset($_POST["surname"]) || !isset($_POST["dob"]) || !isset($_POST["password"]) || !isset($_POST["confirm-password"])) {
        // Error - one or more fields are not set
        showPopup("Error registering", "One or more of the required fields is blank", "error");
    } else {
        if ($_POST["password"] != $_POST["confirm-password"]) {
            showPopup("Error registering", "The passwords you entered do not match. Please try again.", "error");
        } else if ($_POST["dob"] > date("Y-m-d") || $_POST["dob"] < date(1900-01-01)) {
            // Check that DOB is valid
            showPopup("Error registering", "Please enter a valid date of birth", "error");
        } else if ($_POST["dob"] > date("Y-m-d", strtotime('-13 years'))) {
            // Check the user is at least 13 years old
            showPopup("Error registering", "You must be at least 13 years old to register an account.", "error");
        } else {
            $username = $connection->real_escape_string(htmlentities($_POST["username"]));
            $forename = $connection->real_escape_string(htmlentities($_POST["forename"]));
            $surname = $connection->real_escape_string(htmlentities($_POST["surname"]));
            $dob = $_POST["dob"];
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

            // Get all current usernames
            $userQuery = mysqli_query($connection, "SELECT username FROM users;");
            $usernames = array();
            while ($row = mysqli_fetch_array($userQuery)) {
                array_push($usernames, $row[0]);
            }

            // Check if username already exists
            if (in_array($username, $usernames)) {
                // Error - username already exists
                showPopup("Error registering", "That username already belongs to someone else. Please choose a different one.", "error");
            } else {
                $query = $connection->prepare("INSERT INTO users (`username`, `password`, `firstname`, `surname`, `dob`) VALUES (?, ?, ?, ?, ?);");

                if (!$query) {
                    $errorMsg = "Prepare failed: (" . $connection->errno . ") " . $connection->error;
                    showPopup("Error registering", $errorMsg, "error");
                } else {
                    // Bind parameters
                    $query->bind_param("sssss", $username, $password, $forename, $surname, $dob);
                    // Execute query
                    $query->execute();
                    showPopup("Successfully registered", "Please log in with your username and password.", "success");
                }
            }
        }
    }
}

// Function to log user out - can be called from anywhere, basically destroys the session and sets session cookies to expired
function logout() {
    $_SESSION = array();
    setcookie(session_name(), '', time()-259200, '/');
    session_destroy();
    $_SESSION["loginStatus"] = FALSE;
    $_SESSION["username"] = NULL;
    $_SESSION["uid"] = NULL;
    showPopup("Logged Out", "You have been successfully logged out!", "success");
    
    // Redirect to the main page after logging out
    header("refresh: 1; url = index.php");
}

// ---------------------------------------------------------------------

?>