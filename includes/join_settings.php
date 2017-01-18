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
        </div>
        <div class="full">
            <input type="text" name="game_name" value="<?php echo (isset($game_name) ? $game_name : ''); ?>" required/>
        </div>

        <div class="full">
            <h4>Your Team Name</h4>
            <input type="text" name="team_name" value="<?php echo (isset($team_name) ? $team_name : ''); ?>" required/>
        </div>

        <div class="full">
            <h4>Password</h4>
        </div>

        <div class="full">
            <input type="number" name="passwort"  value="<?php echo (isset($passwort) ? $passwort : ''); ?>" required/>
        </div>

        <input type="submit" class="info" value="Join"/>
        <a href="index.php"><span class="button">Back</span></a>
    </div>
</form>