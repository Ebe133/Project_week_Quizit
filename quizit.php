<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="quizit.css">
    <title>Quizit</title>
</head>
<body>
    <div class="login-container">
        <h1>
            <?php
            
            ?>
        </h1>
        <form action="" method="POST">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Inloggen">
        </form>

        <?php
        
        $valid_user = "ebe";
        $valid_pass = "123";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if ($username === $valid_user && $password === $valid_pass) {
                header("Location: vragen.php");
                exit();
            } else {
                echo "<p class='error-message'>Ongeldige inloggegevens!</p>";
            }
        }



        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "quizit_1";
        
    
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        
        if ($conn->connect_error) {
            die("Verbinding mislukt: " . $conn->connect_error);
        }
        
        echo "De verbinding werkt!";
        
        ?>


        
        




        <a href="register.php" style="display: block; margin-top: 20px;">Registreer hier</a>
    </div>
</body>
</html>
