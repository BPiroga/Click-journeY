document.addEventListener("DOMContentLoaded", function () {
    const submit_boutton = document.getElementById("submit");
    const select_date = document.getElementById("date");
    const select_ville = document.getElementById("ville");
    const select_type = document.getElementById("type");
    const select_prix = document.getElementById("prix_max");
    const select_duree = document.getElementById("duree_min");
    const resultats_voyages = document.getElementById("voyages");

    afficher_all_voyages();

    submit_boutton.addEventListener("click", () => {
        console.log("clic");
        const date_choisie = select_date.value; 
        const ville_choisie = select_ville.value;
        const type_choisie = select_type.value; 
        const prix_choisie = select_prix.value;
        const duree_choisie = select_duree.value;
        const selectedOptions = Array.from(document.querySelectorAll('input[name="options"]:checked')).map(cb => cb.value);

        fetch("data/offres.json")
            .then(response => response.json())
            .then(data => {
                const resultats = data.filter(offre =>
                //(date_choisie === "" || offre.date.toLowerCase() === date_choisie.toLowerCase())&&
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