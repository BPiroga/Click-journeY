<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 1;

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
            <p class="title">Séjour gastronomique à Madère</p>
            <img src="../src/foodmadeira.jpg" alt="Madeira Food">
            <p>
                Partez à la découverte de l’île de Madère, un véritable paradis pour les gourmands. Découvrez les fruits exotiques, les spécialités à base de poisson frais et goûtez aux délicieux gâteaux locaux dans un cadre tropical.
            </p>
        </div>

        <div id="resumer">
            <p>Ce qui est inclus dans le circuit</p>
            <div class="nbrnuit"> <img src="../src/nuit.png" alt="icone nuit">
                <p>4 nuits</p>
            </div>
            <div class="découverte"> <img src="../src/découverte.png" alt="icone découverte">
                <p>4 découvertes culinaires</p>
            </div>
            <div class="transport"> <img src="../src/transport.png" alt="icone transport">
                <p>Transport inclus</p>
            </div>
        </div>

        <div class="parcours">
            <p class="title">Parcours</p>
            <ul>
                <li>Jour 1: Arrivée à Madère et exploration de Funchal
                    <ul>
                        <li>Arrivée à Funchal et installation à l’hôtel</li>
                        <li>Découverte des marchés locaux et dégustation de fruits tropicaux</li>
                        <li>Visite d’un restaurant local servant la spécialité de poisson grillé</li>
                    </ul>
                </li>
                <li>Jour 2: Dégustation et traditions culinaires
                    <ul>
                        <li>Visite d’une plantation de canne à sucre et dégustation de produits à base de sucre de canne</li>
                        <li>Déjeuner traditionnel avec un plat à base de viande de porc</li>
                        <li>Dîner dans une taverne madérienne</li>
                    </ul>
                </li>
                <li>Jour 3: Aventure gourmande dans les montagnes
                    <ul>
                        <li>Randonnée dans les montagnes avec arrêt pour déguster des spécialités locales</li>
                        <li>Retour à Funchal et exploration des pâtisseries locales</li>
                        <li>Dîner avec des produits frais de la mer</li>
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