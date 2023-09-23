<?php
// Probably useless object, but I'm afraid of removing it because everything will probably break,
// and I'm writing this sentence at 15:23, 7 minutes before I have to show this project.
class GameData {
  public $join_code;
  public $host_username;
  public $question_category;

  function __construct(int $join_code, string $host_username, string $category) {
    $this->join_code = $join_code;
    $this->host_username = $host_username;
    $this->question_category = $category;
  }
}
?>
