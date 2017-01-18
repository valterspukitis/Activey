<!--
/* Matrikelnr.: 1510601043, fhs38707
 * Autor: Valters Pukitis
 * FH Salzburg / MMT / Zweck: MMP1 */
-->

<?php

include "includes/functions.php";
include "includes/header.php";

if($_POST) {

    include "includes/check_game.php";

    if(empty($errors))
    try {
        $_SESSION['game_name'] = $game_name;
        $_SESSION['team_name'] = $team_name;
        $_SESSION['anzahl_teams'] = $anzahl_teams;
        $_SESSION['rounds'] = $rounds;
        $_SESSION['passwort'] = $passwort;
        $_SESSION['round']  = 1;
        $_SESSION['score'] = 0;
        $_SESSION['turn'] = 0;

        $sth = $dbh->query("SELECT game_id FROM game WHERE game_name = '$game_name' and passwort='$passwort'");
        $_SESSION['exists'] = $sth->fetch();
        if($_SESSION['exists']!=null){
            throw new Exception("Game already exists!");
        }

        $sth = $dbh->prepare("INSERT INTO game(game_name, anzahl_teams, anzahl_rounds, passwort)
                                  VALUES(      ?,         ?,            ?,             ?     )");
        $sth->execute(array(
            $_SESSION['game_name'],
            $_SESSION['anzahl_teams'],
            $_SESSION['rounds'],
            $_SESSION['passwort']
        ));

        $_SESSION['game_id'] = $dbh->lastInsertId('game_game_id_seq');

        $sth = $dbh->prepare("INSERT INTO teams(team_nr, team_name, score, game_id, user_id)
                                   VALUES(            ?,         ?,     ?,       ?,       ? )");
        $sth->execute(array(
            1,
            $_SESSION['team_name'],
            0,
            $_SESSION['game_id'],
            $_SESSION['id']
        ));

        $_SESSION['team_nr'] = 1;
        $_SESSION['team_id'] = $dbh->lastInsertId('teams_team_id_seq');

        $sth = $dbh->prepare("INSERT INTO round_turn(game_id, round, turn)
                                       VALUES(      ?,       ?,        ?    )");
        $sth->execute(array(
            $_SESSION['game_id'],
            $_SESSION['round'],
            $_SESSION['turn']
        ));

        $_SESSION['round_id'] = $dbh->lastInsertId('round_turn_round_id_seq');
        header("Location: game.php");

    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }
}
       echo "<form class='form' action='create_game.php' method='post'>";
       include "includes/create_settings.php";
       include "includes/footer.php";
?>