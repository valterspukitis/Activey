<!--
/* Matrikelnr.: 1510601043, fhs38707
 * Autor: Valters Pukitis
 * FH Salzburg / MMT / Zweck: MMP1 */
-->

<?php
    $pagetitle = "Score";
    include "includes/functions.php";
    include "includes/header_game.php";

$round_id = $_SESSION['round_id'];
$query = $dbh->query("SELECT * FROM round_turn where round_id='$round_id'");
$_SESSION['round'] = $query->fetch()->round;
$query = $dbh->query("SELECT * FROM round_turn where round_id='$round_id'");
$_SESSION['turn'] = $query->fetch()->turn;

try {
    $gameid = $_SESSION['game_id'];
    $query = $dbh->query("SELECT * FROM teams where game_id='$gameid' order by score desc");
    $teams = $query->fetchAll();

    echo "<div class='page'>";
    echo "<br><br><div class='score_title'>";
    echo "<div class='score_team'>TEAM NAME</div><div class='score_points'>POINTS</div>";
    echo "</div>";
    echo "<div class='clear'></div>";
    foreach($teams as $team){
        echo "<div class='score_small'>";
        echo "<div class='score_team'>" . $team->team_name . "</div><div class='score_points'>" . $team->score . "</div>";
        echo "</div>";
        echo "<div class='clear'></div>";
    }
    echo "</div>";
} catch (Exception $e) {
    echo $e->getMessage();
}
    include "includes/footer.php";
?>