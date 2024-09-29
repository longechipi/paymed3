<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
$sqlpago = ("SELECT a.idmed, b.idlogin, a.nrodoc, a.apellido1, a.nombre1, a.movil, a.correo, a.idestatus , b.estatus
FROM medicos a, loginn b WHERE a.idlogin=b.idlogin and b.estatus='I' and a.idestatus='4'");
$resultpago = $mysqli->query($sqlpago);
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
                    <h5 class="card-title text-primary">Listado de Medicos por Aprobacion
                    </h5>
                    <div class="table-responsive"></div>
                    <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th class="text-center">Documentos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($resultpago)) { 
                                $idmed=$row['idmed'];
                                $sqlimg = ("SELECT imagen FROM drdocument WHERE idmed='".$idmed."'");

                                $objimg =$mysqli->query($sqlimg);
                                //$arrimg    = mysqli_fetch_array($objimg);
                                //$imagen=$arrimg['imagen'];
                            ?>
                            <tr>
                                <td><?php echo $row['nrodoc']; ?></td>
                                <td><?php echo $row['apellido1']; ?></td>
                                <td><?php echo $row['nombre1']; ?></td>
                                <td><?php echo $row['movil']; ?></td>
                                <td><?php echo $row['correo']; ?></td>
                                <td>
                                    <?php while ($rowimg = mysqli_fetch_array($objimg)) { ?>
                                        
                                        <a HREF="drdocument/<?php echo $rowimg['imagen'];?>" target="_blank"><?php echo $rowimg['imagen']; ?></a><br>

                                    <?php } ?>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-success btn-sm" href="apromed.php?idp=<?php echo $row['idmed']; ?>"><i class="fas fa-smile"></i> Aprobar</a>
                                    <a class="btn btn-danger btn-sm" href="notaccept.php?idm=<?php echo $row['idmed'];?>&idl=<?php echo $row['idlogin'];?>"><i class="fas fa-trash"></i> </a>
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