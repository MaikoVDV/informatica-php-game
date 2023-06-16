<?php
class GameStateData {
  public $state = "Lobby";
  public $question = 0;

  function __construct(string $s, int $q) {
    $this->state = $s;
    $this->question = $q;
  }
}
// Fetch the gamestate to decide what data to send to users.
function fetch_game_state($sql_conn, $join_code) {
  $game_state_query = "SELECT game_state, current_question FROM current_games WHERE join_code=$join_code";
  try {
    $game_state_result = mysqli_query($sql_conn, $game_state_query);
    $row = mysqli_fetch_assoc($game_state_result);
    $game_state = $row['game_state'];
    $current_question = $row['game_state'];

    // $data = new GameStateData($game_state, $current_question);
    $data = new GameStateData($game_state, (int)$current_question);
    return json_encode($data);
  } catch (Exception $e) {
    
  }
}
?>
