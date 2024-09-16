<?php 
include('../layouts/header.php');
require('../admin/conexion.php');
$fechahoy=date('Y-m-d');
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
                    <h5 class="card-title text-primary">Listado de Medicos por Aprobacion
                    </h5>
                    <div class="table-responsive"></div>
                    <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>C.I</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Cargo</th>
                            <th>Médico</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        <?php  
                        $sql="SELECT a.idlogin, b.idlogin as idloginAsist, b.idasist, b.apellidos, b.nombres, b.nrodoc, b.correo,  b.movil, b.cargo, b.tpasist, concat(a.apellido1,' ',a.nombre1) as nombremedico
                        FROM medicos a, asistentes b, medicosxasist c 
                        WHERE a.idmed=c.idmed 
                        and b.idasist=c.idasist
                        ORDER by 1;";
                        $result = $mysqli->query($sql);
                         $hoy = strtotime(date('Y-m-d'));
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['apellidos'].' '.$row['nombres']; ?></td>
                                <td><?php echo $row['nrodoc']; ?></td>
                                <td><?php echo $row['correo']; ?></td>
                                <td><?php echo $row['movil']; ?></td>
                                <td><?php echo $row['cargo']; ?></td>
                                <td><strong><?php echo $row['nombremedico']; ?></strong></td>
                                <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" style="">
                                        <li><a class="dropdown-item" href="updasist.php?gp1=<?php echo $row['idasist']; ?>"><i class="fi fi-rr-edit"></i> Editar Asistente</a></li>
                                        <li><a class="dropdown-item" href="src_del_asist.php?xy=<?php echo $row['idasist']; ?>"><i class="fi fi-rr-trash"></i> Eliminar Asistente</a></li>
                                        
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