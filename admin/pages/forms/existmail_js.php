<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	//$idlogin=$_POST['idlogin']; // id del medico
	$correo =$_POST['correo'];
	/* Busco correo del asistente, si existe leo datos */
	$sqlasist = ("SELECT  nrodoc, apellidos, nombres, movil, correo, cargo, tpasist
			FROM asistentes  WHERE correo='".$correo."'; ");
	$objasist=$mysqli->query($sqlasist); $arrasist=$objasist->fetch_array(); 
	if(isset($arrasist[0])){ // Si Existe Asistente
		$nrodoc		=$arrasist['nrodoc'];
		$apellidos	=$arrasist['apellidos'];
		$nombres	=$arrasist['nombres'];
		$movil		=$arrasist['movil'];
		$cargo		=$arrasist['cargo'];
		$tpasist	=$arrasist['tpasist'];
		echo $nrodoc.'|'.$apellidos.'|'.$nombres.'|'.$movil.'|'.$cargo.'|'.$tpasist; exit();
	} 
	/* busco Login a ver si tiene registro <> Asistente  */
	$sqllogin = ("SELECT count(*) as hay FROM loginn  WHERE correo='".$correo."' and cargo not like '%Asistente%';");
	$objlogin=$mysqli->query($sqllogin); $arrlogin=$objlogin->fetch_array(); $hay=$arrlogin[0];
	if ($hay!='0') { 
		echo '99'; exit();	
	}

/*		$sql1 = ("SELECT count(*) as hay1, idasist FROM asistentes  WHERE correo='".$correo."'; ");
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
*/	
	//$conex=$mysqli->query($sql);
    /*    */
	echo '1';
?>