<?php 
include('../layouts/header.php');
require('../conf/conexion.php');

?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Consulta Previa del <?php 
                    $idcita = $_GET['idcita'];
                    $a = "SELECT CM.*, CONCAT(P.apellido1,' ', P.nombre1) AS nom_paci, SUBSTRING(P.cedula, 2) AS Cedula, P.edad, 
                    RX.*
                    FROM consultas_med CM
                    INNER JOIN pacientes P ON CM.idpaci = P.idpaci
                    INNER JOIN servimage RX ON CM.codserv = RX.codserv
                    WHERE CM.idcita = $idcita
                    AND CM.codserv = RX.codserv
                    AND CM.codzona = RX.codzona
                    AND CM.codestudio = RX.codestudio";
                    $ares=$mysqli->query($a);
                    $row = $ares->fetch_assoc();
                    echo $row['fechadia']; ?></h5>
                    <div class="row">
                        <div class="divider">
                            <div class="divider-text">Datos de Previos</div>
                        </div>
                        <div class="col-md-5 mt-3">
                            <p class="mb-4">
                                <span class="fw-bold">Paciente:</span> <?php echo $row['nom_paci']; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Cédula:</span> <?php echo $row['Cedula']; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Edad:</span> <?php echo $row['edad']; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Fecha Consulta:</span> <?php echo $row['fechadia'] .' '. $row['hora']; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Fumador:</span> <?php echo $row['fumador']; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Peso:</span> <?php echo $row['peso'] . ' ' . $row['kglb']."s"; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Estatura:</span> <?php echo $row['estatura'] . ' ' . $row['cmpie']; ?>
                            </p>

                            <p class="mb-4">
                                <span class="fw-bold">Presión Arterial:</span> <?php echo $row['presion']; ?>
                            </p>
                        </div>
                        <div class="col-7 mt-3">
                            <p class="mb-4">
                                <span class="fw-bold">Antecedentes:</span> <?php echo $row['antecedentes'] ; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Motivo:</span> <?php echo $row['motivo'] ; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Exmen Físico:</span> <?php echo $row['exfisico'] ; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Hallazgos:</span> <?php echo $row['hallazgos'] ; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Laboratorio:</span> <?php echo $row['laboratorio'] ; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Imagenología:</span> <?php echo $row['imagenologia'] ; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Anatomía:</span> <?php echo $row['anatomia'] ; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Interconsultas:</span> <?php echo $row['interconsultas'] ; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Otros:</span> <?php echo $row['otros'] ; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Observaciones:</span> <?php echo $row['observaciones'] ; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Estudios Realizados:</span> <?php echo $row['servicio']; ?>
                            </p>
                            <p class="mb-4">
                                <span class="fw-bold">Zona:</span> <?php echo  $row['estudio'] ; ?>
                            </p>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="divider">
                            <div class="divider-text">Recipes y Ordenes Medicas</div>
                        </div>
                        <div class="col-3 mt-3">
                            <p class="fw-bold">Informe Medico</p>
                            <button class="btn btn-primary">Descargar</button>
                        </div>
                        <div class="col-3 mt-3">
                            <p class="fw-bold">Imagenologia</p>
                            <button class="btn btn-primary">Descargar</button>
                        </div>
                        <div class="col-3 mt-3">
                            <p class="fw-bold">Laboratorio</p>
                            <button class="btn btn-primary">Descargar</button>
                        </div>
                        <div class="col-3 mt-3">
                            <p class="fw-bold">Recipe</p>
                            <button class="btn btn-primary">Descargar</button>
                        </div>


                    </div>
                    <div class="text-center mt-5">
                    <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
                    </div>
                    <?php include('../layouts/footer.php')?>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<?php include('../layouts/script.php')?>

</body>
</html>