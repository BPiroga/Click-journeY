<?php
// fichier utiliser par le code
require('php/getapikey.php');

session_start(); // Démarrer la session pour accéder aux données de session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header('Location: connexion.php'); // Rediriger vers la page de connexion
    exit(); // Terminer le script après la redirection
}

// Récupérer l'ID de l'offre depuis la session
$offreId = $_SESSION['offre_id'] ?? null;

// Vérifier si les données de CYBANK existent dans l'URL
if (isset($_GET['transaction'], $_GET['montant'], $_GET['vendeur'], $_GET['status'], $_GET['control'])) {
    // Récupérations des données de CYBANK visibles dans l'URL
    $transaction = $_GET['transaction'];
    $montant = $_GET['montant'];
    $vendeur = $_GET['vendeur'];
    $statut = $_GET['status'];
    $control_recu = $_GET['control'];
    // Récupération de la clé API secrète
    $api_key = getAPIKey($vendeur);

    // Contrôle MD5 retourné par CYBANK
    $control_attendu = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $statut . "#");
}

// Charger le fichier JSON des utilisateurs
$usersFile = 'data/users.json';
$users = json_decode(file_get_contents($usersFile), true);

// Vérifier si l'utilisateur est connecté (par exemple, via un email stocké dans la session)
$email = $_SESSION['email'] ?? null;

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
            <a href="profil.php">Retour au panier</a>
        </div>
    </header>

    <div class="container">
        <div class="retour">
            <?php
            // Vérifier si les valeurs nécessaires pour la comparaison existent
            if (!isset($control_recu, $control_attendu, $statut)) {
                echo "<h2>Erreur : données de contrôle manquantes !</h2>";
            } else {
                // Comparer les valeurs de contrôle avant et après CYBANK
                if ($control_recu === $control_attendu) {
                    if ($statut === "accepted") {
                        // Ajouter l'offre dans reservations[] et la retirer de panier[]
                        if ($email) {
                            foreach ($users['users'] as &$user) {
                                if ($user['email'] === $email) {
                                    // Retirer l'offre du panier
                                    $user['panier'] = array_diff($user['panier'], [$offreId]);

                                    // Ajouter l'offre aux réservations
                                    if (!in_array($offreId, $user['reservations'])) {
                                        $user['reservations'][] = $offreId;
                                    }
                                    break;
                                }
                            }

                            // Sauvegarder les modifications dans le fichier JSON
                            file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
                        }

                        echo "<h2>Paiement accepté !</h2>";
                    } else {
                        echo "<h2>Paiement refusé.</h2>";
                    }
                } else {
                    echo "<h2>Erreur : données invalides !</h2>";
                }
            }
            ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 CY Portugal</p>
        <a href="profil.php">Compte</a>
        <a href="admin.php">Administration</a>
        <p>Contact : CY Tech</p>
    </footer>

    <script src="js/theme-mode.js"></script>
</body>
</html>