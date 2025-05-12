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
    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        const submit_boutton = document.getElementById("submit");
        const select_ville = document.getElementById("ville");
        const select_type = document.getElementById("type");
        const select_prix = document.getElementById("prix_max");
        const select_duree = document.getElementById("duree_min");
        const resultats_voyages = document.getElementById("voyages");

        afficher_all_voyages();

        submit_boutton.addEventListener("click", () => {
            console.log("clic");

            const ville_choisie = select_ville.value;
            const type_choisie = select_type.value; 
            const prix_choisie = select_prix.value;
            const duree_choisie = select_duree.value;
            const selectedOptions = Array.from(document.querySelectorAll('input[name="options"]:checked')).map(cb => cb.value);

            fetch("data/offres.json")
                .then(response => response.json())
                .then(data => {
                    const resultats = data.filter(offre =>
                    (ville_choisie === "" || offre.ville.toLowerCase() === ville_choisie.toLowerCase())&&
                    (type_choisie === "" || offre.type.toLowerCase() === type_choisie.toLowerCase())&&
                    (prix_choisie === "" || offre.prix <= parseFloat(prix_choisie))&&
                    (duree_choisie === "" || offre.duree >= parseInt(duree_choisie))&&
                    (selectedOptions.length === 0 || selectedOptions.every(opt => offre.options.includes(opt)))
                    );
                    afficher_resultats_voyages(resultats);
                })
                .catch(error => console.error("Erreur lors du chargement des offres :", error));
        });


        function afficher_all_voyages() {
            fetch("data/offres.json")
                .then(response => response.json())
                .then(data => {
                    afficher_resultats_voyages(data);
                })
                .catch(error => console.error("Erreur lors du chargement des offres :", error));
        }
        

        function afficher_resultats_voyages(resultats) {
            resultats_voyages.innerHTML = ""; 
            if (resultats.length === 0) {
                resultats_voyages.innerHTML = "<h3>Aucune offre trouvée.</h3>";
                return;
            }

            resultats.forEach(offre => {
                const div = document.createElement("div");
                div.classList.add("voyage-card");
                div.innerHTML = `
                    <a href="offres/offre${offre.id}.php"> 
                        <img src="${offre.image}" alt="${offre.titre}">
                    </a>
                    <h3>${offre.titre}</h3>
                    <p>${offre.duree} jours - À partir de ${offre.prix}€</p>
                `;
                
                resultats_voyages.appendChild(div);
            });
        }
    });
    </script>
</body>
</html>