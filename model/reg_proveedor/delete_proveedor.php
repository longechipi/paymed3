<?php
require('../../conf/conexion.php');
if(isset($_GET['id'])){
    $idtppr=$_GET['id'];
    $sql="DELETE FROM tipoproveedor WHERE idtppr='".$idtppr."' ";
    //echo $sql;exit();
    $query=$mysqli->query($sql);	
    echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="../../html/rpt_tpprov.php"; </script>';
}