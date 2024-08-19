<?php
	date_default_timezone_set('America/Caracas');
	require('../../conexion.php');
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	//$fecha_actual = strtotime(date("Y-m-d"));
    $idcita = $_POST['idcita'];
	//$fechacita = $_POST['fechacita'];
    $sql = ("SELECT fechacita, idmed, idclinica FROM citas WHERE idcita='".$idcita."'");
    $obj = $mysqli->query($sql); $arr = $obj->fetch_array();
    $fechacita =strtotime($arr['fechacita']);
    $idmed =$arr['idmed'];$idclinica =$arr['idclinica'];
    $fecha_actual = strtotime(date("Y-m-d")); 

    //$diahoy = date("w", strtotime($fechacita));

    $fechacitadate=date_create($arr['fechacita']);
    $fechacitadate=date_format($fechacitadate,"Y-m-d");

    //$dia_semana_en = date("w", strtotime($fechacitadate));
    $diacitasolicitada= $dias[date("w", strtotime($fechacitadate))]; // busca nombre del dia de la cita
    //echo $diacitasolicitada.'--'.$idmed.'--'.$idclinica;exit();
    $diahoy=$dias[date('w')];
    $sqlatiende = ("SELECT idhorario FROM  horariomed  
    		WHERE idmed='".$idmed."' AND idclinica='".$idclinica."' AND dia='".$diahoy."';");

    $result=$mysqli->query($sqlatiende);$row_cnt = $result->num_rows;
    if($row_cnt == '0'){ //No atiene el dia hoy
    	echo "99";exit();
    }
    if($fechacita > $fecha_actual){
        echo "1";
    }else {
        echo "0";
    }
    //$fecha_entrada = strtotime($fechacita); echo $fecha_actual.'--'.$fecha_entrada;	exit();

    //$day = date("l", strtotime($fechacita));
	
	/*$fecha_actual = strtotime(date("Y-m-d")); $fecha_entrada = strtotime($fechaconsulta);
	echo $fecha_actual.'--'.$fecha_entrada;	exit();
	if($fecha_entrada < $fecha_actual){	echo '00'; exit();} */
	/* ------------------------- -------------------------- ----------------------- --------------------*/
	//$sql = ("SELECT dia, desde, hasta FROM  horariomed  where idmed='".$idmed."' AND dia='".$dia."';");
	//$result=$mysqli->query($sql);$row_cnt = $result->num_rows;if($row_cnt == '0'){ // Virifica si es dia de consulta

?>