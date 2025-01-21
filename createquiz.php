<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ontvang de formuliergegevens
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];

    // Hier kun je de gegevens bijvoorbeeld opslaan in een database

    // Bevestigingsbericht
    $message = "Question registered successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-container h2 {
            text-align: center;
            color: #333;
        }
        .form-container input[type="text"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container input[type="submit"] {
            background-color: #42bfdd;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #084b83;  
        }
        .form-container .success-message {
            margin-top: 20px;
            text-align: center;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add a Question</h2>

        <?php
        if (isset($message)) {
            echo "<p class='success-message'>$message</p>";
        }
        ?>

        <form action="add_question.php" method="POST">
            <textarea name="question" placeholder="Enter the question" required></textarea>
            <input type="text" name="option_a" placeholder="Option A" required>
            <input type="text" name="option_b" placeholder="Option B" required>
            <input type="text" name="option_c" placeholder="Option C" required>
            <input type="text" name="option_d" placeholder="Option D" required>
            <select name="correct_option" required>
                <option value="">Select the correct option</option>
                <option value="A">Option A</option>
                <option value="B">Option B</option>
                <option value="C">Option C</option>
                <option value="D">Option D</option>
            </select>
            <input type="submit" value="Add Question">
        </form>
    </div>
</body>
</html>
