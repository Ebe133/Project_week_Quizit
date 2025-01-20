<?php
// Include the database connection file
include_once 'database.php';

// Initialize the score of the user
$score = 0;

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch all questions and their correct answers from the database
    $sql = "SELECT id, correct_option FROM questions";
    $result = $conn->query($sql); // Execute the query
    
    // Check if there are results retrieved from the database
    if ($result->num_rows > 0) {
        // Loop through each question and check the answers
        while ($row = $result->fetch_assoc()) {
            // Get the ID and correct answer of the current question
            $question_id = $row['id'];
            $correct_option = $row['correct_option'];

            // Check if the user has answered and if it's correct
            if (isset($_POST["question_$question_id"]) && !empty($_POST["question_$question_id"])) {
                if ($_POST["question_$question_id"] === $correct_option) {
                    $score++; // Increase the score by 1 if the answer is correct
                }
            }
        }
    }

    // Display the final score to the user
    echo "<p>Your score: $score</p>";

    // Close the database connection
    $conn->close();
}
?>
