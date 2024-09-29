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
                    
                    <h5 class="card-title text-primary">Registro de Compañía de Seguros</h5>
    <form id="regseg">
            <div class="divider">
                <div class="divider-text">Datos de Básicos</div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="rif">RIF:</label>
                            <select class="form-select" id="tprif" name="tprif">
                                <option value="N">N</option>
                                <option value="J">J</option>
                                <option value="G">G</option>
                            </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="rif">N° RIF</label>
					    <input type="text" name="rif" id="rif"  maxlength="9" minlength="9" class="form-control" 
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>

                <div class="col-md-5">
					<div class="form-group">
						<label for="razsocial">Razón Social:</label>
						<input type="text" name="razsocial" style="text-transform:uppercase;" 
						 onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122 && event.keyCode = 32) event.returnValue = false;" id="razsocial" class="form-control mb-3" required>
					</div>
				</div>

                <div class="col-md-3">
					<div class="form-group">
                        <label for="descripcion">Tipo Proveedor:</label>
                            <select id="idtiposeg" class="form-select" name="idtiposeg" required>
                                <option value="" disabled selected>Seleccione</option>
                                <?php
                                $query = $mysqli -> query ("SELECT idtiposeg , tiposeg FROM tiposeguro WHERE idestatus='1' ORDER BY tiposeg ASC");
                                while ($valores = mysqli_fetch_array($query)) {
                                echo '<option value="'.$valores['idtiposeg'].'">'.$valores['tiposeg'].'</option>';
                                } ?>
                            </select>
					</div>
				</div>

             </div><!-- FIN ROW -->
             <div class="row"> <!--INICIO ROW 3 -->
                <div class="col-md-3 mb-3">
                    <div class="form-group">
                    <label for="descripcion">País:</label>
                    <select id="idpais" class="form-select" name="idpais" required>
                        <option value="" selected disabled >Seleccione</option>
                        <?php
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


            <div class="row">
            <div class="col-md-4">
					<div class="form-group">
						<label for="urbanizacion">Urbanización:</label>
						<input type="text"  style="text-transform:uppercase;" name="urbanizacion" id="urbanizacion" class="form-control" required>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="calleav">Calle/Avenida:</label>
						<input type="text" style="text-transform:uppercase;" name="calleav" id="calleav" class="form-control" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="casaedif">Casa/Edif.:</label>
						<input type="text" style="text-transform:uppercase;" name="casaedif" id="casaedif" class="form-control" required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="piso">Piso:</label>
						<input type="text" maxlength="2"  name="piso" id="piso" style="text-transform:uppercase;" class="form-control" required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="oficina">Oficina:</label>
						<input type="text" name="oficina" maxlength="8" id="oficina" style="text-transform:uppercase;" class="form-control" required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="codpostal">Cod.Postal:</label>
						<input type="text" name="codpostal" id="codpostal"  maxlength="4" minlength="4" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control mb-3" required>
					</div>
				</div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> GUARDAR</button>
                <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
            </div>
    </form>
                   
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
<script src="../js/step.js"></script>
<script>
$(document).ready(function() {
    $('#regseg').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/mod_seguro/regseg.php",
        data: $("#regseg").serialize(),
        success: function(data){
            console.log(data)
            if(data == 1){
                Swal.fire({
                    title: 'Registro Exitoso!',
                    text: 'Se ha registrado correctamente El Seguro',
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
                    text: 'Ocurrio un Error al Registrar el Seguro',
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
    $('#idpaisint', '#user').select2({
        theme: 'bootstrap-5',
        width: '100%',
    });
})
</script>
</body>
</html>