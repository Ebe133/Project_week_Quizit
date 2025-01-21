<?php 
session_start(); // Start the session
include_once 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $password = $_POST["password"];

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT password FROM user WHERE name = ?");
    $stmt->bind_param("s", $name); 

    if ($stmt->execute()) {
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                echo "<p class='success-message'>Inloggen succesvol! Welkom, " . htmlspecialchars($name) . ".</p>";
                $_SESSION['name'] = $name;
                sleep(2);
                header("Location: Homepage.php");
                exit();
            } else {
                echo "<p class='error-message'>Onjuist wachtwoord!</p>";
            }
        } else {
            echo "<p class='error-message'>Gebruiker niet gevonden!</p>";
        }
    } else {
        echo "<p class='error-message'>Er is een probleem opgetreden. Probeer het opnieuw!</p>";
    }

    $stmt->close(); // Close the prepared statement
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
            <label for="name">Gebruikersnaam:</label>
            <input type="text" id="name" name="name" required>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Inloggen">
        </form>

        <?php
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $lname = $_POST["name"];
            $lpassword = $_POST["password"];
        
            // Check if fields are empty
            if (empty($lname) || empty($lpassword)) {
                echo "<p class='error-message'>Vul alle velden in!</p>";
            } else {
                
                $Ausername = "Ashworth";
                $Apassword = "Appeltaart";
        
                if ($lname === $Ausername && $lpassword === $Apassword) {
                
                    header("Location: admin.php");
                    exit();
                } else {
                    echo "<p class='error-message'>Onjuiste gebruikersnaam of wachtwoord!</p>";
                }
            }
        }
    
        
            
        
        
        ?>

        <a href="register.php" class="register-link">Nog geen account? Registreer hier.</a>


    </div>
</body>
</html>
