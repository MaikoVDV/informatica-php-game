<html>
<!-- Navbar is used on all pages, so I'm putting it in a separate PHP file and importing it where I need it. -->
<body>
  <style>
    @import "./assets/stylesheets/navbar.css";
  </style>
  <nav class="navbar">
    <div id="main-links">
      <div class="navbar-link">
        <a href=".">Home</a>
      </div>
      <div class="navbar-link">
        <a href="./join-game.php">Join game</a>
      </div>
      <div class="navbar-link">
        <a href="./new-game.php">Create game</a>
      </div>
      <div class="navbar-link">
        <a href="./public-games-list.php">Lobby list</a>
      </div>
    </div>
<!-- Show username if logged in, or Login and Register buttons if not logged in. -->
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
