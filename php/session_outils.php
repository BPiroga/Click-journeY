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
    // Vérifier si le fichier actuel est dans le dossier "offres"
    $isInOffresFolder = strpos($_SERVER['SCRIPT_FILENAME'], 'offres') !== false;
    $basePath = $isInOffresFolder ? '../' : '';

    if ($isLoggedIn) {
        // Vérifier si l'utilisateur est un administrateur
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            echo '<a href="' . $basePath . 'admin.php" class="loginbtn">Compte</a>'; // Rediriger vers admin.php
        } else {
            echo '<a href="' . $basePath . 'profil.php" class="loginbtn">Compte</a>'; // Rediriger vers profil.php
        }
        echo '<a href="' . $basePath . 'index.php?logout=true" class="logoutbtn">Se déconnecter</a>';
    } else {
        echo '<a href="' . $basePath . 'connexion.php" class="loginbtn">Se connecter</a>';
    }
}
?>