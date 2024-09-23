<?php 
include('../layouts/header.php');
require('../admin/conexion.php');
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

                  $sqlct = ("SELECT * FROM asegurador_servicios WHERE idaseg='" . $idaseg . "'");
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
                    <h5 class="card-title text-primary">Servicios Ofrecidos por: <?php echo $arraseg['razsocial']; ?></h5>
                    <form id="updseg">
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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="descripcion">Servicio:</label>
										<select id="cargo1" class="form-select" name="servi" required>
                                            <option value="" disabled selected>Seleccione</option>
											<?php
											$query = $mysqli->query("SELECT idservaf,servicio FROM serviciosafiliados WHERE idestatus='1'");
											while ($valores = mysqli_fetch_array($query)) {
												echo '<option value="' . $valores['idservaf'] . '">' . $valores['servicio'] . '</option>';
											} ?>
										</select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="correo1">Periodicidad:</label>
                                        <select class="form-select" name="periodo" required>
                                            <option value="N/A">No Aplica</option>
                                            <option value="Mensual">Mensual</option>
                                            <option value="Trimestral">Trimestral</option>
                                            <option value="Semestral">Semestral</option>
                                            <option value="Anual">Anual</option>
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="movil">Cantidad:</label>
                                <input type="text" name="canti" id="canti" maxlength="2" minlength="1" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="telefono">Monto ($):</label>
                                    <input type="text" name="monto" id="monto" minlength="2" maxlength="6" class="form-control mb-3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
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
                                    <th>Servicio</th>
                                    <th>Cantidad</th>
                                    <th>Monto($)</th>
                                    <th>Periodo</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($rowct = mysqli_fetch_array($resulct)) { ?>
                                    <tr>
                                        <td><?php
                                            $queryti = ("SELECT servicio FROM serviciosafiliados WHERE idservaf ='" . $rowct['idserv'] . "'");
                                            $arreti  = $mysqli->query($queryti);
                                            $rowit = mysqli_fetch_array($arreti);
                                            echo $rowit['servicio']; ?></td>
                                        <td><?php if($rowct['cantidad']==0){echo '∞';}
                                                    else{echo $rowct['cantidad'];}?></td>
                                        <td><?php echo $rowct['monto']; ?> </td>
                                        <td><?php echo $rowct['periodo']; ?></td>
                                        <td>

                                        <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                            <a class="dropdown-item" href="../model/mod_seguro/delservicioseg.php?idseg=<?php echo $rowct['idaseg']; ?>&idlin=<?php echo $rowct['idasegserv']; ?>">
                                                <i class="fi fi-rr-trash"></i> Eliminar Servicio
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


    $('#updseg').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/mod_seguro/updsegserv.php",
        data: $("#updseg").serialize(),
        success: function(data){
            if(data == 1){
                Swal.fire({
                    title: 'Actualización Exitosa!',
                    text: 'Agrego Correctamente el Servicio',
                    icon: 'success',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "rpt_seg.php";
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error Agregar el Contacto',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        }
    })
})
})
</script>

</body>
</html>