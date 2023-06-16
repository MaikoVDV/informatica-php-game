<?php
function join_game($sql_conn, $join_code) {
  $user_id = $_SESSION['user_id'];
  $join_lobby_query = "
    UPDATE users
    SET current_game = $join_code, correct_answers = 0, selected_answer = NULL
    WHERE id = $user_id;
  ";

  try {
    $join_lobby_result = mysqli_query($sql_conn, $join_lobby_query);
  } catch(Exception $e) {
    redirect_error("./login.php", "Failed to join game. Please try logging in again.");
  }
}
?>
