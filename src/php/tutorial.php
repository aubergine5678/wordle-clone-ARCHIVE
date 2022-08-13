<?php
echo <<<POPUP
    <div class="tutorial">
    
        <i id="tutorial-btn" class="close fa-solid fa-xmark"></i>
        
        <h2 id="tutorial-header">Welcome!</h2>

        <ul id="tutorial-text">
            <li>Guess the wordle in six tries or less to win!</li>
            <li>Each guess must be a valid five/seven letter word. Hit the enter button to submit.</li>
            <li>After each guess, the colour of the tiles changes depending on how close your guess was.</li>
        </ul>

        <h3 id="tutorial-sub-header">Examples:</h3>
         
        <div class="examples">
            <div class='tutorial-item '>W</div>
            <div class='tutorial-item '>O</div>
            <div class='tutorial-item tutorial-yellow'>R</div>
            <div class='tutorial-item '>D</div>
            <div class='tutorial-item '>S</div>
        </div>
         
        <p>The letter "R" is somewhere in the word</p>
         
        <div class="examples">
            <div class='tutorial-item tutorial-grey'>L</div>
            <div class='tutorial-item '>O</div>
            <div class='tutorial-item '>R</div>
            <div class='tutorial-item '>D</div>
            <div class='tutorial-item '>S</div>
        </div>
         
        <p>The letter "L" is not in the word</p>
         
        <div class="examples">
            <div class='tutorial-item '>S</div>
            <div class='tutorial-item '>T</div>
            <div class='tutorial-item '>O</div>
            <div class='tutorial-item '>R</div>
            <div class='tutorial-item tutorial-green'>E</div>
        </div>
         
        <p>The letter "E" is in the exact position in the word</p>
        <br>
        <br>
        <small>The purpose of this site is for educational and research purposes only,
         the Wordle IP belongs to its rightful owners</small>
        <br><br>
    </div>
POPUP;
?>