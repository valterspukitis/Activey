<!--
/* Matrikelnr.: 1510601043, fhs38707
 * Autor: Valters Pukitis
 * FH Salzburg / MMT / Zweck: MMP1 */
-->

<?php
    $pagetitle = "Home";
    include "includes/functions.php";
    include "includes/header.php";
?>
<div class="page">
    <img src="img/logo_a2.png" alt="activey_logo">
    <div class="main_menu">
        <?php if (isset($_SESSION['id'])) { ?>
            <?php if(isset($_SESSION['game_id'])){
                echo "<a href='game.php'><span class='info'>Resume</span></a>";
            }?>
            <a href="create_game.php"><span class="info">Start new game</span></a>
            <a href="join_game.php"><span class="info">Join a game</span></a>
            <a href="includes/logout.php" class="btn">
            <span class="button">
            <h2>Logout</h2>
            <h6>Logged in as <?php echo $_SESSION['firstname']?></h6>
            </span>
            </a>
       <?php }
        else{
        ?><span class="fb">
                <div class="fb-login-button" data-scope="public_profile" data-size="large" onlogin="logmeintoFB()" >Login with Facebook</div>
            </span>

            <h3 id="fail"></h3>
        <?php }?>
    </div>
</div>
<?php
include "includes/footer.php";
?>



