<?php
//////////////////////////////////////////////////////////////////// CE FICHIER N'EST PAS UTILE POUR L'INSTANT ///////////////////////////////////////////////////////////////////////////////////////////
session_start();
//regarde si c'est la bonne methode de transfert de donné POST
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    //récueration des données entré par l'utilisateur
    $nom= trim($_POST["nom"]);
    $prenom= trim($_POST["prenom"]);
    $num_card= trim($_POST["num_card"]);
    $date_ex= trim($_POST["date_ex"]);
    $crypto= trim($_POST["cryptogramme"]);
    
    //création d'un tableau associatif
    $new_card = [
        'nom'=> $nom,
        'prenom'=> $prenom,
        'num_card'=> $num_card,
        'date_ex'=> $date_ex,
        'crypto' => $crypto
    ];

    $fichier_json = "data/card_data.json";
    $clients = [];

    if(file_exists($fichier_json)){
        echo "fichier existe";
        $contenu = file_get_contents($fichier_json);
        $clients = json_decode($contenu, true); 
        foreach($clients as $client){
            if($client["nom"] === $nom && $client["prenom"] === $prenom && $client["num_card"] === $num_card && $client["date_ex"] === $date_ex && $client["crypto"] === $crypto){
                echo "Vous êtes déjà enregistré.";
                header("Location: https://www.plateforme-smc.fr/cybank/");
                exit; 
            }
        }
        $clients[]=$new_card;
        file_put_contents($fichier_json, json_encode($clients, JSON_PRETTY_PRINT));
        header("Location: https://www.plateforme-smc.fr/cybank/");
        exit;
    }   
}
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
    </header>
    <div class='container'>
        <div class='connexion'>
            <form action="payment.php" method="post">
                <table>
                    <tr>
                        <td class="titre-connexion">Paiement</td>
                    </tr>
                    <tr>
                        <td>Nom et prénom du propriétaire de la carte:</td>
                        <td><input type="text" name="prenom" placeholder="Nom" required></td>
                        <td><input type="text" name="nom" placeholder="Prénom" required></td>
                    </tr>
                    <tr>
                        <td>Numéro de carte bancaire</td>
                        <td><input type="texte" pattern="{16,16}" name="num_card" required></td>
                    </tr>
                    <tr>
                        <td>Date d'expiration:</td>
                        <td><input type="month" name="date_ex" required></td>
                    </tr>
                    <tr>
                        <td>Cryptogramme:</td>
                        <td><input type="text" pattern="{3,3}" name="cryptogramme" required></td>
                    </tr>
                </table>
                <div class="form-buttons">
                    <button type="submit">SOUMMETTRE</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>