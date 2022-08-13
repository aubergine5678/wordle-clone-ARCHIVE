<?php
    require 'php/required.php';
    require 'php/head.php';

    // BOARD
    $game = "game" . $gameMode;

    echo "<meta name=\"gameMode\" gameMode=\"$gameMode\">";

    echo "<div id='game' class=$game>";

        for ($i = 1; $i <= 6; $i++) {
            for ($j = 1; $j <= $gameMode; $j++) {
                $id = $i . "-" .$j;
                echo "<div class='grid-item cells' id=$id></div>";
            }
        }

    echo '<p id="timer">0:00</p>';
    echo '</div>';
    echo <<<MESSAGE
    <div id="message">
        <i id="message-close" class=" close fas fa-times"></i>
        <h2 id="title">YOU WON!</h2>
        <br>
        <p>The wordle was:
        <h3 id="wordle">
            PP 
            <a><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
        </h3>
        <br>
        <br>
        <div id="stats">
            <h3 id="m-time"></h3>
            <h3 id="m-guesses"></h3>
        </div>
        <div id="labels">
            <h3>Time</h3>
            <h3>Guesses</h3>
        </div>

    </div>

MESSAGE;


    // KEYBOARD 
    echo "<div id='keyboard'>";

        echo "<div id='row1'>";
            $keys = ["Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P"];
            for ($i = 0; $i < count($keys); $i++) {
                echo "<div class='keys' id='$keys[$i]'>$keys[$i]</div>";
            }
        echo "</div>";

        echo "<div id='row2'>";
            $keys = ["A", "S", "D", "F", "G", "H", "J", "K", "L"];
            for ($i = 0; $i < count($keys); $i++) {
                echo "<div class='keys' id='$keys[$i]'>$keys[$i]</div>";
            }
        echo "</div>";

        echo "<div id='row3'>";
            $keys = ["ENTER", "Z", "X", "C", "V", "B", "N", "M", "DEL"];
            for ($i = 0; $i < count($keys); $i++) {
                echo "<div class='keys' id='$keys[$i]'>$keys[$i]</div>";
            }
        echo "</div>";

    echo '</div>';

    // Only show the tutorial if the user is not logged in
    include "php/leaderboard.php";
    include "php/tutorial.php";
    include "php/form.php";

?>
</body>
</html>
<?php if (isset($conncetion)) {$connection->close();} ?>