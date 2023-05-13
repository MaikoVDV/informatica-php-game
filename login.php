<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/pages/page_login.css">
    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
  </head>
  <body>
<?php
include("./components/navbar.php");
?>

    <div class="main-content-wrapper">
<?php
require "./assets/utils.php";
require "./database_manager/db_connect.php";
require "./database_manager/auth.php";

ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);

$usernameError = $passwordError = "";
$username = $password = "";
// Only check for login data if request is POST.
// A GET request would be the user loading the page
if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $username = clean_user_input($_POST['username']);
  $password = clean_user_input($_POST['password']);
  if (empty($username)) {
    $usernameError = "Please enter a valid username";
  }
  if (empty($password)) {
    $passwordError = "Please enter a valid password.";
  }
  if ($passwordError === "" && $usernameError === "") {
    echo "Entered Username: $username, Password: $password<br>";
    // The user has inputted a valid username and password.
    // Should now ask the database for user info.

    $login_query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $query_result = mysqli_query($sql_conn, $login_query);
    if ($query_result) {
    } else {
      exit("Query error.");
    }
    if ($row = mysqli_fetch_assoc($query_result)) {
      //echo "Found a user:<br>Found username: " .$row["username"] . ", password: ". $row["password"];
      setCredentials($row["id"], $row["username"], $row["password"]);
      redirect("./home.php");
    }
  }
} else {
  // GET request.
}
function clean_user_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
      <div class="modal" id="login-container">
        <h1>Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <input type="text" name="username" placeholder="Username"> 
          <span class="error-message"><?php echo "$usernameError"; ?></span>
          <input type="password" name="password" placeholder="Password"> 
          <span class="error-message"><?php echo $passwordError; ?></span>
          <input type="submit" value="Login">
        </form>
      </div>
    </div>
  </body>
</html>
