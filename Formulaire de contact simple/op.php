<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = isset($_POST['num1']) ? (float)$_POST['num1'] :'';
    $num2 = isset($_POST['num2']) ? (float)$_POST['num2'] : '';
    $op = isset($_POST['op']) ? $_POST['op'] : '';
    $result = '';

    f (!is_numeric($num1) || !is_numeric($num2)) {
        $result = "Veuillez entrer des nombres valides.";
    } else {
        $num1 = (float)$num1;
        $num2 = (float)$num2;
            }
    switch ($op) {
        case 'add':
            $result = $num1 + $num2;
            break;
        case 'soustraction':
            $result = $num1 - $num2;
            break;
        case 'multiplication':
            $result = $num1 * $num2;
            break;
        case 'division':
            if ($num2 != 0) {
                $result = $num1 / $num2;
            } else {
                $result = "Erreur : Division par zéro";
            }
            break;
        default:
            $result = "Opération invalide";
    }

    echo "Résultat : $result";
} else {
    echo "Méthode non autorisée.";
}
?>
