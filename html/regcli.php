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
                <h5 class="card-title text-primary">Registro de Clínicas</h5>
                <form id="reg_cli">
                     <div class="row"> <!--INICIO ROW 1 -->
                     <div class="divider">
                        <div class="divider-text">Datos de Principales</div>
                      </div>
                        <div class="col-md-1">
                            <div class="form-group">
                            <label for="rif">N°</label>
                                <select class="form-select"  id="tprif" name="tprif" required>
                                    <option value="N">N</option>
                                    <option value="J">J</option>
                                    <option value="G">G</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label for="rif">RIF:</label>
                                <input type="text" name="rif" id="rif"  maxlength="9" minlength="9" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					        </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="razsocial">Razón Social:</label>
                                <input type="text" name="razsocial" id="razsocial" class="form-control" style="text-transform:uppercase;" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nbcs">Nom. Centro de Salud:</label>
                                <input type="text" name="nbcs" id="nbcs" class="form-control" style="text-transform:uppercase;" required>
                            </div> 
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="correoppal">Correo Master:</label>
                                <input type="email" name="correoppal" id="correoppal" class="form-control" required>
                            </div>
                        </div>
                    </div><!--FIN ROW 1 -->
                    
                    <div class="row"> <!--INICIO ROW 2 -->
                        <div class="col-md-3 ">
                            <div class="form-group">
                            <label for="idtipo">Tipo de Empresa:</label>
                            <select class="form-select" id="idtipo" name="idtipo" required>
                                <option value="">-- Seleccione --</option>
                                <?php
                                $query = $mysqli -> query ("SELECT idtipoempresa, tipoempresa FROM tipoempresa  WHERE idestatus='1'");
                                while ($valores = mysqli_fetch_array($query)) {
                                echo '<option value="'.$valores['idtipoempresa'].'">'.$valores['tipoempresa'].'</option>';
                            } ?>
                            </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="idtipo">Tipo de Proveedor:</label>
                                <select class="form-select" id="idtipoprov" name="idtipoprov" required>
                                    <option value="">-- Seleccione --</option>
                                    <?php
                                    $srtsql = $mysqli -> query ("SELECT idtppr, tipoprov FROM tipoproveedor  WHERE idestatus='1'");
                                    while ($valsql = mysqli_fetch_array($srtsql)) {
                                    echo '<option value="'.$valsql['idtppr'].'">'.$valsql['tipoprov'].'</option>';
                                } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripción (breve):</label>
                                <input type="text" name="descripcion" id="descripcion" style="text-transform:uppercase;" class="form-control" required>
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
						    <select id="idpais" class="form-select" name="idpais" required>
                                <option value="">-- Pais --</option>
                                <?php
                                //require('admin/conexion.php');
                                $query = $mysqli -> query ("SELECT idpais, pais, idestatus FROM paises WHERE idestatus =1 AND idpais = 232");
                                while ($valores = mysqli_fetch_array($query)) {
                                echo '<option value="'.$valores['idpais'].'">'.$valores['pais'].'</option>';
                                } ?>
						    </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Estado:</label>
                                <select id="id_estado" class="form-select" name="idestado" required>
                                    <option value="">-- Seleccione --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Municipio:</label>
                                <select id="id_municipio" class="form-select" name="idmunicipio" required>
                                    <option value="">-- Municipio --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Parroquia:</label>
                                <select id="id_parroquia" class="form-select" name="idparroquia" required>
                                    <option value="">-- Parroquia --</option>
                                </select>	
                            </div>
                        </div>
                    </div><!--FIN ROW 3 -->

                    <div class="row"> <!--INICIO ROW 3 -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="urbanizacion">Urbanización:</label>
                                <input type="text" name="urbanizacion" style="text-transform:uppercase;"  id="urbanizacion" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="calleav">Calle/Avenida:</label>
                                <input type="text" name="calleav" id="calleav" style="text-transform:uppercase;" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="casaedif">Casa/Edif.:</label>
                                <input type="text" maxlength="8" name="casaedif" id="casaedif" class="form-control" style="text-transform:uppercase" required>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="piso">Piso:</label>
                                <input type="text" name="piso" id="piso" maxlength="2" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="oficina">Oficina:</label>
                                <input type="text" style="text-transform:uppercase;" name="oficina" id="oficina" maxlength="8" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="codpostal">Cod.Postal:</label>
                                <input type="text" name="codpostal" id="codpostal"  maxlength="4" minlength="4" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control" required>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" id="btn_register_clinica" class="btn btn-primary"><i class="fi fi-rs-disk"></i> REGISTRAR</button>
                            <a href="rpt_clin.php" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
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
    $('#reg_cli').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/reg_clinica/register_clinica.php",
        data: $("#reg_cli").serialize(),
        success: function(data){
            if(data == 1){
                Swal.fire({
                    title: 'Registro Exitoso!',
                    text: 'Se ha registrado correctamente la Clinica',
                    icon: 'success',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "regcli.php";
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Registrar la Clinica',
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
});

</script>
</body>
</html>