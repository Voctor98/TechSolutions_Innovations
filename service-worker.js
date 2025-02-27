const CACHE_NAME = "techsolutions-cache-v1";
const urlsToCache = [
    "./",
    "./index.php",
    "./services.php",
    "./products.php",
    "./about.php",
    "./contact.php",
    "./faq.php",
    "./sitemap.html",
    "./style.css",
    "./images/favicon.png",
];

// Instalar el Service Worker y agregar archivos al caché
self.addEventListener("install", (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log("Archivos en caché agregados");
            return Promise.all(
                urlsToCache.map((url) => {
                    return cache.add(url).catch((error) => {
                        console.error("Failed to cache", url, error);
                    });
                })
            );
        })
    );
});

// Activar el Service Worker y limpiar cachés antiguos
self.addEventListener("activate", (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cache) => {
                    if (cache !== CACHE_NAME) {
                        console.log("Eliminando caché antiguo:", cache);
                        return caches.delete(cache);
                    }
                })
            );
        })
    );
});

// Interceptar las solicitudes y servir desde el caché si es posible
self.addEventListener("fetch", (event) => {
    event.respondWith(
        caches.match(event.request).then((response) => {
            return (
                response ||
                fetch(event.request).catch(() => {
                    // Si la solicitud falla (offline), cargar index.php como fallback
                    return caches.match("./index.php");
                })
            );
        })
    );
});

// Escuchar el evento 'push' para notificaciones
self.addEventListener('push', (event) => {
    let title = 'Nueva Notificación';
    let options = {
        body: event.data ? event.data.text() : 'Esta es una notificación push.',
        icon: 'images/favicon.png',
        badge: 'images/badge.png'
    };

    event.waitUntil(self.registration.showNotification(title, options));
});