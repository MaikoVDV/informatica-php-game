<?php
// Players connect to this endpoint when they go to a question in a game.
// It checks if the question has been answered by all players, so the players can move on to the
// next question when it is time.

// Setup http connection for Server Source Events
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

ini_set('display_errors', 1);
error_reporting(E_ALL);

require("../database_manager/db_connect.php");

// Helper functions for querying the database.
require("./functions/echo_message.php");
require("./functions/fetch_question.php");
require("./functions/fetch_blank_users.php");

$join_code = $_GET['join_code'];

// Code here can't use sessions, because they cause extremely long loading with this interval-based loop.
session_write_close();
while(1) {
  // Sending messages
  $question = fetch_question($sql_conn, $join_code);
  echo_message("current_question", $question);
  $user_list = fetch_blank_users($sql_conn, $join_code);
  echo_message("blank_users", json_encode($user_list));


  // After all the querying work has been done, flush the buffered echo messages to the client,
  // Check if the client is still connected (if not, break the loop)
  // And sleep for x seconds to not DDOS the database and clients.
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
?>
