<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
?>
<html>
  <head>
    <title>Lobby</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
  </head>
  <body>
<?php
session_start();
include("./components/navbar.php");
require "./database_manager/db_connect.php";
include("./assets/utils.php");

include_once("./components/game_data.php");

$join_code = $_GET['join_code'];
if (empty($join_code)) {
  // Somehow there isn't a join code in the url paramters.
  $error = "Couldn't find a join code in the URL.";
  redirect("./join-game.php?error=$error");
  exit();
}

try {
  $current_game_query = "SELECT * FROM current_games WHERE join_code=$join_code";
  $current_game_result = mysqli_query($sql_conn, $current_game_query);
  if (mysqli_num_rows($current_game_result) <= 0) {
    // There isn't a game with the code entered.
    $error = "Failed to get data for the game with code: $join_code";
    redirect("./join-game.php?error=$error");
  }
  if ($row = mysqli_fetch_assoc($current_game_result)) {
    new GameData($row["join_code"]);
  }
} catch (Exception $e) {
  $serverError = "Failed to get data for this game :(";
  echo $e;
}
?>
    <div class="main-content-wrapper">
      <h1>Lobby</h1>
      <h2>Join code: <?php echo $join_code; ?>
    </div>
  </body>
</html>
