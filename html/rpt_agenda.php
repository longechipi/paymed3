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
                    <h5 class="card-title text-primary">Listado de Cuentas</h5>
                    
                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                    <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Fecha</th>   
                            <th>Hora</th>
                            <th>Actividad</th>
                            <th>Motivo</th>
                            <th>Responsable</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sqlasesor = ("SELECT idasesor FROM asesor WHERE correo='".$_SESSION['correouso']."'"); 
                        $resultado=$mysqli->query($sqlasesor);  
                          $roww = mysqli_fetch_array($resultado);
                  
                      if(isset($_GET['dia'])){
                          //$dia=$_GET['dia'];$mes=$_GET['mes'];$ano=$_GET['ano'];
                          $mes=$_GET['mes']+1;
                          $fechacita=$_GET['ano'].'-'.$mes.'-'.$_GET['dia'];	
                          //echo $fechacita; exit();
                        if($privilegios==1){
                              $sql = ("SELECT a.idcita, a.fechacita, a.horacita, a.ampm, a.nombre, a.telefono, a.correo, a.comentario, a.tipo, a.estatus, a.asignadoa, b.idasesor, b.imagen FROM citas a, asesor b WHERE a.fechacita='".$fechacita."' AND a.asignadoa=b.idasesor ORDER BY a.fechacita DESC, a.horacita DESC"); 
                        }else{
                          $sql = ("SELECT a.idcita, a.fechacita, a.horacita, a.ampm, a.nombre, a.telefono, a.correo, a.comentario, a.tipo, a.estatus, a.asignadoa, b.idasesor, b.imagen FROM citas a, asesor b WHERE a.fechacita='".$fechacita."' a.asignadoa='".$roww['idasesor']."' AND a.asignadoa=b.idasesor ORDER BY a.fechacita DESC, a.horacita DESC");}
                      
                      }else{
                  
                            if($privilegios==1){
                          $sql = ("SELECT a.idcita, a.fechacita, a.horacita, a.ampm, a.nombre, a.telefono, a.correo, a.comentario, a.tipo, a.estatus, a.asignadoa, b.idasesor, b.imagen FROM citas a, asesor b WHERE a.asignadoa=b.idasesor ORDER BY a.fechacita DESC, a.horacita DESC");
                          //echo $privilegios;exit();
                        }else{
                          $sql = ("SELECT a.idcita, a.fechacita, a.horacita, a.ampm, a.nombre, a.telefono, a.correo, a.comentario, a.tipo, a.estatus, a.asignadoa, b.idasesor, b.imagen FROM citas a, asesor b WHERE a.asignadoa='".$roww['idasesor']."' AND a.asignadoa=b.idasesor ORDER BY a.fechacita DESC, a.horacita DESC");
                        }
                          
                      }
                      $result=$mysqli->query($sql);?>
                         <?php while($row = mysqli_fetch_array($result)) { ?>
                            <tr>                    
                      
					  <td class="project_progress"><?php echo $row['fechacita'] ?></td>
                      							   <?php if(empty($row['horacita'])){ ?>
													 	<td style="color: #6C6C6C" class="project_progress"><i>Por asignar...</i></td>
												   <?php }else{ ?>
														<td class="project_progress"><b><?php echo $row['horacita'].' '.$row['ampm'] ?></b></td>
												   <?php } ?>
					  <td class="project_progress"><?php echo $row['nombre'] ?></td>                     
                      <td class="project_progress"><?php if($row['tipo']=='V') { ?>
													Ver Inmueble</td>
												<?php } elseif($row['tipo']=='M') { ?>
													Mostrar Inmueble</td>
												<?php } elseif($row['tipo']=='R') { ?>
													Reunion</td>
												<?php } ?>		
                      <td><ul class="list-inline"><li class="list-inline-item"><img class="table-avatar" src="img/<?php echo $row['imagen'];?>"></li></ul></td>
                      <td class="project_progress"><?php if($row['estatus']=='A'){ ?>
													 <img class="table-avatar" src="media/no.png" with="32" height="32"></td>
                     							   <?php }else{ ?>
                     							   	 <img class="table-avatar" src="media/ok.png" with="32" height="32"></td>
                     							   <?php } ?>
                      <td class="project-actions text-right">
						            <a class="btn btn-warning btn-sm" href="src_det_cita.php?idcita=<?php echo $row['idcita'];?>" style="color: #FFFFFF;background: #DD8900;border: #DD8900"><i class="fas fa-eye"></i> Ver & Responder</a>    
                        <?php if($privilegios==1){  ?>                
						              <a class="btn btn-info btn-sm" href="modevento.php?idcita=<?php echo $row['idcita'];?>"><i class="fas fa-pencil-alt"></i> Editar</a>                        
                          <a class="btn btn-danger btn-sm" href="src_del_agenda.php?idcita=<?php echo $row['idcita'];?>"><i class="fas fa-trash"></i> </a>
                        <?php } ?>
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