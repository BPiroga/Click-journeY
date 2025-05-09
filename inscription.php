<?php
$errorMessage = ''; // Variable pour stocker le message d'erreur

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : '';
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $date_naissance = isset($_POST['date_naissance']) ? trim($_POST['date_naissance']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['code']) ? trim($_POST['code']) : '';
    $confirm_password = isset($_POST['confirm_code']) ? trim($_POST['confirm_code']) : '';

    // Valider les données
    if (empty($prenom) || empty($nom) || empty($date_naissance) || empty($email) || empty($password) || empty($confirm_password)) {
        $errorMessage = 'Tous les champs sont obligatoires.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Adresse email invalide.';
    } elseif ($password !== $confirm_password) {
        $errorMessage = 'Les mots de passe ne correspondent pas.';
    } else {
        // Charger le fichier JSON contenant les utilisateurs
        $jsonFile = 'data/users.json';
        if (!file_exists($jsonFile)) {
            $errorMessage = 'Le fichier des utilisateurs est introuvable.';
        } else {
            $jsonData = file_get_contents($jsonFile);
            $users = json_decode($jsonData, true);

            // Vérifier si l'email existe déjà
            $emailExists = false;
            foreach ($users['users'] as $user) {
                if ($user['email'] === $email) {
                    $emailExists = true;
                    break;
                }
            }

            if ($emailExists) {
                $errorMessage = 'Un utilisateur avec cet email existe déjà.';
            } else {
                // Ajouter le nouvel utilisateur sans hachage du mot de passe
                $newUser = [
                    'prenom' => $prenom,
                    'nom' => $nom,
                    'date_naissance' => $date_naissance,
                    'email' => $email,
                    'mot_de_passe' => $password // Stocker le mot de passe en clair
                ];
                $users['users'][] = $newUser;

                // Sauvegarder les données dans le fichier JSON
                if (file_put_contents($jsonFile, json_encode($users, JSON_PRETTY_PRINT))) {
                    header('Location: connexion.php'); // Rediriger vers la page de connexion
                    exit();
                } else {
                    $errorMessage = 'Erreur lors de l\'enregistrement des données.';
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
            <form method="post" action="inscription.php">
                <table>
                    <tr>
                        <td class="titre-connexion">Inscription</td>
                    </tr>
                    <tr>
                        <td>Prénom :</td>
                        <td>
                            <input type="text" name="prenom" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Nom :</td>
                        <td>
                            <input type="text" name="nom" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Date de naissance :</td>
                        <td>
                            <input type="date" name="date_naissance" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Adresse email :</td>
                        <td>
                            <input type="email" name="email" placeholder="exemple@email.com" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Créer mot de passe :</td>
                        <td>
                            <input type="password" name="code" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Confirmer mot de passe :</td>
                        <td> 
                            <input type="password" name="confirm_code" required>
                        </td>
                    </tr>
                </table>
                <?php
                    if (!empty($errorMessage)) {
                        echo '<p style="color:red">' . htmlspecialchars($errorMessage) . '</p>';
                    }
                ?>
                <div class="form-buttons">
                    <button type="submit">SOUMMETTRE</button>
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