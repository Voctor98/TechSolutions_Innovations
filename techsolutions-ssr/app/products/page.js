export default async function ProductsPage() {
    try {
        // Realizamos la llamada a la API
        const res = await fetch("http://localhost/TechSolutions _Innovations/api/getProducts.php", { cache: "no-store" });

        if (!res.ok) {
            // Si la respuesta no es correcta, lanzamos un error
            throw new Error(`HTTP error! Status: ${res.status}`);
        }

        // Convertimos la respuesta a JSON
        const articles = await res.json();

        return (
            <div>
                <h1>Lista de Artículos</h1>
                <div style={{ display: "flex", flexWrap: "wrap", gap: "20px" }}>
                    {articles.length > 0 ? (
                        // Si hay artículos, los mapeamos para mostrar las tarjetas
                        articles.map((article) => (
                            <div key={article.id} style={{ border: "1px solid #ddd", padding: "10px", width: "250px" }}>
                                <img 
                                    src={`http://localhost/TechSolutions _Innovations/images/${article.image}`}  // Verifica la ruta correcta de las imágenes
                                    alt={article.name} 
                                    width="100%" 
                                    style={{ maxHeight: "150px", objectFit: "cover" }} 
                                />
                                <h3>{article.name}</h3>
                                <p><strong>Categoría:</strong> {article.category}</p>
                                <p><strong>Marca:</strong> {article.brand}</p>
                                <p><strong>Precio:</strong> ${article.price}</p>
                                <p>{article.description}</p>
                            </div>
                        ))
                    ) : (
                        <p>No hay productos disponibles.</p> // Mensaje si no hay productos
                    )}
                </div>
            </div>
        );
    } catch (error) {
        console.error("Error al obtener datos:", error);
        return <div>Error al cargar los productos.</div>;
    }
}
