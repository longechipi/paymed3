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
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Listado de Presupuestos</h5>
                    <div class="row">
                        <div class="text-center">
                            <a class="btn btn-primary mb-4" href="regcli.php" role="button"><i class="fi fi-ts-hospital"></i> AÑADIR PRESUPUESTO</a>
                        </div>
                    </div>
                    
                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                        <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>COD Presupuesto</th>
                                    <th>Nro Doc</th>
                                    <th>Paciente</th>
                                    <th>Fecha</th>
                                    <th>Carta aval</th>
                                    <th class="text-center">Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            if($privilegios==1){
                                $sql = ("SELECT a.*,b.cedula,b.apellido1,b.nombre1,b.cedula FROM presupuesto a, pacientes b 
                                        WHERE a.idpaci=b.cedula");
                                }
                              elseif($privilegios==2){ 
                                  $sql = ("SELECT a.*,b.cedula,b.apellido1,b.nombre1,b.cedula FROM presupuesto a, pacientes b 
                                           WHERE a.idpaci=b.cedula AND a.idmed='".$idlogin."'");
                                }
                            $result=$mysqli->query($sql);	

                            while($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                            <td class="project_progress"><a><?php echo $row['idpresupuesto']; ?></a></td>
                <td class="project_progress"><?php echo $row['cedula']; ?></td>
                <td class="project_progress"><?php echo $row['apellido1'].' '.$row['nombre1']; ?></td>
                <td class="project-progress"><?php echo $row['fec_creacion']; ?></td>
                <td class="project_progress"><?php echo $row['carta_aval']; ?></td>
                <td class="project-actions text-right">
                  <a class="btn btn-danger btn-sm" 
                     href="src_del_user.php?idpresu=<?php echo $row['idpresupuesto'];?>">
                     <i class="fi fi-rr-trash"></i></a>
                </td>
                            </tr>
                                <?php } ?>
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