const CACHE_NAME = "techsolutions-cache-v1";
const urlsToCache = [
  "./",
  "./index.php",
  "./services.php",
  "./products.php",
  "./about.php",
  "./contact.php",
  "./sitemap.html",
  "./styles.css",
  "./script.js",
  "./images/favicon.png",
  "./images/icon-192x192.png",
  "./images/icon-512x512.png"
];

// Nombre de la base de datos IndexedDB
const DB_NAME = "TechSolutionsDB";
const DB_VERSION = 1;
const STORE_NAME = "offlineData";

// Abrir la base de datos IndexedDB
function openDB() {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open(DB_NAME, DB_VERSION);

    request.onupgradeneeded = (event) => {
      const db = event.target.result;
      if (!db.objectStoreNames.contains(STORE_NAME)) {
        db.createObjectStore(STORE_NAME, { keyPath: "id", autoIncrement: true });
      }
    };

    request.onsuccess = (event) => {
      resolve(event.target.result);
    };

    request.onerror = (event) => {
      reject("Error al abrir la base de datos: " + event.target.error);
    };
  });
}

// Guardar datos en IndexedDB
async function saveOfflineData(data) {
  const db = await openDB();
  const transaction = db.transaction(STORE_NAME, "readwrite");
  const store = transaction.objectStore(STORE_NAME);
  store.add(data);
}

// Sincronizar datos almacenados localmente con el servidor
async function syncOfflineData() {
  const db = await openDB();
  const transaction = db.transaction(STORE_NAME, "readonly");
  const store = transaction.objectStore(STORE_NAME);
  const request = store.getAll();

  request.onsuccess = async () => {
    const data = request.result;
    if (data.length > 0) {
      try {
        // Enviar datos al servidor
        await fetch('/api/sync', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(data)
        });

        // Limpiar la base de datos después de sincronizar
        const clearTransaction = db.transaction(STORE_NAME, "readwrite");
        clearTransaction.objectStore(STORE_NAME).clear();
      } catch (err) {
        console.error("Error al sincronizar datos:", err);
      }
    }
  };
}

// Instalar el Service Worker y agregar archivos al caché
self.addEventListener("install", (event) => {
  console.log("Instalando Service Worker...");
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log("Archivos en caché agregados:", urlsToCache);
      return cache.addAll(urlsToCache);
    }).catch((error) => console.error("Error al agregar al caché:", error))
  );
});

// Activar el Service Worker y limpiar cachés antiguos
self.addEventListener("activate", (event) => {
  console.log("Service Worker activado.");
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

// Interceptar solicitudes y servir desde el caché si es posible
self.addEventListener("fetch", (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request).catch(() => {
        // Fallback en caso de que falle la conexión
        return caches.match("./index.php");
      });
    })
  );
});

// Sincronización en segundo plano cuando la conexión esté disponible
self.addEventListener('sync', (event) => {
  if (event.tag === 'sync-offline-data') {
    event.waitUntil(syncOfflineData());
  }
});
