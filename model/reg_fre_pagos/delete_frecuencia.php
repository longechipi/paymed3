<?php 
require('../../conf/conexion.php');
if(isset($_GET['idfrecuencia'])){
    $idfrecuencia=$_GET['idfrecuencia'];
    $sql="DELETE FROM frecuenciapago WHERE idfq='".$idfrecuencia."'";
    $query=$mysqli->query($sql);	
    echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="../../html/rpt_frecuencia.php"; </script>';
} 
?>