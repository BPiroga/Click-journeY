<?php
require_once '../php/session_outils.php';

// ID de l'offre actuelle
$offreId = 6;

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
            <p class="title">Séjour culinaire à Faro (Algarve)</p>
            <img src="../src/algarve.jpg" alt="Faro Food">
            <p>
                Découvrez Faro, une ville ensoleillée de l'Algarve, riche en traditions culinaires. Profitez de ses fruits de mer frais, de ses plats à base de riz et d'une découverte de ses marchés typiques pour une immersion totale.
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
            <div class="transport"> <img src="src/transport.png" alt="icone transport">
                <p>Transport inclus</p>
            </div>
        </div>

        <div class="parcours">
            <p class="title">Parcours</p>
            <ul>
                <li>Jour 1: Arrivée et marché de Faro
                    <ul>
                        <li>Arrivée à Faro et installation</li>
                        <li>Visite du marché de la ville pour découvrir les poissons et fruits de mer locaux</li>
                        <li>Dégustation de "Arroz de Marisco" (riz aux fruits de mer)</li>
                    </ul>
                </li>
                <li>Jour 2: Découverte des saveurs de l'Algarve
                    <ul>
                        <li>Visite d'un village de pêcheurs et dégustation de poissons grillés</li>
                        <li>Déjeuner avec "Cataplana" (ragoût traditionnel de fruits de mer)</li>
                        <li>Visite d'une distillerie locale pour découvrir l’eau-de-vie "Medronho"</li>
                    </ul>
                </li>
                <li>Jour 3: Détente et gastronomie
                    <ul>
                        <li>Matinée libre pour explorer les plages de l'Algarve</li>
                        <li>Dîner dans un restaurant typique avec une vue sur l’océan</li>
                        <li>Retour à Faro et fin du séjour</li>
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
