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
    <h1>Vraag 1: Hoeveel geld is Ebenezer nog schuldig aan Meneer Ashworth?</h1>
    <form action="" method="POST">
        <div class="answers">
            <p><input type="radio" id="a" name="answer" value="A">
            <label for="a">Antwoord A: Geen</label></p>

            <p><input type="radio" id="b" name="answer" value="B">
            <label for="b">Antwoord B: 5,00 Euro</label></p>

            <p><input type="radio" id="c" name="answer" value="C">
            <label for="c">Antwoord C: 100   Euro</label></p>

            <p><input type="radio" id="d" name="answer" value="D">
            <label for="d">Antwoord D: 200 Euro</label></p>
        </div>
        <button type="submit" class="btn-submit">Bevestig Antwoord</button>
    </form>

    <div class="result">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correctAnswer = "A";

            
            if ($selectedAnswer === $selectedAnswer){
                header("Location: vraag2.php");
                exit();

             
            }

            if ($selectedAnswer === $correctAnswer){
               
               
                
            };
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "quizit_1";
            
         
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            
            if ($conn->connect_error) {
                die("Verbinding mislukt: " . $conn->connect_error);
            }
            
            echo "De verbinding werkt!";
            
           
        }
        ?>
    </div>
</body>
</html>
