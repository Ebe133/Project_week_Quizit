<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizit_1";

// Maak verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
?>
<?php


if ($_SERVER["REQEUST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword =["confirmPassword"];


    if ($password !== $confirmPassword){
        echo "klopt niet";
    }else 
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->blind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()){
        echo "<p class= 'sucess-message'>gelukt<a herf='test.php'>log in niggga</a></p>";
    } else {
        echo  "<p class='error-message'> fout ".$conn->error. "</p>";
    }



}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer</title>
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
        .login-container h2 {
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
        }
        .success-message {
            color: green;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Registreer</h2>
        <form action="" method="POST">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Herhaal wachtwoord:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="submit" value="Registreer">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $rusername = $_POST["username"];
            $rpassword = $_POST["password"];
            $rconfirmPassword = $_POST["confirm_password"];

            if ($rpassword !== $rconfirmPassword) {
                echo "<p class='error-message'>De wachtwoorden komen niet overeen!</p>";
            } else {
                echo "<p class='success-message'>Registratie gelukt! Welkom, " . htmlspecialchars($rusername) . ".</p>";
            }
        }
        ?>
    </div>
</body>
</html>
