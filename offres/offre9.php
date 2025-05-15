<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 9;

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
    <link id="theme-stylesheet" rel="stylesheet" href="../style.css">
    <title>CY Portugal</title>
</head>
<body data-mode="light">
    <header class="navbar">
        <a class="logo" href="../index.php"><img id="logo-image" src="../src/Logo.png" alt="Logo CY Portugal" width="210px"></a>
        <p class="titre">CY Portugal</p>
        <button id="toggle-mode" class="button-link-admin">
            <img id="mode-icon" src="../src/sun.png" alt="Changer de mode" width="24px">
        </button>
        <div class="navlinks">
            <a href="../presentation.php">Présentation</a>
            <a href="../recherche.php">Recherche</a>
            <?php renderAuthLinks($isLoggedIn); ?>
        </div>
    </header>
    <div class="container">

        <div class="description">
            <p class="title">Séjour gastronomique à Porto : Saveurs du Nord</p>
            <img src="../src/offre7.jpg" alt="Porto Food">
            <p>
                Découvrez Porto à travers sa gastronomie unique ! De la Francesinha aux vins de la vallée du Douro, ce séjour vous fera explorer les spécialités de la ville et la richesse culinaire du nord du Portugal.
            </p>
        </div>

        <div id="resumer">
            <p>Ce qui est inclus dans le circuit</p>
            <div class="nbrnuit"> <img src="../src/nuit.png" alt="icone nuit">
                <p>2 nuits</p>
            </div>
            <div class="découverte"> <img src="../src/découverte.png" alt="icone découverte">
                <p>3 découvertes culinaires</p>
            </div>
            <div class="transport"> <img src="../src/transport.png" alt="icone transport">
                <p>Transport inclus</p>
            </div>
        </div>

        <div class="parcours">
            <p class="title">Parcours</p>
            <ul>
                <li>Jour 1: Immersion dans la cuisine portuense
                    <ul>
                        <li>Arrivée et installation à Porto</li>
                        <li>Visite du marché de Bolhão et dégustation de produits locaux</li>
                        <li>Dîner avec une Francesinha, le sandwich emblématique de la ville</li>
                    </ul>
                </li>
                <li>Jour 2: Dégustation de vins et spécialités du Douro
                    <ul>
                        <li>Balade au bord du fleuve Douro et visite d’une cave à vin</li>
                        <li>Dégustation de vins de Porto et accord mets-vins</li>
                        <li>Déjeuner typique avec "Tripas à Moda do Porto" (ragoût de tripes et haricots)</li>
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
    <script src="../js/theme-mode.js"></script>
</body>
</html>
