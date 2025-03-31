<?php

// fichier utiliser par le code
require('getapikey.php');
require('data/cart_users.json');

// ces infos doivent être récuper d'un autre fichier
$transaction = "TX12345ABC";
$montant = '49.99';
$vendeur = 'MI-5_B';

//impossible de mettre un fichier en localhost 
$retour = 'retour.php';

//récuperation de la clé API secrète
$api_key = getAPIKey($vendeur);

//controle md5 retourné par CYBANK
$control = md5($api_key."#".$transaction."#".$montant."#".$vendeur."#".$retour."#");
?>


<!DOCTYPE html>
<html>
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
            <a href="index.php">Retour</a>
        </div>
    </header>
    <div class="container">
        <div class="connexion">
            <table>
                <tr>
                    <td class="titre-connexion"> Votre panier</td>
                </tr>
                <tr>
                    <td>Nom du voyage</td>
                    <td>date voyage début/fin</td>
                    <td>image du voyage</td>
                </tr>

                <tr>
                    <td class="titre-connexion">Total : 49.99€</td>
                </tr>
            </table>
            <form action="https://www.plateforme-smc.fr/cybank/index.php" method="post">
                <input type="hidden" name="transaction" value="<?= $transaction ?>">
                <input type="hidden" name="montant" value="<?= $montant ?>">
                <input type="hidden" name="vendeur" value="<?= $vendeur ?>">
                <input type="hidden" name="retour" value="<?= $retour ?>">
                <input type="hidden" name="control" value="<?= $control ?>">
                <input type="submit" value="Payer">
            </form>
        </div>
    </div>
</body>
</html>