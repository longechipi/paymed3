<?php 
require('../../conf/conexion.php');

if(isset($_GET['idlin'])){
    $idcconta=$_GET['idlin'];
    $idseguro=$_GET['idseg'];
    $sql="DELETE FROM asegurador_servicios WHERE idasegserv='".$idcconta."' ";
    $query=$mysqli->query($sql);	
    echo '<script language="javascript">alert("¡Registro Eliminado!");
            window.location.href="../../html/updsegservicios.php?id='.$idseguro.'"; </script>';
} 

?>