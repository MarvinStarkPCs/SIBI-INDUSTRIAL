
    document.addEventListener("DOMContentLoaded", function() {
    let alertBoxes = document.querySelectorAll('.alert');

    alertBoxes.forEach(function(alertBox) {
    let progressBar = alertBox.querySelector('.progress-bar');

    if (alertBox && progressBar) {
    // Mostrar el mensaje con la clase 'show'
    alertBox.classList.add('show');

    // Animar la barra de progreso
    progressBar.style.width = '0%';

    // Ocultar el mensaje después de 5 segundos (5000ms)
    setTimeout(function() {
    alertBox.classList.remove('show');
    alertBox.classList.add('hide');
}, 5000);
}
});
});



