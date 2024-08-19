<?php
	require('../../conexion.php');
	date_default_timezone_set('America/Caracas');
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$idmed = $_POST['idmed'];$idclinica = $_POST['idclinica'];$fechaconsulta = $_POST['fechaconsulta'];
	$fechaaux=substr($fechaconsulta,0,10);
	//$fecha = "2018-03-29 15:20:40";
	$dt = new DateTime($fechaaux);
	//print $dt->format('d/m/Y'); // imprime 29/03/2018
	$dianumber=$dt->format('w');  //print $dt->format('l'); // imprime 15:20:40
	$diaseleccionado=$dias[$dianumber]; // Convierto dia nombre del dia Ingles a Español
	$sqldiaselec=("SELECT count(*) as diadecita FROM horariomed 
		   WHERE idmed='".$idmed."' AND idclinica='".$idclinica."' AND dia='".$diaseleccionado."';");
	$objdiaselec=$mysqli->query($sqldiaselec);	$arrdiaselec=$objdiaselec->fetch_array(); 	$haydiadecita=$arrdiaselec[0];
	if ($haydiadecita=='0') {echo '0'; exit();} // La Clinica No Trabaja el dia Seleccionado
	
	$sql=("SELECT count(*) as consultas FROM citas WHERE idmed='".$idmed."' AND idclinica='".$idclinica."' AND fechacita='".$fechaconsulta."';");
	$obj=$mysqli->query($sql);	$arr=$obj->fetch_array(); 	$consultas=$arr[0];
    //if ($consultas=='0') { //si no hay consultas para ese dia, busco en la tabla horario, hora de inicio */
    	$sqlhora=("SELECT desde FROM horariomed WHERE idmed='".$idmed."' AND idclinica='".$idclinica."' LIMIT 1;");
		$objhora=$mysqli->query($sqlhora); $arrhora=$objhora->fetch_array(); $desde=$arrhora[0];
		/* Ciclo de Horario */
		$arrdesde='';
		$desde=strtotime($desde);
		$desde = strtotime ( '-30 minute' , $desde );
		for ($x = 0; $x <= 14; $x++) {
			$desde = strtotime ( '+30 minute' , $desde );
			$desde   = date ( 'H:i' , $desde );
			/*  Busco si hay Consulta para ese dia y hora   */
			$sql=("SELECT count(*) as horaconsulta FROM citas 
				WHERE idmed='".$idmed."' AND idclinica='".$idclinica."' AND fechacita='".$fechaconsulta."' AND horacita='".$desde."' ;");
			$obj=$mysqli->query($sql);	$arr=$obj->fetch_array(); 	$horaconsulta=$arr[0];
			if ($horaconsulta=='0') {	
				$arrdesde.=$desde.',';
			}	
			$desde=strtotime($desde);
		}
		/* */
		$sqlpacxdia=("SELECT concat(apellido,' ',nombre) as allname, horacita FROM citas WHERE idmed='".$idmed."' AND idclinica='".$idclinica."' AND fechacita='".$fechaconsulta."';");
		$objpacxdia=$mysqli->query($sqlpacxdia);
		$ln='0';
		$htmlpacientes='';
		while ($row = mysqli_fetch_array($objpacxdia)) {$ln++;
			if($ln%2==0){
				$htmlpacientes.="<li class='list-group-item list-group-item-primary'>".$row[1]."--".$row[0]."</li>";
			}else{
				$htmlpacientes.="<li class='list-group-item list-group-item-success'>".$row[1]."--".$row[0]."</li>";
			}
			
		}
		/* */
    	//echo "$consultas,$arrdesde";
    	echo "$consultas,$arrdesde|$htmlpacientes";
?>