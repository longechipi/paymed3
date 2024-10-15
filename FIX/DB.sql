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


