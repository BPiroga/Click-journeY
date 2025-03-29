<?php require_once '../php/session_outils.php'; ?>
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
            <p class="title">Découverte des vins de Porto</p>
            <img src="../src/Vin Porto.jpg" alt="Vin Porto">
            <p>
                    Partez pour une escapade immersive au cœur des traditions viticoles portugaises et laissez-vous envoûter
                    par les saveurs de Porto et du Douro ! Entre visites de caves, dégustations de vins d’exception et
                    paysages à couper le souffle, ce séjour est une invitation à la gourmandise et à la détente.
            </p>
        </div>

        <div id="resumer">
            <p>Ce qui est inclus dans le circuit</p>
            div class="brnuit"> <ig src="../sc/nuit.png"alt="icone nuit">
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
                <li>Jour 1: Porto et ses caves légendaires
                    <ul>
                        <li>Arrivée à Porto et installation</li>
                        <li>Balade dans le quartier historique de Ribeira</li>
                        <li>Visite guidée d’une cave à Vila Nova de Gaia avec dégustation de Porto</li>
                    </ul>
                </li>
                <li>Jour 2: Excursion dans la Vallée du Douro 
                    <ul>
                        <li>Croisière sur le fleuve Douro à travers les vignobles en terrasses</li>
                        <li>Déjeuner gastronomique avec accords mets-vins</li>
                        <li>Visite d’un domaine viticole et dégustation de grands crus</li>
                    </ul>
                </li>
                <li>Jour 3: Derniers plaisirs à Porto 
                    <ul>
                        <li>Matinée libre pour explorer la ville</li>
                        <li>Dégustation de spécialités locales (Francesinha, bacalhau)</li>
                        <li>Retour en fin de journée</li>
                    </ul>
                </li>
            </ul>
            <button>Réserver maintenant</button>
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