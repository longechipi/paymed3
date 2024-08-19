<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$rif=$_POST['rif'];
	$sql=("SELECT count(*) as hay FROM proveedores WHERE rif='".$rif."'; ");
	$obj=$mysqli->query($sql); $arr=$obj->fetch_array(); $hay=$arr[0];
	if ($hay!='0') {
		echo '1';
	}else{
		echo '0';
	}
?>