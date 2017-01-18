<div class="page">
    <?php
    if(isset($errors)){
        foreach($errors as $error){
            echo "<ul class='info_text'>";
            echo "<li>$error</li>";
            echo "</ul>";
        }
    }
    ?>
    

    <div class="full">
        <h4>Game Name</h4>
        <input type="text" name="game_name" value="<?php echo (isset($game_name) ? $game_name : ''); ?>" required />
    </div>

    <div class="full">
        <h4>Your Team Name</h4>
        <input type="text" name="team_name" value="<?php echo (isset($team_name) ? $team_name : ''); ?>" required/>
    </div>

    <div class="full">
        <h4>Password</h4>
        <input type="number" name="passwort" value="<?php echo (isset($passwort) ? $passwort : ''); ?>" required/>
    </div>

    <div class="full">
        <div class="onehalf_left">
            <h4>Team count</h4>
            <input type="number" name="anzahl_teams" max="9" min="2" value="<?php echo $anzahl_teams; ?>" required/>
        </div>

        <div class="onehalf_right">
            <h4>Rounds</h4>
            <input type="number" name="rounds" max="18" min="3" value="<?php echo $rounds; ?>" required/>
        </div>
    </div>


        <input type="submit" class="info" value="Start"/>
         <a href="index.php"><span class="button">Back</span></a>
</div>