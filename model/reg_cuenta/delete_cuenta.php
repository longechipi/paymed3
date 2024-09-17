<?php
require('../../conf/conexion.php');
if(isset($_GET['idtc'])){
    $idtc=$_GET['idtc'];
    $sql="DELETE FROM tipocuenta WHERE idtipocuenta='".$idtc."'";
    //echo $sql;exit();
    $query=$mysqli->query($sql);
    echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="../../html/rpt_tipocuenta.php"; </script>';
}
?>