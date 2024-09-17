<?php
require('../../conf/conexion.php');
if(isset($_GET['idtp'])){
    $idtp=$_GET['idtp'];
    $sql="DELETE FROM tipoempresa WHERE idtipoempresa='".$idtp."'";
    //echo $sql;exit();
    $query=$mysqli->query($sql);
    echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="../../html/rpt_tipoempresa.php"; </script>';
}
?>