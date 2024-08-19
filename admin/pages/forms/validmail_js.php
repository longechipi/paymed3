<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$idlogin=$_POST['idlogin']; // id del medico
	$correo =$_POST['correo'];
	/* Busco idmed */
	$sqlmed = ("SELECT idmed FROM medicos  WHERE idlogin='".$idlogin."'; ");
	$objmed=$mysqli->query($sqlmed); $arrmed=$objmed->fetch_array(); $idmed=$arrmed[0];
	/* busco tbl */
	$sql = ("SELECT count(*) as hay FROM loginn  WHERE correo='".$correo."'; ");
	$obj=$mysqli->query($sql); $arr=$obj->fetch_array(); $hay=$arr[0];

	if ($hay!='0') { //Si esta verifico cargo
		$sql1 = ("SELECT count(*) as hay1, idasist FROM asistentes  WHERE correo='".$correo."'; ");
    	$obj1=$mysqli->query($sql1); $arr1=$obj1->fetch_array(); $hay1=$arr1[0];$idasist=$arr1[1];
    	if ($hay1!='0') { //Verifico Si es asistente
    		$sqlestaasist = ("SELECT count(*) as esta FROM medicosxasist  
    					WHERE idasist='".$idasist."' AND idmed='".$idmed."'; ");
    		$objestaasist=$mysqli->query($sqlestaasist); $arrestaasist=$objestaasist->fetch_array(); 
    		$yaregistrado=$arrestaasist[0];
    		if ($yaregistrado!='0') { //Verifico Si es asistente ya registrado con el mismo medico(logeado)
    			$hay='1';	
    		}else{
    			$hay='0';	
    		}
    	}
	}
	//$conex=$mysqli->query($sql);
    /*    */
	echo $hay;
?>