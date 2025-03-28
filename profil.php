<?php
// Charger les données utilisateur depuis le fichier JSON
session_start(); // Assurez-vous que la session est démarrée pour stocker les informations utilisateur
$jsonFile = 'data/users.json';
$userData = null;

if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $users = json_decode($jsonData, true);

    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['email'])) {
        foreach ($users['users'] as $user) {
            if ($user['email'] === $_SESSION['email']) {
                $userData = $user;
                break;
            }
        }
    }
}

/* Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
if (!isset($userData)) {
    header('Location: connexion.php');
    exit();
}
*/
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
        </div>
    </header>
    <p>Profil utilisateur</p>
    <div class="profil-info">
        <p>Information profil</p>

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
            <input type="text" value="<?php echo htmlspecialchars($userData['date_naissance']); ?>" disabled>
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