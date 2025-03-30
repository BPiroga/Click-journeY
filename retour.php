<?php
// fichier utiliser par le code
require('getapikey.php');

//récuperations des données de CYBANK visble dans l'URL
$transaction = $_GET['transaction'];
$montant = $_GET['montant'];
$vendeur = $_GET['vendeur'];
$statut = $_GET['status'];
$control_recu = $_GET['control'];

//récuperation de la clé API secrète
$api_key = getAPIKey($vendeur);

//controle md5 retourné par CYBANK
$control_attendu = md5($api_key."#".$transaction."#".$montant."#".$vendeur."#".$statut."#");

on compare les valeurs de controle avant et après CYBANK
if ($control_recu === $control_attendu) {
    if ($statut === "accepted") {
        echo "<h2>Paiement accepté !</h2>";
    } else {
        echo "<h2>Paiement refusé.</h2>";
    }
} else {
    echo "<h2>Erreur : données invalides !</h2>";
}
?>