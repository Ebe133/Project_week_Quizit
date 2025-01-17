<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vraag2.css">
    <title>Quiz: Ebenezer's Schuld</title>
</head>
<body>
    <h1>Vraag 1: hoelaat is het</h1>
    <form action="" method="POST">
        <div class="answers">
            <p><input type="radio" id="a" name="answer" value="A">
            <label for="a">Antwoord A: 23:59</label></p>

            <p><input type="radio" id="b" name="answer" value="B">
            <label for="b">Antwoord B: 12:00</label></p>

            <p><input type="radio" id="c" name="answer" value="C">
            <label for="c">Antwoord C: 15:50</label></p>

            <p><input type="radio" id="d" name="answer" value="D">
            <label for="d">Antwoord D: 15:40</label></p>
        </div>
        <button type="submit" class="btn-submit">Bevestig Antwoord</button>
    </form>

    <div class="result">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correctAnswer = "A";
            $selectedAnswer = $_POST["answer"];

        $score = "";

            if ($selectedAnswer === $correctAnswer){
                $score++; 
                echo "Je hebt het antwoord A gekozen. Goed gedaan!" . "<br>" . "Je hebt $score punten."; 
            }


            
        }
        ?>
    </div>
</body>
</html>
