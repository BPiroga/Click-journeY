document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const passwordInput = form.querySelector("input[name='code']");
    const confirmPasswordInput = form.querySelector("input[name='confirm_code']");
    const togglePassword = form.querySelector(".toggle-password");
    const passwordCounter = form.querySelector(".password-counter");

    form.addEventListener("submit", (e) => {
        let isValid = true;
        clearErrors();

        // Vérification du mot de passe
        if (passwordInput.value.length < 6) {
            showError(passwordInput, "Mot de passe trop court (min. 6 caractères).");
            isValid = false;
        }

        // Vérification de la confirmation du mot de passe
        if (passwordInput.value !== confirmPasswordInput.value) {
            showError(confirmPasswordInput, "Les mots de passe ne correspondent pas.");
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
        confirmPasswordInput.setAttribute("type", type);
        togglePassword.textContent = type === "password" ? "👁️" : "🙈";
    });

    // Compteur de caractères pour le mot de passe
    passwordInput.addEventListener("input", () => {
        passwordCounter.textContent = `${passwordInput.value.length}/20`;
    });

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
