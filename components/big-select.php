<?php
class SelectOption {
  public $title;
  public $description;
  function __construct(string $title, string $description = "") {
    $this->title = $title;
    $this->description = $description;
  }
}
?>
<!--
<a class="big-button">
  <p class="gamemode-title">Singleplayer</p>
  <p class="gamemode-description">Play alone with pre-made questions</p>
</a>
-->
