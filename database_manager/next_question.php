<?php
// Check if other users have answered the question, and if so, move on to the next question.
function check_next_question($sql_conn, $join_code) {
  $answered_users_query = "
    SELECT username 
    FROM users
    WHERE `current_game`=$join_code
    AND selected_answer IS NULL;
  ";

  $answered_users_result = mysqli_query($sql_conn, $answered_users_query);
  $users_without_answer = mysqli_num_rows($answered_users_result);

  if ($users_without_answer === 0) {
    // All users have answered the question. Move on to the next one.
    $next_question_query = "
      UPDATE `current_games`
      SET `current_question`=current_question + 1
      WHERE join_code=$join_code
    ";
    $clear_answers_query = "
      UPDATE `users`
      SET `selected_answer`= NULL
      WHERE current_game=$join_code
    ";
    mysqli_query($sql_conn, $next_question_query);
    mysqli_query($sql_conn, $clear_answers_query);
    refresh();
  }
}
?>
