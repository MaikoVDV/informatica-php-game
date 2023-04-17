<html>
  <head>
    <title>Homepage</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
  </head>
  <body>
<?php
$username = $_POST["username"];
$password = $_POST["password"];

echo "Hello $username, your highly-secured password is $password."
?>

  </body>
</html>
