<?php
    include "includes/functions.php";
    $turn = $_GET['turn'];
    $round_id = $_SESSION['round_id'];
    $query = $dbh->query("SELECT * FROM round_turn where round_id='$round_id'");
    $act_turn = $query->fetch()->turn;


    if($turn != $act_turn){
        echo 1;
    }
    else{
        echo 0;
    }
?>