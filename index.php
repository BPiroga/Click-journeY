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
        <div class="navlinks">
            <a href="presentation.php">Présentation</a>
            <a href="recherche.php">Recherche</a>
            <a href="connexion.php" class="loginbtn">Se connecter</a>
            <a href="panier.php">Mon panier</a>
        </div>
    </header>
    <div class="container">
        <div class="offres">
            <div>
                <img src="src/Vin Porto.jpg" alt="Vin Porto" id="vin-porto">
                <img src="src/Verre de vin.webp" alt="Verre de vin" id="verre-de-vin">
                <a class="button-offres" href="vin.php">299€</a>
            </div>
            <div>
                <img src="src/Street food.webp" alt="Street food" id="street-food">
                <a class="button-offres" href="street.php">199€</a>
            </div>
        </div>
    </div>
    <div class="container-recherche"> 
        <div class="bar-recherche">
            <input type="text" placeholder="Rechercher une expérience">
            <button>Rechercher</button>
        </div>
        <div class="voyages">

            <div class="voyage-card">
                <a href="vin.php">
                    <img src="src/Vin Porto.jpg" alt="Vin Porto">
                </a>
                <h3>Découverte des vins de Porto</h3>
                <p>3 jours - À partir de 299€</p>
            </div>

            <div class="voyage-card">
                <a href="street.php">
                    <img src="src/Street food.webp" alt="Street food">
                </a>
                <h3>Street food à Lisbonne</h3>
                <p>2 jours - À partir de 199€</p>
            </div>

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