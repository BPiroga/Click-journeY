<?php
// fichier utiliser par le code
require('getapikey.php');


//récuperations des données de CYBANK visble dans l'URL
$transaction = $_GET['transaction'];
$montant = $_GET['montant'];
$vendeur = $_GET['vendeur'];
$statut = $_GET['status'];
$control_recu = $_GET['control'];

//récuperation de la clé API secrète
$api_key = getAPIKey($vendeur);

//controle md5 retourné par CYBANK
$control_attendu = md5($api_key."#".$transaction."#".$montant."#".$vendeur."#".$statut."#");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CY Portugal</title>
</head>
<body>
<header class="navbar">
    <a class="logo" href="index.php"><img src="src/Logo CY Portugal.png" alt="Logo CY Portugal" width="210px"></a>
    <p class="titre">CY Portugal</p>
    <div class="navlinks">
        <a href="presentation.php">Présentation</a>
        <a href="recherche.php">Recherche</a>
        <a href="index.php">Retour au site</a>
    </div>
</header>



<div class="container">
    <div class="titre-connexion">
        <?php
//On compare les valeurs de controle avant et après CYBANK
            if ($control_recu === $control_attendu) {
                if ($statut === "accepted") {
                    echo "<h2>Paiement accepté !</h2>";
                } else {
                    echo "<h2>Paiement refusé.</h2>";
                }
            } else {
                echo "<h2>Erreur : données invalides !</h2>";
            }
        ?>
    </div>
<div>
</body>

<html>