<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livre d’or</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px auto;
            max-width: 600px;
        }
        textarea, input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        .message {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background: #f9f9f9;
        }
        .date {
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>

<h1> Livre d’or</h1>

<form method="post" action="">
    <input type="text" name="nom" placeholder="Votre nom" required>
    <textarea name="message" rows="4" placeholder="Votre message..." required></textarea>
    <button type="submit">Envoyer</button>
</form>

<?php
$fichier = "messages.txt";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars(trim($_POST["nom"]));
    $message = htmlspecialchars(trim($_POST["message"]));
    $date = date("d/m/Y H:i:s");

    if ($nom && $message) {
        $ligne = "$date | $nom : $message\n";
        file_put_contents($fichier, $ligne, FILE_APPEND);
        echo "<p style='color: green;'>Merci pour votre message </p>";
    }
}

if (file_exists($fichier)) {
    $lignes = file($fichier, FILE_IGNORE_NEW_LINES);

    echo "<h2> Messages :</h2>";
    foreach ($lignes as $ligne) {
        // Exemple de ligne : 18/04/2025 16:30:12 | Jean : Bonjour tout le monde
        $parties = explode(" | ", $ligne, 2);
        if (count($parties) == 2) {
            echo "<div class='message'>";
            echo "<div class='date'>" . htmlspecialchars($parties[0]) . "</div>";
            echo "<div>" . nl2br(htmlspecialchars($parties[1])) . "</div>";
            echo "</div>";
        }
    }
}
?>

</body>
</html>
