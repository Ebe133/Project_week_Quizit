<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="quizit.css">
    <title>Registreer</title>
</head>
<body>
    <div class="login-container">
        <h2>Registreer</h2>
        <form action="quizit.php?role=leerling" method="POST">
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
            $username = $_POST["username"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirm_password"];

            if ($password !== $confirmPassword) {
                echo "<p class='error-message'>De wachtwoorden komen niet overeen!</p>";
            } else {
                echo "<p class='success-message'>Registratie geslaagd! Welkom, $username.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
