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
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Listado Seguros</h5>
                    <div class="row">
                        <div class="text-center">
                            <a class="btn btn-primary mb-4" href="regcli.php" role="button"><i class="fi fi-ts-hospital"></i> AÑADIR SEGURO</a>
                        </div>
                    </div>
                    <?php 
                     $sql = ("SELECT a.idaseg, a.idlogin, a.rif, a.razsocial, a.movil, a.telefono, a.correo, a.idestatus, b.pais, c.estado FROM aseguradores a, paises b, estado c WHERE a.idpais= b.idpais AND a.idestado=c.idestado ORDER BY a.razsocial ASC");
                    $result=$mysqli->query($sql);	
  
                    ?>
                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                        <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Razón Social</th> 
                                    <th>Rif</th>
                                    <th>Pais</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                while($row = mysqli_fetch_array($result)) {?>
                            <tr>
                                <td><?php echo substr($row['razsocial'], 0,25); ?>...</td>
                                <td><?php echo $row['rif']; ?></td>
                                <td><?php echo $row['pais']; ?></td>
                                <td><?php echo $row['estado']; ?></td>
<td>

<div class="btn-group">
    <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bx bx-dots-vertical-rounded"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
        <li>
            <a class="dropdown-item" href="updseg.php?id=<?php echo $row['idaseg'];?>">
                <i class="fi fi-rr-edit"></i> Editar Seguro</a>
        </li>
        <li>
            <a class="dropdown-item" href="updsegcontacto.php?id=<?php echo $row['idaseg'];?>">
                <i class="fi fi-rr-phone-call"></i> Agregar Contacto</a>
        </li>
        <li>
            <a class="dropdown-item" href="updsegservicios.php?id=<?php echo $row['idaseg'];?>">
            <i class="fi fi-rr-customer-care"></i> Servicios Ofrecidos</a>
        </li>
        <li>
            <a class="dropdown-item" href="updsegbaremo.php?id=<?php echo $row['idaseg'];?>">
            <i class="fi fi-ss-growth-chart-invest"></i> Baremos Actuales</a>
        </li>
        <li>
            <a class="dropdown-item" href="src_del_seg.php?id=<?php echo $row['idaseg'];?>">
            <i class="fi fi-rr-trash"></i> Eliminar Seguro</a>
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