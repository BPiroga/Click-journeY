<?php
require('getapikey.php');

$transaction = "TX12345ABC";
$montant = '49.99';
$vendeur = 'MI-5_B';
$retour = 'http://localhost/exemple/retour.php';
$api_key = getAPIKey($vendeur);

$control = md5($api_key."#".$transaction."#".$montant."#".$vendeur."#".$retour."#");
?>

<h2>Votre panier</h2>
<p>Total : 49.99€</p>
<form action="https://www.plateforme-smc.fr/cybank/index.php" method="post">
    <input type="hidden" name="transaction" value="<?= $transaction ?>">
    <input type="hidden" name="montant" value="<?= $montant ?>">
    <input type="hidden" name="vendeur" value="<?= $vendeur ?>">
    <input type="hidden" name="retour" value="<?= $retour ?>">
    <input type="hidden" name="control" value="<?= $control ?>">
    <input type="submit" value="Payer">
</form>

