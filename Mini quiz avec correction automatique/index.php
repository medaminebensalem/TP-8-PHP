<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini Quiz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        .question {
            background-color: #fff;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .correct {
            color: green;
        }
        .wrong {
            color: red;
        }
        </style>
</head>
<body>

<h1>🎯 Mini Quiz</h1>

<?php
// Questions et réponses
$quiz = [
    [
        "question" => "Quelle est la capitale du Maroc ?",
        "options" => ["Madrid", "Maroc", "Paris", "Rome"],
        "correct" => 2
    ],
    [
        "question" => "Quel langage est utilisé pour le développement web côté client ?",
        "options" => ["PHP", "Java", "Python", "JavaScript"],
        "correct" => 3
    ],
    [
        "question" => "Combien de bits contient un octet ?",
        "options" => ["4", "8", "16", "32"],
        "correct" => 1
    ],
    [
        "question" => "Quel est le résultat de 5 + 3 * 2 ?",
        "options" => ["16", "11", "13", "10"],
        "correct" => 1
    ],
    [
        "question" => "HTML est un langage de...",
        "options" => ["programmation", "marquage", "script", "compilation"],
        "correct" => 1
    ]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $score = 0;
    echo "<h2>Résultats :</h2>";
    foreach ($quiz as $index => $q) {
        $user_answer = isset($_POST["q$index"]) ? intval($_POST["q$index"]) : -1;
        $is_correct = $user_answer === $q["correct"];
        
        echo "<div class='question'>";
        echo "<p><strong>" . htmlspecialchars($q["question"]) . "</strong></p>";
        foreach ($q["options"] as $i => $option) {
            $style = '';
            if ($user_answer == $i) {
                $style = $is_correct ? "correct" : "wrong";
                echo "<p class='$style'>➤ " . htmlspecialchars($option) . "</p>";
            } else {
                echo "<p>• " . htmlspecialchars($option) . "</p>";
            }
        }
        if (!$is_correct) {
            echo "<p class='correct'>✔ Réponse correcte : " . htmlspecialchars($q["options"][$q["correct"]]) . "</p>";
        }
        echo "</div>";

        if ($is_correct) {
            $score++;
        }
    }

    echo "<h3>✅ Score final : $score / " . count($quiz) . "</h3>";
    echo "<a href=''>Rejouer</a>";

} else {
    // Formulaire du quiz
    echo "<form method='post'>";
    foreach ($quiz as $index => $q) {
        echo "<div class='question'>";
        echo "<p><strong>" . htmlspecialchars($q["question"]) . "</strong></p>";
        foreach ($q["options"] as $i => $option) {
            echo "<label>";
            echo "<input type='radio' name='q$index' value='$i' required> " . htmlspecialchars($option);
            echo "</label><br>";
        }
        echo "</div>";
    }
    echo "<button type='submit'>Valider</button>";
    echo "</form>";
}
?>

</body>
</html>
