const CACHE_NAME = "techsolutions-cache-v1";
const urlsToCache = [
  "./",
  "./index.php",
  "./styles.css",
  "./script.js",
  "./images/favicon.png",
  "./images/icon-192x192.png",
  "./images/icon-512x512.png"
];

// Instalar el Service Worker y agregar archivos al caché
self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log("Archivos en caché agregados");
      return cache.addAll(urlsToCache);
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
