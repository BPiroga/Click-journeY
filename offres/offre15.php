<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 15;

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
            <p class="title">Road trip gastronomique dans le Douro : Vins et spécialités du nord</p>
            <img src="../src/offre14.jpg" alt="Douro Vins">
            <p>
                Partez pour un voyage à travers les magnifiques paysages du Douro et dégustez les meilleurs vins et spécialités du nord du Portugal.
            </p>
        </div>

        <div id="resumer">
            <p>Ce qui est inclus dans le circuit</p>
            <div class="nbrnuit"> <img src="../src/nuit.png" alt="icone nuit">
                <p>3 nuits</p>
            </div>
            <div class="découverte"> <img src="../src/découverte.png" alt="icone découverte">
                <p>4 dégustations de vins et spécialités</p>
            </div>
            <div class="transport"> <img src="../src/transport.png" alt="icone transport">
                <p>Transport inclus</p>
            </div>
        </div>

        <div class="parcours">
            <p class="title">Parcours</p>
            <ul>
                <li>Jour 1: Arrivée à Porto et immersion gastronomique
                    <ul>
                        <li>Visite du centre historique et découverte de la Francesinha</li>
                        <li>Dégustation de vins de Porto dans une cave</li>
                    </ul>
                </li>
                <li>Jour 2: Excursion dans la vallée du Douro
                    <ul>
                        <li>Visite de vignobles et dégustation de vins du Douro</li>
                        <li>Déjeuner traditionnel avec Cabrito Assado (chevreau rôti)</li>
                    </ul>
                </li>
                <li>Jour 3: Randonnée et spécialités locales
                    <ul>
                        <li>Balade le long du fleuve et dégustation de Queijo da Serra</li>
                        <li>Dîner dans une quinta avec produits locaux</li>
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