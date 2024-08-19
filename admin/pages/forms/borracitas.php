<?php //ALTER TABLE `consultas_med` ADD `fecharegistro` DATETIME NOT NULL COMMENT 'Fecha hora seg de registro' AFTER `idcita`;
//Borra las citas que paso 24 horas
$fechahoraactual = date("Y-m-d H:i:s"); $fechaactual = date("Y-m-d"); 
//$sqldelcitas = ("SELECT idregistro, idcita, fechadia, hora, fecharegistro FROM consultas_med WHERE fin!='1';");
$sqldelcitas = ("SELECT idregistro, idcita, fechadia, hora FROM consultas_med 
    WHERE fechadia<'".$fechaactual."' AND fin!='1';");
//echo $sqldelcitas; exit();
$objdelcitas = $mysqli->query($sqldelcitas);
//$rowdelcitas = mysqli_fetch_array($objdelcitas); //$idmed =$rowdelcitas['fechadia'];
//print_r($rowdelcitas);
while ($rowdelcitas = mysqli_fetch_array($objdelcitas)) {
    $idregistro=$rowdelcitas['idregistro'];
    $fecharegistro=$rowdelcitas['fechadia'];
    $fecharegistroensegundos=strtotime($fecharegistro);
    $fechaactualensegundos=strtotime($fechahoraactual);
    $segundosTranscurridos=$fechaactualensegundos-$fecharegistroensegundos;
    $diasTranscurridos = $segundosTranscurridos / 86400;
    $dias =floor($diasTranscurridos);
    //echo $fechaactual.'--'.$fecharegistro.'--'.$diasTranscurridos.'<br>';    echo $dias.'<br>';
    if ($dias>0) { // Paso 24 horas
        /* - - Marco con 9 los que se van a eliminar, ya que paso mas de 24horas - - */
        $str="UPDATE consultas_med SET fin='9' WHERE idregistro='".$idregistro."';";
        //echo $str.'<br>';
        $conexion=$mysqli->query($str);
    }
}
// Elimino Citas, tratamiento y examenes, ya que la consulta no fue registrada completa, despues 24 horas
$sqldelete = ("delete FROM examenesx where idcita in(SELECT idcita FROM consultas_med where fin='9');"); 
$conex = $mysqli->query($sqldelete);
$sqldelete = ("delete FROM consultas_trat where idcita in(SELECT idcita FROM consultas_med where fin='9');"); 
$conex = $mysqli->query($sqldelete);
$sqldelete = ("DELETE FROM consultas_med where fin='9';");  $conex = $mysqli->query($sqldelete);
?>