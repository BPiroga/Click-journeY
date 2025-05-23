<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 8;

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
            <p class="title">Road trip gourmand à Madère</p>
            <img src="../src/offre8.jpg" alt="Madère Food">
            <p>
                Partez à la découverte de Madère, une île exotique aux saveurs inoubliables. Entre fruits tropicaux, poissons frais et plats traditionnels, vivez un voyage culinaire au cœur de l'Atlantique.
            </p>
        </div>

        <div id="resumer">
            <p>Ce qui est inclus dans le circuit</p>
            <div class="nbrnuit"> <img src="../src/nuit.png" alt="icone nuit">
                <p>4 nuits</p>
            </div>
            <div class="découverte"> <img src="../src/découverte.png" alt="icone découverte">
                <p>5 découvertes culinaires</p>
            </div>
            <div class="transport"> <img src="../src/transport.png" alt="icone transport">
                <p>Voiture de location incluse</p>
            </div>
        </div>

        <div class="parcours">
            <p class="title">Parcours</p>
            <ul>
                <li>Jour 1: Arrivée et premières saveurs
                    <ul>
                        <li>Arrivée à Funchal et installation</li>
                        <li>Visite du marché des Lavradores et dégustation de fruits exotiques</li>
                        <li>Dîner avec un "Espetada" (brochette de bœuf cuite sur des braises)</li>
                    </ul>
                </li>
                <li>Jour 2: Saveurs de la mer et paysages grandioses
                    <ul>
                        <li>Excursion en bateau pour observer les dauphins et dégustation de poisson frais</li>
                        <li>Déjeuner avec "Filete de Espada com Banana" (filet de poisson à la banane)</li>
                        <li>Visite d’une fabrique de vin de Madère et dégustation</li>
                    </ul>
                </li>
                <li>Jour 3: Nature et cuisine traditionnelle
                    <ul>
                        <li>Randonnée dans la forêt de Laurisilva</li>
                        <li>Déjeuner avec "Bolo do Caco" (pain à l’ail typique de Madère)</li>
                        <li>Atelier de cuisine pour apprendre à préparer une "Poncha" (cocktail local)</li>
                    </ul>
                </li>
                <li>Jour 4: Derniers plaisirs culinaires
                    <ul>
                        <li>Découverte des montagnes de l’île</li>
                        <li>Dîner d’adieu avec spécialités locales</li>
                        <li>Retour à Funchal et fin du séjour</li>
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
