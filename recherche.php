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
        </div>
    </header>
    <div class="container-recherche">
        <div class="filters">
            <input type="date" placeholder="jj/mm/aaaa">
            <select>
                <option>Choisissez une ville</option>
                <option>Lisbonne</option>
                <option>Porto</option>
            </select>
            <select>
                <option>Type d'expérience</option>
                <option>Vins</option>
                <option>Street Food</option>
            </select>
        
            <input type="number" placeholder="Prix max (€)" min="0">
            <input type="number" placeholder="Durée min (jours)" min="0">
            
            <div class="options">
                <details class="options-details">
                    <summary class="options-btn">Options</summary>
                    <label><input type="checkbox" name="option1"> Voyager avec des enfants</label>
                    <label><input type="checkbox" name="option2"> Vue sur la mer</label>
                    <label><input type="checkbox" name="option3"> Annulation gratuite</label>
                    <label><input type="checkbox" name="option4"> Bagage inclus</label>
                    <label><input type="checkbox" name="option5"> Animaux autorisés</label>
                </details>
            </div>
            
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