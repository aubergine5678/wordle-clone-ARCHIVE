<?php
    echo <<<FORMS
        <div id="register-bg" class="shadow glass" action="index.php" method="post">
            
            <i id="form-close" class=" close fas fa-times"></i>
            <h1 id="form-label">Log In</h1>

            <form class="log-in" action="index.php?login" method="post">

                <div class="text-box" id="username">
                    <input class="nice-text" id="username" type="text" name="username" autocomplete="off" required placeholder=" ">
                    <div class="underline"></div>
                    <label class="label-input" for="username">Username</label>
                </div>

                <div class="text-box">
                    <input class="nice-text" id="password" type="password" name="password" autocomplete="off" required placeholder=" ">
                    <div class="underline"></div>
                    <label class="label-input" for="password">Password</label>
                    <i class="fas fa-eye-slash" id="show-password" onclick="show_password()"></i>
                </div>

                <p class="label-switch" onclick="switch_form()">Create Account?</p>
                <input class="button" type="submit" value="Login">

            </form>

            <form class="register hideMe" action="index.php?register" method="post">
FORMS;

            // to avoid repetition i used a for loop and an array
            $form_fields = ["forename", "surname", "dob", "username", "password", "confirm-password"];

            foreach ($form_fields as $field) {
                if ($field == "password") {
                    echo <<<FIELD
                        <div class="text-box">
                            <input name="password" class="nice-text" id="new-password" type="password" autocomplete="off" required placeholder=" ">
                            <div class="underline"></div>
                            <label class="label-input" for="password">Password</label>
                            <i class="fas fa-eye-slash" id="show-password" onclick="show_new_password()"></i>
                        </div>
FIELD;
                } else if ($field == "confirm-password") {
                    echo <<<FIELD
                        <div class="text-box">
                            <input name="confirm-password" class="nice-text" id="confirm-password" type="password" autocomplete="off" required placeholder=" ">
                            <div class="underline"></div>
                            <label class="label-input" for="confirm-password">Confirm Password</label>
                            <i class="fas fa-eye-slash" id="show-password" onclick="show_confirm_password()"></i>
                        </div>
FIELD;
                } else if ($field == "dob") {
                    echo <<<FIELD
                        <div class="text-box">
                            <input name="dob" class="nice-text" id="dob" type="date" required>
                            <div class="underline"></div>
                        </div>
FIELD;
                } else {
                    echo <<<FIELD
                        <div class="text-box">
                            <input name="$field" class="nice-text" id="$field" type="text" autocomplete="off" required placeholder=" ">
                            <div class="underline"></div>
                            <label class="label-input" for="$field">$field</label>
                        </div>
FIELD;
                }
            }

            echo <<< FORMS
                <p class="label-switch" onclick="switch_form()">Already Have Account</p>
                <input class="button" type="submit" value="Register">
            </form>
        </div>
FORMS;
?>