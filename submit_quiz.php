<?php
// Include the database connection file
include_once 'database.php';

// Initialize the user's score and total questions
$score = 0;
$total_questions = 0;
$errors = 0;

// Check if the form is submitted and a quiz ID is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quiz_id'])) {
    $quizId = $_POST['quiz_id'];

    // Fetch all questions and their correct answers for the specified quiz
    $sql = "SELECT id, correct_option FROM questions WHERE quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $quizId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if questions were retrieved from the database
    if ($result->num_rows > 0) {
        // Loop through each question and validate the user's answers
        while ($row = $result->fetch_assoc()) {
            $question_id = $row['id'];
            $correct_option = $row['correct_option'];

            // Increment the total number of questions
            $total_questions++;

            // Check if the user answered the question and if the answer is correct
            if (isset($_POST["question_$question_id"]) && !empty($_POST["question_$question_id"])) {
                if ($_POST["question_$question_id"] === $correct_option) {
                    $score++; // Increment the score for a correct answer
                }
            }
        }
    }

    // Calculate the number of errors
    $errors = $total_questions - $score;

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect back to the homepage if the form was not submitted properly
    header("Location: homepage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Resultaat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
            color: #333;
        }
        .result-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .result-container h2 {
            color: #333;
        }
        .result-container p {
            font-size: 1.2em;
            color: #555;
        }
        .result-container a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #42bfdd;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: bold;
        }
        .result-container a:hover {
            background-color: #084b83;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h2>Quiz Resultaat</h2>
        <p>Je score: <?php echo $score; ?> van <?php echo $total_questions; ?></p>
        <p>Aantal fouten: <?php echo $errors; ?></p>
        <a href="homepage.php">Terug naar de homepagina</a>
    </div>
</body>
</html>
