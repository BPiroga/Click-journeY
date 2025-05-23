<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 5;

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
            <p class="title">Séjour culinaire dans l'Alentejo</p>
            <img src="../src/AlentejoFood.jpg" alt="Alentejo Food">
            <p>
                Explorez l'Alentejo, une région du Portugal riche en traditions agricoles et gastronomiques. Partez à la découverte de ses spécialités à base de viande, fromage et vin tout en profitant de la beauté de ses paysages.
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
                <li>Jour 1: Découverte des marchés de l'Alentejo
                    <ul>
                        <li>Arrivée dans la région et installation dans une auberge traditionnelle</li>
                        <li>Visite d’un marché local et dégustation de produits artisanaux</li>
                        <li>Déjeuner avec un ragoût de viande accompagné de pain de maïs</li>
                    </ul>
                </li>
                <li>Jour 2: Dégustation de vin et spécialités fromagères
                    <ul>
                        <li>Visite d’une cave à vin de l'Alentejo et dégustation de vins locaux</li>
                        <li>Déjeuner dans une ferme traditionnelle avec fromage artisanal et charcuterie</li>
                        <li>Promenade dans les collines pour découvrir la production locale</li>
                    </ul>
                </li>
                <li>Jour 3: Cuisine traditionnelle et patrimoine
                    <ul>
                        <li>Cours de cuisine pour apprendre à préparer des plats typiques de l'Alentejo</li>
                        <li>Dîner avec les plats préparés lors du cours</li>
                        <li>Retour le lendemain matin</li>
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
