<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 3;

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
            <p class="title">Séjour culinaire à Évora (Alentejo)</p>
            <img src="../src/EvoraFood.jpg" alt="Evora Food">
            <p>
                Évora, une ville pleine de charme et d’histoire, vous invite à découvrir les saveurs authentiques du terroir alentejano. Profitez de ses viandes succulentes, de ses fromages et de ses vins tout en explorant ses monuments antiques.
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
                <li>Jour 1: Arrivée à Évora et premier goût de la région
                    <ul>
                        <li>Arrivée à Évora et installation</li>
                        <li>Visite du marché de la ville et dégustation de fromages et charcuteries</li>
                        <li>Dîner traditionnel avec "Porco Preto" (porc noir de l’Alentejo)</li>
                    </ul>
                </li>
                <li>Jour 2: Dégustation de vins et exploration des saveurs locales
                    <ul>
                        <li>Visite d’un vignoble local avec dégustation de vins de l'Alentejo</li>
                        <li>Déjeuner avec "Ensopado de Borrego" (ragoût d'agneau)</li>
                        <li>Exploration des anciens moulins et visite d'une ferme traditionnelle</li>
                    </ul>
                </li>
                <li>Jour 3: Aventure culinaire et retour
                    <ul>
                        <li>Participation à un atelier de cuisine pour apprendre à préparer des plats locaux</li>
                        <li>Déjeuner de spécialités cuites sur des braises</li>
                        <li>Retour à Évora et fin du séjour</li>
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
