<?php
function join_game($sql_conn, $join_code) {
  $user_id = $_SESSION['user_id'];
  // Check if the user can join the game.
  // Conditions:
  //  1. Game exists with join code entered by the user.
  //  2. Other players are allowed to join (game is Multiplayer) OR the user is the host
  //  3. The game is still running (state is not 'Ended')
  $game_verify_query = "SELECT `join_code` FROM `current_games` WHERE `join_code` = $join_code AND (`access_group` = 'Multiplayer' OR `host_user` = '$user_id') AND `game_state` <> 'Ended'";
  $game_verify_result = mysqli_query($sql_conn, $game_verify_query);
  if (mysqli_num_rows($game_verify_result) <= 0) {
    // No valid game found.
    redirect_error("./join-game.php", "Couldn't join the game. Maybe it has ended...?");
  } else {
    $join_lobby_query = "
      UPDATE users
      SET current_game = $join_code, correct_answers = 0, selected_answer = NULL
      WHERE id = $user_id;
    ";
  
    try {
      $join_lobby_result = mysqli_query($sql_conn, $join_lobby_query);
      redirect("./lobby.php?join_code=$join_code");
    } catch(Exception $e) {
      redirect_error("./login.php", "Failed to join game. Please try logging in again.");
    }
  }
}
?>
