-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-02-2022 a las 15:23:47
-- Versión del servidor: 10.3.32-MariaDB-0ubuntu0.20.04.1
-- Versión de PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laura_seguridad`
--


-- --------------------------------------------------------

--
-- Estructura para la vista `auditorias_view`
--
DROP TABLE IF EXISTS `auditorias_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `auditorias_view`  AS  select `a`.`id_auditoria` AS `id_auditoria`,`a`.`id_fila` AS `id_fila`,`a`.`tabla` AS `tabla`,`a`.`accion` AS `accion`,`a`.`id_usuario` AS `id_usuario`,`u`.`nombre_usuario` AS `nombre_usuario`,`a`.`created_at` AS `created_at` from (`auditoria` `a` join `usuarios` `u` on(`a`.`id_usuario` = `u`.`id_usuario`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `cantones_view`
--
DROP TABLE IF EXISTS `cantones_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY INVOKER VIEW `cantones_view`  AS  select `ubicaciones`.`cod_provincia` AS `cod_provincia`,`ubicaciones`.`cod_canton` AS `cod_canton`,`ubicaciones`.`canton` AS `canton` from `ubicaciones` group by `ubicaciones`.`cod_provincia`,`ubicaciones`.`cod_canton` order by `ubicaciones`.`cod_provincia`,`ubicaciones`.`cod_canton` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `distritos_view`
--
DROP TABLE IF EXISTS `distritos_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY INVOKER VIEW `distritos_view`  AS  select `ubicaciones`.`cod_provincia` AS `cod_provincia`,`ubicaciones`.`cod_canton` AS `cod_canton`,`ubicaciones`.`cod_distrito` AS `cod_distrito`,`ubicaciones`.`distrito` AS `distrito` from `ubicaciones` group by `ubicaciones`.`cod_provincia`,`ubicaciones`.`cod_canton`,`ubicaciones`.`cod_distrito` order by `ubicaciones`.`cod_provincia`,`ubicaciones`.`cod_canton`,`ubicaciones`.`cod_distrito` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `empresas_view`
--
DROP TABLE IF EXISTS `empresas_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `empresas_view`  AS  select `empresas`.`id_empresa` AS `id_empresa`,`empresas`.`identificacion` AS `identificacion`,`empresas`.`id_tipo_identificacion` AS `id_tipo_identificacion`,`tipos_identificaciones`.`tipo_identificacion` AS `tipo_identificacion`,`empresas`.`razon` AS `razon`,`empresas`.`razon` AS `nombre`,`empresas`.`cod_actividad` AS `cod_actividad`,`empresas`.`nombre_comercial` AS `nombre_comercial`,`empresas`.`id_ubicacion` AS `id_ubicacion`,`u`.`cod_provincia` AS `cod_provincia`,`u`.`provincia` AS `provincia`,`u`.`cod_canton` AS `cod_canton`,`u`.`canton` AS `canton`,`u`.`cod_distrito` AS `cod_distrito`,`u`.`distrito` AS `distrito`,`u`.`cod_barrio` AS `cod_barrio`,`u`.`barrio` AS `barrio`,`empresas`.`otras_senas` AS `otras_senas`,`codigos_paises`.`codigo_telefono` AS `codigo_telefono`,`empresas`.`telefono` AS `telefono`,`empresas`.`cod_pais` AS `cod_pais`,`codigos_paises`.`nombre` AS `nombre_pais`,`empresas`.`correo` AS `correo`,`empresas`.`estado` AS `estado` from (((`empresas` join `tipos_identificaciones` on(`tipos_identificaciones`.`id_tipo_identificacion` = `empresas`.`id_tipo_identificacion`)) join `codigos_paises` on(`codigos_paises`.`cod_pais` = `empresas`.`cod_pais`)) join `ubicaciones` `u` on(`empresas`.`id_ubicacion` = `u`.`id_ubicacion`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `modulos_roles_view`
--
DROP TABLE IF EXISTS `modulos_roles_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `modulos_roles_view`  AS  select `p`.`id_permiso` AS `id_permiso`,`r`.`id_rol` AS `id_rol`,`p`.`id_modulo` AS `id_modulo`,`m`.`nombre_modulo` AS `nombre_modulo`,`m`.`icono` AS `icono` from ((`permisos_submodulos` `p` join `modulos` `m` on(`p`.`id_modulo` = `m`.`id_modulo`)) join `roles` `r` on(`p`.`id_rol` = `r`.`id_rol`)) where `p`.`estado` = 1 group by `r`.`id_rol`,`p`.`id_modulo` order by `r`.`id_rol`,`p`.`id_modulo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `permisos_view`
--
DROP TABLE IF EXISTS `permisos_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `permisos_view`  AS  select `p`.`id_permiso` AS `id_permiso`,`p`.`id_rol` AS `id_rol`,`r`.`nombre_rol` AS `nombre_rol`,`p`.`id_modulo` AS `id_modulo`,`s`.`nombre_modulo` AS `nombre_modulo`,`p`.`id_submodulo` AS `id_submodulo`,`s`.`nombre_submodulo` AS `nombre_submodulo`,`s`.`objeto` AS `objeto`,`s`.`url` AS `url`,`p`.`id_accion` AS `id_accion`,`a`.`nombre_accion` AS `nombre_accion`,`a`.`icono` AS `icono`,`p`.`estado` AS `estado`,`p`.`fecha_creacion` AS `fecha_creacion`,`p`.`fecha_modificacion` AS `fecha_modificacion` from (((`permisos_submodulos` `p` join `submodulos_view` `s` on(`p`.`id_modulo` = `s`.`id_modulo` and `p`.`id_submodulo` = `s`.`id_submodulo`)) join `roles` `r` on(`p`.`id_rol` = `r`.`id_rol`)) join `acciones` `a` on(`p`.`id_accion` = `a`.`id_accion`)) where `p`.`estado` = 1 and `a`.`nombre_accion` <> 'eliminar' group by `p`.`id_rol`,`p`.`id_modulo`,`p`.`id_submodulo`,`p`.`id_accion` order by `p`.`id_rol`,`p`.`id_modulo`,`p`.`id_submodulo`,`p`.`id_accion` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `provincias_view`
--
DROP TABLE IF EXISTS `provincias_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `provincias_view`  AS  select `ubicaciones`.`cod_provincia` AS `cod_provincia`,`ubicaciones`.`provincia` AS `provincia` from `ubicaciones` group by `ubicaciones`.`cod_provincia` order by `ubicaciones`.`cod_provincia` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `submodulos_acciones_view`
--
DROP TABLE IF EXISTS `submodulos_acciones_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `submodulos_acciones_view`  AS  select `s`.`id_modulo` AS `id_modulo`,`v`.`nombre_modulo` AS `nombre_modulo`,`s`.`id_submodulo` AS `id_submodulo`,`v`.`nombre_submodulo` AS `nombre_submodulo`,`s`.`id_accion` AS `id_accion`,`a`.`nombre_accion` AS `nombre_accion`,`a`.`icono` AS `icono` from ((`submodulos_acciones` `s` join `submodulos_view` `v` on(`s`.`id_modulo` = `v`.`id_modulo` and `s`.`id_submodulo` = `v`.`id_submodulo`)) join `acciones` `a` on(`s`.`id_accion` = `a`.`id_accion`)) order by `v`.`nombre_modulo`,`v`.`nombre_submodulo`,`a`.`nombre_accion` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `submodulos_roles_view`
--
DROP TABLE IF EXISTS `submodulos_roles_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `submodulos_roles_view`  AS  select `p`.`id_permiso` AS `id_permiso`,`p`.`id_rol` AS `id_rol`,`p`.`id_modulo` AS `id_modulo`,`p`.`id_submodulo` AS `id_submodulo`,`s`.`nombre_submodulo` AS `nombre_submodulo`,`s`.`icono` AS `icono`,`s`.`objeto` AS `objeto`,`s`.`url` AS `url` from (`permisos_submodulos` `p` join `submodulos_view` `s` on(`p`.`id_modulo` = `s`.`id_modulo` and `p`.`id_submodulo` = `s`.`id_submodulo`)) where `p`.`estado` = 1 group by `p`.`id_rol`,`p`.`id_modulo`,`p`.`id_submodulo` order by `p`.`id_rol`,`p`.`id_modulo`,`p`.`id_submodulo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `submodulos_view`
--
DROP TABLE IF EXISTS `submodulos_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `submodulos_view`  AS  select `s`.`id_modulo` AS `id_modulo`,`m`.`nombre_modulo` AS `nombre_modulo`,`s`.`id_submodulo` AS `id_submodulo`,`s`.`nombre_submodulo` AS `nombre_submodulo`,`s`.`icono` AS `icono`,`s`.`objeto` AS `objeto`,`s`.`url` AS `url`,`s`.`fecha_creacion` AS `fecha_creacion` from (`modulos_submodulos` `s` join `modulos` `m` on(`s`.`id_modulo` = `m`.`id_modulo`)) order by `m`.`nombre_modulo`,`s`.`nombre_submodulo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `usuarios_view`
--
DROP TABLE IF EXISTS `usuarios_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `usuarios_view`  AS  select `u`.`id_usuario` AS `id_usuario`,`u`.`nombre` AS `nombre`,`u`.`nombre_usuario` AS `nombre_usuario`,`u`.`identificacion` AS `identificacion`,`u`.`id_tipo_identificacion` AS `id_tipo_identificacion`,`t`.`tipo_identificacion` AS `tipo_identificacion`,`u`.`correo` AS `correo`,`u`.`telefono` AS `telefono`,`u`.`id_rol` AS `id_rol`,`r`.`nombre_rol` AS `nombre_rol`,`u`.`id_empresa` AS `id_empresa`,`e`.`razon` AS `nombre_empresa`,`u`.`cod_pais` AS `cod_pais`,`c`.`nombre` AS `nombre_pais`,`c`.`codigo_telefono` AS `codigo_telefono`,`u`.`fecha_registro` AS `fecha_registro`,`u`.`fecha_actualizacion` AS `fecha_actualizacion`,`u`.`fecha_eliminacion` AS `fecha_eliminacion`,`u`.`estado` AS `estado` from ((((`usuarios` `u` join `roles` `r` on(`u`.`id_rol` = `r`.`id_rol`)) join `tipos_identificaciones` `t` on(`u`.`id_tipo_identificacion` = `t`.`id_tipo_identificacion`)) join `empresas` `e` on(`u`.`id_empresa` = `e`.`id_empresa`)) join `codigos_paises` `c` on(`u`.`cod_pais` = `c`.`cod_pais`)) order by `u`.`nombre` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id_accion`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id_auditoria`);

--
-- Indices de la tabla `codigos_paises`
--
ALTER TABLE `codigos_paises`
  ADD PRIMARY KEY (`cod_pais`);

--
-- Indices de la tabla `contrasenia_usuarios`
--
ALTER TABLE `contrasenia_usuarios`
  ADD PRIMARY KEY (`id_contrasenia`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `fk_empresas_ubicaciones` (`id_ubicacion`),
  ADD KEY `fk_empresas_cod_pais` (`cod_pais`),
  ADD KEY `fk_empresas_tipo_identificaciones` (`id_tipo_identificacion`);

--
-- Indices de la tabla `error`
--
ALTER TABLE `error`
  ADD PRIMARY KEY (`id_error`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `modulos_submodulos`
--
ALTER TABLE `modulos_submodulos`
  ADD PRIMARY KEY (`id_modulo`,`id_submodulo`);

--
-- Indices de la tabla `permisos_submodulos`
--
ALTER TABLE `permisos_submodulos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `submodulos_acciones`
--
ALTER TABLE `submodulos_acciones`
  ADD PRIMARY KEY (`id_modulo`,`id_submodulo`,`id_accion`),
  ADD KEY `FK_ACCION` (`id_accion`),
  ADD KEY `fk_submodulo` (`id_modulo`,`id_submodulo`),
  ADD KEY `fk_modulo` (`id_modulo`);

--
-- Indices de la tabla `tipos_identificaciones`
--
ALTER TABLE `tipos_identificaciones`
  ADD PRIMARY KEY (`id_tipo_identificacion`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id_ubicacion`),
  ADD KEY `cod_provincia` (`cod_provincia`),
  ADD KEY `cod_provincia_2` (`cod_provincia`,`cod_canton`),
  ADD KEY `cod_provincia_3` (`cod_provincia`,`cod_canton`,`cod_distrito`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_rol` (`id_rol`),
  ADD KEY `fk_tipo_identificacion` (`id_tipo_identificacion`),
  ADD KEY `cod_pais` (`cod_pais`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `id_accion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `permisos_submodulos`
--
ALTER TABLE `permisos_submodulos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `fk_empresas_cod_pais` FOREIGN KEY (`cod_pais`) REFERENCES `codigos_paises` (`cod_pais`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_empresas_tipo_identificacion` FOREIGN KEY (`id_tipo_identificacion`) REFERENCES `tipos_identificaciones` (`id_tipo_identificacion`),
  ADD CONSTRAINT `fk_empresas_ubicaciones` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicaciones` (`id_ubicacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `modulos_submodulos`
--
ALTER TABLE `modulos_submodulos`
  ADD CONSTRAINT `FK_MODULO` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id_modulo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `submodulos_acciones`
--
ALTER TABLE `submodulos_acciones`
  ADD CONSTRAINT `FK_ACCION` FOREIGN KEY (`id_accion`) REFERENCES `acciones` (`id_accion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_modulo_submodulo` FOREIGN KEY (`id_modulo`,`id_submodulo`) REFERENCES `modulos_submodulos` (`id_modulo`, `id_submodulo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipo_identificacion` FOREIGN KEY (`id_tipo_identificacion`) REFERENCES `tipos_identificaciones` (`id_tipo_identificacion`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
