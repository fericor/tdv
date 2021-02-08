-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: db5000349226.hosting-data.io
-- Tiempo de generación: 08-07-2020 a las 17:03:55
-- Versión del servidor: 5.7.30-log
-- Versión de PHP: 7.0.33-0+deb9u8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbs339303`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_ciudades`
--

CREATE TABLE `tdv_ciudades` (
  `idCiudad` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_configuracion`
--

CREATE TABLE `tdv_configuracion` (
  `id` int(11) NOT NULL,
  `idIglesia` int(11) NOT NULL,
  `iglesia` varchar(150) NOT NULL,
  `direccion` text NOT NULL,
  `fecha_fiscal` date NOT NULL,
  `proteccionDatos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_departamentos`
--

CREATE TABLE `tdv_departamentos` (
  `idDepartamento` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_estado_civil`
--

CREATE TABLE `tdv_estado_civil` (
  `idEstadoCivil` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_familias`
--

CREATE TABLE `tdv_familias` (
  `idFamilia` int(11) NOT NULL,
  `idFamiliaIntegrantes` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `idMiembro` int(11) NOT NULL,
  `idParentesco` int(11) NOT NULL,
  `nota` text NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_grupo_vida_barrios`
--

CREATE TABLE `tdv_grupo_vida_barrios` (
  `idBarrio` int(11) NOT NULL,
  `idDistrito` int(11) NOT NULL,
  `idZona` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_grupo_vida_casas`
--

CREATE TABLE `tdv_grupo_vida_casas` (
  `idCasa` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idLista` int(11) NOT NULL,
  `idDistrito` int(11) NOT NULL,
  `idZona` int(11) NOT NULL,
  `idBarrio` int(11) NOT NULL,
  `direccion` text NOT NULL,
  `idDueno` int(11) NOT NULL,
  `idMaestro` int(11) NOT NULL,
  `idAyudante` int(11) NOT NULL,
  `diaReunion` varchar(100) NOT NULL,
  `horaReunion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_grupo_vida_distritos`
--

CREATE TABLE `tdv_grupo_vida_distritos` (
  `idDistrito` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idIglesia` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `color` varchar(50) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_grupo_vida_zonas`
--

CREATE TABLE `tdv_grupo_vida_zonas` (
  `idZona` int(11) NOT NULL,
  `idDistrito` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_lista_miembros`
--

CREATE TABLE `tdv_lista_miembros` (
  `idListaGrupo` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idServicio` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `comentarios` text,
  `creacion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_lista_miembros_items`
--

CREATE TABLE `tdv_lista_miembros_items` (
  `idUser` int(11) NOT NULL,
  `idMiembro` int(11) NOT NULL,
  `idLista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_lista_miembros_items_historico`
--

CREATE TABLE `tdv_lista_miembros_items_historico` (
  `idUser` int(11) NOT NULL,
  `idMiembro` int(11) NOT NULL,
  `idLista` int(11) NOT NULL,
  `idServicio` int(11) NOT NULL,
  `asistencia` varchar(5) NOT NULL,
  `comentarios` text NOT NULL,
  `fecha` datetime NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_menus`
--

CREATE TABLE `tdv_menus` (
  `id` int(11) NOT NULL,
  `icon` varchar(150) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `nivel` int(11) NOT NULL,
  `sub_nivel` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_miembros`
--

CREATE TABLE `tdv_miembros` (
  `idMiembro` int(11) NOT NULL,
  `idIglesia` int(11) NOT NULL,
  `idFamilia` int(11) NOT NULL,
  `idParentesco` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `nacimiento` date NOT NULL,
  `direccion` text NOT NULL,
  `idCiudad` int(11) NOT NULL,
  `codigoPostal` varchar(20) NOT NULL,
  `bautizado` varchar(5) NOT NULL,
  `espirituSanto` varchar(5) NOT NULL,
  `fechaBautizado` date NOT NULL,
  `fechaEspirituSanto` date NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idTipoMiembro` int(11) NOT NULL,
  `estadoCivil` int(11) NOT NULL,
  `nHijos` int(11) NOT NULL,
  `idNacionalidad` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `idUser` int(11) NOT NULL,
  `idCulto` int(11) NOT NULL,
  `idDistrito` int(11) NOT NULL,
  `idZona` int(11) NOT NULL,
  `idBarrio` int(11) NOT NULL,
  `idCasa` int(11) NOT NULL,
  `fechaVisita` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imgBase64` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_nacionalidades`
--

CREATE TABLE `tdv_nacionalidades` (
  `idNacionalidad` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_notificaciones`
--

CREATE TABLE `tdv_notificaciones` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `contenido` text NOT NULL,
  `idUser` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `activo` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_parentescos`
--

CREATE TABLE `tdv_parentescos` (
  `idParentesco` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_roles`
--

CREATE TABLE `tdv_roles` (
  `idRol` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `modulos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_servicios_cultos`
--

CREATE TABLE `tdv_servicios_cultos` (
  `idServicio` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `dia` varchar(20) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_textos`
--

CREATE TABLE `tdv_textos` (
  `idTexto` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `contenido` text NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_tipos_miembros`
--

CREATE TABLE `tdv_tipos_miembros` (
  `idTipoMiembro` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `permisos` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdv_users`
--

CREATE TABLE `tdv_users` (
  `id` int(11) NOT NULL,
  `idIglesia` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `idRol` int(11) NOT NULL,
  `modDefault` varchar(100) NOT NULL,
  `activo` varchar(5) DEFAULT 'on',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `imgBase64` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tdv_configuracion`
--
ALTER TABLE `tdv_configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tdv_departamentos`
--
ALTER TABLE `tdv_departamentos`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indices de la tabla `tdv_estado_civil`
--
ALTER TABLE `tdv_estado_civil`
  ADD PRIMARY KEY (`idEstadoCivil`);

--
-- Indices de la tabla `tdv_familias`
--
ALTER TABLE `tdv_familias`
  ADD PRIMARY KEY (`idFamilia`);

--
-- Indices de la tabla `tdv_grupo_vida_barrios`
--
ALTER TABLE `tdv_grupo_vida_barrios`
  ADD PRIMARY KEY (`idBarrio`);

--
-- Indices de la tabla `tdv_grupo_vida_casas`
--
ALTER TABLE `tdv_grupo_vida_casas`
  ADD PRIMARY KEY (`idCasa`);

--
-- Indices de la tabla `tdv_grupo_vida_distritos`
--
ALTER TABLE `tdv_grupo_vida_distritos`
  ADD PRIMARY KEY (`idDistrito`);

--
-- Indices de la tabla `tdv_grupo_vida_zonas`
--
ALTER TABLE `tdv_grupo_vida_zonas`
  ADD PRIMARY KEY (`idZona`);

--
-- Indices de la tabla `tdv_lista_miembros`
--
ALTER TABLE `tdv_lista_miembros`
  ADD PRIMARY KEY (`idListaGrupo`);

--
-- Indices de la tabla `tdv_menus`
--
ALTER TABLE `tdv_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tdv_miembros`
--
ALTER TABLE `tdv_miembros`
  ADD PRIMARY KEY (`idMiembro`),
  ADD KEY `id_departamento` (`idDepartamento`),
  ADD KEY `idTipoMiembro` (`idTipoMiembro`);

--
-- Indices de la tabla `tdv_nacionalidades`
--
ALTER TABLE `tdv_nacionalidades`
  ADD PRIMARY KEY (`idNacionalidad`);

--
-- Indices de la tabla `tdv_notificaciones`
--
ALTER TABLE `tdv_notificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tdv_parentescos`
--
ALTER TABLE `tdv_parentescos`
  ADD PRIMARY KEY (`idParentesco`);

--
-- Indices de la tabla `tdv_roles`
--
ALTER TABLE `tdv_roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tdv_servicios_cultos`
--
ALTER TABLE `tdv_servicios_cultos`
  ADD PRIMARY KEY (`idServicio`);

--
-- Indices de la tabla `tdv_textos`
--
ALTER TABLE `tdv_textos`
  ADD PRIMARY KEY (`idTexto`);

--
-- Indices de la tabla `tdv_tipos_miembros`
--
ALTER TABLE `tdv_tipos_miembros`
  ADD PRIMARY KEY (`idTipoMiembro`);

--
-- Indices de la tabla `tdv_users`
--
ALTER TABLE `tdv_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tdv_configuracion`
--
ALTER TABLE `tdv_configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_departamentos`
--
ALTER TABLE `tdv_departamentos`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_estado_civil`
--
ALTER TABLE `tdv_estado_civil`
  MODIFY `idEstadoCivil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_familias`
--
ALTER TABLE `tdv_familias`
  MODIFY `idFamilia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_grupo_vida_barrios`
--
ALTER TABLE `tdv_grupo_vida_barrios`
  MODIFY `idBarrio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_grupo_vida_casas`
--
ALTER TABLE `tdv_grupo_vida_casas`
  MODIFY `idCasa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_grupo_vida_distritos`
--
ALTER TABLE `tdv_grupo_vida_distritos`
  MODIFY `idDistrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_grupo_vida_zonas`
--
ALTER TABLE `tdv_grupo_vida_zonas`
  MODIFY `idZona` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_lista_miembros`
--
ALTER TABLE `tdv_lista_miembros`
  MODIFY `idListaGrupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_menus`
--
ALTER TABLE `tdv_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_miembros`
--
ALTER TABLE `tdv_miembros`
  MODIFY `idMiembro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_nacionalidades`
--
ALTER TABLE `tdv_nacionalidades`
  MODIFY `idNacionalidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_notificaciones`
--
ALTER TABLE `tdv_notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_parentescos`
--
ALTER TABLE `tdv_parentescos`
  MODIFY `idParentesco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_roles`
--
ALTER TABLE `tdv_roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_servicios_cultos`
--
ALTER TABLE `tdv_servicios_cultos`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_textos`
--
ALTER TABLE `tdv_textos`
  MODIFY `idTexto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_tipos_miembros`
--
ALTER TABLE `tdv_tipos_miembros`
  MODIFY `idTipoMiembro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdv_users`
--
ALTER TABLE `tdv_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tdv_miembros`
--
ALTER TABLE `tdv_miembros`
  ADD CONSTRAINT `tdv_miembros_ibfk_1` FOREIGN KEY (`idDepartamento`) REFERENCES `tdv_departamentos` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tdv_miembros_ibfk_2` FOREIGN KEY (`idTipoMiembro`) REFERENCES `tdv_tipos_miembros` (`idTipoMiembro`);

--
-- Filtros para la tabla `tdv_users`
--
ALTER TABLE `tdv_users`
  ADD CONSTRAINT `tdv_users_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `tdv_roles` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
