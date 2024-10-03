<?php 
if($privilegios == 2){
    $a="SELECT CASE WHEN H.nrohistoria IS NULL THEN 'S/H' ELSE H.nrohistoria END AS num_histo, P.idpaci,P.idmed,
        CONCAT(P.apellido1,' ', P.nombre1) AS nom_paci, P.cedula, P.movil AS celular, P.correo,  DATE(P.fecreg) AS fecreg
        FROM pacientes P
         LEFT JOIN historias H ON P.idpaci = H.idpaci
         WHERE P.idmed = $idmedico";
        $ares=$mysqli->query($a);
        $data = array();
        while($row = $ares->fetch_assoc()){
            $data[] = $row;
        }
}elseif($privilegios == 1){
    $a="SELECT CASE WHEN H.nrohistoria IS NULL THEN 'S/H' ELSE H.nrohistoria END AS num_histo, P.idpaci,P.idmed,
    CONCAT(P.apellido1,' ', P.nombre1) AS nom_paci, P.cedula, P.movil AS celular, P.correo, CONCAT(M.apellido1,' ', M.nombre1) AS nom_med, 
    DATE(P.fecreg) AS fecreg
    FROM pacientes P
    LEFT JOIN medicos M ON P.idmed = M.idmed
    LEFT JOIN historias H ON P.idpaci = H.idpaci
    ";
    $ares=$mysqli->query($a);
    $data = array();
    while($row = $ares->fetch_assoc()){
        $data[] = $row;
    }
}else{
    $a="SELECT CASE WHEN H.nrohistoria IS NULL THEN 'S/H' ELSE H.nrohistoria END AS num_histo, P.idpaci, P.idmed, M.idlogin,
    L.idtrabajacon, CONCAT(P.apellido1,' ', P.nombre1) AS nom_paci, P.cedula, P.movil AS celular, 
    P.correo,  DATE(P.fecreg) AS fecreg
    FROM pacientes P
    LEFT JOIN historias H ON P.idpaci = H.idpaci
    LEFT JOIN medicos M ON P.idmed = M.idmed
    INNER JOIN loginn L ON L.idtrabajacon = M.idlogin
    WHERE L.idlogin = $idlogin";
    $ares=$mysqli->query($a);
    $data = array();
    while($row = $ares->fetch_assoc()){
        $data[] = $row;
    }
}
?>