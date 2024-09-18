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
                    <h5 class="card-title text-primary">Listado Médicos</h5>
                    <div class="row">
                        <div class="text-center">
                            <a class="btn btn-primary mb-4" href="regmed.php" role="button"><i class="fi fi-ts-hospital"></i> AÑADIR MEDICO</a>
                        </div>
                    </div>
                    <?php 
                     $sql = ("SELECT * FROM medicos WHERE idestatus!='99' ORDER BY nombre1 ASC");
                    $result=$mysqli->query($sql);	
  
                    ?>
                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                        <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>N.Doc:</th>
                                    <th>Nombre:</th>
                                    <th>Móvil:</th>
                                    <th>Correo:</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                
                                <td><?php echo $row['nrodoc']; ?></td>
                                <td><?php echo $row['nombre1'].' '.$row['apellido1']; ?></td>
                                <td><?php echo $row['movil']; ?></td>
                                <td><?php echo $row['correo']; ?></td>
                    <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li>
                                <a class="dropdown-item" href="updmed.php?id=<?php echo $row['idlogin'];?>">
                                    <i class="fi fi-rr-edit"></i> Editar Medico</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="medctas.php?id=<?php echo $row['idmed'];?>">
                                <i class="fi fi-rr-file-invoice-dollar"></i> Cuentas Bancarias</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="medctas.php?id=<?php echo $row['idmed'];?>">
                                <i class="fi fi-rs-category"></i> Especialidades</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="adddoc.php?id=<?php echo $row['idmed'];?>">
                                <i class="fi fi-rs-document-signed"></i> Documentos</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="adddoc.php?id=<?php echo $row['idmed'];?>">
                                <i class="fi fi-rs-membership"></i></i> Afiliacion</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="src_del_med.php?id=<?php echo $row['idmed'];?>">
                                    <i class="fi fi-rr-trash"></i> Eliminar Medico</a>
                            </li>
                            
                          </ul>
                        </div>
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