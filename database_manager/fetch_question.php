<?php
function fetch_question($sql_conn, $join_code) {
  $question_query = 
    "SELECT title, sub_title, correct_answer, answer_1, answer_2, answer_3, answer_4
    FROM questions
    WHERE category_id IN (
      SELECT question_category
      FROM current_games
      WHERE join_code=$join_code
    )
    ORDER BY id ASC
  ";
  $question_index_query = "
    SELECT current_question
    FROM current_games
    WHERE join_code=$join_code
  ";

  $questions_result = mysqli_query($sql_conn, $question_query);
  $questions = mysqli_fetch_all($questions_result, MYSQLI_ASSOC);

  $question_index_result = mysqli_query($sql_conn, $question_index_query);
  $current_q_index = mysqli_fetch_assoc($question_index_result);

  try {
    if ($current_q_index['current_question'] >= sizeof($questions)) {
      $end_game_query = "UPDATE `current_games` SET `game_state` = 'Ended' WHERE `join_code` = '$join_code'";
      mysqli_query($sql_conn, $end_game_query);
      redirect("./leaderboard.php?id=$join_code");
    }
    $row = $questions[$current_q_index['current_question']];

    // if (is_null($row['sub_title'])) {
    //   $row['sub_title'] = "";
    // }

    return new Question(
      $row['title'],
      (isset($row['sub_title'])) ? $row['sub_title'] : "",
      $row['answer_1'],
      $row['answer_2'],
      (isset($row['answer_3'])) ? $row['answer_3'] : "",
      (isset($row['answer_4'])) ? $row['answer_4'] : "",
      $row['correct_answer'],
      $current_q_index['current_question'],
      sizeof($questions)
    );
  } catch (Exception $e) {
    echo "Failed to fetch question.";
  }
}
class Question {
  public $title;
  public $sub_title;
  public $answers;
  public $correct_answer;
  public $current_game_index;
  public $total_questions;

  function __construct(string $t, string $st, string $a1, string $a2, string $a3, string $a4, int $c_answer, int $index, int $total_questions) {
    $this->title = $t;
    $this->sub_title = $st;
    $this->answers = array($a1, $a2, $a3, $a4);
    $this->correct_answer = $c_answer;
    $this->current_game_index = $index;
    $this->total_questions = $total_questions;
  }
}
?>
