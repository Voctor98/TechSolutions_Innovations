const openDatabase = () => {
  if (typeof window !== "undefined" && window.indexedDB) {  // Verifica que estamos en el navegador
    return new Promise((resolve, reject) => {
      const request = indexedDB.open('techsolutionsDB', 1);

      request.onupgradeneeded = (event) => {
        const db = event.target.result;
        if (!db.objectStoreNames.contains('products')) {
          db.createObjectStore('products', { keyPath: 'id' });
        }
      };

      request.onsuccess = (event) => {
        resolve(event.target.result);
      };

      request.onerror = (event) => {
        reject(event.target.error);
      };
    });
  } else {
    console.error("indexedDB no está disponible en este entorno");
    return Promise.reject("indexedDB no está disponible");
  }
};

const saveProductsToDB = (products) => {
  openDatabase().then((db) => {
    const transaction = db.transaction('products', 'readwrite');
    const store = transaction.objectStore('products');

    products.forEach(product => {
      store.put(product);
    });

    transaction.oncomplete = () => {
      console.log('Productos guardados correctamente en IndexedDB');
    };

    transaction.onerror = (event) => {
      console.error('Error al guardar productos en IndexedDB:', event.target.error);
    };
  });
};

const getAllProductsFromDB = () => {
  if (typeof window !== "undefined" && window.indexedDB) {  // Verifica que estamos en el navegador
    return new Promise((resolve, reject) => {
      openDatabase().then((db) => {
        const transaction = db.transaction('products', 'readonly');
        const store = transaction.objectStore('products');
        const request = store.getAll();

        request.onsuccess = () => {
          resolve(request.result);
        };

        request.onerror = (event) => {
          reject(event.target.error);
        };
      });
    });
  } else {
    return Promise.reject("indexedDB no está disponible");
  }
};

// Exporta las funciones
export { saveProductsToDB, getAllProductsFromDB };
