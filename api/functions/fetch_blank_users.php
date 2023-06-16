<?php
// This function fetches users and returns an array of their usernames.
function fetch_blank_users($sql_conn, $join_code) {
  $user_list_query = "SELECT username, selected_answer FROM users WHERE current_game=$join_code";
  try {
    $user_list_result = mysqli_query($sql_conn, $user_list_query);

    $user_list = [];
    while ($row = mysqli_fetch_assoc($user_list_result)) {
      $answer_value = ($row['selected_answer'] == null) ? null : "ANSWERED";
      array_push($user_list, array($row['username'], $answer_value));
    }
  } catch(Exception $e) {
    echo "data: Error while querying for users.\n\n";
  }
  // Needs to be encoded to JSON when sent to clients.
  return $user_list;
}
?>
