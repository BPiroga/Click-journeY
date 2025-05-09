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
    <link id="theme-stylesheet" rel="stylesheet" href="style-dark.css">
    <title>CY Portugal</title>
</head>
<body data-mode="dark">
    <header class="navbar">
        <a class="logo" href="index.php"><img id="logo-image" src="src/Logo-dark.png" alt="Logo CY Portugal" width="210px"></a>
        <p class="titre">CY Portugal</p>
        <div class="navlinks">
            <a href="presentation.php">Présentation</a>
            <a href="recherche.php">Recherche</a>
            <?php renderAuthLinks($isLoggedIn); ?>
        </div>
        <button id="toggle-mode" class="button-link-admin">
            <img id="mode-icon" src="src/moon-icon.png" alt="Changer de mode" width="24px">
        </button>
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
    <script>
    // Vérifier le cookie pour définir le mode initial
    document.addEventListener('DOMContentLoaded', () => {
        const mode = getCookie('mode') || 'dark'; // Par défaut, mode sombre
        setMode(mode);
    });

    // Ajouter un événement au bouton pour changer de mode
    document.getElementById('toggle-mode').addEventListener('click', () => {
        const currentMode = document.body.dataset.mode;
        const newMode = currentMode === 'dark' ? 'light' : 'dark';
        setMode(newMode);
        setCookie('mode', newMode, 30); // Enregistrer le mode dans un cookie pour 30 jours
    });

    // Fonction pour appliquer le mode
    function setMode(mode) {
        document.body.dataset.mode = mode;
        const stylesheet = document.getElementById('theme-stylesheet');
        const logoImage = document.getElementById('logo-image');
        const modeIcon = document.getElementById('mode-icon');
        
        stylesheet.href = mode === 'dark' ? 'style-dark.css' : 'style.css';
        logoImage.src = mode === 'dark' ? 'src/Logo-dark.png' : 'src/Logo.png';
        modeIcon.src = mode === 'dark' ? 'src/moon.png' : 'src/sun.png';
        modeIcon.alt = mode === 'dark' ? 'Mode sombre' : 'Mode clair';
    }

    // Fonction pour définir un cookie
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${value};expires=${date.toUTCString()};path=/`;
    }

    // Fonction pour récupérer un cookie
    function getCookie(name) {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            if (cookie.startsWith(name + '=')) {
                return cookie.substring(name.length + 1);
            }
        }
        return null;
    }
</script>
</body>
</html>