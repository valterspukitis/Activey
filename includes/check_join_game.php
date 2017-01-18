<?php

$errors = array();
$game_name = strtoupper($_POST['game_name']);

if(empty($game_name)) {
    $errors[] = "Please enter game name";
}

$team_name = strtoupper($_POST['team_name']);
if(empty($team_name)) {
    $errors[] = "Please enter team name";
}



$passwort = $_POST['passwort'];
if(empty($passwort)) {
    $errors[] = "Please enter a password";
}
else {
    if(strlen($passwort) < 4) {
        $errors[] = "The password must be at least 4 digits long";
    }
}
?>