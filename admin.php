<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
        <h1>Welkom Docent!</h1>
        <a href="login.php" id="Signout" onclick="logout()" style="  position: absolute;
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

    <section class="question-management">
        <div class="form-container">
<a href="createquiz.php">Nieuwe quiz toevoegen</a>
        </div>
    </section>

    <section class="leaderboard">
        <h2>Leaderboard</h2>
        
                </tr>
            </tbody>
        </table>
    </section>
</body>
<script>
function logout() {
    <?php session_destroy(); ?>
}
</script>
</html>
