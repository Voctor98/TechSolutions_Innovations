-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-08-2024 a las 04:33:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `techsolutions`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `about`
--

INSERT INTO `about` (`id`, `title`, `content`, `image`) VALUES
(1, 'About Us', 'TechSolutions Innovations is dedicated to providing the best technology products.', 'about_us.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`id`, `name`, `description`, `price`, `category`, `brand`, `image`) VALUES
(1, 'Laptop HP Spectre x360 14-inch', 'Equipada con procesadores Intel de última generación, hasta 16 GB de RAM y almacenamiento SSD rápido, garantiza un funcionamiento fluido y eficiente.', 999.99, 'Laptops', 'HP', 'laptop_hp.jpg'),
(2, 'Samsung Galaxy S21', 'Cuenta con una pantalla Dynamic AMOLED 2X de 6.2 pulgadas con resolución Full HD+. Equipado con el procesador Exynos 2100 y hasta 8 GB de RAM, garantiza un rendimiento fluido y rápido.', 799.99, 'Smartphones', 'Samsung', 'samsung_galaxy_s21.jpg'),
(3, 'Galaxy S24', 'Equipado con una pantalla Dynamic AMOLED 2X de 6.2 pulgadas, ofrece una resolución impresionante y una tasa de refresco de 120Hz para una visualización fluida y vibrante.', 14000.00, 'Smartphones', 'SAMSUNG', 'mx-galaxy-s24-sm-s921bzvlltm-thumb-539298737.jpg'),
(4, 'Teclado Logitech G PRO X', 'El Logitech G PRO X es un teclado mecánico compacto diseñado para gamers y profesionales que buscan rendimiento y personalización. Equipado con interruptores mecánicos GX, ofrece una respuesta táctil precisa excepcional.', 1200.00, 'Accessories', 'LOGITECH', 'logitech_gpro.jpg'),
(5, 'Audífonos Sony WH-1000XM4', 'Los audífonos Sony WH-1000XM4 son unos auriculares inalámbricos de alta gama diseñados para ofrecer la mejor experiencia de sonido con cancelación de ruido activa.', 2500.00, 'Accessories', 'SONY', 'sony_wh1000xm4.jpg'),
(6, ' Monitor Dell UltraSharp U2718Q', 'Este monitor cuenta con tecnología HDR (High Dynamic Range) que proporciona una mayor profundidad de color y contraste, haciendo que las imágenes cobren vida con una precisión de color del 99% sRGB. ', 3600.00, 'Accessories', 'DELL', 'dell_ultrasharp.jpg'),
(7, 'Galaxy S24 Ultra', 'stá equipado con una pantalla Dynamic AMOLED 2X de 6.8 pulgadas con resolución QHD+ y una tasa de refresco de 120Hz. En su interior, cuenta con un potente procesador Exynos 2200, acompañado de hasta 16 GB de RAM y opciones de almacenamiento que van desde 256 GB hasta 1 TB.', 29000.00, 'Smartphones', 'SAMSUNG', 's24ultra.avif'),
(8, 'Mouse Logitech G203 ', 'El Logitech G203 es un ratón para gaming diseñado para ofrecer un rendimiento óptimo y una gran precisión. Cuenta con un sensor óptico de alta precisión con una resolución de hasta 8000 DPI, permitiendo un seguimiento preciso y un control suave durante el juego.', 299.00, 'Accessories', 'LOGITECH', 'logitech203.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Laptops'),
(2, 'Smartphones'),
(3, 'Tablets'),
(4, 'Accessories');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `date`) VALUES
(1, '\"¡Samsung Galaxy S24 Ultra ha llegado!\"', '\"Samsung ha lanzado su esperado Galaxy S24 Ultra, con una cámara de 200MP, una batería de larga duración y un diseño elegante. Descubre todas las innovaciones que trae este nuevo modelo.\"', '2024-03-10 00:00:00'),
(2, '\"Apple Revoluciona el Mercado con el iPhone 15 Pro\"', '\"El nuevo iPhone 15 Pro de Apple está aquí, equipado con la última tecnología A16 Bionic, una pantalla ProMotion de 120Hz y mejoras significativas en la cámara. ¡No te pierdas todos los detalles!\"', '2024-03-10 00:00:00'),
(3, '\"Google Pixel 7: Innovación y Tecnología a tu Alcance\"', '\"Google ha presentado el Pixel 7, un smartphone con la mejor experiencia de Android, una cámara impresionante y un rendimiento excepcional gracias a su procesador Tensor G2.\"', '2024-03-10 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `brand`, `image`) VALUES
(1, 'Laptop HP', 'A high performance laptop', 999.99, 'Laptops', 'HP', 'laptop_hp.jpg'),
(2, 'Samsung Galaxy S21', 'Latest Samsung smartphone', 799.99, 'Smartphones', 'Samsung', 'samsung_galaxy_s21.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `testimonials`
--

INSERT INTO `testimonials` (`id`, `content`, `name`, `date`) VALUES
(1, '\"TechSolutions Innovations ha revolucionado la forma en que vemos la tecnología. Sus productos no solo son innovadores, sino también increíblemente funcionales y fáciles de usar.\"', 'JAVI', '2024-01-15 00:00:00'),
(2, '\"Como analista de tecnología, he visto muchas empresas fallar en sus promesas. TechSolutions Innovations es una excepción, siempre cumplen y superan las expectativas.\"', 'Eduardo Palacio', '2024-02-20 00:00:00'),
(3, '\"La atención al detalle y la calidad de los productos de TechSolutions Innovations es insuperable. Recomiendo encarecidamente sus soluciones tecnológicas.\"', 'Sebastián Velasco', '2024-02-20 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `is_locked` tinyint(1) DEFAULT 0,
  `lock_time` datetime DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `failed_attempts`, `is_locked`, `lock_time`, `reset_token`, `reset_token_expiry`) VALUES
(1, 'admin', '$2y$10$0U7bMQhcViEU.6BqvVm7NOqEJrzIazfbWLQsFTZFWawHud8DoS1VG', 'victormendozapalacio@gmail.com', 'admin', 0, 0, NULL, NULL, NULL),
(3, 'victor', '$2y$10$3NGGY1/PZk8EQ//DMHCCt.RmMXa/GxjjmzL0Hqu/1LVnFiAn2WdOy', 'victorleemendoza@gmail.com', 'admin', 0, 0, NULL, '', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
