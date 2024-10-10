CREATE TABLE `usuarios` (
  `id_user` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL UNIQUE,
  `clave` varchar(255) NOT NULL,
  `id_dep` int NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

INSERT INTO usuarios(nombre, apellido, usuario, clave, id_dep)
VALUES('JEAN', 'CASTILLO', 'SOYLASUPERCLAVE','castilloacostajean@gmail.com', 1)
SELECT nombre, apellido, U.id_dep, G.nom_gere, UP.id_pri, P.nom_pri, UE.id_estatus, E.nombre_estatus
FROM usuarios U
INNER JOIN gerencia G ON U.id_dep = G.id_dep
INNER JOIN usuarios_privilegios UP ON U.id_user = UP.id_user
INNER JOIN privilegios P ON UP.id_pri = P.id_pri
INNER JOIN usuarios_estatus UE ON U.id_user = UE.id_estatus
INNER JOIN estatus E ON UE.id_estatus = E.id_estatus
--------------------------------------------------------------------------------

CREATE TABLE `gerencia` (
  `id_dep` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nom_gere` varchar(50) NOT NULL
);

ALTER TABLE `usuarios`
  ADD CONSTRAINT fk_gerencia
  FOREIGN KEY (`id_dep`)
  REFERENCES `gerencia` (`id_dep`);

INSERT INTO gerencia(nom_gere) VALUES('DIRECCION')
--------------------------------------------------------------------------------

CREATE TABLE `privilegios` (
  `id_pri` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nom_pri` varchar(50) NOT NULL
);
INSERT INTO privilegios(nom_pri)VALUES('ASISTENTE')

CREATE TABLE `usuarios_privilegios` (
  `id_upri` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_pri` int NOT NULL,
  PRIMARY KEY (`id_upri`),
  FOREIGN KEY (`id_user`) REFERENCES `usuarios`(`id_user`),
  FOREIGN KEY (`id_pri`) REFERENCES `privilegios`(`id_pri`)
);
INSERT INTO usuarios_privilegios(id_user, id_pri)VALUES(1, 1)
--------------------------------------------------------------------------------
CREATE TABLE `estatus` (
  `id_estatus` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nombre_estatus` varchar(50) NOT NULL
);
INSERT INTO estatus(nombre_estatus)VALUES('ACTIVO')

CREATE TABLE `usuarios_estatus` (
  `id_usuario` int NOT NULL,
  `id_estatus` int NOT NULL,
  PRIMARY KEY (`id_usuario`, `id_estatus`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_user`),
  FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id_estatus`)
);
