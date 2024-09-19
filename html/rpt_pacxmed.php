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
                    <h5 class="card-title text-primary">Listado de Paises</h5>
                    <div class="text-center">
                        <a class="btn btn-primary" href="regpaconly.php" rel="noopener noreferrer"><i class="fi fi-rr-hospital-user"></i> AÑADIR PACIENTE</a>
                    </div>
                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                    <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#Hist</th>
                            <th>Nombre</th>
                            <th>Cedula</th>
                            <th>Movil</th>
                            <th>Correo</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($cargo=='Asistente1' || $cargo=='Asistente2') {
                            if (isset($_SESSION['idloginmed'])) {$idlogin_session = $_SESSION['idloginmed'];}else{$idlogin_session = $_SESSION['idlogin'];}
                                 // busco idtrabajacon en loginn para poder vincular con idmed
                                 $sqlasist = ("SELECT idlogin, idtrabajacon FROM loginn WHERE correo='".$usuario."'");
                                 $objasist = $mysqli->query($sqlasist); $arrasist = $objasist->fetch_array();
                                 $idregistrador = $arrasist['idlogin'];       // Leo el idlogin del Asistente para registrarlo en la pacientes
                                 $idtrabajacon = $arrasist['idtrabajacon'];   // Leo el idlogin del Medico para quien trabaja
                                 //echo $cargo.'/'; echo $idtrabajacon; exit();
                                 // busco idmed para insertarlo en paciente
                                 //antes $sqlmed = ("SELECT idmed FROM medicos WHERE idlogin='".$idtrabajacon."'");
                                 $sqlmed = ("SELECT idmed FROM medicos WHERE idlogin='".$idlogin_session."'");
                                 $objmed = $mysqli->query($sqlmed); $arrmed = $objmed->fetch_array();
                                 $idmed = $arrmed['idmed'];
                                 //echo $idmed; exit();
                                 $sql = ("SELECT a.idpaci, a.apellido1, a.nombre1, a.cedula, a.operadora , a.movil, a.correo 
                                 FROM pacientes a, medicos b
                                 WHERE a.idmed=b.idmed
                                 AND b.idmed = '".$idmed."';");
                         }else if ($cargo=='Medico') {
                                 $sql = ("SELECT a.idpaci, a.apellido1, a.nombre1, a.cedula, a.operadora , a.movil, a.correo 
                                 FROM pacientes a, medicos b
                                 WHERE a.idmed=b.idmed
                                 AND b.idlogin = '".$idlogin."';");
                         }
                         
                        $result = $mysqli->query($sql);?>
                         <?php while ($row = mysqli_fetch_array($result)) { 
                             $idpaci=$row['idpaci'];
                             $sqlhist = ("SELECT count(*) as hay, nrohistoria FROM historias WHERE idpaci='".$idpaci."'");
                 
                             $objhist = $mysqli->query($sqlhist); $arrhist = $objhist->fetch_array();
                             if ($arrhist[0]=='0') {$nrohistoria='S/H';}else{$nrohistoria = $arrhist[1];}
                             ?>
                             <tr>
                <td><?php echo $nrohistoria; ?></td>
                <td><?php echo $row['apellido1'].' '.$row['nombre1']; ?></td>
                <td><?php echo $row['cedula']; ?></td>
                <td><?php echo $row['operadora'].$row['movil']; ?></td>
                <td><?php echo $row['correo']; ?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="updpac.php?i=<?php echo $row['idpaci'];?>">
                                <i class="fi fi-rr-edit"></i> Editar Paciente
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="src_del_user.php?idlogin=<?php echo $row['cedula'];?>">
                                <i class="fi fi-rr-trash"></i> Eliminar Paciente
                                </a>
                            </li>
                            
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