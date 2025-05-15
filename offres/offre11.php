<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 11;

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
            <p class="title">Expérience culinaire et fado à Lisbonne</p>
            <img src="../src/offre10.jpg" alt="Lisbonne Fado">
            <p>
                Imprégnez-vous de l'âme de Lisbonne à travers un voyage entre saveurs et musique. Dégustez des plats traditionnels tout en écoutant du Fado dans des lieux emblématiques de la ville.
            </p>
        </div>

        <div id="resumer">
            <p>Ce qui est inclus dans le circuit</p>
            <div class="nbrnuit"> <img src="../src/nuit.png" alt="icone nuit">
                <p>3 nuits</p>
            </div>
            <div class="découverte"> <img src="../src/découverte.png" alt="icone découverte">
                <p>3 expériences culinaires et musicales</p>
            </div>
            <div class="transport"> <img src="../src/transport.png" alt="icone transport">
                <p>Transport inclus</p>
            </div>
        </div>

        <div class="parcours">
            <p class="title">Parcours</p>
            <ul>
                <li>Jour 1: Arrivée et premiers plaisirs gustatifs
                    <ul>
                        <li>Installation et découverte du quartier de Bairro Alto</li>
                        <li>Dîner avec dégustation de Bacalhau à Brás</li>
                        <li>Soirée Fado dans une taverne historique</li>
                    </ul>
                </li>
                <li>Jour 2: Entre saveurs et traditions
                    <ul>
                        <li>Visite du marché Time Out et dégustations de spécialités locales</li>
                        <li>Cours de cuisine pour apprendre à préparer des Pasteis de Nata</li>
                        <li>Dîner spectacle avec Fado et vin portugais</li>
                    </ul>
                </li>
                <li>Jour 3: Balade et dernières découvertes
                    <ul>
                        <li>Brunch typique avec café et Torradas</li>
                        <li>Découverte du quartier de l’Alfama et ses restaurants familiaux</li>
                        <li>Retour en fin d’après-midi</li>
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
