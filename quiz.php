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

    <div id="timerDisplay" style="
    font-size: 30px; 
    font-weight: bold; 
    text-align: center; 
    margin: 20px auto; 
    display: block; 
    width: 100%; ">2:00</div> <!-- Timer display -->

    <form action="submit_quiz.php" method="POST">
    <input type="hidden" name="quiz_id" value="<?php echo $quizId; ?>">
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
    $quizQuery = $conn->prepare("SELECT title, timer FROM quizzes WHERE id = ?");
    $quizQuery->bind_param('i', $quizId);
    $quizQuery->execute();
    $quizResult = $quizQuery->get_result();
    $quiz = $quizResult->fetch_assoc();
    $timer = $quiz['timer'];
    ?>
    <input type="submit" value="Submit Quiz">
</form>

    <body>
    <div>
        <form action="/submit" method="POST">
            <!-- Form content here -->
            <button type="button" id="copyButton" onclick="CopyLink()">Copy Quiz Link</button>
        </form>
    </div>
     
    <script>
    // Get the timer value from PHP
let timer = <?php echo $timer; ?>; // Timer value in seconds

function startTimer() {
    const timerDisplay = document.getElementById("timerDisplay");

    const interval = setInterval(() => {
        const minutes = Math.floor(timer / 60);
        const seconds = timer % 60;
        timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        timer--;

        if (timer < 0) {
            clearInterval(interval);
            alert('Time is up!');
        }
    }, 1000);
}

window.onload = startTimer;

    function CopyLink() {
            const quizLink = `http://${window.location.hostname}/quiz.php?quiz_id=<?php echo $quizId; ?>`;
            navigator.clipboard.writeText(quizLink);
            alert("Copied the link: " + quizLink);
        }

    window.onload = startTimer;
</script>

</body>
</html>
