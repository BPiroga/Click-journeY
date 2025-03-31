<?php
require('getapikey.php');

$offresFile = 'data/offres.json';
$offreId = $_GET['id'] ?? null;

if ($offreId === null) {
    die('Aucune offre sélectionnée.');
}

// Charger les données des offres
$offres = json_decode(file_get_contents($offresFile), true);
$offre = null;

// Trouver l'offre correspondante
foreach ($offres as $o) {
    if ($o['id'] == $offreId) {
        $offre = $o;
        break;
    }
}

if ($offre === null) {
    die('Offre introuvable.');
}

// Informations pour le paiement
$transaction = "TX" . uniqid(); // Générer un identifiant unique pour la transaction
$montant = $offre['prix'];
$vendeur = 'MI-5_B';

//impossible de mettre un fichier en localhost 
$retour = 'http://localhost/Click-journeY/retour.php';

// Récupération de la clé API secrète
$api_key = getAPIKey($vendeur);

// Contrôle MD5 retourné par CYBANK
$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
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
            <a href="profil.php">Retour</a>
        </div>
    </header>
    <div class="container">
        <div class="connexion">
            <table>
                <tr>
                    <td class="titre-connexion">Votre panier</td>
                </tr>
                <tr>
                    <td><?= htmlspecialchars($offre['titre']) ?></td>
                    <td><img src="<?= htmlspecialchars($offre['image']) ?>" alt="<?= htmlspecialchars($offre['titre']) ?>" width="400px"></td>
                </tr>
                <tr>
                    <td class="titre-connexion">Total : <?= htmlspecialchars($montant) ?> €</td>
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