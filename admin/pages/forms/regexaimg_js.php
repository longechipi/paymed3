<?php  // Registra datos de los examenes, laboratorio, etc
	require('../../conexion.php');
	date_default_timezone_set('America/Caracas');
	$idpac = $_POST['idpac'];$idcita = $_POST['idcita'];$tipo = $_POST['tipo'];
	if($tipo =='Imagenologia' ){ // Examen de imagenologia
		$codserv = $_POST['codserv'];$codzona = $_POST['codzona'];$codestudio = $_POST['codestudio'];
		$sql=("SELECT idimage FROM servimage WHERE codserv='".$codserv."' AND codzona='".$codzona."' AND codestudio='".$codestudio."';");
		$obj=$mysqli->query($sql);	$arr=$obj->fetch_array(); 	$idimage=$arr[0];
	}else if ($tipo =='Laboratorio') { // Para Examenes Laboratorios
		$idimage = $_POST['idlab'];
	}
	/* Busco si el Examen ya esta Registrado, else inserto */
	$sqlesta=("SELECT count(*) as hay FROM examenesx 
		WHERE idtbl='".$idimage."' AND idpac='".$idpac."' AND idcita='".$idcita."' AND tipo='".$tipo."';");
		$objesta=$mysqli->query($sqlesta);	$arresta=$objesta->fetch_array(); 	$esta=$arresta[0];
	if ($esta=='0') {
		//Inserto en la tabla de todos los Examenes */
	    $sqlreg=("INSERT INTO examenesx(idexam, idpac, idcita, tipo, idtbl, idestatus) 
	    				VALUES (null, '".$idpac."','".$idcita."','".$tipo."','".$idimage."','1');");   				
		$conex=$mysqli->query($sqlreg); //$arrhora=$objhora->fetch_array(); $desde=$arrhora[0];
	    //echo "$consultas,$arrdesde|$htmlpacientes";
	    echo "$idimage";
	}else{
		echo "0";
	}
?>