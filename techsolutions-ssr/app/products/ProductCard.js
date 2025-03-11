// app/products/ProductCard.js
export default function ProductCard({ article }) {
  return (
    <div style={{ border: "1px solid #ddd", padding: "10px", width: "250px" }}>
      <img 
        src={`http://localhost/techsolutions/images/${article.image}`} 
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
  );
}
