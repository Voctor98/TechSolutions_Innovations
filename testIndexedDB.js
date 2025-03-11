const DB_NAME = "TechSolutionsDB";
const DB_VERSION = 1;
const STORE_NAME = "productos";

let db;

// 📌 Abrir la base de datos correctamente
const openDatabase = async () => {
    return new Promise((resolve, reject) => {
        const request = indexedDB.open(DB_NAME, DB_VERSION);

        request.onupgradeneeded = (event) => {
            const db = event.target.result;
            if (!db.objectStoreNames.contains(STORE_NAME)) {
                const store = db.createObjectStore(STORE_NAME, { keyPath: "id", autoIncrement: true });
                store.createIndex("name", "name", { unique: false });
                store.createIndex("price", "price", { unique: false });
            }
        };

        request.onsuccess = (event) => {
            db = event.target.result; // ✅ Ahora asigna correctamente la base de datos
            console.log("📌 Base de datos abierta con éxito.");
            resolve(db);
        };

        request.onerror = (event) => reject(`❌ Error al abrir la base de datos: ${event.target.error}`);
    });
};

// 📌 Asegurar que `db` esté lista antes de cualquier operación
const getTransaction = async (mode) => {
    if (!db) await openDatabase(); // ✅ Esperar a que `db` esté asignada
    return db.transaction(STORE_NAME, mode).objectStore(STORE_NAME);
};

// 📌 Agregar un producto
const addProduct = async (product) => {
    try {
        const store = await getTransaction("readwrite");
        const request = store.add(product);
        request.onsuccess = () => {
            console.log(`✅ Producto agregado: ${JSON.stringify(product)}`);
            getProducts(); // ✅ Actualizar la lista de productos
        };
    } catch (error) {
        console.error("❌ Error al agregar producto:", error);
    }
};

// 📌 Obtener productos
const getProducts = async () => {
    try {
        const store = await getTransaction("readonly");
        const request = store.getAll();
        request.onsuccess = (event) => {
            displayProducts(event.target.result);
        };
    } catch (error) {
        console.error("❌ Error al obtener productos:", error);
    }
};

// 📌 Eliminar producto
const deleteProduct = async (id) => {
    try {
        const store = await getTransaction("readwrite");
        const request = store.delete(id);
        request.onsuccess = () => {
            console.log(`🗑️ Producto eliminado: ID ${id}`);
            getProducts(); // ✅ Refrescar la lista
        };
    } catch (error) {
        console.error("❌ Error al eliminar producto:", error);
    }
};

// 📌 Mostrar productos en la interfaz
const displayProducts = (products) => {
    const productList = document.getElementById("productList");
    productList.innerHTML = "";

    products.forEach((product) => {
        const li = document.createElement("li");
        li.innerHTML = `
            <img src="${product.imageUrl}" alt="${product.name}" width="100">
            <h3>${product.name}</h3>
            <p>${product.description}</p>
            <p><strong>$${product.price}</strong></p>
            <button onclick="deleteProduct(${product.id})">🗑️ Eliminar</button>
        `;
        productList.appendChild(li);
    });
};

// 📌 Manejar el formulario para agregar productos
document.getElementById("productForm").addEventListener("submit", async (event) => {
    event.preventDefault();

    const name = document.getElementById("name").value.trim();
    const price = parseFloat(document.getElementById("price").value);
    const description = document.getElementById("description").value.trim();
    const imageUrl = document.getElementById("imageUrl").value.trim();

    if (!name || !price || !description || !imageUrl) {
        alert("⚠️ Todos los campos son obligatorios.");
        return;
    }

    const product = { name, price, description, imageUrl };
    await addProduct(product);
    event.target.reset();
});

// 📌 Inicializar la base de datos y cargar productos al inicio
(async () => {
    await openDatabase();
    getProducts();
})();
