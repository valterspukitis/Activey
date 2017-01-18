<!--
/* Matrikelnr.: 1510601043, fhs38707
 * Autor: Valters Pukitis
 * FH Salzburg / MMT / Zweck: MMP1 */
-->

<?php

    include "includes/functions.php";
    include "includes/header.php";



    if($_POST) {
        include "includes/check_join_game.php";

        if(empty($errors))
        try {
            $_SESSION['game_name'] = $game_name;
            $_SESSION['team_name'] = $team_name;
            $_SESSION['passwort'] = $passwort;
            $_SESSION['score'] = 0;

            //$game_name = $_SESSION['game_name'];
            //$passwort = $_SESSION['passwort'];

            $stm = $dbh->query("SELECT game_id, anzahl_teams, anzahl_rounds FROM game WHERE game_name = '$game_name' and passwort='$passwort'");
            $_SESSION['game_id'] = $stm->fetch()->game_id;
            $stm = $dbh->query("SELECT game_id, anzahl_teams, anzahl_rounds FROM game WHERE game_name = '$game_name' and passwort='$passwort'");
            $_SESSION['anzahl_teams'] = $stm->fetch()->anzahl_teams;
            $stm = $dbh->query("SELECT game_id, anzahl_teams, anzahl_rounds FROM game WHERE game_name = '$game_name' and passwort='$passwort'");
            $_SESSION['rounds'] = $stm->fetch()->anzahl_rounds;


            $game_id =$_SESSION['game_id'];
            $userid = $_SESSION['id'];

            if($_SESSION['game_id']==null){
                throw new Exception("Game does not exist!");
            }

            $stm = $dbh->query("SELECT * FROM round_turn WHERE game_id = '$game_id'");
            $_SESSION['round'] = $stm->fetch()->round;

            $stm = $dbh->query("SELECT * FROM round_turn WHERE game_id = '$game_id'");
            $_SESSION['turn'] = $stm->fetch()->turn;

            $stm = $dbh->query("SELECT count(*) as teamsin FROM teams WHERE game_id = '$game_id'");
            $teamsconnected= $stm->fetch()->teamsin;
            $_SESSION['team_nr'] = $teamsconnected+1;


            if($_SESSION['team_nr'] > $_SESSION['anzahl_teams']){
                throw new Exception("Game is already full!");
            }

            $sth = $dbh->prepare("INSERT INTO teams(team_nr, team_name, score, game_id, user_id)
                                       VALUES(            ?,         ?,     ?,       ?,       ?  )");
            $sth->execute(array(
                $_SESSION['team_nr'],
                $_SESSION['team_name'],
                0,
                $_SESSION['game_id'],
                $_SESSION['id']
            ));

            $_SESSION['team_id'] = $dbh->lastInsertId('teams_team_id_seq');

            $stm = $dbh->query("SELECT * FROM round_turn WHERE game_id=$game_id");
            $_SESSION['round_id'] = $stm->fetch()->round_id;


            if($_SESSION['team_nr'] == $_SESSION['anzahl_teams']){
                $sth = $dbh->prepare("UPDATE round_turn SET turn = ? WHERE round_id = ?");
                $sth->execute(array(
                    1,
                    $_SESSION['round_id']
                ));
            }

            header("Location: game.php");

        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }
?>

<form class="form" action="join_game.php" method="post">

<?php
    include "includes/join_settings.php";
    include "includes/footer.php";
?>