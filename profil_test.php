<?php
require_once 'php/session_outils.php'; // Inclure les outils de session

$jsonFile = 'data/users.json';
$offresFile = 'data/offres.json';

if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $users = json_decode($jsonData, true);

    // Vérifier si un email est passé dans l'URL
    if (isset($_GET['email'])) {
        $selectedEmail = $_GET['email'];
        foreach ($users['users'] as $user) {
            if ($user['email'] === $selectedEmail) {
                $userData = $user;
                break;
            }
        }
    } else {
        // Si aucun email n'est passé, afficher le profil de l'utilisateur connecté
        if (isset($_SESSION['email'])) {
            foreach ($users['users'] as $user) {
                if ($user['email'] === $_SESSION['email']) {
                    $userData = $user;
                    break;
                }
            }
        }
    }
}


?>

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

    <p>Profil utilisateur</p>
    <div class="profil-info">
        <p class="profil-title" style="<?php echo (isset($userData['role']) && $userData['role'] === 'vip') ? 'color: gold; -webkit-text-stroke: 0.5px black;':''; ?>">
            <?php echo (isset($userData['role']) && $userData['role'] === 'vip') ? 'Information profil VIP' : 'Information profil'; ?>
        </p>

        <form id="profil-form" method="post" action="php/update_profil.php">
            <div>
                <p>Prénom :</p>
                <input type="text" name="prenom" value="<?= htmlspecialchars($userData['prenom'] ?? '') ?>" disabled>
                <button type="button" class="edit-btn">Modifier</button>
                <button type="button" class="cancel-btn" style="display: none;">Annuler</button>
                <button type="button" class="save-btn" style="display: none;">Valider</button>
            </div>
            
            <div>
                <p>Nom :</p>
                <input type="text" name="nom" value="<?= htmlspecialchars($userData['nom'] ?? '') ?>" disabled>
                <button type="button" class="edit-btn">Modifier</button>
                <button type="button" class="cancel-btn" style="display: none;">Annuler</button>
                <button type="button" class="save-btn" style="display: none;">Valider</button>
            </div>
            
            <button type="submit" id="submit-btn" style="display:none;">Soumettre</button>
        </form>
    </div>
    
    <footer>
        <p>&copy; 2025 CY Portugal</p>
        <a href="profil.php">Compte</a>
        <a href="admin.php">Administration</a>
        <p>Contact : CY Tech</p>
    </footer>

    <script src="js/profil_test.js"></script>
    <script src="js/theme-mode.js"></script>
</body>
</html>