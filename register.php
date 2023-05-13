<?php
include("./assets/utils.php");
include("./database_manager/db_connect.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

function clean_user_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
    <link rel="stylesheet" href="./assets/stylesheets/pages/page_register.css">
  </head>
  <body>
    <?php include("./components/navbar.php"); ?>

    <div class="main-content-wrapper">
<?php

$usernameError = $passwordError = "";
$username = $password = "";
$serverError = "";
// Only check for login data if request is POST.
// A GET request would be the user loading the page
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require("./database_manager/auth.php");
    
    $username = clean_user_input($_POST['username']);
    $password = clean_user_input($_POST['password']);
    if (empty($username)) {
        $usernameError = "Please enter a valid username";
    }
    if (empty($password)) {
        $passwordError = "Please enter a valid password.";
    }
    if ($passwordError === "" && $usernameError === "") {
        //echo "Entered Username: $username, Password: $password<br>";
        // The user has inputted a valid username and password.
        // Should now ask the database to create a new user.

        $register_query = "INSERT INTO `users` (`id`, `username`, `password`, `join_date`) VALUES (NULL, '$username', '$password', current_timestamp());";
        try {
            mysqli_query($sql_conn, $register_query);
        } catch (Exception $e) {
            echo "Error: $e";
            $serverError = match($e->getCode()) {
                1062 => "Someone with that username exists!",
                default => "An unknown error occurred. Please try again later.",
            };
        }
        if (empty($serverError)) {
            echo "Database query successful!";
        }
        //if ($row = mysqli_fetch_assoc($query_result)) {
        //  //echo "Found a user:<br>Found username: " .$row["username"] . ", password: ". $row["password"];
        //  $requestError = $row;
        //  $_SESSION['user_id'] = $row["id"];
        //  $_SESSION['username'] = $row["username"];
        //  $_SESSION['password'] = $row["password"];

        //  //redirect("./home.php");
        //}
    }

} else {
    // GET request.
}
?>
      <div class="modal" id="register-container">
        <h1>Register</h1>
        <div class="error-message h-centered"><?php echo "$serverError"; ?></div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <input type="text" name="username" placeholder="Username"> 
          <span class="error-message"><?php echo "$usernameError"; ?></span>
          <input type="password" name="password" placeholder="Password"> 
          <span class="error-message"><?php echo $passwordError; ?></span>
          <input type="submit" value="Register new account">
        </form>
      </div>
    </div>
  </body>
</html>
