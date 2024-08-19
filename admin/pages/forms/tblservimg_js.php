<?php 
	require('../../conexion.php');
	$codserv=$_POST['codserv'];$codzona=$_POST['codzona'];
	$sql = ("SELECT idimage, codserv, servicio, codzona, zona, codestudio, estudioori, estudio, idestatus FROM servimage 
        WHERE codserv='".$codserv."'  AND codzona='".$codzona."' AND idestatus in(1,2) ");	
	$result = $mysqli->query($sql);
	$html="";
    $html.=" <tbody id='tblistado'>";
    while ($row = mysqli_fetch_array($result)) {
		$html.="    <tr>";
		$html.="    	<td>".$row['idimage']."</td>";
		$html.="        <td>".$row['servicio']."</td>";
		$html.="        <td>".$row['zona']."</td>";
		$html.="        <td>".$row['estudio']."</td>
						<td>Activo</td>";
		$html.="        <td class='project-actions text-right'>";
		$html.="           <a class='btn btn-info btn-sm' href='upd_servimg.php?id=".$row['idimage']."><i class='fas fa-pencil-alt'></i> Editar</a>";
		
		$html.="			</td>";
		$html.="    </tr>";
	}
    $html.="</tbody>";
	echo $html;
?>