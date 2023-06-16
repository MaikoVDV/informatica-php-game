<?php
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
