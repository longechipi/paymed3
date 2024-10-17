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
  `id_user` INT NOT NULL, -- CLAVE FORANEA
  `nac` varchar(1) NOT NULL,
  `cedula` INT(10) NOT NULL UNIQUE,
  `nombre1` varchar(100) NOT NULL,
  `nombre2` varchar(100) NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) NULL,
  `rif` varchar(12) NOT NULL,
  `cod_col_med` INT NULL UNIQUE,
  `id_espe` INT NOT NULL,
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
  FOREIGN KEY (`id_espe`) REFERENCES `especialidades_med` (`id_espe`),
  FOREIGN KEY (`idpais`) REFERENCES `pais` (`id`),
  FOREIGN KEY (`idestado`) REFERENCES `estados` (`id_estado`),
  FOREIGN KEY (`idmunicipio`) REFERENCES `municipios` (`id_municipio`),
  FOREIGN KEY (`idparroquia`) REFERENCES `parroquias` (`id_parroquias`)
);
INSERT INTO medicos(id_user, nac, cedula, nombre1, nombre2, apellido1, apellido2, rif, cod_col_med,id_espe,
mpss, fec_nac, edad,idsex,idcivil,celular, telf, correo_pri,correo2,idpais,
idestado,idmunicipio,idparroquia,direccion,id_sta)VALUES(2, 'V', 11197801, 'KATRINS', 'HAIDY', 'ARVELO', 'CRESPO', 'J111978014', 987877000, 3,
98987, '1981-05-24', 41, 1, 1, '04242974834', '02126834798', 'harvelo@armisglobal.com', 'harvelo@armisglobal.com', 232, 
24, 462, 112, 'EL PARAISO', 1)

------------------------------------------------------------------------------------

CREATE TABLE `sexo` (
  `id_sex` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `genero` varchar(50) NOT NULL,
  `id_sta` INT NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);
INSERT INTO sexo(genero, id_sta) VALUES('FEMENINO', 1)

------------------------------------------------------------------------------------
CREATE TABLE `pais` (
  `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `pais` varchar(50) NOT NULL,
  `id_sta` INT NOT NULL,
  FOREIGN KEY (`id_sta`) REFERENCES `estatus` (`id_sta`)
);

INSERT INTO pais(pais, id_sta) VALUES('VENEZUELA', 1 )
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