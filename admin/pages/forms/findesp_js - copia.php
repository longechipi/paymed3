<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$id=$_POST['id'];
	$idmed=$_POST['idmed'];
	/*Busco id del Medico y Especialidad, si existe no inserto */
	$sql = ("SELECT idespmed FROM medicos_esp WHERE idmed='".$idmed."'  AND idespmed='".$id."'; ");
	
	$objesp=$mysqli->query($sql); 
	$rowcounti=mysqli_num_rows($objesp);
	if ($rowcounti>0) {
		echo '1';
	}else{
		/*Inserto */
		$sql = ("INSERT INTO medicos_esp(idespxmed, idmed, idespmed, idestatus) VALUES (null, '".$idmed."','".$id."', '1'); ");
		$conex=$mysqli->query($sql);
		/* */
		$sqllast = ("SELECT max(idespxmed) from medicos_esp;");
	    $objlast=$mysqli->query($sqllast); $arrlast=$objlast->fetch_array();  
    	$medicos_esp=$arrlast[0];
	    /*    */
		$sql = ("SELECT especialidad FROM especialidadmed WHERE idespmed='".$id."'; ");
	    $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
	    $especialidad=$arr['especialidad'];
		echo $medicos_esp.';'.$especialidad; 
	}
?>