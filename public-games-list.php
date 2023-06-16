<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
?>
<html>
  <head>
    <title>Games directory</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
    <link rel="stylesheet" href="./assets/stylesheets/pages/page_join_game.css">
  </head>
  <body>
<?php
session_start();
include("./components/navbar.php");

include("./assets/utils.php");
require "./database_manager/db_connect.php";
?>
    <div class="main-content-wrapper">
      <div class="modal">
        <h1>Games</h1>
<?php
// The game has been created. Redirect to the lobby for that game.
$lobby_query = "
  SELECT current_games.join_code, users.username, question_categories.name 
  FROM current_games 
  INNER JOIN users ON current_games.host_user=users.id
  INNER JOIN question_categories ON current_games.question_category=question_categories.id
  WHERE access_group='Multiplayer'"; 
try {
  $lobby_query_result = mysqli_query($sql_conn, $lobby_query);
  while ($row = mysqli_fetch_assoc($lobby_query_result)) {
    $host_user = $row['username'];
    $join_code = $row['join_code'];
    $category = $row['name'];
    echo "Created by $host_user. Category: $category | Join code: $join_code"."<br>";
  }
} catch (Exception $e) {
  echo $e;
  //redirect_error("./public-games-list.php", "Failed to fetch current public games. Please try again later.");
}
?>
      </div>
    </div>
  </body>
</html>
