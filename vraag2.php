<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz: Ebenezer's Schuld</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            color: #333;
        }
        .answers {
            margin-top: 20px;
        }
        .answers p {
            margin: 5px 0;
        }
        .btn-submit {
            margin-top: 20px;
            padding: 10px 15px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
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
S
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
