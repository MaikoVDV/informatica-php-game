<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
  </head>
  <body>
<?php
session_start();
include("./components/navbar.php");
?>
    <div class="main-content-wrapper">
      <?php
        include("./assets/utils.php");
        include("./database_manager/db_connect.php");
      
        // $username = $_SESSION["username"];
        // $password = $_SESSION["password"];
        // $user_id = $_SESSION["user_id"];
        // if (is_null($username)) {
        //   redirect("./login.php");
        // }
      
        // echo "Hello $username, your highly-secure password is $password.<br>";
      
        // $msg_query = "SELECT content FROM posted_messages WHERE author_id=$user_id";
        // $queried_messages = mysqli_query($sql_conn, $msg_query);
      
        // echo "Messages posted by you: <br>";
        // echo "<ul>";
        // while ($row = mysqli_fetch_assoc($queried_messages)) {
        //   echo "<li>" . $row['content'] . "</li>";
        // }
        // echo "</ul>";
      ?>
      <h1>Welcome to my Kahoot ripoff</h1>
      <p>You can play quizzes here with friends (or alone, if you don't have friends). If you think that something is broken with the website, remember: <i>it's a feature, not a bug</i>.</p>

      <h2>User guide</h2>
      <p>You can create or join quizzes. To create a quiz, go to <a href="./new-game.php">Create Game</a> and select "Singleplayer" or "Multiplayer".</p>
      <p>If you'd rather join an existing quiz, ask a friend for the join code and enter it in <a href="./join-game.php">Join Game</a>.<br>
      You can also find the codes for games in the <a href="public-games-list.php">Games List</a>.</p>
      <p>When you join or create a game, you enter a lobby. The creator of the game will start the game when everyone is ready.</p>
      <p>The questions are multiple-choice, and at the end there will be a leaderboard.</p>

      <h2>Notes & Links</h2>
      <p>This website is open source, and hosted on <a href="https://github.com/MaikoVDV/informatica-php-game" target="_blank">GitHub</a></p>
      <p>This website was written in vannilla PHP, SQL, HTML, JavaScript and CSS.</p>
      <p>I'm hosting it myself, on my computer at home.</p>
    </div>
  </body>
</html>
