<?php
//Template for general purpose popups
echo <<<POPUP
        <div class="popup $popupType">
            <i id="popup-btn" class="close fa-solid fa-xmark"></i>
            <h2 id="popup-header">$popupTitle</h2>
            <div id="popup-text">
                <p>$popupText</p>
            </div>
        </div>
POPUP;
?>