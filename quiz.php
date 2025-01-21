<?php
include_once 'database.php';

$sql = "SELECT * FROM questions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="quiz.css">
    <title>Quiz</title>
</head>
<body>
    <header id="header">
    <h1>Quiz</h1>
    </header>
    <div id="timerDisplay">10</div> <!-- De beginnende waarde van de timer -->
    <form action="submit_quiz.php" method="POST">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<p>" . htmlspecialchars($row['question']) . "</p>";
                echo "<input type='radio' name='question_" . $row['id'] . "' value='A'> " . htmlspecialchars($row['option_a']) . "<br>";
                echo "<input type='radio' name='question_" . $row['id'] . "' value='B'> " . htmlspecialchars($row['option_b']) . "<br>";
                echo "<input type='radio' name='question_" . $row['id'] . "' value='C'> " . htmlspecialchars($row['option_c']) . "<br>";
                echo "<input type='radio' name='question_" . $row['id'] . "' value='D'> " . htmlspecialchars($row['option_d']) . "<br>";
                echo "</div>";
            }
        } else {
            echo "<p>No questions available.</p>";
        }
        ?>
        <input type="submit" value="Submit Quiz">
    </form>
</body>
<script>
let timer = 10; // Initialiseer de timer met de gewenste begintijd (bijv. 60 seconden)

if(timer > 0){
    function startTimer() {
    interval = setInterval(() => {
        timer--;
        document.getElementById("timerDisplay").innerText = timer; // Werk de tijd bij op de website
        if (timer <= 0) {
            clearInterval(interval); // Stop de timer als deze nul bereikt
        }
    }, 1000);
}
} else {
    alert(`Quiz is over!`);
}

window.load = startTimer()
</script>
</html>
