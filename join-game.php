<!DOCTYPE html>
<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// ini_set('session.cache_limiter', 'public');
// session_cache_limiter(false);
?>
<html>
  <head>
    <title>Join game</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
    <link rel="stylesheet" href="./assets/stylesheets/pages/page_join_game.css">
  </head>
  <body>
<?php
session_start();
include("./components/navbar.php");
include("./assets/utils.php");
require("./database_manager/join_game_function.php");

if(empty($_SESSION['user_id'])) {
  // User is not logged in.
  redirect_error("./login.php", "You need to log in to join a game.");
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  require "./database_manager/db_connect.php";

  $entered_code = $_POST['entered_code'];
  if (empty($entered_code)) {
    redirect_error("./join-game.php", "Please enter a join code. It should be a 6-digit number.");
  }
  echo "Entered code: $entered_code<br>";
  $lobby_code_query = "SELECT host_user, access_group FROM current_games WHERE join_code=$entered_code";
  try {
    $lobby_code_result = mysqli_query($sql_conn, $lobby_code_query);
    $rows_amount = mysqli_num_rows($lobby_code_result);
    if ($rows_amount > 0) {
      if ($row = mysqli_fetch_assoc($lobby_code_result)) {
        // A game has been found with the join code.
        join_game($sql_conn, $entered_code);
      }
    } else {
      // Couldn't find a game with the code entered.
      throw new Exception("There isn't a game with join_code: $entered_code");
    }

  } catch (Exception $e) {
    echo $e;
    redirect_error("./join-game.php", "Failed to join game with code $entered_code. Please check that you have entered the right code.");
  }
}
?>
    <div class="main-content-wrapper">
      <div class="modal">
        <h1>Join game</h1>
         <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <span class="error-message"><?php if (isset($_GET['error'])) { echo "Error: " . $_GET['error']; } ?></span>
          <input type="text" name="entered_code" placeholder="Join code"> 
          <input type="submit" value="Join">
        </form>
      </div>
    </div>
  </body>
</html>
