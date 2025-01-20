<?php
include_once 'database.php';

$sql = "SELECT id, correct_option FROM questions";
$result = $conn->query($sql);

$score = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $question_id = $row['id'];
        $correct_option = $row['correct_option'];
        if (isset($_POST["question_$question_id"]) && $_POST["question_$question_id"] === $correct_option) {
            $score++;
        }
    }
}

echo "<p>Your score: $score</p>";

$conn->close();
?>
