<!DOCTYPE html>
<html>
  <head>
    <title>Welcome</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
  </head>
  <body>
    <h1>Welcome.php</h1>
<?php
$name = $_POST["name"];
$age = $_POST["age"];
echo "Hi $name, you are $age years old.";
?>
  </body>
</html>
