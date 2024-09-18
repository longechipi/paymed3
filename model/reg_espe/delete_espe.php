<?php 
require('../../conf/conexion.php');
if(isset($_GET['idespmed'])){
    $idespmed=$_GET['idespmed'];
    $sql="DELETE FROM especialidadmed WHERE idespmed='".$idespmed."' ";
    $query=$mysqli->query($sql);
    echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="../../html/rpt_espmed.php"; </script>';
} 
?>