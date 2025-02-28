<?php
// Voeg het database verbindingsbestand in
include_once 'database.php';

// Controleer of het formulier is verzonden via de POST-methode
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haal gebruikersinvoer op en verwijder eventuele onnodige spaties
    $name = isset($_POST["name"]) ? trim($_POST['name']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    $confirmPassword = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : null;

    // Controleer of alle velden zijn ingevuld
    if (empty($name) || empty($password) || empty($confirmPassword)) {
        $message = "<p class='error-message'>Alle velden zijn verplicht!</p>";
    } elseif ($password !== $confirmPassword) {
        // Controleer of de ingevoerde wachtwoorden overeenkomen
        $message = "<p class='error-message'>De wachtwoorden komen niet overeen!</p>";
    } else {
        // Controleer of de naam al bestaat in de database
        $stmt = $conn->prepare("SELECT id FROM user WHERE name = ?");
        if (!$stmt) {
            $message = "<p class='error-message'>Voorbereiding mislukt: " . $conn->error . "</p>";
        } else {
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Naam bestaat al
                $message = "<p class='error-message'>De gebruikersnaam is al in gebruik. Kies een andere naam.</p>";
            } else {
                // Hash het wachtwoord voor veilige opslag in de database
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Bereid de SQL-query voor om de nieuwe gebruiker in de database in te voegen
                $stmt = $conn->prepare("INSERT INTO user (name, password) VALUES (?, ?)");
                if (!$stmt) {
                    $message = "<p class='error-message'>Voorbereiding mislukt: " . $conn->error . "</p>";
                } else {
                    $stmt->bind_param("ss", $name, $hashedPassword);
                    if ($stmt->execute()) {
                        $message = "<p class='success-message'>Registratie gelukt! Je kunt nu <a href='login.php'>inloggen</a>.</p>";
                    } else {
                        $message = "<p class='error-message'>Fout: " . $conn->error . "</p>";
                    }
                }
            }
        }
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
        a {
            color: lightblue;
            text-decoration: none;
            background-color: #003D66;
            border: none;
            border-radius: 2px ;
        }
        a:hover {
            text-decoration: underline;
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
            border: 1px solid black;
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
            <label for="name">Gebruikersnaam:</label>
            <input type="text" id="name" name="name" required>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Herhaal wachtwoord:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="submit" value="Registreer">
        </form>
        <a href="login.php">Inloggen</a>
        <?php
        // Toon het bericht (indien aanwezig)
        if (isset($message)) {
            echo $message;
        }
        ?>
    </div>
</body>
</html>
