<?php 
require('../../conf/conexion.php');

   $apel_comp = strtoupper($_POST['apellido1']) . ' ' .strtoupper($_POST['apellido2']);
   $nom_comp = strtoupper($_POST['nombre1']) . ' ' . strtoupper($_POST['nombre2']);
   $full_name = $apel_comp . ' ' . $nom_comp;

   $rif = $_POST['tprif'] . $_POST['rif'];
   $nrodoc = $_POST['tpdoc'] . $_POST['nrodoc'];

   $fnacimiento = $_POST['fnacimiento'];
   $edad = $_POST['edad'];
   $idsexo = $_POST['idsexo'];
   $idestcivil = $_POST['idestcivil'];

   $movilcom = $_POST['movil'];
   $cod_area = substr($movilcom, 0, 4);// Operadora
   $movil = substr($movilcom, 4); //Movil
   $telefono = $_POST['telefono'];
   $correo = $_POST['correo'];
   $correoalt = $_POST['correoalt'];

   $idpais = $_POST['idpais'];
   $idestado = $_POST['idestado'];
   $idmunicipio = $_POST['idmunicipio'];
   $idparroquia = $_POST['idparroquia'];

   $direccion_comple = strtoupper($_POST['urbanizacion']) .' '. strtoupper($_POST['calleav']) .' '. 'Casa:'.' '. $_POST['casaedif'] .' '. 'Piso:' .' '. $_POST['piso'].' '. 'Oficina:'.' '. $_POST['oficina'];

   $codpostal = $_POST['codpostal'];

   $str = "INSERT INTO loginn (idlogin, nombres, apellidos, fullname, cedula, correo, usuario, telefono, movil, direccion, cargo, nombrecargo, clave, privilegios, idtrabajacon, trabajacon, estatus, imagen) 
   VALUES (NULL, '$nom_comp', '$apel_comp', '$full_name', '$nrodoc', '$correo', '$correo', '$telefono', '$movilcom', '$direccion_comple', 'MEDICO', 'MEDICO', '123','2','0', 'MEDICO', 'A', '1.jpg');";
   $conexion = $mysqli->query($str);

   $sqllast = ("SELECT max(idlogin) from loginn;");
   $objlast = $mysqli->query($sqllast);
   $arrlast = $objlast->fetch_array();
   $idlogin = $arrlast[0];

   $str = "INSERT INTO medicos (idmed, idlogin, idcomp, nrodoc, codcolemed, mpss, rif, nombre1, nombre2, apellido1, apellido2, fnacimiento, edad, idsexo, idestcivil, operadora, movil, codarea, telefono, correo, correoalt, idpais, idestado, idmunicipio, idparroquia, correoppal, calleav, casaedif, piso, oficina, urbanizacion, codpostal, dirnovzla, codpostalnovzla, idestatus)
   VALUES (NULL, '$idlogin', '0', '$nrodoc', '000000' , '000000' ,'$rif', '".strtoupper($_POST['nombre1'])."', '".strtoupper($_POST['nombre2'])."', '".strtoupper($_POST['apellido1'])."', '".strtoupper($_POST['apellido2'])."', '$fnacimiento', '$edad', '$idsexo', '$idestcivil','$cod_area', '$movil','0212', '$telefono', '$correo', '$correoalt', '$idpais', '$idestado', '$idmunicipio', '$idparroquia', '$correo', '".strtoupper($_POST['calleav'])."','". $_POST['casaedif'] ."', '". $_POST['piso']."', '".$_POST['oficina']."', '".strtoupper($_POST['urbanizacion'])."', '$codpostal', 'NO APLICA', '0000', '1' );";
   $conexion = $mysqli->query($str);

if($conexion){
	echo "1";
}else{
	echo "0";
}
?>