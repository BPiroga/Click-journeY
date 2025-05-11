document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("profil-form");
    const submitBtn = document.getElementById("submit-btn");

    if (!form) {
        console.error("Le formulaire de profil est introuvable.");
        return;
    }

    form.querySelectorAll("div").forEach((fieldContainer) => {
        const input = fieldContainer.querySelector("input");
        const editBtn = fieldContainer.querySelector(".edit-btn");
        const cancelBtn = fieldContainer.querySelector(".cancel-btn");
        const saveBtn = fieldContainer.querySelector(".save-btn");

        if (!input || !editBtn || !cancelBtn || !saveBtn) {
            console.error("Un ou plusieurs éléments nécessaires sont introuvables dans un champ.");
            return;
        }

        let originalValue = input.value;

        // Empêche la soumission avec la touche Entrée dans un champ input
        input.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();
                saveBtn.click(); // Simule un clic sur le bouton "Valider"
            }
        });

        // Activer l'édition
        editBtn.addEventListener("click", () => {
            input.disabled = false;
            input.focus();
            editBtn.style.display = "none";
            cancelBtn.style.display = "inline-block";
            saveBtn.style.display = "inline-block";
        });

        // Annuler l'édition
        cancelBtn.addEventListener("click", () => {
            input.value = originalValue; // Restaurer la valeur initiale
            input.disabled = true;
            editBtn.style.display = "inline-block";
            cancelBtn.style.display = "none";
            saveBtn.style.display = "none";
        });

        // Valider l'édition
        saveBtn.addEventListener("click", () => {
            originalValue = input.value; // Mettre à jour la valeur initiale
            input.disabled = true;
            editBtn.style.display = "inline-block";
            cancelBtn.style.display = "none";
            saveBtn.style.display = "none";
            submitBtn.style.display = "block"; // Afficher le bouton "Soumettre"
        });

        // Forcer la première lettre en majuscule à chaque saisie
        input.addEventListener("input", () => {
            input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1);
        });
    });

    // Avant soumission, activer tous les champs pour qu'ils soient envoyés
    form.addEventListener("submit", () => {
        form.querySelectorAll("input").forEach((input) => {
            input.disabled = false;
        });
    });
});
