<?php
require_once 'php/session_outils.php';

$offresFile = 'data/offres.json';
$keywordsFile = 'data/keywords.json';

$offres = json_decode(file_get_contents($offresFile), true);
$keywords = json_decode(file_get_contents($keywordsFile), true);

// Récupérer les offres avec les IDs 2 et 14
$offresChoisies = array_filter($offres, function ($offre) {
    return in_array($offre['id'], [2, 14]);
});

// Vérifier si une recherche a été effectuée
$query = $_GET['query'] ?? null;
if ($query) {
    $query = strtolower($query); // Convertir en minuscule pour une recherche insensible à la casse

    // Trouver les IDs des offres correspondant aux mots-clés
    $matchingIds = [];
    foreach ($keywords as $id => $words) {
        foreach ($words as $word) {
            if (strpos($word, $query) !== false) {
                $matchingIds[] = (int)$id;
                break; // Passer à l'offre suivante si un mot-clé correspond
            }
        }
    }

    // Filtrer les offres en fonction des IDs correspondants
    $offres = array_filter($offres, function ($offre) use ($matchingIds) {
        return in_array($offre['id'], $matchingIds);
    });
}
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
            <?php foreach ($offresChoisies as $offre): ?>
                <div>
                    <img class="offre-image" src="<?= htmlspecialchars($offre['image']) ?>" alt="<?= htmlspecialchars($offre['titre']) ?>">
                    <a class="button-offres" href="offres/offre<?= $offre['id'] ?>.php"><?= htmlspecialchars($offre['prix']) ?>€</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="container-recherche"> 
        <div class="bar-recherche">
            <form method="GET" action="index.php">
                <input type="text" name="query" placeholder="Rechercher une expérience" value="<?= htmlspecialchars($_GET['query'] ?? '') ?>">
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <div class="voyages">
            <?php if (empty($offres)): ?>
                <p>Aucune offre ne correspond à votre recherche.</p>
            <?php else: ?>
                <?php foreach ($offres as $offre): ?>
                    <div class="voyage-card">
                        <a href="offres/offre<?= $offre['id'] ?>.php">
                            <img src="<?= htmlspecialchars($offre['image']) ?>" alt="<?= htmlspecialchars($offre['titre']) ?>">
                        </a>
                        <h3><?= htmlspecialchars($offre['titre']) ?></h3>
                        <p><?= htmlspecialchars($offre['duree']) ?> jours - À partir de <?= htmlspecialchars($offre['prix']) ?>€</p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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