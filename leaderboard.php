<?php
session_start();
require("./database_manager/db_connect.php");
require("./assets/utils.php");
require("./database_manager/join_game_function.php");

include("./components/navbar.php");
?>
<html>
  <head>
    <title>Leaderboard</title>

    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/pages/page_leaderboard.css">
    <link rel="stylesheet" href="./assets/stylesheets/big_select.css">
    <link rel="stylesheet" href="./assets/stylesheets/button.css">
    <link rel="stylesheet" href="./assets/stylesheets/modal.css">
    <link rel="stylesheet" href="./assets/stylesheets/player_list.css">
    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
  </head>
  <body>
    <div class="main-content-wrapper">
<?php
$join_code = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch users and amount correct answers
$leaderboard_query = 
 "SELECT username, correct_answers
  FROM `users`
  WHERE `current_game`=$join_code
  ORDER BY correct_answers DESC;
";
// $leaderboard is an array with associative arrays. So it looks like
// [[user1, 3], [user2, 4], [user3, 1]]
$leaderboard_result = mysqli_query($sql_conn, $leaderboard_query);
$leaderboard = mysqli_fetch_all($leaderboard_result);
?>
      <h1>Leaderboard</h1>
      <ol id="leaderboard" class="player-list">
        <?php foreach ($leaderboard as &$ranked_user): ?>
        <li>
          <p><?php echo $ranked_user[0]?></p>
          <p><b><?php echo $ranked_user[1]?></b> questions correct</p>
        </li>
        <?php endforeach; ?>
        </ol>
    </div>
  </body>
</html>
