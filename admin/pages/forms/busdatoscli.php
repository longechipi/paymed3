<?php 
	$sqldatoscli = ("SELECT b.idmed, b.idclinica, c.nombrecentrosalud, d.pais, e.estado, f.municipio, g.parroquia,
					c.casaedif, c.calleav, a.idclinica, a.idmed, a.pacxdia, a.pacconseg, a.pacsinseg, a.consultorio, a.piso, a.telefono1, a.telefono2, a.idestatus 
					FROM clinicamedico a, citas b, clinicas c, paises d, estado e, municipios f, parroquias g
					WHERE a.idclinica=b.idclinica
					and a.idmed=b.idmed and a.idclinica=c.idclinica
					AND c.idpais= d.idpais AND c.idestado=e.idestado AND c.idmunicipio = f.idmunicipio AND c.idparroquia =g.idparroquia
					AND b.idcita='".$rowhist['idcita']."';");
	//echo $sqldatoscli; exit();
    $objdatoscli=$mysqli->query($sqldatoscli);
    $rowdatoscli = mysqli_fetch_array($objdatoscli);
    $idmed_aux          =$rowdatoscli['idmed'];
    $idclinica_aux      =$rowdatoscli['idclinica'];
    $nombrecentrosalud	=$rowdatoscli['nombrecentrosalud'];
    $pais				=$rowdatoscli['pais'];
    $estado				=$rowdatoscli['estado'];
    $municipio			=$rowdatoscli['municipio'];
    $parroquia			=$rowdatoscli['parroquia'];
    $calleav            =$rowdatoscli['calleav'];
    $casaedif           =$rowdatoscli['casaedif'];
    $consultorio		=$rowdatoscli['consultorio'];
    $piso 				=$rowdatoscli['piso'];
    $telefono1 			=$rowdatoscli['telefono1'];
    $telefono2			=$rowdatoscli['telefono2'];

    // Busco los dias los dias que atiende y cual clinica
    $sqldiaatiende = ("SELECT idclinica, idmed, dia, desde, hasta FROM horariomed where idmed ='".$idmed_aux."' AND idclinica='".$idclinica_aux."';");
    //echo $sqldiaatiende; exit();
    $objdiaatiende=$mysqli->query($sqldiaatiende);
?>