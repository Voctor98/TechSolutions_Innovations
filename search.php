<?php
session_start();
include 'techsolutions.php';

$search_query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';

$sql_articles = "SELECT 'articles' AS section, name AS title, description AS content FROM articles WHERE name LIKE '%$search_query%' OR description LIKE '%$search_query%'";
$sql_testimonials = "SELECT 'testimonials' AS section, name AS title, content FROM testimonials WHERE name LIKE '%$search_query%' OR content LIKE '%$search_query%'";
$sql_news = "SELECT 'news' AS section, title, content FROM news WHERE title LIKE '%$search_query%' OR content LIKE '%$search_query%'";
$sql_services = "SELECT 'services' AS section, name AS title, description AS content FROM services WHERE name LIKE '%$search_query%' OR description LIKE '%$search_query%'";
$sql_about = "SELECT 'about' AS section, title, content FROM about WHERE title LIKE '%$search_query%' OR content LIKE '%$search_query%'";

$sql = "$sql_articles UNION ALL $sql_testimonials UNION ALL $sql_news UNION ALL $sql_services UNION ALL $sql_about";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Búsqueda - TechSolutions Innovations</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
            color: #333; /* Color oscuro para el texto */
        }
        .background-image {
            background-image: url('images/jean-philippe-delberghe-75xPHEQBmvA-unsplash.jpg'); /* Ruta de la imagen de fondo */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.9; /* Ajusta la opacidad si es necesario */
        }
        .content {
            position: relative;
            z-index: 1;
            padding: 20px;
        }
        .search-results {
            margin-top: 20px;
        }
        .highlight {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <!-- Menú de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">TechSolutions Innovations</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="services.php">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contacto</a>
                </li>
                <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Iniciar Sesión</a>
                    </li>
                <?php endif; ?>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="search.php" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" name="query" value="<?php echo htmlspecialchars($search_query); ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </nav>
    <!-- Fin del Menú de Navegación -->

    <div class="background-image"></div>
    <div class="container content">
        <h1 class="text-center">Resultados de Búsqueda</h1>
        <div class="search-results">
            <?php
            if ($result->num_rows > 0) {
                echo "<ul class='list-group'>";
                while ($row = $result->fetch_assoc()) {
                    $title = htmlspecialchars($row['title']);
                    $content = htmlspecialchars($row['content']);
                    $highlighted_title = str_ireplace($search_query, "<span class='highlight'>$search_query</span>", $title);
                    $highlighted_content = str_ireplace($search_query, "<span class='highlight'>$search_query</span>", $content);

                    echo "<li class='list-group-item'>";
                    echo "<h5>$highlighted_title</h5>";
                    echo "<p>$highlighted_content</p>";
                    echo "<small>Sección: " . htmlspecialchars($row['section']) . "</small>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p class='text-center'>No se encontraron resultados para: <strong>" . htmlspecialchars($search_query) . "</strong></p>";
            }
            $conn->close();
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            window.history.back();
        }
    });
    </script>
</body>
</html>
