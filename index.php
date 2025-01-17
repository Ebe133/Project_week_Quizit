<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuze</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #42bfdd;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            background-color: #084b83;
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
            gap: 20px;
        }
        .choice {
            background-color: #a8e0ff;
            padding: 20px 40px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.2s;
            text-decoration: none;
            color: black;
        }
        .choice:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <h1>Bent u een leerling of docent?</h1>
    <div class="container">
        <a class="choice" href="quizit.php?role=leerling">Leerling</a>
        <a class="choice" href="quizit.php?role=docent">Docent</a>
    </div>
</body>
</html>
