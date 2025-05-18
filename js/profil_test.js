document.addEventListener("DOMContentLoaded", () => {

    // togglePassword.addEventListener("click", () => {
    //     const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    //     passwordInput.setAttribute("type", type);
    //     togglePassword.textContent = type === "password" ? "👁️" : "🙈";
    // });
    const form = document.getElementById("profil-form");
    const submitBtn = document.getElementById("submit-btn");

    form.querySelectorAll("div").forEach((fieldContainer) => {
        const input = fieldContainer.querySelector("input");               // Le champ texte
        const editBtn = fieldContainer.querySelector(".edit-btn");         // Bouton "Modifier"
        const cancelBtn = fieldContainer.querySelector(".cancel-btn");     // Bouton "Annuler"
        const saveBtn = fieldContainer.querySelector(".save-btn");         // Bouton "Valider"
        
        input.dataset.originalValue = input.value;

        editBtn.addEventListener("click", () => {
            input.disabled = false;               // On rend le champ éditable
            input.focus();                        // Focus direct sur le champ pour écrire
            editBtn.style.display = "none";       // On cache le bouton "Modifier"
            cancelBtn.style.display = "inline-block"; // On affiche "Annuler"
            saveBtn.style.display = "inline-block";   // On affiche "Valider"
        });
        
        cancelBtn.addEventListener("click", () => {
            input.value = input.dataset.originalValue; // On remet la valeur d'origine
            input.disabled = true;                    // On ré-désactive le champ
            editBtn.style.display = "inline-block";   // On ré-affiche "Modifier"
            cancelBtn.style.display = "none";         // On cache "Annuler"
            saveBtn.style.display = "none";           // On cache "Valider"
        });

        saveBtn.addEventListener("click", () => {
            input.dataset.originalValue = input.value; // On met à jour la valeur d'origine avec la nouvelle
            input.disabled = true;                     // On désactive à nouveau le champ
            editBtn.style.display = "inline-block";    // On ré-affiche "Modifier"
            cancelBtn.style.display = "none";          // On cache "Annuler"
            saveBtn.style.display = "none";            // On cache "Valider"
            submitBtn.style.display = "block";         // On affiche le bouton "Soumettre" pour enregistrer
        });
    });
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        form.querySelectorAll("input").forEach((input) => {
            input.disabled = false;
        });
        const formData = new FormData(form);
        fetch('php/update_profil_test.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Profil mis à jour !");
                
                form.querySelectorAll("input").forEach((input) => {
                    input.dataset.originalValue = input.value;
                    input.disabled = true; // On désactive à nouveau les champs
                });
                
                submitBtn.style.display = "none";
            }
            else {
                alert("Erreur : " + data.message);
                form.querySelectorAll("input").forEach((input) => {
                    input.value = input.dataset.originalValue;
                    input.disabled = true;
                });
            }
        })
        .catch(() => {
            alert("Erreur réseau");
            
            form.querySelectorAll("input").forEach((input) => {
                input.value = input.dataset.originalValue;
                input.disabled = true;
            });
        });
    });
});