<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizit_1";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
?>
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

   
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

 
        if (password_verify($password, $hashedPassword)) {
            echo "<p class='success-message'>Inloggen succesvol! Welkom, " . htmlspecialchars($username) . ".</p>";
            header("Location: vragen.php");
            exit();
        } else {
            echo "<p class='error-message'>Onjuist wachtwoord!</p>";
        }
    } else {
        echo "<p class='error-message'>Gebruiker niet gevonden!</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
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
        .register-link {
            margin-top: 15px;
            display: block;
            font-size: 14px;
            color: #003D66;
            text-decoration: none;
        }
        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Inloggen</h2>
        <form action="" method="POST">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Inloggen">
        </form>

        <a href="register.php" class="register-link">Nog geen account? Registreer hier.</a>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $lusername = $_POST["username"];
            $lpassword = $_POST["password"];

            if (empty($lusername) || empty($lpassword)) {
                echo "<p class='error-message'>Vul alle velden in!</p>";
            }
        }
        ?>
    </div>
</body>
</html>
