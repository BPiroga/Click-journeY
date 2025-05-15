<?php require_once 'php/session_outils.php';?>

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
            <a href="teste.php">Recherche</a>
            <?php renderAuthLinks($isLoggedIn); ?>
        </div>
    </header>

    <div class="container-recherche">
        <div class="filters">
            <input type="date" name="date" id="date" placeholder="jj/mm/aaaa">
            <select name="ville" id="ville">
                <option value="">Choisissez une ville</option>
                <option value="Lisbonne">Lisbonne</option>
                <option value="Porto">Porto</option>
                <option value="Douro">Douro</option>
                <option value="Algarve">Algarve</option>
                <option value="Madère">Madère</option>
                <option value="Alentejo">Alentejo</option>
                <option value="Sintra">Sintra</option>
                <option value="Faro">Faro</option>

            </select>
            <select name="type" id="type">
                <option value="">Type d'expérience</option>
                <option value="Vins" >Vins</option>
                <option value="Street Food">Street Food</option>
                <option value="Gastronomie">Gastronomie</option>
                <option value="Pâtisseries">Pâtisseries</option>
            </select>
            <input type="number" id="prix_max" placeholder="Prix max (€)" min="0">
            <input type="number" id="duree_min" placeholder="Durée min (jours)" min="0">
            <div class="options">
                <details class="options-details">
                    <summary class="options-btn">Options</summary>
                        <label>
                            <input type="checkbox" id="option_bagage" name="options"value="Bagage inclus">
                            Bagage inclus
                        </label>
                        <label>
                            <input type="checkbox" id="option_annulation" name="options" value="Annulation gratuite">
                            Annulation gratuite
                        </label>
                        <label>
                            <input type="checkbox" id="option_animaux" name="options" value="Animaux autorisés">
                            Animaux autorisés
                        </label>
                        <label>
                            <input type="checkbox" id="option_enfants" name="options" value="Voyager avec des enfants">
                            Voyager avec des enfants
                        </label>
                        <label>
                            <input type="checkbox" id="option_vue_mer" name="options" value="Vue sur la mer">
                            Vue sur la mer
                        </label>
                </details>
            </div>
            <button type="button" id="submit">Rechercher</button>
        </div>
        <div id="voyages" class="voyages">

        </div>
    </div>
    <footer>
        <p>&copy; 2025 CY Portugal</p>
        <a href="profil.php">Compte</a>
        <a href="admin.php">Administration</a>
        <p>Contact : CY Tech</p>
    </footer>
    <script src="javascript/recherche.js"></script>
</body>
</html>