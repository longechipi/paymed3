<?php 
include('../layouts/header.php');
require('../conf/conexion.php');

$sqlpago=("SELECT a.*, b.idmed, b.nombre1, b.correo, SUBSTRING(c.cargo,1,1) AS cargo
            FROM regpagos a, medicos b, loginn c
           WHERE a.idmed=b.idmed AND a.idestatus='0' AND b.idlogin=c.idlogin
           UNION
           SELECT a.*, b.idprov, b.razsocial, b.correo, SUBSTRING(c.cargo,1,1) AS cargo
           FROM regpagos a, proveedores b, loginn c
           WHERE a.idmed=b.idprov 
           AND b.idlogin=c.idlogin
           AND a.idestatus='0';");
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
                    <h5 class="card-title text-primary">Listado de Pagos</h5>
                        <div class="text-center">
                            <h3 class="card-title">Pagos por Aprobar</h3>
                        </div>


                        <div class="table-responsive">
                <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Concepto</th>
                                    <th>Fecha Pago</th>
                                    <th>Banco</th>
                                    <th>Monto</th>
                                    <th>#REF</th>
                                    <th>Adjunto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($resultpago)) { ?>
                                    <tr>
                                        <td><?php echo $row['nombre1']; ?></td>
                                        <td><?php echo $row['correo']; ?></td>
                                        <td><?php echo $row['conptopago']; ?></td>
                                        <td><?php echo $row['fechabco']; ?></td>
                                        <td><?php 
                                                $sql = ("SELECT forma FROM formpago 
                                                         WHERE idforpag = '".$row['formapago']."'");
                                                  $result=$mysqli->query($sql); $vale = mysqli_fetch_array($result);
                                                    echo $vale['forma'];?></td>
                                        <td><?php echo $row['monto']?></td>
                                        <td><?php echo $row['nroref']?></td>
                                        <td><a href="../../pagos/<?php echo $row['archivo']?>" target="_blank"><i class="fas fa-eye"></i></a></td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-success btn-sm" href="aprob_pagos.php?idp=<?php echo $row['idpagos']; ?>&c=<?php echo $row['cargo']; ?>"><i class="fas fa-smile"></i> Aprobar</a>
                                            <a class="btn btn-danger btn-sm" href="src_del_pago.php?idp=<?php echo $row['idpagos']; ?>"><i class="fas fa-trash"></i> </a>
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