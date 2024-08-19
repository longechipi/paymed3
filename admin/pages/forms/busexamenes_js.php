<?php  // busco datos de los examenes, laboratorio
	require('../../conexion.php');
	date_default_timezone_set('America/Caracas');
	$idpac = $_POST['idpac'];$idcita = $_POST['idcita'];
	/* Busco idcita y idpaci, saber que tipo de examenes tiene */
	$sqlexamen = ("SELECT tipo, idtbl FROM examenesx WHERE idpac='".$idpac."' and idcita='".$idcita."';");
	$objexamen = $mysqli->query($sqlexamen); //$arrexamen = $objexamen->fetch_array();
	//$idpaci = $arrexamen['idpac'];$tipo = $arrexamen['tipo'];
	$datos = array();
	while ($row = mysqli_fetch_array($objexamen)) {
  		$tipo = $row['tipo'];
  		$idtbl = $row['idtbl'];
  		//$nombreexamen='xvaina';
  		if ($tipo=='Laboratorio') {  //busco nombre del examen
  			$sqllab = ("SELECT nombre FROM laboratorios WHERE idlab='".$idtbl."';");
  			$objlab = $mysqli->query($sqllab); $arrlab = $objlab->fetch_array();
			$nombreexamen = $arrlab['nombre']; //$tipo = $arrexamen['tipo'];
  		}elseif ($tipo=='Imagenologia') {
  			$sqlimg = ("SELECT estudio FROM servimage WHERE idimage='".$idtbl."';");
  			$objimg = $mysqli->query($sqlimg); $arrimg = $objimg->fetch_array();
			$nombreexamen = $arrimg['estudio']; //$tipo = $arrexamen['tipo'];
  		}

  		$datos[] = array('tipo' => $tipo, 'idtbl' => $idtbl, 'nombreexamen' => $nombreexamen);
  		//$datos[] = array('tipo' => $tipo, 'idtbl' => $idtbl);
}
	echo json_encode($datos); exit();
	//echo $idpaci.'-'.$tipo; exit();
/*
	if($tipo =='Imagenologia' ){ // Examen de imagenologia
		$codserv = $_POST['codserv'];$codzona = $_POST['codzona'];$codestudio = $_POST['codestudio'];
		$sql=("SELECT idimage FROM servimage WHERE codserv='".$codserv."' AND codzona='".$codzona."' AND codestudio='".$codestudio."';");
		$obj=$mysqli->query($sql);	$arr=$obj->fetch_array(); 	$idimage=$arr[0];
	}else if ($tipo =='Laboratorio') { // Para Examenes Laboratorios
		$idimage = $_POST['idlab'];
	}
	/* Busco si el Examen ya esta Registrado, else inserto * /
	$sqlesta=("SELECT count(*) as hay FROM examenesx 
		WHERE idtbl='".$idimage."' AND idpac='".$idpac."' AND idcita='".$idcita."' AND tipo='".$tipo."';");
		$objesta=$mysqli->query($sqlesta);	$arresta=$objesta->fetch_array(); 	$esta=$arresta[0];
	if ($esta=='0') {
		//Inserto en la tabla de todos los Examenes * /
	    $sqlreg=("INSERT INTO examenesx(idexam, idpac, idcita, tipo, idtbl, idestatus) 
	    				VALUES (null, '".$idpac."','".$idcita."','".$tipo."','".$idimage."','1');");   				
		$conex=$mysqli->query($sqlreg); //$arrhora=$objhora->fetch_array(); $desde=$arrhora[0];
	    //echo "$consultas,$arrdesde|$htmlpacientes";
	    echo "$idimage";
	}else{
		echo "0";
	}*/

?>