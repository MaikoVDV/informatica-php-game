<!DOCTYPE html>
<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

session_start();
require("./database_manager/db_connect.php");
require("./assets/utils.php");
include_once("./components/game_data.php");

include("./components/navbar.php");
include("./database_manager/fetch_question.php");
include("./database_manager/next_question.php");

?>
<html>
  <head>
    <title>Game</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/pages/page_game.css">
    <link rel="stylesheet" href="./assets/stylesheets/big_select.css">
    <link rel="stylesheet" href="./assets/stylesheets/button.css">
    <link rel="stylesheet" href="./assets/stylesheets/modal.css">
    <link rel="stylesheet" href="./assets/stylesheets/player_list.css">
    <link rel="stylesheet" href="./assets/stylesheets/variables.css">

    <script src="./components/game_manager.js"></script>
  </head>
  <body>
    <div class="main-content-wrapper">
<?php
$join_code = $_GET['id'];
$user_id = $_SESSION['user_id'];
$game_data = unserialize($_SESSION['game_data']);

// Updating game state to send other clients to game.php
if($game_data->host_username === $_SESSION['username']) {
  $game_state_update_query = "
    UPDATE `current_games`
    SET `game_state`='Game'
    WHERE join_code=$join_code";
  
  try {
    $state_update_result = mysqli_query($sql_conn, $game_state_update_query);
  } catch (Exception $e) {

  } 
}

// Question processing
$question = fetch_question($sql_conn, $join_code);

if($_SERVER['REQUEST_METHOD'] === "POST") {
  // If the user has answered the question, update the database with their answer.
  if (isset($_POST['selected_answer'])) {
    $selected_answer = $_POST['selected_answer'];
    $escaped_answer = mysqli_real_escape_string($sql_conn, $selected_answer);
    $submit_answer_query = "
      UPDATE `users`
      SET `selected_answer`='$escaped_answer'
      WHERE `users`.`id`='$user_id';
    ";
    mysqli_query($sql_conn, $submit_answer_query);

    if ($question->answers[$question->correct_answer - 1] === $selected_answer) {
      // User entered the correct answer.
      $correct_answer_query = "
        UPDATE `users`
        SET `correct_answers` = correct_answers + 1
        WHERE `users`.`id`='$user_id';
      ";
      mysqli_query($sql_conn, $correct_answer_query);
    }
  } 
}

// Check if the user has answered the question already, and hide the buttons if so.
$check_answered_query = "SELECT `selected_answer` from `users` WHERE `id`='$user_id'";
$check_answered_result = mysqli_query($sql_conn, $check_answered_query);

$already_answered = mysqli_fetch_assoc($check_answered_result)["selected_answer"] != null;
check_next_question($sql_conn, $join_code);

$form_url = htmlspecialchars($_SERVER['PHP_SELF'])."?id=$join_code";
?>
<h3 style="margin-bottom: 0px"><?php echo "Question " . $question->current_game_index+1 . "/" . $question->total_questions; ?></h3>
<?php if(!$already_answered): ?>
      <form class="" method="post" action="<?php echo $form_url; ?>">
          <span class="error-message"><?php if (isset($_GET['error'])) { echo "Error: " . $_GET['error']; } ?></span>
          <h1><?php echo $question->title; ?></h1>
          <h2><?php echo $question->sub_title; ?></h2>
          <div id="answer-button-container">
            <?php foreach($question->answers as &$possible_answer): ?>
              <?php if($possible_answer !== ""): ?>
                <label class="big-select">
                  <div class="text-container">
                    <p class="gamemode-title"><?= $possible_answer; ?></p>
                  </div>
                  <input type="submit" value="<?php echo $possible_answer; ?>" name="selected_answer">
                </label>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
      </form>
<?php endif; ?>
      <div>
        <h2>Waiting for</h2>
        <ul id="blank-users-list" style="padding: 0px;">
            </ul>
      </div>
      <script defer>
        //fetchUsers(<?php echo $join_code; ?>);
        fetchQuestionSSE(<?php echo $join_code; ?>, <?php echo $question->current_game_index ?>);
        // setInterval(fetchUsers, 5000, <?php echo $join_code ?>);
      </script>
    </div>
  </body>
</html>
