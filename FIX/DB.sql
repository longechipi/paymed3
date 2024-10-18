CREATE TABLE `estatus` (
  `id_sta` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nom_sta` varchar(50) NOT NULL
);
INSERT INTO estatus(nom_sta)VALUES('ACTIVO')
--------------------------------------------------------------------------------
CREATE TABLE `users` (
  `id_user` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL UNIQUE,
  `clave` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP()
);
INSERT INTO users(nombre, apellido, usuario, clave)
VALUES('JEAN', 'CASTILLO', 'castilloacostajean@gmail.com','SOYLASUPERCLAVE')
--------------------------------------------------------------------------------
CREATE TABLE `privilegios` (
  `id_pri` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nom_pri` varchar(50) NOT NULL
);
INSERT INTO privilegios(nom_pri)VALUES('ASISTENTE')
--------------------------------------------------------------------------------
CREATE TABLE `users_privilegios` (
  `id_upri` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_pri` int NOT NULL,
  PRIMARY KEY (`id_upri`),
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`),
  FOREIGN KEY (`id_pri`) REFERENCES `privilegios`(`id_pri`)
);
INSERT INTO users_privilegios(id_user, id_pri)VALUES(1, 1)
--------------------------------------------------------------------------------
CREATE TABLE `users_status` (
  `id_usta` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_sta` int NOT NULL,
  PRIMARY KEY (`id_usta`, `id_user`),
  FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);

INSERT INTO users_status (id_user, id_sta) VALUES(1, 1)
--------------------------------------------------------------------------------

CREATE TABLE `medicos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `id_user` INT NOT NULL, 
  `nac` varchar(1) NOT NULL,
  `cedula` INT(10) NOT NULL UNIQUE,
  `nombre1` varchar(100) NOT NULL,
  `nombre2` varchar(100) NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) NULL,
  `rif` varchar(12) NOT NULL,
  `cod_col_med` INT NULL UNIQUE,
  `mpss` INT NULL UNIQUE,
  `fec_nac` DATE NOT NULL,
  `edad` INT NOT NULL,
  `idsex` INT NULL,
  `idcivil` INT NULL,
  `celular` varchar(15) NOT NULL,
  `telf` varchar(15) NULL,
  `correo_pri` varchar(100) NOT NULL UNIQUE,
  `correo2` varchar(100) NULL UNIQUE,
  `idpais` INT NULL,
  `idestado` INT NULL,
  `idmunicipio` INT NULL,
  `idparroquia` INT NULL,
  `direccion` TEXT NULL,
  `id_sta` INT NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP(),

  FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`),
  FOREIGN KEY (`idpais`) REFERENCES `pais` (`id`),
  FOREIGN KEY (`idestado`) REFERENCES `estados` (`id_estado`),
  FOREIGN KEY (`idmunicipio`) REFERENCES `municipios` (`id_municipio`),
  FOREIGN KEY (`idparroquia`) REFERENCES `parroquias` (`id_parroquias`)
);
INSERT INTO medicos(id_user, nac, cedula, nombre1, nombre2, apellido1, apellido2, rif, cod_col_med,
mpss, fec_nac, edad,idsex,idcivil,celular, telf, correo_pri,correo2,idpais,
idestado,idmunicipio,idparroquia,direccion,id_sta)VALUES(2, 'V', 11197801, 'KATRINS', 'HAIDY', 'ARVELO', 'CRESPO', 'J111978014', 987877000,
98987, '1981-05-24', 41, 1, 1, '04242974834', '02126834798', 'harvelo@armisglobal.com', 'harvelo@armisglobal.com', 1, 
24, 462, 112, 'EL PARAISO', 1)

------------------------------------------------------------------------------------

CREATE TABLE `sexo` (
  `id_sex` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `genero` varchar(50) NOT NULL,
  `id_sta` INT NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
INSERT INTO sexo(genero, id_sta) VALUES('FEMENINO', 1)
-------------------------------------------------------------------------------------
CREATE TABLE `especialidades_med` (
  `id_espe` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `especialidad` varchar(50) NOT NULL,
  `id_sta` INT NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
INSERT INTO especialidades_med(especialidad, id_sta)VALUES('GINECOLOGIA', 1)
-------------------------------------------------------------------------------------
CREATE TABLE `bancos` (
  `id_ban` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `cod_ban` varchar(100) NOT NULL,
  `banco` varchar(100) NOT NULL,
  `nacional` INT NOT NULL,
  `id_sta` INT NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
INSERT INTO bancos(cod_ban, banco, nacional, id_sta)VALUES('0108', 'PROVINCIAL', 1, 1)
-------------------------------------------------------------------------------------
CREATE TABLE `tipo_cuenta_banco` (
  `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `tipo_cuenta` varchar(100) NOT NULL,
  `id_sta` INT NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
INSERT INTO tipo_cuenta_banco(tipo_cuenta, id_sta)VALUES('AHORRO', 1)
-------------------------------------------------------------------------------------
CREATE TABLE `datos_bancarios_med` (
  `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `id_user` INT NOT NULL,
  `id_ban` INT NOT NULL,
  `id_tip` INT NOT NULL,
  `nro_cuenta` varchar(100) NOT NULL,
  `ach` varchar(100) NULL,
  `swit` varchar(100) NULL,
  `aba` varchar(100) NULL,
  `id_sta` INT NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`),
  FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  FOREIGN KEY (`id_ban`) REFERENCES `bancos` (`id_ban`),
  FOREIGN KEY (`id_tip`) REFERENCES `tipo_cuenta_banco` (`id`)
  
)
INSERT INTO datos_bancarios_med(id_user, id_ban, id_tip, nro_cuenta, ach, swit, aba, id_sta)VALUES(2, 1, 2, '01021478963210254789', '0', '0', '0', 1)
-------------------------------------------------------------------------------------
CREATE TABLE `pais` (
  `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `pais` varchar(50) NOT NULL,
  `id_sta` INT NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);

INSERT INTO pais(pais, id_sta) VALUES('VENEZUELA', 1 )
-------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(250) NOT NULL,
  `iso_3166-2` varchar(4) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;
INSERT INTO `estados` (`id_estado`, `estado`, `iso_3166-2`) VALUES
(1, 'Amazonas', 'VE-X'),
-------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ciudades` (
  `id_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) NOT NULL,
  `ciudad` varchar(200) NOT NULL,
  `capital` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ciudad`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=523 
INSERT INTO `ciudades` (`id_ciudad`, `id_estado`, `ciudad`, `capital`) VALUES
(1, 1, 'Maroa', 0),
-------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `municipios` (
  `id_municipio` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  PRIMARY KEY (`id_municipio`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=463 ;
INSERT INTO `municipios` (`id_municipio`, `id_estado`, `municipio`) VALUES
(1, 1, 'Alto Orinoco'),
-------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `parroquias` (
  `id_parroquia` int(11) NOT NULL AUTO_INCREMENT,
  `id_municipio` int(11) NOT NULL,
  `parroquia` varchar(250) NOT NULL,
  PRIMARY KEY (`id_parroquia`),
  KEY `id_municipio` (`id_municipio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1139 ;
INSERT INTO `parroquias` (`id_parroquia`, `id_municipio`, `parroquia`) VALUES
(1, 1, 'Alto Orinoco'),
-------------------------------------------------------------------------------------

CREATE TABLE `medico_especialidad` (
  `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `id_user` INT NOT NULL,
  `id_espe` INT NOT NULL,
  `id_sta` INT NOT NULL,
  FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  FOREIGN KEY (`id_espe`) REFERENCES `especialidades_med` (`id_espe`),
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
INSERT INTO medico_especialidad(id_user, id_espe, id_sta)VALUES(2, 1, 1)
-------------------------------------------------------------------------------------
CREATE TABLE `tipoempresa` (
  `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `id_tip` INT NOT NULL,
  `tip_empresa` varchar(200) NOT NULL,
  `id_sta` INT NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
INSERT INTO tipoempresa(id_tip, tip_empresa, id_sta)VALUES(2, 'GUBERNAMENTAL', 1)
-------------------------------------------------------------------------------------
CREATE TABLE `tipoproveedor` (
  `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `tipo_prove` varchar(200) NOT NULL,
  `id_sta` INT NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
INSERT INTO tipoproveedor(tipo_prove, id_sta)VALUES('CLINICA', 1)
-------------------------------------------------------------------------------------
CREATE TABLE `clinicas` (
  `id_cli` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `rif` varchar(100) NOT NULL UNIQUE,
  `raz_social` varchar(100) NOT NULL,
  `nom_cli` varchar(100) NOT NULL,
  `descrip` TEXT NULL,
  `id_tip` INT NOT NULL,
  `id_pro` INT NOT NULL,
  `idpais` INT NOT NULL,
  `idestado` INT NOT NULL,
  `idmunicipio` INT NOT NULL,
  `idparroquia` INT NOT NULL,
  `correo_pri` varchar(100) NOT NULL UNIQUE,
  `direccion` TEXT NULL,
  `id_sta` INT NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  
  FOREIGN KEY (`id_tip`) REFERENCES `tipoempresa` (`id`),
  FOREIGN KEY (`id_pro`) REFERENCES `tipoproveedor` (`id`),
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
)

INSERT INTO clinicas (rif, raz_social, nom_cli, descrip, id_tip, id_pro, idpais, idestado, idmunicipio, idparroquia, correo_pri, direccion, id_sta)
VALUES('J941911221', 'CENTRO MEDICO DE CARACAS C.A', 'CENTRO MEDICO DE CARACAS C.A', 'CENTRO DE SALUD', 
1, 1, 1, 24, 462, 112, 'INFO@CMEDICO.COM', 'AV. LOS ERASOS, PLAZA EL ESTANQUE SAN BERNARDINO', 1)
-------------------------------------------------------------------------------------

CREATE TABLE `medico_clinicas` (
  `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `id_cli` INT NOT NULL,
  `id_med` INT NOT NULL,
  `pac_dia` INT NOT NULL,
  `pac_aseg` INT NULL,
  `pac_part` INT NULL,
  `consul` varchar(50) NULL,
  `piso` varchar(50) NULL,
  `telf1` varchar(50) NULL,
  `telf2` varchar(50) NULL,
  `id_sta` INT NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  
  FOREIGN KEY (`id_cli`) REFERENCES `clinicas` (`id_cli`),
  FOREIGN KEY (`id_med`) REFERENCES `medicos` (`id_user`),
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
INSERT INTO medico_clinicas(id_cli, id_med, pac_dia, pac_aseg, pac_part, consul, piso, telf1, telf2, id_sta)
VALUES(1, 2, 10, 2, 8, 'C-11', 2, '02126830000', '02126831111', 1 )