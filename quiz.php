<?php
include_once 'database.php';

// Check if a specific quiz ID is provided in the query string
if (!isset($_GET['quiz_id'])) {
    echo "No quiz selected. Please select a quiz.";
    exit;
}

$quizId = $_GET['quiz_id'];

// Fetch the quiz title
$quizQuery = $conn->prepare("SELECT title FROM quizzes WHERE id = ?");
$quizQuery->bind_param('i', $quizId);
$quizQuery->execute();
$quizResult = $quizQuery->get_result();
$quiz = $quizResult->fetch_assoc();

if (!$quiz) {
    echo "Quiz not found.";
    exit;
}

// Fetch questions for the selected quiz
$sql = "SELECT * FROM questions WHERE quiz_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $quizId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="quiz.css">
    <title><?php echo htmlspecialchars($quiz['title']); ?> - Quiz</title>
</head>
<body>
    <header id="header">
        <h1><?php echo htmlspecialchars($quiz['title']); ?></h1>
    </header>

    <div id="timerDisplay">10</div> <!-- Timer display -->

    <form action="submit_quiz.php" method="POST">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<p>" . htmlspecialchars($row['question_text']) . "</p>";
                echo "<input type='radio' name='question_" . $row['id'] . "' value='A'> " . htmlspecialchars($row['option_a']) . "<br>";
                echo "<input type='radio' name='question_" . $row['id'] . "' value='B'> " . htmlspecialchars($row['option_b']) . "<br>";
                echo "<input type='radio' name='question_" . $row['id'] . "' value='C'> " . htmlspecialchars($row['option_c']) . "<br>";
                echo "<input type='radio' name='question_" . $row['id'] . "' value='D'> " . htmlspecialchars($row['option_d']) . "<br>";
                echo "</div>";
            }
        } else {
            echo "<p>No questions available for this quiz.</p>";
        }
        ?>
        <input type="submit" value="Submit Quiz">
    </form>

    <button id="LinkButton" onclick="CopyLink()">Copy Quiz Link</button>

    <body>
    <div>
        <div id="timerDisplay">1000</div>
        <form action="/submit" method="POST">
            <!-- Form content here -->
            <button type="button" id="copyButton" onclick="CopyLink()">Copy Quiz Link</button>
        </form>
    </div>

    <script>
    // Timer functionality
    let timer = 120; // Starting timer value in seconds (2 minutes)
    let interval;

    function startTimer() {
        interval = setInterval(() => {
            timer--;
            
            // Convert seconds to minutes and seconds
            let minutes = Math.floor(timer / 60);
            let seconds = timer % 60;
            
            // Format timer with leading zeros if needed (e.g., 02:05 instead of 2:5)
            document.getElementById("timerDisplay").innerText = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
            
            if (timer <= 0) {
                clearInterval(interval);
                alert("Time's up! Submitting the quiz.");
                document.querySelector("form").submit(); // Automatically submit when timer ends
            }
        }, 1000);
    }

    window.onload = startTimer;
</script>

</body>
</html>
