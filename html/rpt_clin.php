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
                    <h5 class="card-title text-primary">Listado de Clínicas</h5>
                    <div class="row">
                        <div class="text-center">
                            <a name="" id="" class="btn btn-primary mb-4" href="#" role="button"><i class="fi fi-ts-hospital"></i> AÑADIR CLINICA</a>
                        </div>
                    </div>
                    <?php 
                     $sql = ("SELECT a.idclinica, a.rif, a.razsocial, a.nombrecentrosalud, a.idestatus, b.estado FROM clinicas a, estado b WHERE a.idestado=b.idestado ORDER BY a.razsocial ASC");
                    $result=$mysqli->query($sql);	
  
                    ?>
                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                        <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>   
                                    <th>Rif</th>
                                    <th>Razón Social</th>
                                    <th>Nombre del Centro</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $ln = 0;
                                while($row = mysqli_fetch_array($result)) {
                            $ln++; ?>
                            <tr>
                                <td><?php echo $ln; ?></td>
                                <td><a><?php echo $row['rif']; ?></a></td>
                                <td class="project_progress"><?php echo substr($row['razsocial'],0,25);?>...</td>
                                <td class="project_progress"><?php echo $row['nombrecentrosalud']; ?></td>
                                <td class="project-state"><?php echo $row['estado']; ?></td>
                                <td class="project-actions text-right">
                                <a class="btn btn-warning" href="updcli.php?id=<?php echo $row['idclinica'];?>"><i class="fi fi-rr-edit"></i></a>
                                <a class="btn btn-secondary" href="updclicontacto.php?id=<?php echo $row['idclinica'];?>"><i class="fi fi-tr-phone-call"></i></a>
                                <a class="btn btn-danger" href="src_del_clin.php?id=<?php echo $row['idclinica'];?>"><i class="fi fi-rr-delete-user"></i></a>
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