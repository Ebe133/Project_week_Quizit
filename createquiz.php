<?php
include_once 'database.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Insert the quiz
    $stmt = $conn->prepare("INSERT INTO quizzes (title, description) VALUES (?, ?)");
    $stmt->bind_param('ss', $title, $description);
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

<form method="POST">
    <label for="title">Quiz Title:</label>
    <input type="text" name="title" id="title" required>
    <br>
    <label for="description">Quiz Description:</label>
    <textarea name="description" id="description"></textarea>
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
            <input type="text" name="questions[0][option_c]" required>
            <br>
            <label for="option_d">Option D:</label>
            <input type="text" name="questions[0][option_d]" required>
            <br>
            <label for="correct_option">Correct Option:</label>
            <select name="questions[0][correct_answer]" id="correct_option" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>
    </div>
    <button type="button" onclick="addQuestion()">Add Question</button>
    <button type="submit">Create Quiz</button>
</form>
<a href="admin.php">Back to Homepage</a>

<script>
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
        <input type="text" name="questions[${questionCount}][option_c]" required>
        <br>
        <label>Option D:</label>
        <input type="text" name="questions[${questionCount}][option_d]" required>
        <br>
        <label>Correct Option:</label>
        <select name="questions[${questionCount}][correct_answer]" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>
    `;
    document.getElementById('questions').appendChild(questionDiv);
    questionCount++;
}
</script>
