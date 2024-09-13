<?php 
require('../../conf/conexion.php');
if(isset($_GET['idlin'])){
    $idcconta=$_GET['idlin'];
    $idclinica=$_GET['idcli'];
    $sql="DELETE FROM clinicas_contacto WHERE idcontacto='".$idcconta."' ";
    $query=$mysqli->query($sql);	
    echo '<script language="javascript">alert("¡Registro Eliminado!");
    window.location.href="../../html/updclicontacto.php?id='.$idclinica.'"; </script>';
} 
