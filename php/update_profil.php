<?php

//Démarre la session
session_start();
header('Content-Type: application/json');

// Fichier JSON des utilisateurs
$userFile = '../data/users.json';
$userData = json_decode(file_get_contents($userFile), true);

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non connecté."]);
    exit;
}

$sessionEmail = $_SESSION['email'];

//Récupère les données envoyées par POST
$prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : null;
$nom = isset($_POST['nom']) ? trim($_POST['nom']) : null;
$date_naissance = isset($_POST['date_naissance']) ? trim($_POST['date_naissance']) : null;
$email = isset($_POST['email']) ? trim($_POST['email']) : null;
$mot_de_passe = isset($_POST['mot_de_passe']) ? trim($_POST['mot_de_passe']) : null;



//Vérifie que les champs existent et sont valides 

if (!$prenom || !$nom || !$date_naissance || !$mot_de_passe || !$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "Données manquantes ou invalides."]);
    exit;
}

//Mise à jour de l'utilisateur dans le tableau
$found = false;
foreach ($userData['users'] as &$user) {
    if ($user['email'] === $sessionEmail) {
        $user['prenom'] = $prenom;
        $user['nom'] = $nom;
        $user['date_naissance'] = $date_naissance;
        $user['email'] = $email;
        $user['mot_de_passe'] = $mot_de_passe;
        // Mise à jour de l'email dans la session si changé
        if ($sessionEmail !== $email) {
            $_SESSION['email'] = $email;
        }

        $found = true;
        break;
    }
}

if (!$found) {
    echo json_encode(["success" => false, "message" => "Utilisateur introuvable."]);
    exit;
}

//Sauvegarde dans le fichier JSON
if (file_put_contents($userFile, json_encode($userData, JSON_PRETTY_PRINT))) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur lors de la sauvegarde."]);
}
?>
