<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #5DC4E3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #E0F5F9;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #003D66;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #B2D4DD;
            border-radius: 4px;
            font-size: 14px;
        }
        .login-container input[type="submit"] {
            background-color: #003D66;
            color: #FFF;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .login-container input[type="submit"]:hover {
            background-color: #005B99;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
        .success-message {
            color: green;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
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
        $valid_pass = "siham";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if ($username === $valid_user && $password === $valid_pass) {
                echo "gelukt";
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
