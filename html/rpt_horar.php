<?php 
include('../layouts/header.php');
require('../admin/conexion.php');
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
                    <h5 class="card-title text-primary">Listado Horarios</h5>
<?php 

$sqlhorario=("SELECT a.idclinica, a.razsocial as nombreclinica
FROM clinicas a, medicos b, horariomed c, clinicamedico d
WHERE a.idclinica=d.idclinica
AND b.idmed=d.idmed
AND b.idmed=c.idmed
AND a.idclinica=c.idclinica
AND c.idmed=d.idmed
AND b.idlogin='".$idlogin."' GROUP by 1,2;");
//echo $sqlhorario; exit();
$resulthorario = $mysqli->query($sqlhorario);
                    
                    ?>

                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                    <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Clinica</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $ln=1; 
                                    while ($row = mysqli_fetch_array($resulthorario)) { ?>
                                    <tr>
                                        <td><?php echo $ln++; ?></td>
                                        <td><?php echo $row['nombreclinica']; ?></td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-warning btn-sm" href="updhorar.php?id=<?php echo $row['idclinica']; ?>&c=<?php echo $row['idclinica']; ?>" title="Actualizar Horario" ><i class="fas fa-edit"></i> Actualizar</a>
                                            
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
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
<script>
$(document).ready(function() {
    $('#user').DataTable({
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
});
</script>
</body>
</html>