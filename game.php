<!--
/* Matrikelnr.: 1510601043, fhs38707
 * Autor: Valters Pukitis
 * FH Salzburg / MMT / Zweck: MMP1 */
-->

<?php

include "includes/functions.php";
$round_id = $_SESSION['round_id'];
$query = $dbh->query("SELECT * FROM round_turn where round_id='$round_id'");
$_SESSION['round'] = $query->fetch()->round;
$query = $dbh->query("SELECT * FROM round_turn where round_id='$round_id'");
$_SESSION['turn'] = $query->fetch()->turn;
if($_SESSION['round']>$_SESSION['rounds']){$pagetitle = "Round: " . $_SESSION['rounds'];
}else{$pagetitle = "Round: " . $_SESSION['round'];}


include "includes/header_game.php";
echo "<script src='includes/timer.js'></script>";

/*
    echo "   mycook: ";
    echo $_COOKIE['my_cookie'];
    echo "-------";
    echo "   gamename: ";
    echo $_SESSION['game_name'];
    echo "   teamname: ";
    echo $_SESSION['team_name'];
    echo "   anzahlteams: ";
    echo $_SESSION['anzahl_teams'];
    echo "   rounds: ";
    echo $_SESSION['rounds'];
    echo "   passwort: ";
    echo $_SESSION['passwort'];
    echo "   round: ";
    echo $_SESSION['round'];
    echo "   score: ";
    echo $_SESSION['score'];
    echo "   turn: ";
    echo $_SESSION['turn'];
    echo "   gameid: ";
    echo $_SESSION['game_id'];
    echo "   teamnr: ";
    echo $_SESSION['team_nr'];
    echo "   teamid: ";
    echo $_SESSION['team_id'];
    echo "-------";
    echo $_SESSION['word']->word;
*/

$team_id = $_SESSION['team_id'];



    $gameid = $_SESSION['game_id'];
    $query = $dbh->query("SELECT count(*) as countconnected FROM teams where game_id='$gameid'");
    $countconnected = $query->fetch()->countconnected;

    if($_SESSION['round'] == ($_SESSION['rounds']+1) )
    {
        try {
            $gameid = $_SESSION['game_id'];

            $query = $dbh->query("SELECT * FROM teams where game_id='$gameid'");
            $teams = $query->fetchAll();

            echo "<div class='page'>";
            echo "<br><br><div class='score_title'><h1>Game is over</h1>";
            echo "<div class='score_team'>TEAM NAME</div><div class='score_points'>POINTS</div>";
            echo "</div>";
            echo "<div class='clear'></div>";
            foreach($teams as $team){
                echo "<div class='score_small'>";
                echo "<div class='score_team'>" . $team->team_name . "</div><div class='score_points'>" . $team->score . "</div>";
                echo "</div>";
                echo "<div class='clear'></div>";
            }
            echo "<a href='index.php'><span class='info'>Main Menu</span></a>";

            echo "</div>";
            include "includes/footer.php";

            die;

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
    elseif($countconnected == $_SESSION['anzahl_teams']){
        if($_SESSION['turn'] == $_SESSION['team_nr']){
            try {

                //if(!isset($_COOKIE['my_cookie'])){
                    $round = $_SESSION['round'];
                    if($round==1 || $round==4 || $round==7 || $round==10 || $round==13 || $round==16){
                        $query = $dbh->query("SELECT * FROM words where kind = 1 ORDER BY RANDOM() LIMIT 1");
                        $_SESSION['word'] = $query->fetch();
                    }
                    if($round==2 || $round==5 || $round==8 || $round==11 || $round==14 || $round==17){
                        $query = $dbh->query("SELECT * FROM words where kind = 2 ORDER BY RANDOM() LIMIT 1");
                        $_SESSION['word'] = $query->fetch();
                    }
                    if($round==3 || $round==6 || $round==9 || $round==12 || $round==15 || $round==18){
                        $query = $dbh->query("SELECT * FROM words where kind = 3 ORDER BY RANDOM() LIMIT 1");
                        $_SESSION['word'] = $query->fetch();
                    }
                //}

                $word = $_SESSION['word'];

                $sth = $dbh->query("SELECT img FROM kind where kind_id='$word->kind'");
                $_SESSION['img'] = $sth->fetch();
                $img = $_SESSION['img'];

                $sth = $dbh->query("SELECT * FROM words where word='$word->word'");
                $_SESSION['points'] = $sth->fetch()->points;
                $points = $_SESSION['points'];

            } catch (Exception $e) {
                echo "<p style='color: red'>Die runde is explodiert<p>";
                echo $e->getMessage();
            }

            if(isset($_POST) && $_POST['change'] )
            {
                if(isset($_POST['success'])){
                $sth = $dbh->query("SELECT score FROM teams where team_id= '$team_id'");
                $_SESSION['score'] = $sth->fetch()->score;
                $_SESSION['score'] = $_SESSION['score'] + $points;

                $sth = $dbh->prepare("UPDATE teams SET score = ? where team_id = '$team_id'");
                $sth->execute(array(
                    $_SESSION['score']
                ));
                }

                if ($_SESSION['anzahl_teams'] == $_SESSION['turn']) {
                    $_SESSION['turn'] = 1;
                    $_SESSION['round'] += 1;
                } else {
                    $_SESSION['turn'] += 1;
                }

                $sth = $dbh->prepare("UPDATE round_turn SET round = ?, turn = ? WHERE round_id = ?");
                $sth->execute(array(
                    $_SESSION['round'],
                    $_SESSION['turn'],
                    $_SESSION['round_id']
                ));

                unset($_POST);
                header("Location: game.php");
            }
        }
        else{

            try {
                $gameid = $_SESSION['game_id'];

                $query = $dbh->query("SELECT * FROM teams WHERE game_id='$gameid' ORDER BY score DESC");
                $teams = $query->fetchAll();

                echo "<div class='page'>";
                    echo "<div class='info_text' >Please wait for your turn!</div>";

                    echo "<div class='score_title'>";
                    echo "<div class='score_team'>TEAM NAME</div><div class='score_points'>POINTS</div>";
                    echo "</div>";
                    echo "<div class='clear'></div>";
                    foreach($teams as $team){
                        echo "<div class='score_small'>";
                        echo "<div class='score_team'>" . $team->team_name . "</div><div class='score_points'>" . $team->score . "</div>";
                        echo "</div>";
                    }
                echo "</div>";


            } catch (Exception $e) {
                echo $e->getMessage();
            }            include "update.js";
            ?>
            <script type="text/javascript">
                setInterval(function() {
                    updateBox();
                }, 3000);
            </script>
            <?php
            include "includes/footer.php";
            die;
        }
    }
    else {
        echo "<div class='page'>";
        echo "<div class='info_text' >Please wait until everyone is connected!</div>";
        echo "<div class='game_info'>";
        echo "<h3>Game name:</h3><h1>" . $_SESSION['game_name'] . "</h1>";
        echo "<h3>Password:</h3><h1>" . $_SESSION['passwort'] . "</h1>";
        echo "</div>";
        echo "</div>";

        include "update.js";
        ?>
        <script type="text/javascript">
            setInterval(function() {
                updateBox();
            }, 3000);
        </script>
        <?php
        include "includes/footer.php";
        die;
    }

?>
<div class="page">
    <div class="wordbox">
        <h1><?php echo $_SESSION['team_name']; ?> TURN</h1>
        <div class="button">
            <?php $word = $_SESSION['word']->word;?>
            <div id = "word" style="display:block" onclick = "showTimer()">
                <h2><?php echo $word; ?></h2>
                <div class="hint"><?php echo "(" . $points . ")" ?></div>
            </div>

            <div id = "time" style="display:none" onclick = "showWord()">
                <span id="countdown" class="timer"></span>
                <div class="hint">TAP TO SEE WORD</div>
            </div>

        </div>

        <img src="img/<?php echo $img->img ?>" alt="kind">

        <div class="fail_success">
            <div class="fail">
                <form class="well form-inline" action="game.php" method="post">
                    <input type="hidden" name="change" value="true" />
                    <input type="submit" value="" class="fail_button" onclick="deleteCook()"/>
                </form>
            </div>

            <div class="success">
                <form class="well form-inline" action="game.php" method="post">
                    <input type="hidden" name="score" value="3" />
                    <input type="hidden" name="success" />
                    <input type="hidden" name="change" value="true"/>
                    <input type="submit" value="" class="success_button" onclick="deleteCook()"/>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include "includes/footer.php";
?>



