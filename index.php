<html>
  <head>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
  </head>
  <body>
    <?php include("./components/navbar.php"); ?>
    <div class="main-content-wrapper">
      <h1>AAAAH PHP AAAAAAAH</h1>
      <form action="welcome.php" method="post">
        Name: <input type="text" name="name">
        Age: <input type="text" name="age">
        <input type="submit">
      </form>
    </div>
  </body>
</html>
