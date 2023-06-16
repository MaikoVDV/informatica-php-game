<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$game_code = $_POST['game_code'];
if (empty($game_code)) {
  echo "Didn't get a game_code";
  return;
}
echo "Got a game code: $game_code";
include_once("../database_manager/db_connect.php");

$users_query = "SELECT username from users WHERE current_game=$game_code";
$users_list_result = mysqli_query($sql_conn, $users_query);

$user_list = [];
while ($row = mysqli_fetch_assoc($users_list_result)) {
  array_push($user_list, $row['username']);
}

?>
<html>
  <body>
    <h1>Users!!!</h1>
    <?php foreach($user_list as $user): ?>
    <p><?php echo $user; ?></p>
    <?php endforeach; ?> 
  </body>
</html>
