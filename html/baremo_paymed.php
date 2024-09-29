<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
$a = "SELECT b.idbaremo, b.validodesde, b.validohasta, b.archivo, b.descbaremo, b.idestatus, e.estatus, b.fecharegistro
 FROM baremos_paymed b
 LEFT JOIN estatus e ON b.idestatus = e.idestatus
 ORDER BY fecharegistro DESC";
$resulct = $mysqli->query($a);
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
                    <h5 class="card-title text-primary">Baremo Paymed </h5>
                    <form action="../model/ope_baremo/regbaremopaymed.php" method="post" enctype="multipart/form-data"> 
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="razsocial">Razón Social:</label>
                                <input style="text-transform:uppercase;" style="text-transform:uppercase;" type="text" value="PAYMED GLOBAL, LLC" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                            <label for="movil">Valido desde:</label> <span class="text-danger">(*)</span>
                            <input type="date" class="form-control" id="desde" name="desde" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="movil">Valido hasta:</label> <span class="text-danger">(*)</span>
                            <input type="date" class="form-control" id="hasta" name="hasta" required>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                            <label for="movil">Baremo (PDF):</label> <span class="text-danger">(*)</span>
                            <input type="file" class="form-control" name="imagen_des">
                            </div>
                        </div>

                        <div class="text-center"> 
                            <button class="btn btn-primary" name="submit">
                            <i class="fi fi-rr-folder-upload"></i> Cargar</button>
                        </div>
                    </div>
                    </form>

                    <hr>
                    <div class="table-responsive">
                    <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Fecha Registro</th>
                                <th>Baremo / Validez</th>
                                <th>Archivo</th>
                                <th>Estatus</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                           <tbody>
                           <?php while ($rowct = mysqli_fetch_array($resulct)) { ?>
                                <tr>
                                    <td><?php echo $rowct['fecharegistro']; ?></td>
                                    <td><?php echo $rowct['descbaremo']; ?></td>
                                    <td><a href="../upload/baremo_paymed/<?php echo $rowct['archivo'] ?>" target="_blank" ><?php echo $rowct['archivo']; ?></a></td>
                                    <td><?php echo $rowct['estatus']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="../model/ope_baremo/delbaremo.php?idlin=<?php echo $rowct['idbaremo']; ?>"><i class="fi fi-rr-trash"></i> Eliminar Baremo</a></li>
                                                
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
    
    $('#hasta').on('blur', function() {
        const desde = $('#desde').val();
        const hasta = $('#hasta').val();

        if (desde > hasta) {
            Swal.fire({
                title: 'Error!',
                text: 'La fecha de inicio no puede ser mayor a la fecha final',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            return
        } 
    });
    
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