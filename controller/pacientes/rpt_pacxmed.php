<?php 
if($privilegios == 2){
    $a="SELECT CASE WHEN H.nrohistoria IS NULL THEN 'S/H' ELSE H.nrohistoria END AS num_histo, P.idpaci,P.idmed,
        CONCAT(P.apellido1,' ', P.nombre1) AS nom_paci, P.cedula, CONCAT(P.operadora, '', P.movil) AS celular, P.correo
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
    CONCAT(P.apellido1,' ', P.nombre1) AS nom_paci, P.cedula, CONCAT(P.operadora, '', P.movil) AS celular, P.correo
    FROM pacientes P
     LEFT JOIN historias H ON P.idpaci = H.idpaci";
    $ares=$mysqli->query($a);
    $data = array();
    while($row = $ares->fetch_assoc()){
        $data[] = $row;
    }
}else{
    $a="SELECT CASE WHEN H.nrohistoria IS NULL THEN 'S/H' ELSE H.nrohistoria END AS num_histo, P.idpaci, P.idmed, M.idlogin,
    L.idtrabajacon, CONCAT(P.apellido1,' ', P.nombre1) AS nom_paci, P.cedula, CONCAT(P.operadora, '-', P.movil) AS celular, 
    P.correo
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