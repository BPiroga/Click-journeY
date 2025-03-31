<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 7;

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
            <p class="title">Séjour gastronomique à Sintra</p>
            <img src="../src/SintraFood.jpg" alt="Sintra Food">
            <p>
                Partez à la découverte de Sintra, une ville magique au cœur des montagnes, célèbre pour ses palais et ses pâtisseries. Profitez de ses saveurs traditionnelles, des douceurs comme le "Travesseiro" et l'incroyable paysage environnant.
            </p>
        </div>

        <div id="resumer">
            <p>Ce qui est inclus dans le circuit</p>
            <div class="nbrnuit"> <img src="../src/nuit.png" alt="icone nuit">
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
                <li>Jour 1: Arrivée et exploration des douceurs de Sintra
                    <ul>
                        <li>Arrivée à Sintra et installation</li>
                        <li>Dégustation des célèbres "Travesseiros" (pâtisserie traditionnelle)</li>
                        <li>Visite du centre historique et dîner avec "Bacalhau à Brás" (morue aux pommes de terre)</li>
                    </ul>
                </li>
                <li>Jour 2: Palais, jardins et gastronomie
                    <ul>
                        <li>Visite du Palais de Pena et exploration des jardins</li>
                        <li>Déjeuner dans un restaurant local avec "Feijoada" (ragoût de haricots et viande)</li>
                        <li>Dégustation de "Queijo da Serra" (fromage de la région) accompagné de vin local</li>
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
