<?php
// Handle log-in and registration requests
if (isset($_GET["login"])) {
    loginValidate($connection);
} else if (isset($_GET["register"])) {
    register($connection);
} else if (isset($_GET["logout"])) {
    logout();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/leaderboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="js/Cell.js"></script>
    <script defer src="js/script.js"></script>
    <script defer src="js/popup.js"></script>
    <script defer src="js/form.js"></script>
    <script defer src="js/requests.js"></script>
    <script defer src="js/leaderboard.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Wordle-clone</title>
</head>

<body onkeydown="return myKeyPress(event)">

    <?php
        $gameMode = 5;
        $a = '<a href="index.php?mode=7">7 letters</a>';

        if (isset($_GET["mode"])){
            if ($_GET['mode'] == 7){
                $gameMode = $_GET['mode'];
                $a = '<a href="index.php?mode=5">5 letters</a>';
            }
        }

        echo <<<HEAD
            <header class="header">
                <a href="index.php" id="logo">Wordle Clone</a>
                <div id="burger" onclick="navbar(this)">
                    <div id="line1"></div>
                    <div id="line2"></div>
                    <div id="line3"></div>
                </div>
                <div id="header-right" class="hide">
                    <a href="index.php?mode=$gameMode" class="active">New Word</a>
                    $a
                    <a href="#" id="l-button">Leaderboard</a>
HEAD;
        if ($_SESSION["loginStatus"]) {
            echo "<a href=\"index.php?logout\" id=\"log-out\">Log Out</a>";
            $username = $_SESSION["username"];
            echo <<<TAG
            <meta name="username" username="$username">
TAG;
        } else {
            echo "<a id=\"log-in\">Log-In</a>";
        }
                    echo <<<HEAD
                </div>
            </header>
HEAD;

echo <<<SETTINGS
    <div class="settings">
        <i id="tutorial" class="fa-solid fa-clipboard-question"></i>
        <i id="theme" class="fa-solid fa-lightbulb"></i>
    </div>
SETTINGS;

?>
