<?php
// Fetch the question
function fetch_question($sql_conn, $join_code) {
  $question_query = 
    "SELECT *
    FROM questions
    WHERE category_id IN (
      SELECT question_category
      FROM current_games
      WHERE join_code=$join_code
    )
    ORDER BY id ASC
  ";
  // Get the index of the question. Note: This is not a foreign key for the question the index of a question can very between games.
  $question_index_query = "
    SELECT current_question
    FROM current_games
    WHERE join_code=$join_code
  ";

  // Fetching all of the questions in the category, and then selecting the one with the right index.
  // I'm querying way more data than I need to (Because I only need to fetch one question, but am fetching all of them),
  // but I felt more confident implementing this in PHP rather than in SQL.
  $questions_result = mysqli_query($sql_conn, $question_query);
  $questions = mysqli_fetch_all($questions_result, MYSQLI_ASSOC);

  $question_index_result = mysqli_query($sql_conn, $question_index_query);
  $current_q_index = mysqli_fetch_assoc($question_index_result);

  try {
    // Go to the leaderboard if the index of the question is greater than the amount of questions in the category.
    // This would mean that all of the questions have been asked and answered.
    if ($current_q_index['current_question'] >= sizeof($questions)) {
      $end_game_query = "UPDATE `current_games` SET `game_state` = 'Ended' WHERE `join_code` = '$join_code'";
      mysqli_query($sql_conn, $end_game_query);
      redirect("./leaderboard.php?id=$join_code");
    }
    // $row represents only the question users need to answer now.
    $row = $questions[$current_q_index['current_question']];

    // Storing the data in a PHP object.
    // sub_title, answer_3 and answer_4 can be null, so I'm using a ternary operator to check if they are set,
    // And entering empty strings if they are not.
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

// Object for storing the current question.
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
