<?php 
include('../layouts/header.php');
require('../admin/conexion.php');
<<<<<<< HEAD
$fechahoy=date('Y-m-d');
$ffechahoy = date("d/m/Y", strtotime($fechahoy));
=======
$usuario = $_SESSION['usuario'];
//$idlogin = $_SESSION['idlogin'];
if (isset($_SESSION['idloginmed'])) {$idlogin = $_SESSION['idloginmed'];}else{$idlogin = $_SESSION['idlogin'];}
$cargo = $_SESSION['cargo'];
$fechahoy=date('Y-m-d');
$ffechahoy = date("d/m/Y", strtotime($fechahoy));

$sqlmed = ("SELECT idmed FROM medicos WHERE correo='".$usuario."'");
$arrmed = $mysqli->query($sqlmed);
$rowmed = mysqli_fetch_array($arrmed);
$idmed  = $rowmed['idmed'];

$sql = ("SELECT a.*, c.cedula, b.idmed, b.idlogin, b.idcomp, b.nrodoc, b.codcolemed, b.mpss, b.rif, b.nombre1, b.nombre2, b.apellido1, b.apellido2 FROM citas a , medicos b,  pacientes c
WHERE a.idmed = b.idmed  AND a.idpaci = c.idpaci  AND a.idestatus IN(3,6,7) AND fechacita='".$fechahoy."' AND b.idlogin='".$idlogin."' ORDER BY a.nombre ASC");


$result = $mysqli->query($sql);
>>>>>>> 8a925a0a77a03344333e6cbe10a42012b14e3039
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
<<<<<<< HEAD
                    <h5 class="card-title text-primary">Listado de Citas </h5>
=======
                    <h5 class="card-title text-primary">Listado de Citas</h5>
>>>>>>> 8a925a0a77a03344333e6cbe10a42012b14e3039
                    <?php 
                    
  
                    ?>
                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                        <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Hist.:</th>
                                    <th>cédula:</th>
                                    <th>Paciente:</th>
                                    <th>Fecha/Sol:</th>
                                    <th>Fecha/Hora:</th>
                                    <th>Telefono:</th>
                                    <th>Clinica:</th>
                                    <th>Medico:</th>
                                    <th>Conf.:</th>
                                </tr>
                            </thead>
                            <tbody>
<<<<<<< HEAD
                            <?php  
                            $sqlmed = ("SELECT idmed FROM medicos WHERE correo='$usuario'");
                            $arrmed = $mysqli->query($sqlmed);
                            $rowmed = mysqli_fetch_array($arrmed);
                            $idmed  = $rowmed['idmed'];
                            
                            $sql = ("SELECT a.*, c.cedula, b.idmed, b.idlogin, b.idcomp, b.nrodoc, b.codcolemed, b.mpss, b.rif, b.nombre1, b.nombre2, b.apellido1, b.apellido2 FROM citas a , medicos b,  pacientes c
                            WHERE a.idmed = b.idmed  AND a.idpaci = c.idpaci  AND a.idestatus IN(3,6,7) AND fechacita='".$fechahoy."' AND b.idlogin='".$idlogin."' ORDER BY a.nombre ASC");
                            
                            
                            $result = $mysqli->query($sql);
                            
                            
                            $hoy = strtotime(date('Y-m-d'));
=======
                            <?php  $hoy = strtotime(date('Y-m-d'));
>>>>>>> 8a925a0a77a03344333e6cbe10a42012b14e3039
                                       //echo $startDate; echo $currentDate;exit();
                                while ($row = mysqli_fetch_array($result)) { $idclinica=$row['idclinica'];
                                    $fechasolimostrar = date("d-m-Y", strtotime($row['fechasoli']));

                                    $varfechacita=$row['fechacita'];
                                    $fechacita = strtotime(date('Y-m-d', strtotime($varfechacita) ) );
                                    $fechacitamostrar = date("d-m-Y", strtotime($varfechacita));




                                    $sqlclin = ("SELECT nombrecentrosalud FROM clinicas WHERE idclinica='".$idclinica."'");
                                    $arrclin = $mysqli->query($sqlclin);
                                    $rowclin = mysqli_fetch_array($arrclin);
                                    $nombrecentrosalud =$rowclin[0];
                                    /* Busco Historia */
                                    $idpaci=$row['idpaci'];
                                    $sqlhist = ("SELECT nrohistoria FROM historias WHERE idpaci='".$idpaci."'");
                                    $objhist = $mysqli->query($sqlhist); $arrhist = $objhist->fetch_array();
                                    if ($arrhist[0]==null) {
                                        $nrohistoria='S/H';
                                    }else{
                                        $nrohistoria = $arrhist[0];
                                    }

                                    ?>
                              
                              <tr>
                                        <td class="project_progress"><?php echo $nrohistoria; ?></td>
                                        <td class="project_progress"><?php echo $row['cedula']; ?></td>
                                        <td class="project_progress"><?php echo $row['nombre'] . " " . $row['apellido']; ?></td>
                                        <td class="project_progress"><?php echo $fechasolimostrar; ?></td>
                                        <td class="project_progress"><?php echo $fechacitamostrar . ' / ' . $row['horacita']; ?></td>
                                        <td class="project_progress"><?php echo $row['telefono']; ?></td>
                                        <td class="project_progress"><?php echo $nombrecentrosalud; ?></td>
                                        <td class="project-progress"><?php echo $row['nombre1'] . " " . $row['apellido1']; ?></td>
                                        <td><!-- Default checked -->
                                            <div class="custom-control custom-checkbox">
                                               <?php if ($row['idestatus']=='6') { ?>
                                                <input type="checkbox" class="custom-control-input" id="Checked<?php echo $row['idcita']?>" onclick="fconfcita(this.id)" Checked>      
                                                <label class="custom-control-label" for="Checked<?php echo $row['idcita']?>"></label>
                                               <?php }else if($row['idestatus']=='3'){ ?>
                                                <input type="checkbox" class="custom-control-input" id="Checked<?php echo $row['idcita']?>" onclick="fconfcita(this.id)" >
                                                <label class="custom-control-label" for="Checked<?php echo $row['idcita']?>"></label>
                                               <?php } ?>
                                            </div>
                                        </td>
                                        <?php if($row['idestatus']!='7'){ ?>
                                            <td class="project-actions text-right">
                                                <?php if($fechacita < $hoy ) {?>
                                                <a class="btn btn-info btn-sm" onclick="showerrormess()" title="Imposible Reagendar Cita"><i class="fa fa-book"></i></a>
                                                <a class="btn btn-success btn-sm" onclick="showerrormess()" title="Imposible Registrar Cita"> <i class="fa fa-eye"></i></a>
                                                <?php }else{ ?>
                                                    <a class="btn btn-info btn-sm" href="reagci.php?cit=<?php echo $row['idcita'];?>" title="Reagendar Cita"><i class="fa fa-book"></i></a>
                                                        <?php if($cargo == 'Asistente1') {
															// A la espera por aclarar que tipo de asistente podra registrar citas
															?>
                                                            <a class="btn btn-success btn-sm"  title="Reg. Informe" disabled> <i class="fa fa-eye"></i></a>
                                                        <?php }else{ ?>    
                                                            <a class="btn btn-success btn-sm"  title="Reg. Informe" onclick="verfeccita(<?php echo $row['idcita'];?>)"> <i class="fa fa-eye"></i></a>
                                                        <?php } ?>    
                                                <?php } ?>
                                                <!-- Ori a class="btn btn-success btn-sm" href="reghist.php?pac=< ?php echo $row['idcita']; ?>" title="Registrar Cita">
                                                    <i class="fa fa-eye"></i></a-->
                                                <!-- Ori a class="btn btn-success btn-sm"  title="Registrar Cita" onclick="verfeccita(< ?php echo $row['idcita'];?>)"> <i class="fa fa-eye"></i></a-->

                                                <!--a class="btn btn-primary btn-sm" href="updhist.php?idc=< ?php echo $row['idcita']; ?>"> <i class="fa fa-edit"></i></a-->
                                                <a class="btn btn-primary btn-sm" href="rpt_historias.php?idpac=<?php echo $row['idpaci']; ?>" title="Informes Medicos"> <i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm" href="src_del_cita.php?idc=<?php echo $row['idcita']; ?>"  title="Eliminar Cita">
                                                    <i class="fas fa-trash"></i> </a>
                                            </td>
                                        <?php }else if($row['idestatus']=='7'){ ?>
                                            <td class="project-actions text-right">
                                                <i class="fa fa-check-square" aria-hidden="true"></i>
                                                <!-- por ahora a class="btn btn-info btn-sm" href="printcita.php?idc=< ?php echo $row['idcita']; ?>"><i class="fas fa-receipt"></i> </a-->
                                                <a class="btn btn-primary btn-sm" href="rpt_historias.php?idpac=<?php echo $row['idpaci']; ?>" title="Informes Medicos"> <i class="fa fa-edit"></i></a>
                                            </td>
                                        <?php } ?>
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