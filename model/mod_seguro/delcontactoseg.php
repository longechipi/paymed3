<?php 
require('../../conf/conexion.php');

$idcconta=$_GET['idlin'];
$idseguro=$_GET['idseg'];
$sql="DELETE FROM asegura_contacto WHERE idcontacto='".$idcconta."'";
$query=$mysqli->query($sql);	
echo '<script language="javascript">alert("¡Registro Eliminado!"); window.location.href="../../html/updsegcontacto.php?id='.$idseguro.'"; </script>';

?>