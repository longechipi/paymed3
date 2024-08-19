<?php //ALTER TABLE `clinicamedico`  ADD `consultorio` VARCHAR(11) NOT NULL  AFTER `pacsinseg`,  ADD `piso` VARCHAR(7) NOT NULL  AFTER `consultorio`;
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$idclinica=$_POST['idclinica'];
	$idmed=$_POST['idmed'];
	if (isset($_POST['pacxdia'])) {
		$pacxdia=$_POST['pacxdia'];
		$pacconseg=$_POST['pacconseg'];
		$pacsinseg=$_POST['pacsinseg'];
		$consultorio=$_POST['consultorio'];
		$piso=$_POST['piso'];
		$telefono1=$_POST['telefono1'];
		$telefono2=$_POST['telefono2'];
	}
	if (isset($_POST['dia'])) {
		$dia=$_POST['dia'];
		$desde=$_POST['desde'];
		$hasta=$_POST['hasta'];
	}

	/*Busco id del Medico y Clinica, si existe no inserto */
	$sql = ("SELECT idclinica, idmed FROM clinicamedico WHERE idclinica='".$idclinica."'  AND idmed='".$idmed."'; ");

	$objclimed=$mysqli->query($sql); 
	$rowcount=mysqli_num_rows($objclimed);

	if ($rowcount==0) {
		/* Inserto */
		$sql = ("INSERT INTO clinicamedico(idmedcli, idclinica, idmed, pacxdia, pacconseg, pacsinseg, consultorio, piso, telefono1, telefono2, idestatus) 
			VALUES (null, '".$idclinica."','".$idmed."','".$pacxdia."','".$pacconseg."','".$pacsinseg."','".$consultorio."','".$piso."', '".$telefono1."','".$telefono2."', '1'); ");
		$conex=$mysqli->query($sql);
	}else{
		/*Inserto tbl horario */
		$sql = ("INSERT INTO horariomed(idhorario, idmedcli, idclinica, idmed, dia, desde, hasta, idestatus) 
			                    VALUES (null, '','".$idclinica."','".$idmed."','".$dia."','".$desde."','".$hasta."','1'); ");
		$conex=$mysqli->query($sql);
	}
?>