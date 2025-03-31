<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 14;

// Vérifier si l'offre est dans le panier
$isInPanier = isOfferInPanier($offreId);

// Ajouter l'offre au panier si le bouton est cliqué
if (isset($_GET['add_to_cart']) && $_GET['add_to_cart'] == $offreId) {
    handlePanier($offreId);
    $isInPanier = true; // Mettre à jour l'état après l'ajout
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>CY Portugal</title>
</head>

<body>
    <header class="navbar">
        <a class="logo" href="../index.php"><img src="../src/Logo CY Portugal.png" alt="Logo CY Portugal" width="210px"></a>
        <p class="titre">CY Portugal</p>
        <div class="navlinks">
            <a href="../presentation.php">Présentation</a>
            <a href="../recherche.php">Recherche</a>
            <?php renderAuthLinks($isLoggedIn); ?>
        </div>
    </header>
    <div class="container">

        <div class="description">
            <p class="title">Découverte des street food à Lisbonne</p>
            <img src="../src/Street food.webp" alt="Street food">
            <p>
                Découvrez Lisbonne autrement à travers ses saveurs de rue authentiques et gourmandes ! Ce séjour vous plongera dans l’ambiance vibrante des marchés, des quartiers animés et des meilleurs spots de street food de la capitale portugaise.
            </p>
        </div>

        <div id="resumer">
            <p>Ce qui est inclus dans le circuit</p>
            <div class="nbrnuit"> <img src="../src/nuit.png"alt="icone nuit">
                <p>2 nuits</p>
            </div>
            <div class="découverte"> <img src="../src/découverte.png" alt="icone découverte">
                <p>2 découvertes culinaires</p>
            </div>
            <div class="transport"> <img src="../src/transport.png" alt="icone transport">
                <p>Transport inclus</p>
            </div>
        </div>

        <div class="parcours">
            <p class="title">Parcours</p>
            <ul>
                <li>Jour 1: Saveurs locales et quartiers emblématiques
                    <ul>
                        <li>Arrivée à Lisbonne et installation</li>
                        <li>Visite du quartier de l’Alfama et découverte des spécialités locales</li>
                        <li>Dégustation de Bifana (sandwich de porc mariné) et de Pasteis de Bacalhau</li>
                        <li>Dîner dans un marché gastronomique</li>
                    </ul>
                </li>
                <li>Jour 2: Marchés et gourmandises de rue
                    <ul>
                        <li>Balade au Mercado de Campo de Ourique et dégustation de spécialités régionales</li>
                        <li>Déjeuner sur le pouce avec une Tosta Mista et un verre de Ginjinha</li>
                        <li>Découverte des secrets du Pastel de Nata dans une pâtisserie emblématique</li>
                        <li>Après-midi libre pour explorer la ville</li>
                        <li>Fin du séjour et retour</li>
                    </ul>
                </li>
            </ul>
            <?php if ($isInPanier): ?>
                <a href="../profil.php">Voir mon panier</a>
            <?php else: ?>
                <a href="?add_to_cart=<?= $offreId ?>" class="btn">Réserver maintenant</a>
            <?php endif; ?>
        </div>
    </div>
    <footer>
        <p>&copy; 2025 CY Portugal</p>
        <a href="../profil.php">Compte</a>
        <a href="../admin.php">Administration</a>
        <p>Contact : CY Tech</p>
    </footer>
</body>
</html>