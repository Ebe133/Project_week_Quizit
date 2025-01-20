<?php
// Voeg het database verbindingsbestand in
include_once 'database.php';

// Haal alle vragen en hun correcte antwoorden op uit de database
$sql = "SELECT id, correct_option FROM questions";
$result = $conn->query($sql); // Voer de query uit

// Initialiseer de score van de gebruiker
$score = 0;

// Controleer of er resultaten zijn opgehaald uit de database
if ($result->num_rows > 0) {
    // Doorloop elke vraag en controleer de antwoorden
    while ($row = $result->fetch_assoc()) {
        // Haal het ID en het correcte antwoord van de huidige vraag op
        $question_id = $row['id'];
        $correct_option = $row['correct_option'];

        // Controleer of de gebruiker een antwoord heeft gegeven en of het correct is
        if (isset($_POST["question_$question_id"]) && $_POST["question_$question_id"] === $correct_option) {
            $score++; // Verhoog de score met 1 als het antwoord correct is
        }
    }
}

// Toon de uiteindelijke score aan de gebruiker
echo "<p>Your score: $score</p>";

// Sluit de databaseverbinding
$conn->close();
?>

