<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$iidaseg=$_POST['iidaseg'];
	$sql="SELECT a.idservaf, a.servicio FROM serviciosafiliados a	
	WHERE a.idservaf IN(select b.idservaf FROM segurosserv b WHERE b.idaseg='".$iidaseg."' );";//echo $str; exit();
	//echo $iidaseg;
	$ln=0;
	$result = $mysqli->query($sql);
	$tabla='<table id="tablaservicios" class="table w-auto text-xsmall" border="1">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Servicio</th>
		      <th scope="col">Eliminar</th>
		    </tr>
		  </thead>';
	while ($row = mysqli_fetch_array($result)) {$ln++;
		$tabla.='
		  <tbody>
		    <tr>
		      <th scope="row">'.$ln.'</th>
		      <td>'.$row['servicio'].'</td>
		      <td class="project-actions text-center"><a class="btn btn-danger btn-sm" title="Eliminar Servicio" 
		      onclick="fdelserv('.$iidaseg.','.$row["idservaf"].')" ><i class="fas fa-trash"></i> </a></td>
		    </tr>
		  </tbody>
		</table>';
	}
echo $tabla;
?>