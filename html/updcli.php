<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
$idclinica = $_GET['id'];
$sql = ("SELECT a.idclinica, a.idlogin, a.rif, a.razsocial, a.nombrecentrosalud,a.descrip, a.idtipo, a.idtppr, a.idpais, a.idestado, a.idmunicipio, a.idparroquia, a.correoppal, a.calleav, a.casaedif, a.piso, a.oficina, a.urbanizacion, a.codpostal, a.idestatus, a.fechahora_sist, a.fecharegistro,
				b.pais, c.estado, d.municipio, e.parroquia, a.correoppal
				FROM clinicas a, paises b, estado c, municipios d, parroquias e
				WHERE a.idclinica='" . $idclinica . "'
				AND a.idpais=b.idpais AND a.idestado=c.idestado AND a.idmunicipio=d.idmunicipio AND a.idparroquia=e.idparroquia");
	$arrcli    = $mysqli->query($sql);
	$rowcli    = mysqli_fetch_array($arrcli);
	/* Asigno Campos a Variables */
	$idclinica = $rowcli['idclinica'];
	$tprif     = substr($rowcli['rif'], 0, 1);
	$rif       = substr($rowcli['rif'], 1, 9);

	$razsocial   = $rowcli['razsocial'];
	$nbdcm       = $rowcli['nombrecentrosalud'];
	$fecmod      = $rowcli['fechahora_sist'];
	$fecreg      = $rowcli['fecharegistro'];
	$descripcion = $rowcli['descrip'];
	$idtipo      = $rowcli['idtipo'];
	$idtipoprov  = $rowcli['idtppr'];

	$idpais      = $rowcli['idpais'];
	$pais = $rowcli['pais'];
	$idestado    = $rowcli['idestado'];
	$estado = $rowcli['estado'];
	$idmunicipio = $rowcli['idmunicipio'];
	$municipio = $rowcli['municipio'];
	$idparroquia = $rowcli['idparroquia'];
	$parroquia = $rowcli['parroquia'];

	$correoppal   = $rowcli['correoppal'];
	$urbanizacion = $rowcli['urbanizacion'];
	$calleav      = $rowcli['calleav'];
	$casaedif     = $rowcli['casaedif'];
	$piso         = $rowcli['piso'];
	$oficina      = $rowcli['oficina'];
	$codpostal    = $rowcli['codpostal'];
	$idestatus    = $rowcli['idestatus'];
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
                <h5 class="card-title text-primary">Editando de Clínica:  <?php echo $razsocial;?></h5>
                <form id="upd_cli">
                <input type="hidden" name="idclinica" value="<?php echo $idclinica; ?>">
                    <div class="row"> <!-- ROW BASE INTERNA -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="rif">Código de Clinica</label>
                                <input type="text" value="CLI-000<?php echo $idclinica; ?>" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="razsocial">Fecha de Registro:</label>
                                <input type="text" value="<?php echo $fecreg; ?>" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="razsocial">Última Modificación:</label>
                                <input type="text" value="<?php echo $fecmod; ?>" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="descripcion">Estatus:</label>
                                <select id="idestatus" class="form-select" name="idestatus" required>
                                    <option value="<?php echo $idestatus; ?>">
                                        <?php
                                        $queryest = ("SELECT estatus FROM estatus WHERE idestatus='" . $idestatus . "'");
                                        $arrest   = $mysqli->query($queryest);
                                        $rowest = mysqli_fetch_array($arrest);
                                        echo $rowest['estatus']; ?></option>
                                    <?php
                                    $query = $mysqli->query("SELECT idestatus, estatus FROM estatus");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores['idestatus'] . '">' . $valores['estatus'] . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>

                    </div><!-- FIN ROW BASE INTERNA -->

                     <div class="row"> <!--INICIO ROW 1 -->
                     <div class="divider">
                        <div class="divider-text">Datos de Principales</div>
                      </div>
                        <div class="col-md-1">
                            <div class="form-group">
                            <label for="rif">N°</label>
                                <select class="form-select"  id="tprif" name="tprif" required>
                                    <option value="<?php echo $tprif; ?>"><?php echo $tprif; ?></option>
                                    <option value="N">N</option>
                                    <option value="J">J</option>
                                    <option value="G">G</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label for="rif">RIF:</label>
                                <input type="text" name="rif" id="rif" value="<?php echo $rif; ?>" minlength="9" maxlength="9" class="form-control" required>
					        </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="razsocial">Razón Social:</label>
                                <input type="text" name="razsocial" id="razsocial" value="<?php echo $razsocial; ?>" class="form-control"style="text-transform:uppercase;" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nbcs">Nom. Centro de Salud:</label>
                                <input type="text" name="nbcm" id="nbcm" value="<?php echo $nbdcm; ?>" class="form-control" style="text-transform:uppercase;" required>
                            </div> 
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="correoppal">Correo Master:</label>
                                <input type="text" name="correoppal" id="correoppal" value="<?php echo $correoppal; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div><!--FIN ROW 1 -->
                    
                    <div class="row"> <!--INICIO ROW 2 -->
                        <div class="col-md-3 ">
                            <div class="form-group">
                            <label for="idtipo">Tipo de Empresa:</label>
                            <select id="idtipo" class="form-select" name="tipo" required>
                                <option value="<?php echo $idtipo; ?>">
                                    <?php
                                    $queryte = ("SELECT tipoempresa FROM tipoempresa WHERE idtipoempresa='" . $idtipo . "'");
                                    $arrete   = $mysqli->query($queryte);
                                    $rowet = mysqli_fetch_array($arrete);
                                    echo $rowet['tipoempresa']; ?></option>
                                <?php
                                $query = $mysqli->query("SELECT idtipoempresa, tipoempresa FROM tipoempresa 
                                WHERE idestatus='1'");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores['idtipoempresa'] . '">' . $valores['tipoempresa'] . '</option>';
                                } ?>
                            </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="idtipo">Tipo de Proveedor:</label>
                            <select class="form-select" id="idtipoprov" name="idtipoprov">
                                <option value="<?php echo $idtipoprov; ?>">
                                    <?php
                                    $querytp = ("SELECT tipoprov FROM tipoproveedor WHERE idtppr='" . $idtipoprov . "'");
                                    $arretp   = $mysqli->query($querytp);
                                    $rowtp = mysqli_fetch_array($arretp);
                                    echo $rowtp['tipoprov']; ?></option>
                                <?php
                                $srtsql = $mysqli->query("SELECT idtppr, tipoprov FROM tipoproveedor  WHERE idestatus='1'");
                                while ($valsql = mysqli_fetch_array($srtsql)) {
                                    echo '<option value="' . $valsql['idtppr'] . '">' . $valsql['tipoprov'] . '</option>';
                                } ?>
                            </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripción (breve):</label>
                                <input type="text" name="descripcion" id="descripcion" style="text-transform:uppercase;" 
                                value="<?php echo $descripcion; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div> <!--FIN ROW 2 --> 

                    <div class="divider">
                        <div class="divider-text">Datos de Contacto</div>
                    </div>
                    <div class="row"> <!--INICIO ROW 3 -->
                        <div class="col-md-3 mb-3">

                        <div class="form-group">
                            <label for="descripcion">País:</label>
						    <select id="idpais"class="form-select" name="idpais" required>
                                <option value="<?php echo $idpais; ?>"><?php echo $pais; ?></option>
                                <?php
                                //require('admin/conexion.php');
                                $query = $mysqli->query("SELECT idpais, pais FROM paises WHERE idestatus='1'; ");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores['idpais'] . '">' . $valores['pais'] . '</option>';
                                } ?>
                            </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Estado:</label>
                                <select id="id_estado" class="form-select" name="idestado" required>
                                    <option value="<?php echo $idestado; ?>"><?php echo $estado; ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Municipio:</label>
                                <select id="id_municipio" class="form-select" name="idmunicipio" required>
                                    <option value="<?php echo $idmunicipio; ?>"><?php echo $municipio; ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Parroquia:</label>
                                <select id="id_parroquia" class="form-select" name="idparroquia" required>
                                    <option value="<?php echo $idparroquia; ?>"><?php echo $parroquia; ?></option>
                                </select>	
                            </div>
                        </div>
                    </div><!--FIN ROW 3 -->

                    <div class="row"> <!--INICIO ROW 3 -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="urbanizacion">Urbanización:</label>
                                <input type="text" name="urbanizacion" style="text-transform:uppercase;" id="urbanizacion" value="<?php echo $urbanizacion; ?>" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="calleav">Calle/Avenida:</label>
                                <input type="text" name="calleav" id="calleav" style="text-transform:uppercase;"value="<?php echo $calleav; ?>" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="casaedif">Casa/Edif.:</label>
                                <input type="text" name="casaedif" style="text-transform:uppercase;" id="casaedif" value="<?php echo $casaedif; ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="piso">Piso:</label>
                                <input type="text" name="piso" maxlength="2" id="piso" value="<?php echo $piso; ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="oficina">Oficina:</label>
                                <input type="text" maxlength="8" name="oficina" id="oficina" value="<?php echo $oficina; ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="codpostal">Cod.Postal:</label>
                                <input type="text" maxlength="4" minlength="4" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control" name="codpostal" id="codpostal" value="<?php echo $codpostal; ?>" required>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" id="btn_update_clinica" class="btn btn-primary"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
                            <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
                        </div>

                   </div>  <!-- FIN ROW 4 -->
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
$(document).ready(function(){
$('#upd_cli').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/reg_clinica/update_clinica.php",
        data: $("#upd_cli").serialize(),
        success: function(data){
            if(data == 1){
                console.log(data)
                Swal.fire({
                    title: 'Actualizo con Exito!',
                    text: 'Se actualizo correctamente la Clinica',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "rpt_clin.php";
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

     $("#idpais").change(function(){				
        $.get("../model/reg_clinica/pais.php","idpais="+$("#idpais").val(), function(data){
            $("#id_estado").html(data);
        });
    });

    $("#id_estado").change(function(){				
        $.get("../model/reg_clinica/estado.php","id_estado="+$("#id_estado").val(), function(data){
            $("#id_municipio").html(data);
        });
    });

    $("#id_municipio").change(function(){
        $.get("../model/reg_clinica/municipio.php","id_municipio="+$("#id_municipio").val(), function(data){
            $("#id_parroquia").html(data);
        });
    });

    $('#id_estado, #id_parroquia, #id_municipio, #idpais').select2({
        theme: 'bootstrap-5',
        width: '100%',
    });
})
</script>
</body>
</html>