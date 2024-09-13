<?php 
include('../layouts/header.php');
require('../admin/conexion.php');
$idclinica = $_GET['id'];

$sql = ("SELECT a.idclinica, a.idlogin, a.rif, a.razsocial, a.nombrecentrosalud,a.descrip, a.idtipo, a.idpais, a.idestado, a.idmunicipio, a.idparroquia, a.correoppal, a.calleav, a.casaedif, a.piso, a.oficina, a.urbanizacion, a.codpostal, a.idestatus, a.fechahora_sist, a.fecharegistro,
b.pais, c.estado, d.municipio, e.parroquia, a.correoppal
FROM clinicas a, paises b, estado c, municipios d, parroquias e
WHERE a.idclinica='".$idclinica."'
AND a.idpais=b.idpais AND a.idestado=c.idestado AND a.idmunicipio=d.idmunicipio AND a.idparroquia=e.idparroquia");
$arrcli = $mysqli->query($sql);
$rowcli = mysqli_fetch_array($arrcli);

$sqlct = ("SELECT * FROM clinicas_contacto WHERE idclinica='".$idclinica."'");
$resulct=$mysqli->query($sqlct);
$tprif = substr($rowcli['rif'], 0,1);
$rif = substr($rowcli['rif'], 1,9);
$razsocial  =$rowcli['razsocial'];
$nbdcm      =$rowcli['nombrecentrosalud'];
$fecmod     =$rowcli['fechahora_sist'];
$fecreg     =$rowcli['fecharegistro']; 
$idestatus  =$rowcli['idestatus'];



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
                <h5 class="card-title text-primary">Datos de Contacto en la Clinica:  <?php echo $idclinica;?></h5>
                <form id="upd_cont">
                <input type="hidden" name="nocli" value="<?php echo $idclinica; ?>">
                    <div class="row"> <!-- ROW BASE INTERNA -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="rif">Código de Clinica</label>
                                <input type="text" value="CLI-000<?php echo $idclinica; ?>" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="razsocial">Razón Social:</label>
                                <input type="text" name="razsocial" id="razsocial" value="<?php echo $razsocial;?>" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                            <label for="razsocial">Nombre del Centro:</label>
                            <input type="text" name="nbcm" id="nbcm" value="<?php echo $nbdcm;?>" class="form-control" disabled>
                            </div>
                        </div>

                    </div><!-- FIN ROW BASE INTERNA -->

                     <div class="row"> <!--INICIO ROW 1 -->
                     
                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="descripcion">Cargo:</label>
                                <select id="cargo1" class="form-select" name="cargo1" required>
                                    <option>-- Seleccione --</option>
                                    <?php
                                        $query = $mysqli->query("SELECT idcargo,cargo FROM cargos WHERE idestatus='1'");
                                            while ($valores = mysqli_fetch_array($query)) {
                                                echo '<option value="' . $valores['idcargo'] . '">' . $valores['cargo'] . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label for="contacto1">Persona Contacto:</label>
                                <input type="text" name="contacto1" id="contacto1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control" required>
					        </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="movil">Cod. Area:</label>
                                <input type="text" name="coda" id="coda" maxlength="4" minlength="4" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="text" name="telefono" id="telefono" minlength="7" maxlength="7" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                            </div> 
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="correo1">Correo:</label>
                                <input type="text" name="correo1" id="correo1" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Departamento:</label>
						        <select id="dpto1" class="form-select" name="dpto1" required>
                                    <option>-- Seleccione --</option>
                                    <?php
                                    $query = $mysqli->query("SELECT idtipocontacto, tipocontacto FROM tipocontacto WHERE idestatus='1' AND idtipouser='2' ORDER BY tipocontacto ASC");
                                        while ($valores = mysqli_fetch_array($query)) {
                                            echo '<option value="' . $valores['idtipocontacto'] . '">' . $valores['tipocontacto'] . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>

                    </div><!--FIN ROW 1 -->
                    <div class="row">
                        <div class="text-center">
                           <button class="btn btn-primary" type="submit">AGREGAR</button>
                           <a href="rpt_clin.php" class="btn btn-outline-warning" rel="noopener noreferrer">VOLVER </a>
                        </div>
                    </div>

                    <div class="table-responsive"> <!-- INICIO Tabla Presupuesto -->
                        <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Cargo</th>   
                                    <th>Persona Contacto</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Departamento</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($rowct = mysqli_fetch_array($resulct)) { 
                                    $queryti = ("SELECT cargo FROM cargos WHERE idcargo ='" . $rowct['cargo'] . "'");
                                    $arreti  = $mysqli->query($queryti);
                                    $rowit = mysqli_fetch_array($arreti);
                                    
                                    $queryte = ("SELECT tipocontacto FROM tipocontacto WHERE idtipocontacto='" . $rowct['dpto'] . "'");
                                    $arrete  = $mysqli->query($queryte);
                                    $rowet = mysqli_fetch_array($arrete);
                                ?>
                            <tr>
                                <td><?php echo $rowit['cargo']; ?></td>
                                <td><?php echo $rowct['contacto'] ?></td>
                                <td><a href="tel:<?php echo $rowct['telefono'] ?>"><?php echo $rowct['telefono'] ?></td>
                                <td><a href="mailto:<?php echo $rowct['correo'] ?>"><?php echo $rowct['correo'] ?></a></td>
                                <td><?php echo $rowet['tipocontacto']; ?></td>
                                <td> <a class="btn btn-danger" id="delcon" href="../model/reg_clinica/delcontacto.php?idcli=<?php echo $rowct['idclinica'];?>&idlin=<?php echo $rowct['idcontacto'];?>">
                                <i class="fi fi-rr-delete-user"></i></a> </td>
                            </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
 </div> <!--fin card -->
</div>
</div>
</div>
                    <?php include('../layouts/footer.php')?>
            
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

$('#upd_cont').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/reg_clinica/register_contacto.php",
        data: $("#upd_cont").serialize(),
        success: function(data){
            if(data == 1){
                console.log(data)
                Swal.fire({
                    title: 'Agrego con Exito!',
                    text: 'Se Agrego correctamente el Contacto',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "updclicontacto.php?id=22";
                    }
                });
            }else{
                console.log(data)
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Actualizar la Clinica',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        }
    }) 
})

});
</script>
</body>
</html>