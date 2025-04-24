<?php
function genererMotDePasse($longueur) {
    $lettres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $chiffres = '0123456789';
    $speciaux = '!@#$%^&*()_+-=[]{}|;:,.<>?';
    $tous = $lettres . $chiffres . $speciaux;

    $motDePasse = '';

   
    $motDePasse .= $lettres[rand(0, strlen($lettres) - 1)];
    $motDePasse .= $chiffres[rand(0, strlen($chiffres) - 1)];
    $motDePasse .= $speciaux[rand(0, strlen($speciaux) - 1)];

    for ($i = 3; $i < $longueur; $i++) {
        $motDePasse .= $tous[rand(0, strlen($tous) - 1)];
    }

   
    $motDePasse = str_shuffle($motDePasse);

    return $motDePasse;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $longueur = intval($_POST["length"]);

    if ($longueur < 4) {
        echo "<p style='color:red;'>Veuillez entrer une longueur d'au moins 4 caractères.</p>";
    } else {
        $motDePasse = genererMotDePasse($longueur);
        echo "<p class='resultat'>Mot de passe généré : $motDePasse</p>";
    }
}
?>
