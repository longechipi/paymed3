<?php
	require('../../conexion.php');
	$cedula = $_POST['cedula'];
	//$cedula =rtrim($cedula,"");
	$sql = ("SELECT idpaci FROM pacientes WHERE cedula = '".$cedula."';");
	//$row_cnt =0;
	$result=$mysqli->query($sql);
    $row_cnt = $result->num_rows;
	if($row_cnt>0){echo '1';}else{echo '0';}
?>