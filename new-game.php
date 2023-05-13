<!DOCTYPE html>
<?php

include("./components/navbar.php");
?>
<html>
  <head>
    <title>New game</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">

    <link rel="stylesheet" href="./assets/stylesheets/pages/page_new-game.css">
    <link rel="stylesheet" href="./assets/stylesheets/variables.css">
  </head>
  <body>
    <div class="main-content-wrapper">
      <h1>New game</h1>
      <div id="gamemode-button-container">
        <button class="big-button">
          <p class="gamemode-title">Singleplayer</p>
          <p class="gamemode-description">Play alone with pre-made questions</p>
        </button>
        <button class="big-button">
          <p class="gamemode-title">Multiplayer</p>
          <p class="gamemode-description">Write and answer questions with friends</p>
        </button>
      </div>
    </div>
  </body>
</html>
