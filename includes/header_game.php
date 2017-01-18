<!--
/* Matrikelnr.: 1510601043, fhs38707
 * Autor: Valters Pukitis
 * FH Salzburg / MMT / Zweck: MMP1 */
-->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Activey</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <script src="//code.jquery.com/jquery-latest.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class='wrapper'>
    <input type="checkbox" id="menuToggle">
    <label for="menuToggle" class="menu-icon"><img src="img/menu.svg" alt="toggle"></label>
    <header>
      <div id="title"><?php echo $pagetitle;?></div>
    </header>
    <nav class="menu">
      <ul>
        <li><a href='game.php'>RESUME</a></li>
        <li><a href="score.php">SCORE</a></li>
        <li><a href="index.php">MAIN MENU</a></li>
        <!--<li><a href="impressum.php">IMPRESSUM</a></li>-->

          <div class="menu_info">
        <h3>YOUR TEAM: <?php echo $_SESSION['team_name']; ?></h3>
        <h3>GAME NAME: <?php echo $_SESSION['game_name']; ?></h3>
        <h3>PASSWORD: <?php echo $_SESSION['passwort']; ?></h3>
          </div>
      </ul>
    </nav>
