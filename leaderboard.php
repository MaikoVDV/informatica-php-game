<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

    <link rel="stylesheet" href="./assets/stylesheets/big_select.css">
    <link rel="stylesheet" href="./assets/stylesheets/button.css">
    <link rel="stylesheet" href="./assets/stylesheets/modal.css">
    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
  </head>
  <body>
    <div class="main-content-wrapper">
<?php
$join_code = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch users and correct answers
$leaderboard_query = "
  SELECT username, correct_answers
  FROM `users`
  WHERE `current_game`=$join_code;
";
$leaderboard_result = mysqli_query($sql_conn, $leaderboard_query);
$leaderboard = mysqli_fetch_all($leaderboard_result);
echo var_dump($leaderboard);
?>
      <h1>Leaderboard</h1>
      <?php foreach ($leaderboard as &$ranked_user): ?>
      <div class="leaderboard-result">
        <p><?php echo $ranked_user[0]?></p>
        <p><?php echo $ranked_user[1]?> questions correct</p>
      </div>
      <?php endforeach; ?>
    </div>
  </body>
</html>
