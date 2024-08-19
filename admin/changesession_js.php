<?php //ALTER TABLE `medicosxasist` CHANGE `onoff` `onoff` CHAR(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Si esta logeado';
	session_start();
	require('conexion.php');
	//$fecha=date('Y-m-d');
	$idmed=$_POST['idmed']; // id del medico
	$inputhide_usuario=$_POST['inputhide_usuario']; // usuario del asistente
	
	/* Busco id del asistente */
	$sqlasist = ("SELECT idasist FROM asistentes  WHERE correo='".$inputhide_usuario."'; ");
	$objasist=$mysqli->query($sqlasist); $arrasist=$objasist->fetch_array();
	$idasist=$arrasist[0];

	/* Busco idlogin del mededico */
	$sqllogin = ("SELECT idlogin FROM medicos  WHERE idmed='".$idmed."'; ");
	$objlogin=$mysqli->query($sqllogin); $arrlogin=$objlogin->fetch_array(); 
	$idloginmed=$arrlogin[0];
	$_SESSION['idloginmed']=$arrlogin[0];

	/* Busco id de medicosxasist */
	$sqlmedxasist = ("SELECT idmedxasis FROM medicosxasist WHERE idasist='".$idasist."' and idmed='".$idmed."'; ");
	$objmedxasist=$mysqli->query($sqlmedxasist); $arrmedxasist=$objmedxasist->fetch_array();
	$_SESSION['idmedxasis']=$arrmedxasist[0];

	// busco si el medico tiene deudas
	$sql=("SELECT a.fecinicio, a.fecfinal FROM regpagos a, medicos b WHERE a.idmed=b.idmed and b.idlogin='".$idloginmed."';");
	
	$arrcli    =$mysqli->query($sql);
	$rowcli    = mysqli_fetch_array($arrcli);
	if (!isset($rowcli['fecinicio'])) {
		$fecinicio='0000-00-00';
	}else{
		$fecinicio=$rowcli['fecinicio'];	
	}
	if (!isset($rowcli['fecfinal'])) {
		$fecfinal='0000-00-00';
	}else{
		$fecfinal=$rowcli['fecfinal'];
	}

	// Actualizo en medicosxasist, logeado
	$sqlonoff = ("UPDATE medicosxasist SET onoff='On' WHERE idasist='".$idasist."' and idmed='".$idmed."'; ");
	$cone=$mysqli->query($sqlonoff);
	echo $arrmedxasist[0].';'.$fecinicio.';'.$fecfinal;
?>