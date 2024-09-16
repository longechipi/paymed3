<?php 
include('../layouts/header.php');
require('../admin/conexion.php');
$sqlct = ("SELECT * FROM baremos_paymed ORDER BY fecharegistro ASC");
$resulct = $mysqli->query($sqlct);
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
                    <h5 class="card-title text-primary">Baremo Paymed </h5>
                    <form action="regbaremopaymed.php" method="post" enctype="multipart/form-data"> 
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
                            <input type="date" class="form-control" name="desde" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="movil">Valido hasta:</label> <span class="text-danger">(*)</span>
                            <input type="date" class="form-control" name="hasta" required>
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
                                <th>Accion</th>
                            </tr>
                        </thead>
                           <tbody>
                           <?php while ($rowct = mysqli_fetch_array($resulct)) { ?>
                                <tr>
                                    <td><?php echo $rowct['fecharegistro']; ?></td>
                                    <td><?php echo $rowct['descbaremo']; ?></td>
                                    <td><a href="imgdocs/<?php echo $rowct['archivo'] ?>" target="_blank" ><?php echo $rowct['archivo']; ?></a></td>
                                    <td align="center">
                                        <a class="btn btn-danger" href="delbaremo.php?idlin=<?php echo $rowct['idbaremo']; ?>">
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