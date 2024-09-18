<?php 
require('../../conf/conexion.php');
$quees=$_POST['quees'];
	$nro=$_POST['nro'];
	$nroriginal=$_POST['nroriginal'];
	if($quees=='1') {
		$sql = ("SELECT count(*) as hay FROM medicos a WHERE a.rif='".$nro."' 
			and a.rif not in(SELECT b.rif from medicos b where b.rif='".$nroriginal."' ); ");
	}else if($quees=='2') {
		$sql = ("SELECT count(*) as hay FROM medicos a WHERE a.nrodoc='".$nro."' 
			and a.nrodoc not in(SELECT b.nrodoc from medicos b where b.nrodoc='".$nroriginal."');");
	}else if($quees=='3') {
		$sql = ("SELECT count(*) as hay FROM medicos WHERE correo='".$nro."' ;");
	}

	$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
    $hay=$arr[0];
	//$conex=$mysqli->query($sql);
    /*    */
	echo $hay;
    ?>