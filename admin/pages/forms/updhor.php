<?php 
	session_start();
	require('../../conexion.php');
	$usuario=$_SESSION['usuario'];
	$idlogin=$_SESSION['idlogin'];
	/* Recibo Variables y las asignos */
	$idmed		= $_POST['idmed'];
	$idclinica	= $_POST['idclinica'];

	$pacxdia 	= $_POST['pacxdia'];
	$pacconseg 	= $_POST['pacconseg'];
	$pacsinseg 	= $_POST['pacsinseg'];
	$consultorio= $_POST['consultorio'];
	$piso	 	= $_POST['piso'];
	$telefono1	= $_POST['telefono1'];
	$telefono2	= $_POST['telefono2'];
	// Actualizo Encabezado de Horario
	$strupd=("UPDATE clinicamedico SET pacxdia='".$pacxdia."', pacconseg='".$pacconseg."', pacsinseg='".$pacsinseg."', 
			consultorio='".$consultorio."', piso='".$piso."', telefono1='".$telefono1."', telefono2='".$telefono2."'
			WHERE idclinica='".$idclinica."' AND idmed='".$idmed."';");
	$conex=$mysqli->query($strupd);

	// hacer try and catch
	// Elimino todo en horario para insertar nuevos valores
	$strdel=("DELETE FROM horariomed WHERE idclinica='".$idclinica."' AND idmed='".$idmed."';");
	$obje=$mysqli->query($strdel);

	if (isset($_POST['dlunes']) && isset($_POST['hlunes'])  && $_POST['dlunes']!='' && $_POST['hlunes']!='') {
		$dlunes	= $_POST['dlunes'];$hlunes	= $_POST['hlunes'];
		$strins=("INSERT INTO horariomed(idhorario, idmedcli, idclinica, idmed, dia, desde, hasta, idestatus) 
				VALUES (null,'0','".$idclinica."','".$idmed."','Lunes','".$dlunes."','".$hlunes."','1') ");
		$obje=$mysqli->query($strins);
	}

	if (isset($_POST['dmartes']) && isset($_POST['hmartes'])  && $_POST['dmartes']!='' && $_POST['hmartes']!='') {
		$dmartes= $_POST['dmartes'];$hmartes	= $_POST['hmartes'];
		$strins=("INSERT INTO horariomed(idhorario, idmedcli, idclinica, idmed, dia, desde, hasta, idestatus) 
				VALUES (null,'0','".$idclinica."','".$idmed."','Martes','".$dmartes."','".$hmartes."','1') ");
		$obje=$mysqli->query($strins);
	}

	if (isset($_POST['dmiercoles']) && isset($_POST['hmiercoles'])  && $_POST['dmiercoles']!='' && $_POST['hmiercoles']!='') {
		$dmiercoles	= $_POST['dmiercoles'];$hmiercoles	= $_POST['hmiercoles'];
		$strins=("INSERT INTO horariomed(idhorario, idmedcli, idclinica, idmed, dia, desde, hasta, idestatus) 
				VALUES (null,'0','".$idclinica."','".$idmed."','Miercoles','".$dmiercoles."','".$hmiercoles."','1') ");
		$obje=$mysqli->query($strins);
	}
	if (isset($_POST['djueves']) && isset($_POST['hjueves'])  && $_POST['djueves']!='' && $_POST['hjueves']!='') {
		$djueves= $_POST['djueves'];$hjueves= $_POST['hjueves'];
		$strins=("INSERT INTO horariomed(idhorario, idmedcli, idclinica, idmed, dia, desde, hasta, idestatus) 
				VALUES (null,'0','".$idclinica."','".$idmed."','Jueves','".$djueves."','".$hjueves."','1') ");
		$obje=$mysqli->query($strins);
	}
	
	if (isset($_POST['dviernes']) && isset($_POST['hviernes'])  && $_POST['dviernes']!='' && $_POST['hviernes']!='') {
		$dviernes= $_POST['dviernes'];$hviernes	= $_POST['hviernes'];
		$strins=("INSERT INTO horariomed(idhorario, idmedcli, idclinica, idmed, dia, desde, hasta, idestatus) 
				VALUES (null,'0','".$idclinica."','".$idmed."','Viernes','".$dviernes."','".$hviernes."','1') ");
		$obje=$mysqli->query($strins);  
	}

	if (isset($_POST['dsabado']) && isset($_POST['hsabado']) && $_POST['dsabado']!='' && $_POST['hsabado']!='') {
		$dsabado= $_POST['dsabado'];$hsabado= $_POST['hsabado'];
		$strins=("INSERT INTO horariomed(idhorario, idmedcli, idclinica, idmed, dia, desde, hasta, idestatus) 
				VALUES (null,'0','".$idclinica."','".$idmed."','Sabado','".$dsabado."','".$hsabado."','1') ");
				//echo $strins; exit();
		$obje=$mysqli->query($strins);
	}

	if (isset($_POST['ddomingo']) && isset($_POST['hdomingo']) && $_POST['ddomingo']!='' && $_POST['hdomingo']!='') {
		$ddomingo	= $_POST['ddomingo'];$hdomingo	= $_POST['hdomingo'];
		$strins=("INSERT INTO horariomed(idhorario, idmedcli, idclinica, idmed, dia, desde, hasta, idestatus) 
				VALUES (null,'0','".$idclinica."','".$idmed."','Domingo','".$ddomingo."','".$hdomingo."','1') ");
		$obje=$mysqli->query($strins);
	}
//echo '<script language="javascript">alert("¡Actualización Exitosa!");window.location.href="medctas.php?id='.$idmed.'"; </script>';
	echo '<script language="javascript">alert("¡Actualización Exitosa!");window.location.href="rpt_horar.php"; </script>';
	
?>