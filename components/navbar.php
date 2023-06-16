<html>
<body>
  <style>
    @import "./assets/stylesheets/navbar.css";
  </style>
  <nav class="navbar">
    <div id="main-links">
      <div class="navbar-link">
        <a href="./home.php">Home</a>
      </div>
      <div class="navbar-link">
        <a href="./new-game.php">Create game</a>
      </div>
      <div class="navbar-link">
        <a href="./join-game.php">Join game</a>
      </div>
      <div class="navbar-link">
        <a href="./public-games-list.php">Public games</a>
      </div>
    </div>
    <?php if (isset($_SESSION["username"])): ?>
    <div class="navbar-link">
      <a href="./login.php"><?php echo $_SESSION["username"]; ?></a>
    </div>
    <?php else: ?>
    <div id="account-links">
      <div class="navbar-link">
        <a href="./login.php">Login</a>
      </div>
      <div class="navbar-link">
        <a href="./register.php">Register</a>
      </div>
    </div>
    <?php endif; ?>
  </nav>
</body>
</html>
