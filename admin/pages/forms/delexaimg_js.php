<?php  
	require('../../conexion.php');
	$idtbl = $_POST['id']; $idpac= $_POST['idpac']; $idcita= $_POST['idcita']; $tipo= $_POST['tipo'];
    //Eliminar de tabla examenesx  */
    $sqldel=("DELETE FROM examenesx WHERE idtbl='".$idtbl."' AND idpac='".$idpac."' AND idcita='".$idcita."' AND tipo='".$tipo."';");
	$conex=$mysqli->query($sqldel); //$arrhora=$objhora->fetch_array(); $desde=$arrhora[0];
	
	/* Busco examenes, si tiene para armar la Tabla de Nuevo  */
    $sqlbusca=("SELECT a.idexam, b.estudio, a.idpac, a.idcita, a.tipo, a.idtbl 
				FROM examenesx a, servimage b
				WHERE a.idtbl=b.idimage	AND idpac='".$idpac."' AND idcita='".$idcita."' AND tipo='".$tipo."';");
    
	$objbusca=$mysqli->query($sqlbusca); //$arrhora=$objhora->fetch_array(); $desde=$arrhora[0];
	$arr='';
	while ($row = mysqli_fetch_array($objbusca)) {
        $arr.=$row['idtbl'].';'.trim($row['estudio']).'|';
    }
    //echo "$consultas,$arrdesde|$htmlpacientes";
    echo "$arr";
?>