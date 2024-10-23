<?php 
require('../../conf/conexion.php');

//------- PARAMETRO DE BUSQUEDA DEL PACIENTE ------//
$dat_paci = $_POST['dat_paci'];
$cod_med = $_POST['cod_med'];

$a = "SELECT P.idpaci, P.idmed, P.cedula, CONCAT(P.apellido1, ' ', P.nombre1) AS nom_paci, 
CONCAT(P.operadora, '', P.movil) AS celular, P.correo
FROM pacientes P
WHERE (cedula LIKE '%$dat_paci%' OR CONCAT(P.apellido1, ' ', P.nombre1) LIKE '%$dat_paci%')
AND P.idmed = $cod_med
LIMIT 5 ";
$ares = $mysqli->query($a);
if ($ares->num_rows > 0) {
    echo '<h4 class="text-primary">Pacientes Registrados:</h4>';
    echo '<ul>';
    while ($row = $ares->fetch_assoc()) {
        $idpaci = $row['idpaci'];
        $idmed = $row['idmed'];
        $cedula = trim($row['cedula']);
        $nom_paci = $row['nom_paci'];
        $celular = $row['celular'];
        $correo = $row['correo'];
        ?>
        <li class="busqueda mt-2" onclick='busq("<?php echo $cedula."--".$nom_paci."--".$celular."--".$correo."--".$idpaci."--".$idmed; ?>")'>
            <a> <?php echo $cedula." ".strtoupper($nom_paci); ?></a>
        </li>
   
<?php 
    }
    echo '</ul>';
} else {
    echo '
    <div class="mt-3">
        <div class="alert alert-danger " role="alert">
            <strong>¡Error!</strong> No Existe el Paciente en el Sistema.
        <a href="#" rel="noopener noreferrer">&nbsp;¿Desea Crear el Paciente?</a>
        </div> 
    </div> 
    ';
}

