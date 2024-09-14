function toggleLoader(show) {
    const loaderOverlay = document.getElementById('loader-overlay');

    if (show) {
        loaderOverlay.style.display = 'flex'; // Mostrar el loader
    } else {
        loaderOverlay.style.display = 'none'; // Ocultar el loader
    }
}

// Ejemplo de uso:
// Mostrar el loader
// toggleLoader(true);

// Ocultar el loader
toggleLoader(false);
