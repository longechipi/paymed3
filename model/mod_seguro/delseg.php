<?php 
require('../../conf/conexion.php');

if(isset($_GET['id'])){
    $idaseg=$_GET['id'];
    $sql="DELETE FROM aseguradores WHERE idaseg='".$idaseg."' ";
    //echo $sql;exit();
    $query=$mysqli->query($sql);	
    echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="../../html/rpt_seg.php"; </script>';
} 

?>