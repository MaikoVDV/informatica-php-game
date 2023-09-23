<!DOCTYPE html>
<?php
session_start();
include("./assets/utils.php");
require("./database_manager/join_game_function.php");
require "./database_manager/db_connect.php";

include("./components/navbar.php");
include_once("./components/big-select.php");
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
// Need a user_id to create a game. Redirect if user is not logged in.
$user_id = $_SESSION["user_id"];
if (is_null($user_id)) {
  redirect_error("./login.php", "You need to log in to create a game.");
}

// Options the user can pick
$option_array = array(
  new SelectOption("Singleplayer", "Answer pre-made questions if you don't have friends"),
  new SelectOption("Multiplayer", "Write and answer questions with friends")
);

$question_category_query = "SELECT `id`, `name` FROM `question_categories`";
$question_category_result = mysqli_query($sql_conn, $question_category_query);
$question_categories = array();
while ($row = mysqli_fetch_assoc($question_category_result)) {
  array_push($question_categories, $row);
}

// Adding the new game to the database
$gamemodeError = "";
if ($_SERVER['REQUEST_METHOD'] === "POST") {

  $chosen_gamemode = $_POST['gamemode'];
  $chosen_category = $_POST['category'];
  if (empty($chosen_gamemode)) {
    redirect_error("./new-game.php", "Please select a gamemode.");
  }
  $join_code = random_int(100000, 999999);
  try {
    $existing_game_query = "SELECT join_code FROM `current_games` WHERE `host_user` = $user_id AND `game_state` <> 'Ended'";
    $existing_game_result = mysqli_query($sql_conn, $existing_game_query);
    if (mysqli_num_rows($existing_game_result) > 0) {
      $existing_game_join_code = mysqli_fetch_assoc($existing_game_result)["join_code"];
      redirect_error("./join-game.php", "It looks like you're already hosting a game. The join code is <b>$existing_game_join_code</b>");
      return;
    }
    $game_create_query = "INSERT INTO `current_games` (`join_code`, `host_user`, `access_group`, `question_category`) VALUES ($join_code, $user_id, '$chosen_gamemode', '$chosen_category');";
    $game_create_result = mysqli_query($sql_conn, $game_create_query);
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
  if ($game_create_result) {
    echo "Created new game!";

    // The game has been created. Redirect to the lobby for that game.
    $lobby_code_query = "SELECT `join_code` FROM current_games WHERE `host_user`='$user_id' AND `game_state` <> 'Ended'";
    $join_code = "";
    try {
      $lobby_code_result = mysqli_query($sql_conn, $lobby_code_query);
      if ($row = mysqli_fetch_assoc($lobby_code_result)) {
        $join_code = $row['join_code'];
        echo "Found the code! ".$join_code;
        join_game($sql_conn, $join_code);
      }
    } catch (Exception $e) {
      redirect_error("./new-game.php", "Created a new game, but couldn't join it. Maybe try logging in again...");
      echo $e;
    }
  } 
}
?>
      <form class="modal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <span class="error-message"><?php if (isset($_GET['error'])) { echo "Error: " . $_GET['error']; } ?></span>
        <div id="gamemode-button-container">
          <?php foreach($option_array as &$option): ?>
            <label class="big-select gamemode-button" id="<?php echo "gamemode_select_".$option->title; ?>">
              <div class="text-container">
                <p class="gamemode-title"><?= $option->title; ?></p>
                <p class="gamemode-description"><?= $option->description; ?></p>
              </div>
              <input type="radio" value="<?php echo $option->title; ?>" name="gamemode">
            </label>
          <?php endforeach; ?>
        </div>
        <div id="question-categories">
          <select name="category">
            <?php foreach($question_categories as &$option): ?>
            <option value="<?php echo $option['id']; ?>">
              <?php echo $option['name']; ?>
            </option>
            <?php endforeach; ?>
          </select>
        </div>
        <input type="submit" value="Play">
      </form>
    </div>
  </body>
</html>
