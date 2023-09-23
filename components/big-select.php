<?php
// Stores the data for big-select buttons.
// Thought I'd use these in more parts of the website, but only ended up using them in new-game.php for selecting Singleplayer or Multiplayer.
class SelectOption {
  public $title;
  public $description;
  function __construct(string $title, string $description = "") {
    $this->title = $title;
    $this->description = $description;
  }
}
?>
