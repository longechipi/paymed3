<?php 
require('../../conf/conexion.php');
if(isset($_GET['idsex'])){
    $idsex=$_GET['idsex'];
    $sql="DELETE FROM sexo WHERE idsexo='".$idsex."' ";
    //echo $sql;exit();
    $query=$mysqli->query($sql);	
    echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="../../html/rpt_sexo.php"; </script>';
} 
?>