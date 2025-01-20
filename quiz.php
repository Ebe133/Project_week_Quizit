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
    <title>Quiz</title>
</head>
<body>
    <h1>Quiz</h1>
    <form action="submit_quiz.php" method="POST">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<p>" . htmlspecialchars($row['question']) . "</p>";
                echo "<input type='radio' name='question_" . $row['ID'] . "' value='A'> " . htmlspecialchars($row['option_a']) . "<br>";
                echo "<input type='radio' name='question_" . $row['ID'] . "' value='B'> " . htmlspecialchars($row['option_b']) . "<br>";
                echo "<input type='radio' name='question_" . $row['ID'] . "' value='C'> " . htmlspecialchars($row['option_c']) . "<br>";
                echo "<input type='radio' name='question_" . $row['ID'] . "' value='D'> " . htmlspecialchars($row['option_d']) . "<br>";
                echo "</div>";
            }
        } else {
            echo "<p>No questions available.</p>";
        }
        ?>
        <input type="submit" value="Submit Quiz">
    </form>
</body>
</html>
