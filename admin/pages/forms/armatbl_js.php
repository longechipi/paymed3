<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$idmed=$_POST['idmed'];
	/*Busco  Especialidades del Medico Seleccionado */
	//$sql = ("SELECT  c.idespmed, c.especialidad FROM medicos a, medicos_esp b, especialidadmed c
	//		WHERE a.idmed='".$idmed."' and a.idmed=b.idmed and b.idespmed =c.idespmed and a.idestatus='1';");
	$sql = ("SELECT  b.idespxmed, c.idesppresu, c.especialidad FROM medicos a, medicos_esp b, presupuesto_especialidades c
			WHERE a.idmed='".$idmed."' AND a.idmed=b.idmed AND b.idespmed =c.idesppresu AND a.idestatus!='2';");
	
	$objesp=$mysqli->query($sql); 
	$rowcounti=mysqli_num_rows($objesp);
	if ($rowcounti=='0') {
		echo '1';
	}else{
		$tabla='<table id="tblesp" class="table table-sm">
						  <thead>
							<tr>
							  <th scope="col">Especialidad Seleccionada</th>
							  <th scope="col"><center> <small style="color: #cb1010;font-weight: bold;">Borrar</small></center></th>
							</tr>
						  </thead>
						  <tbody>';
		while($row = mysqli_fetch_array($objesp)) {
			$tabla.='<tr id="'.$row['idespxmed'].'" onclick="fdel(this.id);"><td>'.$row['especialidad'].'</td><td style="background: red" align="center" ><p class="cursor-pointer"><i class="fa fa-trash"></i></p></td></tr>';

		}
		$tabla.='</tbody></table>';
		echo $tabla;
	}
?>