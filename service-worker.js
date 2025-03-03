const CACHE_NAME = "techsolutions-cache-v1";
const urlsToCache = [
  "./",
  "./index.php",
  "./services.php",
  "./products.php",
  "./index.php",
  "./about.php",
  "./contact.php",
  "./sitemap.html",
  "./styles.css",
  "./script.js",
  "./images/favicon.png",
  "./images/icon-192x192.png",
  "./images/icon-512x512.png"
];

// Instalar el Service Worker y agregar archivos al cache
self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log("Archivos en cache agregados");
      return cache.addAll(urlsToCache);
    })
  );
});

// Activar el Service Worker y limpiar caches antiguos
self.addEventListener("activate", (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cache) => {
          if (cache !== CACHE_NAME) {
            console.log("Eliminando cache antiguo:", cache);
            return caches.delete(cache);
          }
        })
      );
    })
  );
});

// Interceptar las solicitudes y servir desde el cache si es posible
self.addEventListener("fetch", (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request);
    })
  );
});
