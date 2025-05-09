document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const emailInput = form.querySelector("input[name='email']");
    const passwordInput = form.querySelector("input[name='code']");
    const togglePassword = form.querySelector(".toggle-password");
    const passwordCounter = form.querySelector(".password-counter");

    form.addEventListener("submit", (e) => {
        let isValid = true;
        clearErrors();

        // Vérification de l'email
        if (!validateEmail(emailInput.value)) {
            showError(emailInput, "Adresse email invalide.");
            isValid = false;
        }

        // Vérification du mot de passe
        if (passwordInput.value.length < 6) {
            
            showError(passwordInput, "Mot de passe trop court (min. 6 caractères).");
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault(); // Stop l'envoi du formulaire si erreur
        }
    });

    // Afficher/masquer le mot de passe
    togglePassword.addEventListener("click", () => {
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);
        togglePassword.textContent = type === "password" ? "👁️" : "🙈";
    });

    // Compteur de caractères pour le mot de passe
    passwordInput.addEventListener("input", () => {
        const maxLength = passwordInput.getAttribute("maxlength") || 20;
        const length = passwordInput.value.length;
    
        passwordCounter.textContent = `${length}/${maxLength}`;
    
        // Changer la couleur du compteur si le mot de passe est trop court
        if (length < 6) {
            passwordCounter.style.color = "red";
        } else {
            passwordCounter.style.color = "#666"; // couleur normale
        }
    });
    

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function showError(input, message) {
        const error = document.createElement("p");
        error.classList.add("form-error");
        error.style.color = "red";
        error.textContent = message;
        input.parentElement.appendChild(error);
    }

    function clearErrors() {
        document.querySelectorAll(".form-error").forEach(e => e.remove());
    }
});
