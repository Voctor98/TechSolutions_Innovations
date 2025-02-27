/* app.js */
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("content").innerHTML = "<h2>Bienvenido a TechSolutions</h2>";
});

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
        .then((registration) => {
            console.log('Service Worker registrado con éxito:', registration);
        })
        .catch((error) => {
            console.log('Error al registrar el Service Worker:', error);
        });
}