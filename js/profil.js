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
        const passwordError = fieldContainer.querySelector("#password-error");

        if (!input || !editBtn || !cancelBtn || !saveBtn) {
            console.error("Un ou plusieurs éléments nécessaires sont introuvables dans un champ.");
            return;
        }

        let originalValue = input.value;

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

            if (passwordError) {
                passwordError.style.display = "none";
            }
        });

        // Valider l'édition
        saveBtn.addEventListener("click", () => {
            if (input.name === "mot_de_passe" && input.value.length > 0 && input.value.length < 6) {
                if (passwordError) {
                    passwordError.style.display = "block";
                }
                return;
            }

            originalValue = input.value; // Mettre à jour la valeur initiale
            input.disabled = true;
            editBtn.style.display = "inline-block";
            cancelBtn.style.display = "none";
            saveBtn.style.display = "none";

            if (passwordError) {
                passwordError.style.display = "none";
            }

            submitBtn.style.display = "block"; // Afficher le bouton "Soumettre"
        });
    });

    // Avant soumission, activer tous les champs pour qu'ils soient envoyés
    form.addEventListener("submit", () => {
        form.querySelectorAll("input").forEach((input) => {
            input.disabled = false;
        });
    });
});