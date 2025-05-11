<?php
require_once 'php/session_outils.php'; // Inclure les outils de session

session_start(); // Démarrer la session

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
                <button class="button-link-admin vip-button" 
                        data-action="vip" 
                        data-email="<?php echo htmlspecialchars($user['email']); ?>" 
                        onclick="simulateAction(this)">
                    <?php echo $user['role'] === 'vip' ? 'Retirer VIP' : 'Passer VIP'; ?>
                </button>
            <?php endif; ?>
            <!-- Lien pour gérer le bannissement -->
            <?php if ($user['role'] !== 'admin'): ?>
                <button class="button-link-admin ban-button" 
                        data-action="ban" 
                        data-email="<?php echo htmlspecialchars($user['email']); ?>" 
                        onclick="simulateAction(this)">
                    <?php echo isset($user['ban']) && $user['ban'] ? 'Débannir' : 'Bannir'; ?>
                </button>
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
    <script>
        function simulateAction(button) {
            // Désactiver le bouton
            button.disabled = true;
            button.style.opacity = "0.5";

            // Simuler un délai de 3 secondes
            setTimeout(() => {
                // Réactiver le bouton
                button.disabled = false;
                button.style.opacity = "1";

                // Envoyer la requête pour mettre à jour les données
                const action = button.getAttribute('data-action');
                const email = button.getAttribute('data-email');
                window.location.href = `admin.php?action=${action}&email=${encodeURIComponent(email)}`;
            }, 3000); // 3 secondes
        }
    </script>
    <script src="js/admin.js"></script>
</body>
</html>