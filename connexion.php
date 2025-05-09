<?php
session_start(); // Démarrer la session pour vérifier si l'utilisateur est connecté

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['email'])) {
    header('Location: index.php'); // Rediriger vers la page d'accueil
    exit(); // Terminer le script après la redirection
}

$errorMessage = ''; // Variable pour stocker le message d'erreur

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['code']) ? trim($_POST['code']) : '';

    // Charger le fichier JSON contenant les utilisateurs
    $jsonFile = 'data/users.json';
    $jsonData = file_get_contents($jsonFile);
    $users = json_decode($jsonData, true);

    // Vérifier si l'utilisateur existe
    $userFound = false;
    foreach ($users['users'] as $user) {
        // Vérifier si l'utilisateur est banni
        if ($user['email'] === $email && isset($user['ban']) && $user['ban'] === true) {
            $errorMessage = 'Ce compte a été supprimé.'; // Définir le message d'erreur
            $userFound = true; // Considérer comme trouvé pour éviter d'autres vérifications
            break;
        }

        // Vérifier l'email et le mot de passe (assurez-vous que les mots de passe sont hachés)
        if ($user['email'] === $email && $password === $user['mot_de_passe']) {
            $userFound = true;
            $_SESSION['email'] = $email; // Stocker l'email dans la session
            $_SESSION['role'] = $user['role']; // Stocker le rôle de l'utilisateur dans la session
            break;
        }
    }

    // Gérer la redirection ou afficher un message d'erreur
    if ($userFound && empty($errorMessage)) {
        header('Location: profil.php'); // Rediriger vers la page profil
        exit(); // Terminer le script après la redirection
    } elseif (empty($errorMessage)) {
        $errorMessage = 'Adresse email ou mot de passe incorrect.'; // Définir le message d'erreur
    }
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
    </header>
    <div class="container">
        <div class="connexion">
            <form method="post" action="connexion.php">
                <table>
                    <tr>
                        <td class="titre-connexion">Connexion</td>
                    </tr>
                    <tr>
                        <td>Adresse mail :</td>
                        <td>
                            <input type="email" name="email" placeholder="Entrer votre adresse mail" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Mot de passe :</td>
                        <td>
                            <input type="password" name="code" placeholder="Entrer votre code" required>
                        </td>
                    </tr>
                </table>
                <?php
                    if (!empty($errorMessage)) {
                        echo '<p style="color:red">' . $errorMessage . '</p>';
                    }
                ?>
                <div class="form-buttons">
                    <button type="submit">SE CONNECTER</button>
                    <button type="reset">EFFACER</button>
                    <a class="button-creation-compte" href="inscription.php">Creer un compte ?</a>
                </div>
            </form>
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
