-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2019 a las 07:02:18
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sanfrancisco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `idTrabajador` int(11) NOT NULL,
  `idPub` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ads`
--

INSERT INTO `ads` (`id`, `idTrabajador`, `idPub`, `fecha`) VALUES
(1, 1, 1, '2018-11-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos`
--

CREATE TABLE `codigos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(18) COLLATE utf8_spanish_ci NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `activacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idRango` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `idUser_Creador` int(11) NOT NULL,
  `estado` enum('activo','disponible') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `codigos`
--

INSERT INTO `codigos` (`id`, `codigo`, `idUsuario`, `creacion`, `activacion`, `idRango`, `cantidad`, `idUser_Creador`, `estado`) VALUES
(1, 'AB15INVY85U6', 24, '2019-10-22 19:35:34', '2019-10-31 05:22:00', 5, 4, 0, 'activo'),
(2, '6FFI71EMYEDS', 1, '2019-10-23 19:00:53', '2019-10-29 01:05:09', 5, 4, 1, 'activo'),
(3, 'JFGV1NGHQSCT', 0, '2019-10-23 19:03:25', '2019-10-29 03:57:09', 4, 2, 1, 'disponible'),
(4, '86C8CG10VTU2', 2, '2019-10-23 19:03:25', '2019-10-29 04:00:08', 12, 1, 1, 'activo'),
(5, 'SA80E0DGH000', 0, '2019-10-23 19:03:26', '2019-10-27 18:44:00', 12, 1, 1, 'disponible'),
(6, '1VMG0M3R7DEU', 0, '2019-10-23 19:03:27', '2019-10-27 18:44:01', 13, 1, 1, 'disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formularios`
--

CREATE TABLE `formularios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(160) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(160) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` enum('activa','inactiva','urgente','revision','atendida') COLLATE utf8_spanish_ci NOT NULL,
  `subscripcion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `formularios`
--

INSERT INTO `formularios` (`id`, `nombre`, `correo`, `descripcion`, `tipo`, `fecha`, `estado`, `subscripcion`) VALUES
(1, 'Leonardo', 'lvazquez@tepatitlan.gob.mx', 'Leonardo Este es un mensaje', 'contacto', '2019-10-13 16:44:29', 'activa', 1),
(2, 'Leonardo', 'lvazquez@tepatitlan.gob.mx', 'Leonardo Este es un mensaje', 'contacto', '2019-10-13 16:47:55', 'activa', 0),
(3, 'Leonardo', 'lvazquez@tepatitlan.gob.mx', 'Me esta fallando el registro de los formularios para crear publicaciones', 'contacto', '2019-10-13 16:51:30', 'activa', 1),
(4, 'Leonardo', 'l@gmail.com', 'NO quiero nada\n', 'contacto', '2019-11-02 20:33:19', 'activa', 0),
(5, 'asd', 'asd@gmail.com', 'asd', 'contacto', '2019-11-02 20:35:18', 'activa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresias`
--

CREATE TABLE `membresias` (
  `id` int(1) NOT NULL,
  `idUser` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `cantPagos` int(11) NOT NULL,
  `cobro` int(11) NOT NULL,
  `tipoPago` enum('efectivo','targeta','codigo') COLLATE utf8_spanish_ci NOT NULL,
  `idcodigo` int(11) DEFAULT NULL,
  `idRango` int(11) NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `membresias`
--

INSERT INTO `membresias` (`id`, `idUser`, `fechaInicio`, `fechaFinal`, `cantPagos`, `cobro`, `tipoPago`, `idcodigo`, `idRango`, `fecha`) VALUES
(15, 26, '2019-10-27', '2019-11-27', 1, 179, 'codigo', 3, 4, '2019-10-27 19:17:26'),
(17, 1, '2018-10-28', '2020-02-28', 4, 996, 'codigo', 2, 5, '2019-10-30 02:28:34'),
(27, 2, '2019-10-28', '2020-10-28', 1, 149, 'codigo', 4, 12, '2019-10-29 04:00:08'),
(31, 24, '2019-10-30', '2020-03-01', 4, 996, 'codigo', 1, 5, '2019-10-31 05:22:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `titulo` varchar(45) NOT NULL,
  `imagen` varchar(60) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` enum('AC','IN','BAN') NOT NULL DEFAULT 'AC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id`, `iduser`, `fecha`, `titulo`, `imagen`, `descripcion`, `estado`) VALUES
(1, 26, '2019-11-06 05:24:30', 'Mi primera impresión para SnSanfrancisco', 'post_1569600088_00001.jpg', 'Snsanfrancisco estamos trabajando por ofrecerte un mejor servicio y una amplia visuvilidad de tu negocio. muchas gracias por estar con nosotros!, nosotros estaremos contigo', 'AC'),
(2, 1, '2019-09-27 21:14:19', 'Publicación para erik', 'post_1569600568_00001.jpg', 'Titulo de la publicación', 'AC'),
(3, 26, '2019-11-06 05:24:28', 'Publicacion para Leo', 'post_1569600739_00001.jpg', 'asdasdasd', 'AC'),
(4, 1, '2019-09-27 19:26:38', 'asdasdasdasdasdasd', 'post_1569612398_00001.jpg', 'asdd', 'AC'),
(5, 26, '2019-11-06 05:24:25', 'lorem', 'post_1569614294_00001.jpg', 'lorem22', 'AC'),
(6, 1, '2019-09-27 19:58:22', 'asdasd', 'post_1569614302_00001.jpg', 'asdasdasd', 'AC'),
(7, 26, '2019-11-06 05:24:33', 'mañana', 'post_1569614307_00001.jpg', 'asdasd', 'AC'),
(8, 26, '2019-11-06 05:24:22', 'asdasd', 'post_1569614313_00001.jpg', 'asdasdasd', 'AC'),
(9, 1, '2019-10-31 02:25:01', 'Como contratar un servicio de internet', 'post_1570156943_00001.jpg', 'Publicaciones y post para empresas', 'AC'),
(10, 1, '2019-10-04 03:10:15', 'qqwe', 'post_1570158615_00001.jpg', 'qweqwe', 'AC'),
(11, 1, '2019-10-19 00:22:15', 'Nuevo Stok para tu casa IDEAL', 'post_1571444535_00001.jpg', 'Lorem', 'AC'),
(12, 30, '2019-10-19 17:17:54', 'Hola que hace', 'post_1571505474_00030.jpg', 'Leonardo Primera', 'AC'),
(13, 44, '2019-11-06 05:17:12', 'Estilista', 'post_1572121334_00026.jpg', 'Lorem', 'AC'),
(14, 26, '2019-11-06 05:24:19', 'Construcción', 'post_1572321945_00002.jpg', 'Instalaciónes electricas! A la necesidad de tu hogar\r\n', 'AC'),
(15, 26, '2019-11-06 05:24:17', 'LOREM', 'post_1572499371_00024.jpg', 'Lorem ipsum dolor sit amet consectetur adipiscing elit mi, iaculis dictumst praesent augue turpis hendrerit metus, tincidunt vehicula venenatis ultricies sociosqu felis fringilla. Mollis velit id magnis conubia luctus metus est blandit morbi, pretium leo varius eu dapibus inceptos quisque vehicula, fringilla quam commodo praesent netus auctor tellus suscipit. At nostra parturient placerat nam curae himenaeos, curabitur massa aliquet fermentum malesuada enim, cum ad dis porta nisl.\r\nLorem ipsum dolor sit amet consectetur adipiscing elit mi, iaculis dictumst praesent augue turpis hendrerit metus, tincidunt vehicula venenatis ultricies sociosqu felis fringilla. Mollis velit id magnis conubia luctus metus est blandit morbi, pretium leo varius eu dapibus inceptos quisque vehicula, fringilla quam commodo praesent netus auctor tellus suscipit. At nostra parturient placerat nam curae himenaeos, curabitur massa aliquet fermentum malesuada enim, cum ad dis porta nisl.', 'AC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rango`
--

CREATE TABLE `rango` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `imagen` varchar(70) NOT NULL,
  `tag` varchar(5) NOT NULL,
  `icono` varchar(40) NOT NULL,
  `iconColor` varchar(80) NOT NULL,
  `bgColor` varchar(60) NOT NULL,
  `textColor` varchar(60) NOT NULL,
  `duracion` int(11) NOT NULL,
  `costo` float NOT NULL,
  `tipo` enum('Privado','Mensual','Anual','') NOT NULL DEFAULT 'Privado',
  `publicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rango`
--

INSERT INTO `rango` (`id`, `nombre`, `imagen`, `tag`, `icono`, `iconColor`, `bgColor`, `textColor`, `duracion`, `costo`, `tipo`, `publicacion`) VALUES
(1, 'Administrador', 'admin.svg', 'ADMIN', 'fas fa-users-cog', 'grey-text', 'elegant-color', 'white-text', 36, 0, 'Privado', 200),
(2, 'Gratis', 'privado.svg', 'PRIV', 'fas fa-user-friends', 'grey-text', 'stylish-color', 'white-text', 0, 0, 'Mensual', 1),
(3, 'Básico', 'premium.svg', 'BSC', 'fas fa-home', 'light-blue-text', 'default-color', 'white-text', 1, 125, 'Mensual', 2),
(4, 'Standart', 'standart.svg', 'STR', 'fas fa-cookie-bite', 'brown-text', 'primary-color', 'white-text', 1, 179, 'Mensual', 9),
(5, 'Premium', 'Basico.svg', 'PRM', 'fas fa-hand-holding-heart', 'pink-text', 'secondary-color', 'white-text', 1, 249, 'Mensual', 15),
(6, 'Gerrero', 'warr.svg', 'WAR', 'fab fa-galactic-senate', 'brown-text', 'brown darken-1', 'white-text', 12, 99, 'Anual', 19),
(12, 'Gladiador', 'gla.svg', 'GLA', 'fab fa-jedi-order', 'deep-orange-text', 'deep-orange darken-3', 'white-text', 12, 149, 'Anual', 24),
(13, 'Ninja', 'ninja.svg', 'NINJ', 'fab fa-old-republic', 'blue-grey-text', 'blue-grey', 'white-text', 12, 199, 'Anual', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `imagen` varchar(60) NOT NULL,
  `color` varchar(40) NOT NULL,
  `icono` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `imagen`, `color`, `icono`) VALUES
(1, 'Estilista', 'Cambia tu Look', 'Estilista.png', 'pink', 'fas fa-cut'),
(2, 'Desarrollador Web', 'Cambia tu entorno', 'Desarrollador_Web.png', 'light-blue', 'fas fa-code'),
(3, 'Construcción', 'Crea cosas impresionantes', 'Construcción.png', 'orange', 'fas fa-hard-hat'),
(4, 'Arquitectura', 'Diseña tu futuro', 'Arquitectura.png', 'stylish-color', 'fas fa-drafting-compass'),
(5, 'Herreria', 'Mayor resistencia', 'Herreria.png', 'unique-color-dark', 'fas fa-tools');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idServicio` int(11) NOT NULL,
  `fechaRegistro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `idUsuario`, `idServicio`, `fechaRegistro`) VALUES
(1, 1, 9, '2018-11-23'),
(2, 2, 8, '2018-11-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usersinfo`
--

CREATE TABLE `usersinfo` (
  `iduser` int(11) NOT NULL,
  `nombreServicio` varchar(80) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `correoServicio` varchar(60) NOT NULL,
  `imagenServicio` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `domicilio` text NOT NULL,
  `idServicio` int(11) NOT NULL,
  `CP` int(11) NOT NULL,
  `colonia` varchar(60) NOT NULL,
  `whatsapp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usersinfo`
--

INSERT INTO `usersinfo` (`iduser`, `nombreServicio`, `telefono`, `celular`, `correoServicio`, `imagenServicio`, `descripcion`, `domicilio`, `idServicio`, `CP`, `colonia`, `whatsapp`) VALUES
(1, 'Leonardo´s Desarrollo', '3919317322', '3313324053', 'webmaster@snsanfrancisco.com', 'profile11.png', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 'Las torres # 3', 2, 47755, 'San Francisco de Asís', 0),
(2, 'Vázquez Construcción', '3332526521', '6584987321', '', 'profile22.png', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.\r\n\r\n', 'Las torres # 3', 3, 47755, 'San Francisco de Asís', 0),
(24, 'asd', '123', '', 'asd@gmail.com', '', '', 'asd', 1, 47755, 'asdasd', 0),
(26, 'Estetica Kristy', '123', '456', 'estetica@snsanfrancisco.com', '', 'Ponchito 2', 'Las torres # 3', 1, 47755, 'San Francisco de Asís', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `password` text NOT NULL,
  `tipoUser` int(11) NOT NULL,
  `validar` int(11) NOT NULL,
  `encriptado` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modo` varchar(12) NOT NULL,
  `img` varchar(30) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellidos`, `correo`, `password`, `tipoUser`, `validar`, `encriptado`, `fecha`, `modo`, `img`) VALUES
(1, 'Leonardo', 'Vázquez', 'leonardovazquez81@gmail.com', '4132df397319d7058bd05faaa04fba70', 1, 1, '699c8f0489033dcb85f2efbcd2148993', '2019-10-19 00:23:06', 'dir', 'perfil_1571444586_00001.jpg'),
(2, 'Ramón', 'Vázquez', 'angulo@gmail.com', '4132df397319d7058bd05faaa04fba70', 3, 1, '335d8d7c2ed7779bbd6668ffd91f466e', '2019-10-26 15:37:13', 'dir', 'perfil_1572104233_00002.jpg'),
(24, 'leonardo', 'vazquez', 'angulo3@gmail.com', '4132df397319d7058bd05faaa04fba70', 3, 1, '0ffd168f55d318b5bf2bd08ddb0a043d', '2019-10-31 05:27:30', 'dir', 'perfil_1572499650_00024.jpg'),
(25, 'leonardo', 'vazquez', 'leonardovazquez21@gmail.com', '4132df397319d7058bd05faaa04fba70', 3, 0, '59cf806a879ed791b31da3c70a16d84d', '2019-10-17 03:45:40', 'dir', 'default.png'),
(26, 'Esthela', 'Angulo Hernandez', 'esthela@gmail.com', '4132df397319d7058bd05faaa04fba70', 3, 1, '477343966d285f24012fd77735431fa4', '2019-10-26 23:54:53', 'dir', 'perfil_1572123564_00026.jpg'),
(27, 'esthela ', 'angulo hernandez', 'esthela1@gmail.com', '4132df397319d7058bd05faaa04fba70', 3, 0, '45160e5021f71d4c06447fd6ee0a6a6e', '2019-10-17 03:45:44', 'dir', 'default.png'),
(28, 'esthela ', 'angulo hernandez', 'esthela2@gmail.com', '4132df397319d7058bd05faaa04fba70', 3, 0, '1564e50220f7f3afde2e86e9b7c2ef98', '2019-10-17 03:45:45', 'dir', 'default.png'),
(29, 'esthela ', 'angulo hernandez', 'esthela3@gmail.com', '4132df397319d7058bd05faaa04fba70', 3, 0, '993960e0f2e825cb64d34dbe8c3841b1', '2019-10-17 03:45:46', 'dir', 'default.png'),
(30, 'leonardo', 'vazquez', 'lvazquez@gmail.com', '4132df397319d7058bd05faaa04fba70', 3, 1, '0ffd168f55d318b5bf2bd08ddb0a043d', '2019-10-19 17:09:36', 'dir', 'perfil_1571504976_00030.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `veneficios`
--

CREATE TABLE `veneficios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `veneficios`
--

INSERT INTO `veneficios` (`id`, `nombre`, `icono`, `color`) VALUES
(1, 'whatsapp', 'fab fa-whatsapp-square', 'green-text');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `codigos`
--
ALTER TABLE `codigos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `membresias`
--
ALTER TABLE `membresias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `idcodigo` (`idcodigo`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `rango`
--
ALTER TABLE `rango`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `tag` (`tag`),
  ADD KEY `id` (`id`),
  ADD KEY `id_3` (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_servicios_trabajador` (`idServicio`);

--
-- Indices de la tabla `usersinfo`
--
ALTER TABLE `usersinfo`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `iduser` (`iduser`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `idUsuario` (`idUsuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `veneficios`
--
ALTER TABLE `veneficios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `codigos`
--
ALTER TABLE `codigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `formularios`
--
ALTER TABLE `formularios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `membresias`
--
ALTER TABLE `membresias`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `rango`
--
ALTER TABLE `rango`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `veneficios`
--
ALTER TABLE `veneficios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `membresias`
--
ALTER TABLE `membresias`
  ADD CONSTRAINT `membresias_ibfk_1` FOREIGN KEY (`idcodigo`) REFERENCES `codigos` (`id`);

--
-- Filtros para la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD CONSTRAINT `fk_servicios_trabajador` FOREIGN KEY (`idServicio`) REFERENCES `servicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
