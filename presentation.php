<?php require_once 'php/session_outils.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="theme-stylesheet" rel="stylesheet" href="style.css">
    <title>CY Portugal</title>
</head>
<body data-mode="light">
    <header class="navbar">
        <a class="logo" href="index.php"><img id="logo-image" src="src/Logo.png" alt="Logo CY Portugal" width="210px"></a>
        <p class="titre">CY Portugal</p>
        <button id="toggle-mode" class="button-link-admin">
            <img id="mode-icon" src="src/sun.png" alt="Changer de mode" width="24px">
        </button>
        <div class="navlinks">
            <a href="presentation.php">Présentation</a>
            <a href="recherche.php">Recherche</a>
            <?php renderAuthLinks($isLoggedIn); ?>
        </div>
    </header>
    <h1 class="presentation-titre">
        Bienvenue chez CY Portugal, votre agence de voyage culinaire au Portugal !
    </h1>
    <p class="presentation-texte">   
        Découvrez le Portugal à travers ses saveurs uniques, ses traditions culinaires et ses paysages. Nous vous proposons des expériences immersives telles que des dégustations de vins ainsi que des spécialités locales. Vivez un voyage sensoriel inoubliable au cœur de la gastronomie portugaise avec notre agence !
    </p>
    <footer>
        <p>&copy; 2025 CY Portugal</p>
        <a href="profil.php">Compte</a>
        <a href="admin.php">Administration</a>
        <p>Contact : CY Tech</p>
    </footer>

    <script src="js/theme-mode.js"></script>
</body>
</html>
