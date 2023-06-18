<!DOCTYPE html>
<?php
session_start();
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// ini_set('session.cache_limiter', 'public');
// session_cache_limiter(false);
?>
<html>
  <head>
    <title>Lobby</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
    <link rel="stylesheet" href="./assets/stylesheets/button.css">
    <link rel="stylesheet" href="./assets/stylesheets/pages/page_lobby.css">

    <script src="./components/lobby_manager.js"></script>
    <!-- Ajax for making API calls -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
<?php
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
  $current_game_query = "
    SELECT current_games.join_code, users.username, question_categories.name
    FROM current_games 
    INNER JOIN users ON current_games.host_user=users.id
    INNER JOIN question_categories ON current_games.question_category=question_categories.id
    WHERE join_code=$join_code";
  $current_game_result = mysqli_query($sql_conn, $current_game_query);
  if (mysqli_num_rows($current_game_result) <= 0) {
    // There isn't a game with the code entered.
    $error = "Failed to get data for the game with code: $join_code";
    redirect("./join-game.php?error=$error");
  }
  if ($row = mysqli_fetch_assoc($current_game_result)) {
    $_SESSION['game_data'] = serialize(new GameData($row["join_code"], $row["username"], $row["name"]));
  }
} catch (Exception $e) {
  $serverError = "Failed to get data for this game :(";
  echo $e;
}
if(unserialize($_SESSION['game_data'])->host_username === $_SESSION['username']) {

}
?>
    <div class="main-content-wrapper">
      <h1>Lobby</h1>
      <h3>Join code: <?php echo unserialize($_SESSION['game_data'])->join_code; ?></h3>
      <h3>Host: <?php echo unserialize($_SESSION['game_data'])->host_username; ?></h3>
      <h3>Category: <?php echo unserialize($_SESSION['game_data'])->question_category; ?></h3>
      <div id="users-list">
        <script defer>
          //fetchUsers(<?php echo $join_code; ?>);
          fetchUsersSSE(<?php echo $join_code; ?>);
          // setInterval(fetchUsers, 5000, <?php echo $join_code ?>);
        </script>
      </div>

      <?php if(unserialize($_SESSION['game_data'])->host_username === $_SESSION['username']): ?>
      <form action="./game.php?id=<?php echo unserialize($_SESSION['game_data'])->join_code ?>" method="post">
          <span class="error-message"><?php if (isset($_GET['error'])) { echo "Error: " . $_GET['error']; } ?></span>
          <input type="submit" value="Start game">
        </form>
      <?php else: ?>
        <h2>Waiting for host to start game...</h2>
      <?php endif; ?>
    </div>
  </body>
</html>
