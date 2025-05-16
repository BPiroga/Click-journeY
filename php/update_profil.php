<?php
session_start();

$jsonFile = '../data/users.json';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header('Location: ../connexion.php');
    exit();
}

// Charger les données utilisateur
if (!file_exists($jsonFile)) {
    die('Fichier des utilisateurs introuvable.');
}

$jsonData = file_get_contents($jsonFile);
$users = json_decode($jsonData, true);

// Trouver l'utilisateur connecté
$email = $_SESSION['email'];
$userIndex = array_search($email, array_column($users['users'], 'email'));

if ($userIndex === false) {
    die('Utilisateur introuvable.');
}

// Mettre à jour les données utilisateur directement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        if (array_key_exists($key, $users['users'][$userIndex]) && !empty(trim($value))) {
            // Validation pour éviter d'écraser les données avec des valeurs invalides ou vides
            $users['users'][$userIndex][$key] = trim($value);
        }
    }

    // Sauvegarder les modifications dans le fichier JSON
    if (file_put_contents($jsonFile, json_encode($users, JSON_PRETTY_PRINT))) {
        $_SESSION['email'] = $users['users'][$userIndex]['email']; // Mettre à jour l'email dans la session si modifié
        header('Location: ../profil.php'); // Rediriger vers le profil mis à jour
        exit();
    } else {
        die('Erreur lors de la sauvegarde des données.');
    }
}
?>
