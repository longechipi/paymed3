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
                    <h5 class="card-title text-primary">Usuarios Registrados</h5>
                    <div class="row">
                        <div class="text-center">
                            <a name="" id="" class="btn btn-primary mb-4" href="#" role="button"><i class="fi fi-rr-user-add"></i> AÑADIR USUARIO</a>
                        </div>
                    </div>
                    <?php 
                    $sql = ("SELECT * FROM loginn");
                    $result=$mysqli->query($sql);
                    ?>
                    <div class="table-responsive"> 
                        <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nombre</th>   
                                    <th>Correo</th>
                                    <th>Usuario</th>
                                    <th>Nivel</th>
                                    <th>Estatus</th>
                                    <th>Registro</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_array($result)) { 
                                    $fecha = strtotime($row['fecha']);
                                    $estatus = (($row['estatus'] == 'A') || ($row['estatus'] )== '1') ? 'Activo' : 'Inactivo';
                                    ?>
                                <tr>
                                    <td><?php echo $row['fullname']; ?></td>                      
                                    <td><?php echo $row['correo'] ?></td>
                                    <td><?php echo $row['usuario'] ?></td>
                                    <td><?php echo $row['cargo'] ?></td>
                                    <td><?php echo $estatus ?></td>
                                    <td><?php echo date('d-m-Y', $fecha) ?></td>
                                    <td class="project-actions text-right">
                                        <a title="Editar Usuario" class="btn btn-warning" href="moduser.php?idlogin=<?php echo $row['idlogin'];?>"><i class="fi fi-rr-edit"></i> </a>
                                        <a title="Eliminar Usuario" class="btn btn-danger" href="src_del_team.php?idlogin=<?php echo $row['idlogin'];?>"><i class="fi fi-rr-delete-user"></i></a>
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