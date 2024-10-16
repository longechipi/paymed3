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
                    <h5 class="card-title text-primary">Listado de Proveedores</h5>
                    <div class="row">
                        <div class="text-center">
                            <a class="btn btn-primary mb-4" href="regprov.php" role="button">
                                <i class="fi fi-rs-supplier-alt"></i> AÑADIR PROVEEDOR</a>
                        </div>
                    </div>
                    <?php 
                     $sql = "SELECT p.idprov, p.idlogin, p.idcateg, p.rif, p.razsocial, p.dencomercial, p.idestado, e.estado, p.idestatus, es.estatus
                                FROM proveedores p
                                LEFT JOIN estado e ON p.idestado = e.idestado
                                LEFT JOIN estatus es ON p.idestatus = es.idestatus";
                    $result=$mysqli->query($sql);	
  
                    ?>
                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                        <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>   
                                    <th>Rif</th>
                                    <th>Razón Social</th>
                                    <th>D. Comercial</th>
                                    <th>Estado</th>
                                    <th>Estatus</th>
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
                                <td><?php echo $row['razsocial'];?></td>
                                <td><?php echo $row['dencomercial']; ?></td>
                                <td><?php echo $row['estado']; ?></td>
                                <td><?php echo $row['estatus']; ?></td>
<td>
<div class="btn-group">
    <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bx bx-dots-vertical-rounded"></i> </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <?php if ($privilegios=='1' ) { //Admin ?>
            <?php if ($row['idestatus']=='3'){ ?>
        <li>
            <a class="dropdown-item" href="#">
                <i class="fi fi-rs-memo-circle-check"></i> Aprobar Proveedor</a>
                
        </li>
        <?php }else if ($row['idestatus']=='1' ){ ?>
            <a class="dropdown-item" href="#">
                <i class="fi fi-rs-memo-circle-check"></i> Desaprobar Proveedor</a>
        <?php } ?>

        <li>

            <a class="dropdown-item" href="updprov.php?id=<?php echo $row['idprov'];?>">
            <i class="fi fi-rr-edit"></i> Editar Proveedor</a>

            <a class="dropdown-item" href="src_del_prov.php?id=<?php echo $row['idprov'];?>">
            <i class="fi fi-rr-trash"></i> Eliminar Proveedor</a>

        </li>
        <?php } else if ($privilegios=='2' ) { // Dr?>
            <?php if ($row['idestatus']=='3'){ ?>
        <li>
        <button type="button" id="btnaprobar<?php echo $row['idprov'];?>" class="btn btn-warning" title="Por Aprobar"><i class="fa fa-exclamation"></i></button>
            <a class="dropdown-item" href="src_del_clin.php?id=<?php echo $row['idclinica'];?>">
            <i class="fi fi-rr-trash"></i> Eliminar Contacto</a>
        </li>
        <?php }else if ($row['idestatus']=='1' ){ ?>
            <button type="button" id="btnaprobar<?php echo $row['idprov'];?>" class="btn btn-success" title="Aprobado"><i class="fi fi-rs-check-circle"></i></button>
        <?php } ?> <?php } ?>  

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