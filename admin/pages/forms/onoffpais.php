<?php
	require('../../conexion.php');
	if(isset($_GET['id'])){
		$idpais=$_GET['id'];
		$onoff=$_GET['onoff'];
		//echo $idpais.'--'.$onoff;
		if ($onoff=='x9') { // Desactivar
			$sql = ("UPDATE paises SET idestatus='2' WHERE idpais = '".$idpais."';");
		}elseif ($onoff=='x1') { // Activar
			$sql = ("UPDATE paises SET idestatus='1' WHERE idpais = '".$idpais."';");
		}
		$result=$mysqli->query($sql);
		echo '<script language="javascript">alert("¡Actualizado!");
              window.location.href="rpt_paises.php"; </script>';
	}

?>