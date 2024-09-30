<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <?php 
                  $idaseg = $_GET['id'];
                  $sql = ("SELECT a.idaseg, a.idlogin, a.rif, a.razsocial, a.movil, a.telefono, a.correo, a.idpais, b.pais, a.idestado, c.estado, a.idmunicipio, d.municipio, a.idparroquia, e.parroquia, a.calleav, a.casaedif, a.piso, a.oficina, a.urbanizacion, a.codpostal, a.idestatus, a.fechahora_sist, a.fecharegistro
                    FROM aseguradores a, paises b, estado c, municipios d, parroquias e
                    WHERE a.idaseg='" . $idaseg . "'
                    AND a.idpais=b.idpais and a.idestado=c.idestado and a.idmunicipio=d.idmunicipio and a.idparroquia=e.idparroquia");
              
                  $objaseg = $mysqli->query($sql);
                  $arraseg = mysqli_fetch_array($objaseg);

                $sqlct = ("SELECT * FROM asegura_negocia WHERE idaseg='$idaseg' ORDER BY idneg DESC");
	            $resulct = $mysqli->query($sqlct);
                ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Convenio con la Compañía de Seguros: <?php echo $arraseg['razsocial']; ?></h5>
                    <form id="updseg" method="post" action="../model/mod_seguro/updsegbaremo.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="rif">Código de Seguro</label>
									<div class="form-group">
										<input type="text" value="SEG-000<?php echo $idaseg; ?>" class="form-control mb-3" readonly>
                                        <input type="hidden" name="nocli" value="<?php echo $idaseg; ?>">
									</div>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="razsocial1">Razón Social:</label>
                                    <input style="text-transform:uppercase;" type="text" name="razsocial" id="razsocial1" value="<?php echo $arraseg['razsocial']; ?>" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="movil">Valido desde:</label>
						            <input type="date" class="form-control" id="desde" name="desde" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="movil">Valido hasta:</label>
						            <input type="date" class="form-control" id="hasta" name="hasta" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="movil">Tipo de Baremo:</label>
						            <select class="form-select" name="tpbaremo" required>
                                        <option value="" disabled selected>Seleccione</option>
						            	<option value="Paymed">Paymed</option>
						            	<option value="Propio">Propio</option>
						            </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="movil">Baremo (PDF):</label>
						            <input type="file" class="form-control" name="imagen_des">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="movil"> % Descuento:</label>
						            <input type="text" name="baremodesc" minlength="1" maxlength="2"  class="form-control mb-3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                                </div>
                            </div> 
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
                                <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                        <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Baremo / Validez</th>
                                    <th>% Descuento</th>
                                    <th>Archivo</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($rowct = mysqli_fetch_array($resulct)) { ?>
                                <tr>
                                    <td><?php echo $rowct['tipobaremo']; ?></td>
                                    <td><?php echo $rowct['descripcion']; ?></td>
                                    <td><?php echo $rowct['descbaremo']; ?>%</td>
                                    <td><a href="../upload/baremos/<?php echo $rowct['archivo'] ?>" target="_blank" ><?php if($rowct['archivo']==''){echo 'BAREMO PAYMED';}
                                            else{echo $rowct['archivo'];} ?>	</a></td>
                                    <td>


                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                            <a class="dropdown-item" href="../model/mod_seguro/delbaremoseg.php?idseg=<?php echo $rowct['idaseg']; ?>&idlin=<?php echo $rowct['idneg']; ?>">
                                                <i class="fi fi-rr-trash"></i> Eliminar Contacto
                                            </a>
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
$(document).ready(function(){

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
    
//     $('#updseg').submit(function(e){
//     e.preventDefault();
//     const desde = $('#desde').val();
//     const hasta = $('#hasta').val();
//     if(desde > hasta){
//         Swal.fire({
//             title: 'Error!',
//             text: 'La fecha de inicio no puede ser mayor a la fecha final',
//             icon: 'error',
//             confirmButtonText: 'Aceptar'
//         });
//         return false;
//     }
//     $.ajax({
//         type: "POST",
//         url: "../model/mod_seguro/updsegbaremo.php",
//         data: $("#updseg").serialize(),
//         success: function(data){
//             console.log(data)
//             // if(data == 1){
//             //     Swal.fire({
//             //         title: 'Actualización Exitosa!',
//             //         text: 'Agrego Correctamente el Baremo',
//             //         icon: 'success',
//             //         confirmButtonColor: "#007ebc",
//             //         confirmButtonText: 'Aceptar'
//             //     }).then((result) => {
//             //         if (result.isConfirmed) {
//             //             window.location.href = "rpt_seg.php";
//             //         }
//             //     });
//             // }else{
//             //     Swal.fire({
//             //         title: 'Error!',
//             //         text: 'Ocurrio un Error Agregar el Baremo',
//             //         icon: 'error',
//             //         confirmButtonText: 'Aceptar'
//             //     });
//             // }
//         }
//     })
// })
 })
</script>

</body>
</html>