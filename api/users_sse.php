<?php
// Setup http connection for Server Source Events
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once("../database_manager/db_connect.php");

$join_code = $_GET['join_code'];
$user_list_query = "SELECT username FROM users WHERE current_game=$join_code";

// Code here can't use sessions, because they cause extremely long loading with this interval-based loop.
session_write_close();
while(1) {
  try {
    $user_list_result = mysqli_query($sql_conn, $user_list_query);

    $user_list = [];
    while ($row = mysqli_fetch_assoc($user_list_result)) {
      array_push($user_list, $row['username']);
    }
  } catch(Exception $e) {
    echo "data: Error while querying for users.\n\n";
  }
  // Convert PHP array to JSON and echo so it can be sent to client.
  echo "data: ".json_encode($user_list)."\n\n"; 

  while (ob_get_level() > 0) {
    ob_end_flush();
  }
  // Send all the echos to the client.
  flush();

  if (connection_aborted()) {
    echo "data: Connection aborted.\n\n";
    break;
  }
  
  sleep(3);
}
$sql_conn->close();
?>
