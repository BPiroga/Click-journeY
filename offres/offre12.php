<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 12;

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
            <p class="title">Aventure gastronomique en Algarve : Poissons et fruits de mer</p>
            <img src="../src/offre11.jpg" alt="Algarve Food">
            <p>
                L’Algarve, terre de soleil et de saveurs marines, vous attend pour un séjour culinaire unique. Entre poissons grillés, fruits de mer et vins régionaux, plongez dans l’essence de la cuisine du sud du Portugal.
            </p>
        </div>

        <div id="resumer">
            <p>Ce qui est inclus dans le circuit</p>
            <div class="nbrnuit"> <img src="../src/nuit.png" alt="icone nuit">
                <p>4 nuits</p>
            </div>
            <div class="découverte"> <img src="../src/découverte.png" alt="icone découverte">
                <p>5 dégustations maritimes</p>
            </div>
            <div class="transport"> <img src="../src/transport.png" alt="icone transport">
                <p>Transport inclus</p>
            </div>
        </div>

        <div class="parcours">
            <p class="title">Parcours</p>
            <ul>
                <li>Jour 1: Arrivée et introduction aux saveurs de l’Algarve
                    <ul>
                        <li>Installation à Faro</li>
                        <li>Dîner avec une Cataplana de fruits de mer</li>
                    </ul>
                </li>
                <li>Jour 2: À la découverte du marché et de la mer
                    <ul>
                        <li>Visite du marché de Loulé et dégustation de produits locaux</li>
                        <li>Déjeuner avec Sardinhas Assadas (sardines grillées)</li>
                        <li>Excursion en bateau et pêche traditionnelle</li>
                    </ul>
                </li>
                <li>Jour 3: Journée à Lagos et ses spécialités
                    <ul>
                        <li>Randonnée le long des falaises de Ponta da Piedade</li>
                        <li>Dégustation de Poisson grillé accompagné d’un vin blanc régional</li>
                    </ul>
                </li>
                <li>Jour 4: Fin du séjour en douceur
                    <ul>
                        <li>Balade dans les ruelles de Tavira</li>
                        <li>Brunch avec Ovos com Farinheira (œufs brouillés à la saucisse)</li>
                        <li>Retour</li>
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
