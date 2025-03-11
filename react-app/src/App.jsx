import { useState, useEffect } from "react";

function App() {
  const [data, setData] = useState([]);

  useEffect(() => {
    fetch("https://jsonplaceholder.typicode.com/users") // API de prueba
      .then((response) => response.json())
      .then((json) => setData(json))
      .catch((error) => console.error("Error al obtener datos:", error));
  }, []);

  return (
    <div>
      <h2>Usuarios (CSR)</h2>
      <ul>
        {data.map((user) => (
          <li key={user.id}>{user.name} - {user.email}</li>
        ))}
      </ul>
    </div>
  );
}

export default App;
