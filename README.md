# wordle-clone-ARCHIVE

This is an archive of a university project I worked on with a few other people.
A wordle-like game including different game modes, accounts, leaderboards and more!
Uploaded here with permission and with all sensitive information removed, therefore it won't work locally without some modification.
*(The main game code was not written by me, most of my work was on all the PHP backend code, the login/registration functions and handling the leaderboards API)*

- This originally ran on an AWS EC2 instance, connecting to a MySQL databse on another EC2 server and relied on an API to handle leaderboards (archived [HERE](https://github.com/aubergine5678/wordle-clone-server-ARCHIVE)).
- If you really want this running locally for some reason, you will need to edit the database connection details in `./src/php/required.php`