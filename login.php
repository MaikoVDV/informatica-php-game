<html>
  <head>
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/page_login.css">
    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
  </head>
  <body>
    <?php
      include("./assets/utils.php");
      include("./database_manager/db_connect.php");
      $usernameError = $passwordError = "";
      $username = $password = "";
      // Only check for login data if request is POST.
      // A GET request would be the user loading the page
      if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $username = clean_user_input($_POST['username']);
        $password = clean_user_input($_POST['password']);
        echo "Username: $username, Password: $password";
        if (empty($username)) {
          $usernameError = "Please enter a valid username";
          echo $usernameError;
        }
        if (empty($password)) {
          $passwordError = "Please enter a valid password.";
        }
        if ($passwordError === "" && $usernameError === "") {
          echo "everying ok";
          redirect("./home.php");
        }
      } else {
        // GET request.
      }
      function clean_user_input($data) {
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
  </body>
</html>
