<?php
require_once 'php/session_outils.php';

$offresFile = 'data/offres.json';
$offres = json_decode(file_get_contents($offresFile), true);

// Tableau contenant les IDs des offres à afficher
$offresChoisies = [2, 14]; // IDs des offres à afficher
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CY Portugal</title>
</head>
<body>
    <header class="navbar">
        <a class="logo" href="index.php"><img src="src/Logo CY Portugal.png" alt="Logo CY Portugal" width="210px"></a>
        <p class="titre">CY Portugal</p>
        <div class="navlinks">
            <a href="presentation.php">Présentation</a>
            <a href="recherche.php">Recherche</a>
            <?php renderAuthLinks($isLoggedIn); ?>
        </div>
    </header>
    <div class="container">
        <div class="offres">
            <?php foreach ($offres as $offre): ?>
                <?php if (in_array($offre['id'], $offresChoisies)): ?>
                    <div>
                        <img class="offre-image" src="<?= htmlspecialchars($offre['image']) ?>" alt="<?= htmlspecialchars($offre['titre']) ?>">
                        <a class="button-offres" href="offres/offre<?= $offre['id'] ?>.php"><?= htmlspecialchars($offre['prix']) ?>€</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="container-recherche"> 
        <div class="bar-recherche">
            <input type="text" placeholder="Rechercher une expérience">
            <button>Rechercher</button>
        </div>
        <div class="voyages">
            <?php foreach ($offres as $offre): ?>
                <div class="voyage-card">
                    <a href="offres/offre<?= $offre['id'] ?>.php">
                        <img src="<?= htmlspecialchars($offre['image']) ?>" alt="<?= htmlspecialchars($offre['titre']) ?>">
                    </a>
                    <h3><?= htmlspecialchars($offre['titre']) ?></h3>
                    <p><?= htmlspecialchars($offre['duree']) ?> jours - À partir de <?= htmlspecialchars($offre['prix']) ?>€</p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <footer>
        <p>&copy; 2025 CY Portugal</p>
        <a href="profil.php">Compte</a>
        <a href="admin.php">Administration</a>
        <p>Contact : CY Tech</p>
    </footer>
</body>
</html>