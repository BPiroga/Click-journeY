<?php

$offresFile = 'data/Offre.json';
$offres = json_decode(file_get_contents($offresFile), true);


$ville = isset($_GET['ville']) ? $_GET['ville'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
$prixMax = isset($_GET['prix_max']) ? (int)$_GET['prix_max'] : null;
$dureeMin = isset($_GET['duree_min']) ? (int)$_GET['duree_min'] : null;


$defaultOptions = [
    "Voyager avec des enfants",
    "Vue sur la mer",
    "Annulation gratuite",
    "Bagage inclus",
    "Animaux autorisés"
];


$optionsFile = 'data/options.json';
if (file_exists($optionsFile)) {
    $options = json_decode(file_get_contents($optionsFile), true);
} else {
    $options = $defaultOptions;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_option'])) {
    $newOption = trim($_POST['new_option']);
    if (!empty($newOption) && !in_array($newOption, $options)) {
        $options[] = $newOption;
        file_put_contents($optionsFile, json_encode($options, JSON_PRETTY_PRINT));
    }
}


$selectedOptions = isset($_GET['options']) ? $_GET['options'] : [];

$filteredOffres = array_filter($offres, function ($offre) use ($ville, $type, $prixMax, $dureeMin) {
    return (!$ville || $offre['ville'] === $ville) &&
           (!$type || $offre['type'] === $type) &&
           (!$prixMax || $offre['prix'] <= $prixMax) &&
           (!$dureeMin || $offre['duree'] >= $dureeMin);
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
            <a href="connexion.php" class="loginbtn">Se connecter</a>
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
                    <?php foreach ($options as $index => $option): ?>
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
                        <a href="offres/offre<?= $offre['id'] ?>.php">
                            <img src="<?= $offre['image'] ?>" alt="<?= htmlspecialchars($offre['titre']) ?>">
                        </a>
                        <h3><?= htmlspecialchars($offre['titre']) ?></h3>
                        <p><?= $offre['duree'] ?> jours - À partir de <?= $offre['prix'] ?>€</p>
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