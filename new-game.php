<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);

include("./components/navbar.php");
include_once("./components/big-select.php");

$option_array = array(
  new SelectOption("Singleplayer", "Answer pre-made questions if you don't have friends"),
  new SelectOption("Multiplayer", "Write and answer questions with friends")
);
?>
<html>
  <head>
    <title>New game</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/pages/page_new-game.css">
    <link rel="stylesheet" href="./assets/stylesheets/big_select.css">
    <link rel="stylesheet" href="./assets/stylesheets/button.css">
    <link rel="stylesheet" href="./assets/stylesheets/modal.css">
    <link rel="stylesheet" href="./assets/stylesheets/variables.css">

    <script src="./components/big-select.js"></script>
  </head>
  <body onload="setupBigSelects()">
    <div class="main-content-wrapper">
      <h1>New game</h1>
<?php
session_start();
include("./assets/utils.php");
// Need a user_id to create a game. Redirect if user is not logged in.
$user_id = $_SESSION["user_id"];
if (is_null($user_id)) {
  redirect_error("./login.php", "You need to log in to create a game.");
}

$gamemodeError = "";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
  require "./database_manager/db_connect.php";

  $gamemode = $_POST['gamemode'];
  if (empty($gamemode)) {
    redirect_error("./new-game.php", "Please select a gamemode.");
  }
  echo "Selected gamemode: $gamemode<br>";
  $join_code = random_int(100000, 999999);
  try {
    $game_create_query = "INSERT INTO `current_games` (`join_code`, `host_user`, `access_group`) VALUES ($join_code, $user_id, '$gamemode');";
    echo $game_create_query;
    $query_result = mysqli_query($sql_conn, $game_create_query);
  } catch (Exception $e){
    echo $e;
    if (mysqli_errno($sql_conn) === 1062) {
      // Error code 1062 corresponds to 'duplicate entry' constraint being violated.
      // This probably means the user is already the host of a currently running game.
      redirect_error("./join-game.php", "It looks like you're already hosting a game. Please enter the code for that game or wait for it to end.");
    } else {
      redirect_error("./new-game.php", "Failed to create new game. Please try again.");
    }
  }
  if ($query_result) {
    echo "Created new game!";

    // The game has been created. Redirect to the lobby for that game.
    $lobby_code_query = "SELECT join_code FROM current_games WHERE host_user=$user_id";
    $join_code = "";
    try {
      $lobby_code_result = mysqli_query($sql_conn, $lobby_code_query);
      if ($row = mysqli_fetch_assoc($lobby_code_result)) {
        $join_code = $row['join_code'];
        echo "Found the code! ".$join_code;
        redirect("./lobby.php?join_code=$join_code");
      }
    } catch (Exception $e) {
      redirect_error("./new-game.php", "Created a new game, but couldn't join it. Maybe try logging in again...");
      echo $e;
      //redirect("./new-game.php?error=$serverError");
    }
  } 
}
?>
      <form class="modal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <span class="error-message"><?php if (isset($_GET['error'])) { echo "Error: " . $_GET['error']; } ?></span>
          <div id="gamemode-button-container">
            <?php foreach($option_array as &$option): ?>
              <label class="big-select">
                <div class="text-container">
                  <p class="gamemode-title"><?= $option->title; ?></p>
                  <p class="gamemode-description"><?= $option->description; ?></p>
                </div>
                <input type="radio" value="<?php echo $option->title; ?>" name="gamemode">
              </label>
            <?php endforeach; ?>
          </div>
          <input type="submit" value="Play">
      </form>
    </div>
  </body>
</html>
