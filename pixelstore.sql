-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2026 a las 21:23:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pixelstore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `ID` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `Nombre_juego` varchar(255) NOT NULL,
  `Genero` varchar(255) NOT NULL,
  `Plataforma` varchar(255) NOT NULL,
  `Precio` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`ID`, `imagen`, `Nombre_juego`, `Genero`, `Plataforma`, `Precio`, `descripcion`) VALUES
(1, 'img/Requiem.jpg', 'Resident Evil Requiem', 'Survival Horror', 'PlayStation 5', 138399, 'Réquiem por los muertos, pesadilla para los vivos. Escapa de la muerte en una experiencia de infarto que te estremecerá.'),
(2, 'img/FF.jpg', 'FINAL FANTASY XVI', 'Action RPG', 'PlayStation 5', 125000, 'Un épico mundo de fantasía oscura cuyo destino está en manos de los poderosos eikon y de los Dominantes que los controlan. Esta es la historia de Clive Rosfield, que jura vengarse del misterioso eikon oscuro Ifrit que solo deja desgracias a su paso.'),
(3, 'img/ragnarok.jpg', 'God of War Ragnarök', 'Hack and slash', 'PlayStation 5', 85000, 'Kratos y Atreus se embarcan en una mítica aventura en busca de respuestas y aliados antes de la llegada del Ragnarök.'),
(4, 'img/wu-kong.jpg', 'Black Myth: Wukong', 'SoulsLike', 'PlayStation 5', 144999, 'Black Myth: Wukong es un RPG de acción basado en la mitología china y en Viaje al Oeste, una de las cuatro grandes novelas clásicas de la literatura china.'),
(5, 'img/fc26.jpg', 'EA Sports FC 26', 'Deportes', 'PlayStation 5', 91999, 'El Club es tuyo en EA SPORTS FC™ 26. Juega a tu manera con una experiencia de juego renovada.'),
(6, 'img/elden.jpg', 'Elden Ring', 'SoulsLike', 'PlayStation 5', 84766, 'EL NUEVO JUEGO DE ROL Y ACCIÓN DE AMBIENTACIÓN FANTÁSTICA. Álzate, Sinluz, y que la gracia te guíe para abrazar el poder del Círculo de Elden y encumbrarte como señor del Círculo en las Tierras Intermedias.'),
(8, 'img/33.jpg', 'Clair Obscur Expedition 33', 'RPG', 'PlayStation 5', 130384, 'Guía a la expedición 33 en su viaje para destruir a la Peintresse para que no pinte la muerte. Explora un mundo inspirado por la Francia de la Belle Époque y combate enemigos únicos en este juego de rol por turnos con mecánicas en tiempo real.'),
(9, 'img/lego.jpg', 'Lego Batman Legacy Of The Dark Knight', 'Aventura', 'PlayStation 5', 141499, 'Renace como el Caballero Oscuro y vive la historia de Batman en una atrevida aventura llena de acción y combates rompedores que se desarrolla en el mundo abierto de Gotham City, todo ello con el humor característico de LEGO que tanto gusta a los fans.'),
(10, 'img/DemonSouls.jpg', 'Demons Souls Remake', 'SoulsLike', 'PlayStation 5', 81250, 'De PlayStation Studios y Bluepoint Games llega un remake del clásico de PlayStation Demon\'s Souls. Completamente reconstruido desde cero y mejorado con maestría.'),
(11, 'img/yotei.jpg', 'Ghost of Yōtei', 'Accion', 'PlayStation 5', 138117, 'Ambientado unos 300 años después del aclamado Ghost of Tsushima, Ghost of Yōtei es una experiencia independiente que transcurre en el siglo XVII en el Japón rural. La historia se centra en una mercenaria solitaria y atormentada que se llama Atsu.'),
(12, 'img/007.jpg', '007 First Light', 'Accion', 'PlayStation 5', 150000, 'Sigue a James Bond como un joven recluta ingenioso y, a veces, temerario en el programa de entrenamiento del MI6.\r\n\r\nTras una heroica hazaña, a James Bond, un joven piloto naval, se le ofrece la oportunidad de unirse al recién reactivado programa 00.'),
(13, 'img/tactics.jpg', 'FINAL FANTASY TACTICS - The Ivalice Chronicles', 'Estrategia', 'PlayStation 5', 116399, 'Estamos en Ivalice, un reino bendecido por la luz de los dioses y gobernado por el León Bicéfalo. Un año después de la derrota ante Ordallia en la Guerra de los Cincuenta Años, el rey falleció a causa de una enfermedad dejando el trono.'),
(14, 'img/rebirth.jpg', 'Final Fantasy VII Rebirth', 'Rol(RPG)', 'PlayStation 5', 116390, 'Final Fantasy VII Rebirth es la segunda entrega dentro del proyecto de remake de Final Fantasy VII, que vuelve a contar la historia del RPG que redefinió el género en tres juegos distintos.'),
(15, 'img/remake.jpg', 'Final Fantasy VII Remake Intergrade', 'Rol(RPG)', 'PlayStation 5', 96000, 'FINAL FANTASY VII REMAKE INTERGRADE es una versión mejorada y expandida del título galardonado y aclamado por la crítica FINAL FANTASY VII REMAKE para PlayStation 5. \r\n\r\nFINAL FANTASY VII REMAKE INTERGRADE viene en un paquete con FF7R EPISODE INTERmission'),
(17, 'img/minecraft.jpg', 'Minecraft', 'Sandbox', 'PlayStation 5', 90249, 'Con la libertad y la originalidad por bandera, Minecraft ofrece modo creativo con herramientas y bloques suficientes para construir casi cualquier mecanismo imaginable; así como un modo supervivencia donde los jugadores, en la piel de Steve, luchan sin pa'),
(19, 'img/tlou.jpg', 'The Last of Us™ Part I', 'Accion', 'PlayStation 5', 66365, 'Resiste y sobrevive. Revive el amado juego que lo comenzó todo, reconstruido para la consola PlayStation®5.\r\n\r\nConoce la emocionante historia y a los entrañables personajes de The Last of Us, ganador de más de 200 premios del Juego del año.'),
(20, 'img/1783536012_tlou2.jpg', 'The Last of Us™ Part II Remastered', 'Accion', 'PlayStation 5', 121000, 'Disfruta del juego ganador de más de 300 premios Game of the Year, remasterizado para la consola PlayStation®5. Vuelve a vivir o juega por primera vez la historia de Ellie y Abby, ahora con mejoras gráficas, nuevos modos de juego, como la experiencia de s');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nombre`, `email`, `password`, `rol`) VALUES
(1, 'ADMIN', 'admin@ad.com', '$2y$10$DDmXfbRgcI7xt4dCzM7w/e79gfbHpTZ8E6NbftCtWt7Sql.qylvbK', 'admin'),
(2, 'USER', 'user@us.com', '$2y$10$//tmRXfOhwo.Vk/CxAJGwuSs8iqKfaUrBzlOOwcplLwTpJ2MWQlt6', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
