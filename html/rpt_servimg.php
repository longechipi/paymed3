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
                    <h5 class="card-title text-primary">Estudios Imagenología</h5>
                    <div class="text-center">
                        
                    </div>
                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                    <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>   
                            <th>Servicio</th>
                            <th>Zona</th>
                            <th>Estudio</th>
                            <th>Estatus</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                       	 $sql = ("SELECT idimage, codserv, servicio, codzona, zona, codestudio, estudioori, estudio, idestatus FROM servimage 
                                    WHERE idestatus in(1,2)");
                           $result=$mysqli->query($sql);	
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td><?php echo $row['idimage']; ?></td>
                                <td><?php echo $row['servicio']; ?></td>
                                <td><?php echo $row['zona']; ?></td>
                                <td><?php echo $row['estudio']; ?></td>
                                <td><?php
                                    $sqlst = ("SELECT estatus FROM estatus WHERE idestatus = '" . $row['idestatus'] . "'");
                                    $respst = $mysqli->query($sqlst);
                                    $rowst = mysqli_fetch_array($respst);
                                    echo $rowst['estatus']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="upd_servimg.php?id=<?php echo $row['idimage']; ?>">
                                                <i class="fi fi-rr-edit"></i> Editar Servicio</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr><?php } ?>
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