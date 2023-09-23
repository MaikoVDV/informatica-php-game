<?php
// Players connect to this API endpoint when in game. It sends updates about the game every x seconds.
//
//
// Setup http connection for Server Source Events
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

ini_set('display_errors', 1);
error_reporting(E_ALL);

require("../database_manager/db_connect.php");

// Helper functions for querying the database.
require("./functions/echo_message.php");
require("./functions/fetch_game_state.php");
require("./functions/fetch_users.php");
require("./functions/fetch_question.php");

$join_code = $_GET['join_code'];

// Code here can't use sessions, because they cause extremely long loading with this interval-based loop.
session_write_close();
while(1) {
  $game_state = fetch_game_state($sql_conn, $join_code);

  // Sending messages
  echo_message("game_state", $game_state);
  echo_message("username_list", json_encode(fetch_users($sql_conn, $join_code)));

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
