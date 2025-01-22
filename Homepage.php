<?php
// Include the database connection
include_once 'database.php';

// Fetch all quizzes from the database
$sql = "SELECT id, title FROM quizzes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <header>
    <?php 
session_start();
if (isset($_SESSION['name'])) {
    echo "<h1>Welkom op de Homepagina, " . $_SESSION['name'] . "!</h1>"; 
} else {
    echo "<h1>Welkom op de Homepagina!</h1>";
}
?>
<a href="login.php" id="Signout" onClick="logout()" style=" position: absolute;
  text-decoration: none;
  top: 30px;
  right: 10px;
  background-color: #000000;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  ">Log uit ->]</a>
</header>
    <h2>Kies een quiz!</h2>
    <nav>
        <ul>
            <?php
            // Check if there are quizzes in the database
            if ($result->num_rows > 0) {
                // Loop through the quizzes and display each as a link
                while ($row = $result->fetch_assoc()) {
                    echo "<li><a href='quiz.php?quiz_id=" . $row['id'] . "'>" . htmlspecialchars($row['title']) . "</a></li>";
                }
            } else {
                // Display a message if no quizzes are available
                echo "<li>Er zijn nog geen quizzen beschikbaar.</li>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </ul>
    </nav>
</body>
<script>
function logout() {
    <?php session_destroy(); ?>
}

</script>
</html>
