<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 13;

// Vérifier si l'offre est dans le panier
$isInPanier = isOfferInPanier($offreId);

// Ajouter l'offre au panier si le bouton est cliqué
if (isset($_GET['add_to_cart']) && $_GET['add_to_cart'] == $offreId) {
    handlePanier($offreId);
    $isInPanier = true; // Mettre à jour l'état après l'ajout
}
?>
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
            <p class="title">Week-end sucré à Lisbonne : Pâtisseries et douceurs portugaises</p>
            <img src="../src/offre12.jpg" alt="Pâtisseries Lisbonne">
            <p>
                Pour les amateurs de douceurs, ce week-end à Lisbonne vous plongera dans l’univers sucré du Portugal. Des célèbres Pasteis de Nata aux recettes moins connues, découvrez les meilleures pâtisseries de la ville.
            </p>
        </div>

        <div id="resumer">
            <p>Ce qui est inclus dans le circuit</p>
            <div class="nbrnuit"> <img src="../src/nuit.png" alt="icone nuit">
                <p>2 nuits</p>
            </div>
            <div class="découverte"> <img src="../src/découverte.png" alt="icone découverte">
                <p>3 dégustations sucrées</p>
            </div>
            <div class="transport"> <img src="../src/transport.png" alt="icone transport">
                <p>Transport inclus</p>
            </div>
        </div>

        <div class="parcours">
            <p class="title">Parcours</p>
            <ul>
                <li>Jour 1: Découverte des classiques
                    <ul>
                        <li>Visite d’une pâtisserie emblématique pour déguster des Pasteis de Nata</li>
                        <li>Atelier pour apprendre à préparer ses propres douceurs</li>
                    </ul>
                </li>
                <li>Jour 2: Exploration sucrée
                    <ul>
                        <li>Brunch avec Bolo de Arroz (gâteau de riz portugais)</li>
                        <li>Balade gourmande dans le quartier du Chiado</li>
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
    </footer>
</body>
</html>