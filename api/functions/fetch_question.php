<?php
// Fetches what question the game is currently on so clients can go there if necessary.
function fetch_question($sql_conn, $join_code) {
  $current_question_query = "SELECT current_question FROM current_games WHERE join_code=$join_code";
  try {
    $current_question_result = mysqli_query($sql_conn, $current_question_query);
    $game_state = mysqli_fetch_assoc($current_question_result)['current_question'];
  } catch (Exception $e) {
    
  }
  return $game_state;
}
?>
