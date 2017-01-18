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

$anzahl_teams = $_POST['anzahl_teams'];
if(empty($anzahl_teams)) {
    $errors[] = "Please enter the number of teams";
}
else {
    if($anzahl_teams < 2) {
        $errors[] = "There must be at least 2 teams";
    }
}

$rounds = $_POST['rounds'];
if(empty($rounds)) {
    $errors[] = "Please enter the number of rounds";
}
else {
    if($rounds < 3) {
        $errors[] = "There must be at least 3 rounds";
    }
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