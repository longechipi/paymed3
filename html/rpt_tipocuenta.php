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
                    <h5 class="card-title text-primary">Listado de Cuentas</h5>
                    <div class="text-center">
                        <a class="btn btn-primary" href="regtipocuenta.php" rel="noopener noreferrer"><i class="fi fi-rr-file-invoice-dollar"></i> AÑADIR CUENTA</a>
                    </div>
                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                    <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>   
                            <th>Tipo de cuenta</th>
                            <th>Estatus</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = ("SELECT * FROM  tipocuenta");
                        $result = $mysqli->query($sql);?>
                         <?php while ($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                              <td><?php echo $row['idtipocuenta']; ?></td>
                              <td><?php echo $row['tipocuenta']; ?></td>
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
                          <ul class="dropdown-menu dropdown-menu-end" >
                            <li><a class="dropdown-item" href="upd_tipocuenta.php?idtc=<?php echo $row['idtipocuenta']; ?>"><i class="fi fi-rr-edit"></i> Editar Cuenta</a></li>
                           
                            <li><a class="dropdown-item" href="src_del_tipocuenta.php?idtc=<?php echo $row['idtipocuenta'];?>"><i class="fi fi-rr-trash"></i> Eliminar Cuenta</a></li>
                            
                          </ul>
                        </div>
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