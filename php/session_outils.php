<?php
session_start(); // Démarrer la session pour vérifier si l'utilisateur est connecté
$isLoggedIn = isset($_SESSION['email']); // Vérifier si l'email est stocké dans la session

// Gérer la déconnexion
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_destroy(); // Détruire la session
    header('Location: index.php'); // Rediriger vers la page d'accueil
    exit();
}

// Fonction pour afficher les liens de connexion/déconnexion
function renderAuthLinks($isLoggedIn) {
    $isInOffresFolder = strpos($_SERVER['SCRIPT_FILENAME'], 'offres') !== false;
    $basePath = $isInOffresFolder ? '../' : '';

    if ($isLoggedIn) {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            echo '<a href="' . $basePath . 'admin.php" class="loginbtn">Compte</a>';
        } else {
            echo '<a href="' . $basePath . 'profil.php" class="loginbtn">Compte</a>';
        }
        echo '<a href="' . $basePath . 'index.php?logout=true" class="logoutbtn">Se déconnecter</a>';
    } else {
        echo '<a href="' . $basePath . 'connexion.php" class="loginbtn">Se connecter</a>';
    }
}

// Fonction pour gérer le panier
function handlePanier($offreId) {
    if (!isset($_SESSION['email'])) {
        header('Location: ../connexion.php');
        exit();
    }

    $usersFile = '../data/users.json';
    $usersData = json_decode(file_get_contents($usersFile), true);

    foreach ($usersData['users'] as &$user) {
        if ($user['email'] === $_SESSION['email']) {
            if (!in_array($offreId, $user['panier'])) {
                $user['panier'][] = $offreId;
            }
            file_put_contents($usersFile, json_encode($usersData, JSON_PRETTY_PRINT));
            break;
        }
    }
}

// Fonction pour vérifier si une offre est dans le panier
function isOfferInPanier($offreId) {
    if (!isset($_SESSION['email'])) {
        return false;
    }

    $usersFile = '../data/users.json';
    $usersData = json_decode(file_get_contents($usersFile), true);

    foreach ($usersData['users'] as $user) {
        if ($user['email'] === $_SESSION['email']) {
            // Vérifier si l'offre est dans le panier ou dans les réservations
            if (in_array($offreId, $user['panier']) || in_array($offreId, $user['reservations'])) {
                return true;
            }
        }
    }

    return false;
}

// Fonction pour mettre à jour le profil utilisateur
function updateUserProfile($email, $newData) {
    $usersFile = '../data/users.json';
    $usersData = json_decode(file_get_contents($usersFile), true);

    foreach ($usersData['users'] as &$user) {
        if ($user['email'] === $email) {
            foreach ($newData as $key => $value) {
                if (isset($user[$key])) {
                    $user[$key] = $value; // Mettre à jour les données
                }
            }
            file_put_contents($usersFile, json_encode($usersData, JSON_PRETTY_PRINT));
            return true;
        }
    }
    return false;
}

// Exemple d'utilisation (à appeler depuis un formulaire)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $newData = [
        'prenom' => $_POST['prenom'] ?? '',
        'nom' => $_POST['nom'] ?? '',
        'date_naissance' => $_POST['date_naissance'] ?? ''
    ];
    $email = $_SESSION['email'] ?? '';
    if ($email && updateUserProfile($email, $newData)) {
        header('Location: profil.php?update=success');
        exit();
    } else {
        header('Location: profil.php?update=error');
        exit();
    }
}
?>