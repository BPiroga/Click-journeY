<?php
require_once 'php/session_outils.php';

$offresFile = 'data/offres.json';
$offres = json_decode(file_get_contents($offresFile), true);

// Récupération des critères de recherche
$ville = isset($_GET['ville']) ? $_GET['ville'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
$prixMax = isset($_GET['prix_max']) ? (int)$_GET['prix_max'] : null;
$dureeMin = isset($_GET['duree_min']) ? (int)$_GET['duree_min'] : null;

// Extraction des options uniques depuis le fichier offres.json
$options = [];
foreach ($offres as $offre) {
    if (isset($offre['options'])) {
        $options = array_merge($options, $offre['options']);
    }
}
$options = array_unique($options); // Supprime les doublons

// Récupération des options sélectionnées
$selectedOptions = isset($_GET['options']) ? $_GET['options'] : [];

// Filtrage des offres en fonction des critères
$filteredOffres = array_filter($offres, function ($offre) use ($ville, $type, $prixMax, $dureeMin, $selectedOptions) {
    $matchesOptions = empty($selectedOptions) || (isset($offre['options']) && !array_diff($selectedOptions, $offre['options']));
    return (!$ville || $offre['ville'] === $ville) &&
           (!$type || $offre['type'] === $type) &&
           (!$prixMax || $offre['prix'] <= $prixMax) &&
           (!$dureeMin || $offre['duree'] >= $dureeMin) &&
           $matchesOptions;
});
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
    <div class="container-recherche">
        <form class="filters" method="get" action="recherche.php">
            <input type="date" name="date" placeholder="jj/mm/aaaa">
            <select name="ville">
                <option value="">Choisissez une ville</option>
                <option value="Lisbonne" <?= $ville === 'Lisbonne' ? 'selected' : '' ?>>Lisbonne</option>
                <option value="Porto" <?= $ville === 'Porto' ? 'selected' : '' ?>>Porto</option>
                <option value="Douro" <?= $ville === 'Douro' ? 'selected' : '' ?>>Douro</option>
                <option value="Algarve" <?= $ville === 'Algarve' ? 'selected' : '' ?>>Algarve</option>
            </select>
            <select name="type">
                <option value="">Type d'expérience</option>
                <option value="Vins" <?= $type === 'Vins' ? 'selected' : '' ?>>Vins</option>
                <option value="Street Food" <?= $type === 'Street Food' ? 'selected' : '' ?>>Street Food</option>
                <option value="Gastronomie" <?= $type === 'Gastronomie' ? 'selected' : '' ?>>Gastronomie</option>
                <option value="Pâtisseries" <?= $type === 'Pâtisseries' ? 'selected' : '' ?>>Pâtisseries</option>
            </select>
            <input type="number" name="prix_max" placeholder="Prix max (€)" min="0" value="<?= htmlspecialchars($prixMax) ?>">
            <input type="number" name="duree_min" placeholder="Durée min (jours)" min="0" value="<?= htmlspecialchars($dureeMin) ?>">
            <div class="options">
                <details class="options-details">
                    <summary class="options-btn">Options</summary>
                    <?php foreach ($options as $option): ?>
                        <label>
                            <input type="checkbox" name="options[]" value="<?= htmlspecialchars($option) ?>" 
                                <?= in_array($option, $selectedOptions) ? 'checked' : '' ?>>
                            <?= htmlspecialchars($option) ?>
                        </label>
                    <?php endforeach; ?>
                </details>
            </div>
            <button type="submit">Rechercher</button>
        </form>

        <div class="voyages">
            <?php if (empty($filteredOffres)): ?>
                <p>Aucune offre ne correspond à vos critères.</p>
            <?php else: ?>
                <?php foreach ($filteredOffres as $offre): ?>
                    <div class="voyage-card">
                        <a href="offres/offre<?= htmlspecialchars($offre['id'] ?? '') ?>.php">
                            <img src="<?= htmlspecialchars($offre['image'] ?? 'src/default.jpg') ?>" alt="<?= htmlspecialchars($offre['titre'] ?? 'Offre') ?>">
                        </a>
                        <h3><?= htmlspecialchars($offre['titre'] ?? 'Titre non disponible') ?></h3>
                        <p><?= htmlspecialchars($offre['duree'] ?? '0') ?> jours - À partir de <?= htmlspecialchars($offre['prix'] ?? '0') ?>€</p>
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