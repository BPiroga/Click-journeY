<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 4;

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
            <p class="title">Voyage gastronomique à Porto</p>
            <img src="../src/gastronomie Porto.jpg" alt="Porto Food">
            <p>
                Partez à la découverte de Porto, une ville où les saveurs se mêlent aux traditions culinaires uniques du nord du Portugal. Dégustez le fameux Francesinha, les vins de Porto et explorez les marchés locaux pour une expérience authentique.
            </p>
        </div>

        <div id="resumer">
            <p>Ce qui est inclus dans le circuit</p>
            <div class="nbrnuit"> <img src="../src/nuit.png" alt="icone nuit">
                <p>3 nuits</p>
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
                <li>Jour 1: Arrivée à Porto et premières dégustations
                    <ul>
                        <li>Arrivée à Porto et installation</li>
                        <li>Dégustation de l’iconique Francesinha</li>
                        <li>Visite d’un marché local et découverte des produits typiques</li>
                    </ul>
                </li>
                <li>Jour 2: Vins de Porto et spécialités régionales
                    <ul>
                        <li>Visite d’une cave à vin de Porto et dégustation</li>
                        <li>Déjeuner avec une assiette de Bacalhau à la mode portugaise</li>
                        <li>Découverte des spécialités sucrées de la ville</li>
                    </ul>
                </li>
                <li>Jour 3: Exploration des rives du Douro
                    <ul>
                        <li>Promenade sur les rives du Douro et déjeuner avec vue sur le fleuve</li>
                        <li>Dîner gastronomique dans un restaurant typique de la ville</li>
                        <li>Retour en soirée</li>
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