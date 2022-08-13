<?php
    $i = '<i class="fa-solid fa-trophy"></i>';

    echo '<div id="leaderboard">';
        echo '<div id="five-tab" class="active">5 Letters</div>';
        echo '<div id="seven-tab" class="in-active">7 Letters</div>';
        echo '<h1 id="l-head">' . $i . "  Leaderboard  " . $i . '</h1>';
        echo '<i id="l-close" class=" close fas fa-times"></i>';
        echo '<div id="container">';
            echo '<ol id="l-list">';
            echo '</ol>';
        echo '</div>';

    echo "</div>";

?>