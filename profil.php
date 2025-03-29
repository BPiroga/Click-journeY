<?php
require_once 'php/session_outils.php'; // Inclure les outils de session
$jsonFile = 'data/users.json';
$userData = null;

// Charger les données utilisateur depuis le fichier JSON
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

// Rediriger vers la page de connexion si l'utilisateur n'est pas connecté ou si le profil n'est pas trouvé
if (!isset($userData)) {
    header('Location: connexion.php');
    exit();
}

// Ne pas rediriger l'admin vers la page admin lorsqu'il consulte son propre profil
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
    <p>Profil utilisateur</p>
    <div class="profil-info">
        <p class="profil-title" style="<?php echo (isset($userData['role']) && $userData['role'] === 'vip') ? 'color: gold; -webkit-text-stroke: 0.5px black;':''; ?>">
            <?php echo (isset($userData['role']) && $userData['role'] === 'vip') ? 'Information profil VIP' : 'Information profil'; ?>
        </p>

        <div>
            <p>Prénom :</p>
            <input type="text" value="<?php echo htmlspecialchars($userData['prenom']); ?>" disabled>
            <button type="button">
                <span>&#9998</span> Modifier
            </button>
        </div>

        <div>
            <p>Nom :</p>
            <input type="text" value="<?php echo htmlspecialchars($userData['nom']); ?>" disabled>
            <button type="button">
                <span>&#9998</span> Modifier
            </button>
        </div>

        <div>
            <p>Date de naissance :</p>
            <input type="text" value="<?php echo htmlspecialchars(date('d/m/Y', strtotime($userData['date_naissance']))); ?>" disabled>
            <button type="button">
                <span>&#9998</span> Modifier
            </button>
        </div>
        
        <div>
            <p>Adresse email :</p>
            <input type="email" value="<?php echo htmlspecialchars($userData['email']); ?>" disabled>
            <button type="button">
                <span>&#9998</span>Modifier
            </button>
        </div>

        <div>
            <p>Mot de passe :</p>
            <input type="password" value="********" disabled>
            <button type="button">
                <span>&#9998</span>Modifier
            </button>
        </div>
    </div>
    
    <p>Réservations</p>
    <div class="profil-reservation">
        <div class="offres">
            <div>
                <img src="src/Vin Porto.jpg" alt="Vin Porto" id="vin-porto">
                <img src="src/Verre de vin.webp" alt="Verre de vin" id="verre-de-vin">
                <a class="button-offres" href="vin.php">Réservé</a>
            </div>
            <div>
                <img src="../src/Street food.webp" alt="Street food" id="street-food">
                <a class="button-offres" href="street.php">Réservé</a>
            </div>
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