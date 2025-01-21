<?php
// Voeg het bestand voor de databaseverbinding in
include_once 'database.php';

// Initialiseer de score en het aantal fouten van de gebruiker
$score = 0;
$total_questions = 0;

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Haal alle vragen en hun correcte antwoorden op uit de database
    $sql = "SELECT id, correct_option FROM questions";
    $result = $conn->query($sql); // Voer de query uit
    
    // Controleer of er resultaten zijn opgehaald uit de database
    if ($result->num_rows > 0) {
        // Loop door elke vraag en controleer de antwoorden
        while ($row = $result->fetch_assoc()) {
            // Haal de ID en het correcte antwoord van de huidige vraag op
            $question_id = $row['id'];
            $correct_option = $row['correct_option'];

            // Verhoog het totaal aantal vragen
            $total_questions++;

            // Controleer of de gebruiker een antwoord heeft gegeven en of het correct is
            if (isset($_POST["question_$question_id"]) && !empty($_POST["question_$question_id"])) {
                if ($_POST["question_$question_id"] === $correct_option) {
                    $score++; // Verhoog de score met 1 als het antwoord correct is
                }
            }
        }
    }

    // Bereken het aantal fouten
    $errors = $total_questions - $score;

    // Sluit de databaseverbinding
    $conn->close();
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
