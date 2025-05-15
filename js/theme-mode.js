// Gestion du mode clair/sombre avec cookie (adapté pour les pages dans /offres/)

document.addEventListener('DOMContentLoaded', () => {
    const mode = getCookie('mode') || 'light'; // Par défaut, mode clair
    setMode(mode);

    const toggleBtn = document.getElementById('toggle-mode');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            const currentMode = document.body.dataset.mode;
            const newMode = currentMode === 'dark' ? 'light' : 'dark';
            setMode(newMode);
            setCookie('mode', newMode, 30);
        });
    }
});

function setMode(mode) {
    document.body.dataset.mode = mode;
    const stylesheet = document.getElementById('theme-stylesheet');
    const logoImage = document.getElementById('logo-image');
    const modeIcon = document.getElementById('mode-icon');

    // Détection automatique du chemin relatif
    const isOffrePage = window.location.pathname.includes('/offres/');
    const styleLight = isOffrePage ? '../style.css' : 'style.css';
    const styleDark = isOffrePage ? '../style-dark.css' : 'style-dark.css';
    const logoLight = isOffrePage ? '../src/Logo.png' : 'src/Logo.png';
    const logoDark = isOffrePage ? '../src/Logo-dark.png' : 'src/Logo-dark.png';
    const sunIcon = isOffrePage ? '../src/sun.png' : 'src/sun.png';
    const moonIcon = isOffrePage ? '../src/moon.png' : 'src/moon.png';

    if (stylesheet) stylesheet.href = mode === 'dark' ? styleDark : styleLight;
    if (logoImage) logoImage.src = mode === 'dark' ? logoDark : logoLight;
    if (modeIcon) {
        modeIcon.src = mode === 'dark' ? moonIcon : sunIcon;
        modeIcon.alt = mode === 'dark' ? 'Mode sombre' : 'Mode clair';
    }
}

function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = `${name}=${value};expires=${date.toUTCString()};path=/`;
}

function getCookie(name) {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if (cookie.startsWith(name + '=')) {
            return cookie.substring(name.length + 1);
        }
    }
    return null;
}