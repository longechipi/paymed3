<?php
require('../../conf/conexion.php');
if(isset($_GET['idservi'])){
    $idservi=$_GET['idservi'];
    $sql="DELETE FROM serviciosafiliados WHERE idservaf='".$idservi."' ";
    //echo $sql;exit();
    $query=$mysqli->query($sql);	
    echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="../../html/rpt_servafafiliados.php"; </script>';
} 