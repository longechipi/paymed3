<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');

		$registrados=0;
		$idpresu =$_POST['idpresu'];
		$idesp   =$_POST['idesp'];
		$acto    =$_POST['acto'];
		$idpaci  =$_POST['idpaci'];
		$nro     =$_POST['nro'];

	$sql = ("SELECT idbaremo
             FROM presupuesto_baremo
             WHERE codproced='".$acto."'");
		$result=$mysqli->query($sql); $row = mysqli_fetch_array($result);
		$idbaremo=$row['idbaremo'];

	$sqlc = ("SELECT COUNT(idviabordaje) as hay
              FROM presupuesto_vias_abordaje
              WHERE idpresupuesto='".$idpresu."' AND nro_via='1'");
		$resultc=$mysqli->query($sqlc); $rowc = mysqli_fetch_array($resultc);
		$registrados=$rowc['hay'];
			//echo $registrados;exit;

		if($registrados==3)
			{

					echo '<script language="javascript">
								alert("¡Excedió MAXIMO de actos quirúrgicos para un presupuesto!");
						        window.location.href="updpresu_vias_abordaje.php?idpac='.$idpaci.'"; 
						  </script>';
			}
		else 
			{
				$c=0; 
				$str="INSERT INTO presupuesto_vias_abordaje 
								   (idpresupuesto, 
								   	nro_via,
									idbaremo) 
					   		VALUES ('".$idpresu."',
					   				'".$nro."',
					   				'".$idbaremo."')";
					$conexion=$mysqli->query($str);

				$sqlc = ("SELECT a.idviabordaje,a.idpresupuesto,a.idbaremo,b.idbaremo,b.costo
			              FROM presupuesto_vias_abordaje a, presupuesto_baremo b
			              WHERE a.idpresupuesto='".$idpresu."' AND 
			              	    a.idbaremo=b.idbaremo AND
			              	    a.nro_via='1'
			              ORDER BY b.costo DESC");
					$resultc=$mysqli->query($sqlc);
					while($row = mysqli_fetch_array($resultc)) 
						{
							$c=$c+1;
							$prc=0;$per_costo=0;$costo_mod=0;

							if($c==1){$prc=100;}
							elseif($c==2){$prc=50;}
							elseif($c==3){$prc=40;}

							$per_costo=($row['costo']*$prc)/100;
							//$costo_mod=$row['costo']+$per_costo;
							$str = "UPDATE presupuesto_vias_abordaje 
									SET percent='".$prc."', 
										costo_mod='".$per_costo."' 
							        WHERE idviabordaje= '".$row['idviabordaje']."'";
							   $conexion = $mysqli->query($str);
						}
					echo '<script language="javascript">//alert("¡Registro Exitoso!");
						        window.location.href="updpresu_vias_abordaje.php?idpac='.$idpaci.'"; 
						  </script>';
			}


?>		