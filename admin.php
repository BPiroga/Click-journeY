<?php
require_once 'php/session_outils.php'; // Inclure les outils de session

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Démarrer la session uniquement si elle n'est pas déjà démarrée
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header('Location: connexion.php'); // Rediriger vers la page de connexion
    exit(); // Terminer le script après la redirection
}

// Vérifier si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Rediriger vers la page précédente ou une autre page
    header('Location: ' . $_SERVER['HTTP_REFERER']); // Redirige vers la page précédente
    exit();
}

// Lire les données des utilisateurs depuis le fichier JSON
$usersFile = 'data/users.json';
$usersData = json_decode(file_get_contents($usersFile), true);
$users = &$usersData['users']; // Référence pour modifier directement les données

// Gérer les actions VIP et bannissement
if (isset($_GET['action']) && isset($_GET['email'])) {
    $email = $_GET['email'];
    $action = $_GET['action'];

    foreach ($users as &$user) {
        if ($user['email'] === $email) {
            if ($action === 'vip') {
                // Gérer le statut VIP
                if ($user['role'] === 'user') {
                    $user['role'] = 'vip';
                } elseif ($user['role'] === 'vip') {
                    $user['role'] = 'user';
                }
            } elseif ($action === 'ban') {
                // Gérer le bannissement
                $user['ban'] = isset($user['ban']) ? !$user['ban'] : true; // Basculer entre true/false
            }
            break;
        }
    }

    // Sauvegarder les modifications dans le fichier JSON
    file_put_contents($usersFile, json_encode($usersData, JSON_PRETTY_PRINT));
    header('Location: admin.php'); // Recharger la page pour refléter les changements
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-dark.css">
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
    <p>Profils utilisateurs</p>
    <div class="profil-info">
        <p>Nombre utilisateurs : <?php echo count($users); ?></p>
        
        <?php foreach ($users as $user): ?>
        <div class="admin-profils">
            <div>
                <div>
                    <p>Prénom :</p>
                    <input type="text" value="<?php echo htmlspecialchars($user['prenom']); ?>" style="color: <?php echo isset($user['ban']) && $user['ban'] ? 'red' : 'black'; ?>;" disabled>
                </div>
                <div>
                    <p>Nom :</p>
                    <input type="text" value="<?php echo htmlspecialchars($user['nom']); ?>" style="color: <?php echo isset($user['ban']) && $user['ban'] ? 'red' : 'black'; ?>;" disabled>
                </div>
                <div>
                    <p>Rôle :</p>
                    <input type="text" value="<?php echo htmlspecialchars($user['role']); ?>" style="color: <?php echo isset($user['ban']) && $user['ban'] ? 'red' : 'black'; ?>;" disabled>
                </div>
            </div>
            <!-- Lien pour voir le profil de l'utilisateur -->
            <a class="button-link-admin" href="profil.php?email=<?php echo urlencode($user['email']); ?>">Voir le profil</a>
            <!-- Lien pour gérer le statut VIP -->
            <?php if ($user['role'] !== 'admin'): ?>
                <a class="button-link-admin" href="admin.php?action=vip&email=<?php echo urlencode($user['email']); ?>">
                    <?php echo $user['role'] === 'vip' ? 'Retirer VIP' : 'Passer VIP'; ?>
                </a>
            <?php endif; ?>
            <!-- Lien pour gérer le bannissement -->
            <?php if ($user['role'] !== 'admin'): ?>
                <a class="button-link-admin" href="admin.php?action=ban&email=<?php echo urlencode($user['email']); ?>">
                    <?php echo isset($user['ban']) && $user['ban'] ? 'Débannir' : 'Bannir'; ?>
                </a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <footer>
        <p>&copy; 2025 CY Portugal</p>
        <a href="profil.php">Compte</a>
        <a href="admin.php">Administration</a>
        <p>Contact : CY Tech</p>
    </footer>
</body>
</html>