<?php
include_once 'database.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $timer = isset($_POST['timer']) ? (int)$_POST['timer'] : 120; // Default to 120 seconds if not provided

    // Insert the quiz
    $stmt = $conn->prepare("INSERT INTO quizzes (title, description, timer) VALUES (?, ?, ?)");
    $stmt->bind_param('ssi', $title, $description, $timer);
    $stmt->execute();
    $quizId = $stmt->insert_id;

    // Insert questions
    if (isset($_POST['questions'])) {
        foreach ($_POST['questions'] as $question) {
            $stmt = $conn->prepare("INSERT INTO questions (quiz_id, question_text, option_a, option_b, option_c, option_d, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('issssss', $quizId, $question['text'], $question['option_a'], $question['option_b'], $question['option_c'], $question['option_d'], $question['correct_answer']);
            $stmt->execute();
        }
    }

    echo "Quiz created successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
    <h1 style="Text-Align: center">Create a Quiz</h1>
    <form method="POST">
        <label for="title">Quiz Title:</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="description">Quiz Description:</label>
        <textarea name="description" id="description"></textarea>
        <br>
        <label for="timer">Timer (in seconds):</label>
        <input type="number" name="timer" id="timer" min="30" value="120" required>
        <br>
        <div id="questions">
            <div class="question">
                <label for="question_text">Question:</label>
                <input type="text" name="questions[0][text]" required>
                <br>
                <label for="option_a">Option A:</label>
                <input type="text" name="questions[0][option_a]" required>
                <br>
                <label for="option_b">Option B:</label>
                <input type="text" name="questions[0][option_b]" required>
                <br>
                <label for="option_c">Option C:</label>
                <input type="text" name="questions[0][option_c]" >
                <br>
                <label for="option_d">Option D:</label>
                <input type="text" name="questions[0][option_d]" >
                <br>
                <label for="correct_option">Correct Option:</label>
                <select name="questions[0][correct_answer]" id="correct_option" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
                <button type="button" class="delete-btn" onclick="deleteQuestion(this)">Delete</button>
            </div>
        </div>
        <button type="button" onclick="addQuestion()">Add Question</button>
        <button type="submit">Create Quiz</button>
    </form>
    <a href="admin.php" onclick="return confirmExit();">Back to Homepage</a>

    <script>
        function confirmExit() {
        return confirm('You have unsaved changes. Are you sure you want to leave?');
        }

        window.addEventListener('beforeunload', function (event) {
        return 'You have unsaved changes. Are you sure you want to leave?'; 
        });

        let questionCount = 1;

        function addQuestion() {
            const questionDiv = document.createElement('div');
            questionDiv.className = 'question';
            questionDiv.innerHTML = `
                <label>Question:</label>
                <input type="text" name="questions[${questionCount}][text]" required>
                <br>
                <label>Option A:</label>
                <input type="text" name="questions[${questionCount}][option_a]" required>
                <br>
                <label>Option B:</label>
                <input type="text" name="questions[${questionCount}][option_b]" required>
                <br>
                <label>Option C:</label>
                <input type="text" name="questions[${questionCount}][option_c]" >
                <br>
                <label>Option D:</label>
                <input type="text" name="questions[${questionCount}][option_d]" >
                <br>
                <label for="correct_option_${questionCount}">Correct Option:</label>
                <select name="questions[${questionCount}][correct_answer]" id="correct_option_${questionCount}" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            `;
            document.getElementById('questions').appendChild(questionDiv);
            questionCount++;
        }

        function deleteQuestion(button) {
        const questionDiv = button.parentElement;
        questionDiv.remove();
}

    </script>
</body>
</html>
