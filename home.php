<?php
  include("./database_manager/db_connect.php");

  $username = $_SESSION["username"];
  $password = $_SESSION["password"];
  $user_id = $_SESSION["user_id"];

  echo "Hello $username, your highly-secure password is $password.<br>";

  $msg_query = "SELECT content FROM posted_messages WHERE author_id=$user_id";
  $queried_messages = mysqli_query($sql_conn, $msg_query);

  echo "Messages posted by you: <br>";
  echo "<ul>";
  while ($row = mysqli_fetch_assoc($queried_messages)) {
    echo "<li>" . $row['content'] . "</li>";
  }
  echo "</ul>";
?>
<html>
  <head>
    <title>Homepage</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
  </head>
  <body>


  </body>
</html>
