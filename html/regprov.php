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
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    
                    <h5 class="card-title text-primary">Registro de Proveedores</h5>
    <form id="signUpForm" action="#!">
        <!-- start step indicators -->
        <div class="form-header d-flex mb-4">
            <span class="stepIndicator">Datos Básicos</span>
            <span class="stepIndicator">Datos Bancarios</span>
            <span class="stepIndicator">Rama del Proveedor</span>
            <span class="stepIndicator">Desconocido</span>
        </div>
        <!-- end step indicators -->
    
        <!-- step one -->
        <div class="step">
        <div class="divider">
            <div class="divider-text">Datos de Básicos</div>
        </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="idcateg">Categoria:</label>
                        <select id="idcateg" class="form-select" name="idcateg" required>
                        <option value="" disabled selected>-- Categoria --</option>
                            <?php
                            //require('admin/conexion.php');
                            $query = $mysqli -> query ("SELECT idcateg, categoria FROM categprove WHERE idestatus='1' ; ");
                            while ($valores = mysqli_fetch_array($query)) {
                                 echo '<option value="'.$valores['idcateg'].'">'.$valores['categoria'].'</option>';
                        } ?>
                        
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="rif">RIF:</label>
					    <input type="text" name="rif" id="rif"  maxlength="9" minlength="9" class="form-control mb-3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
					</div>
				</div>

                <div class="col-md-3">
					<div class="form-group">
						<label for="razsocial">Razón Social:</label>
						<input type="text" name="razsocial" id="razsocial" class="form-control" style="text-transform:uppercase;">
					</div>
				</div>

                <div class="col-md-3">
					<div class="form-group">
						<label for="dencomercial">Denominación Comercial:</label>
						<input type="text" name="dencomercial" id="dencomercial" class="form-control"style="text-transform:uppercase;">
					</div>
				</div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" name="correo" id="correo" class="form-control mb-3" required>
                    </div>
                </div>

                <div class="col-md-1">
                    <div class="form-group">
                        <label for="codarea">Cod:</label>
                        <input type="text" name="codarea" id="codarea" minlength="3" maxlength="5"class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                    </div>
                </div>

                <div class="col-md-3">
					<div class="form-group">
						<label for="telefono">Telefono Local:</label>
						<input type="text" name="telefono" id="telefono" maxlength="7" minlength="7" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="operadora">Operadora:</label>
                        <select class="form-select" id="operadora" name="operadora">
                        <option value="" disabled selected>Cod Cel</option>
                            <option value="0412">0412</option>
                            <option value="0414">0414</option>
                            <option value="0424">0424</option>
                            <option value="0416">0416</option>
                            <option value="0426">0426</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="movil">Telefono Movil</label>
                        <input type="text" name="movil" id="movil" maxlength="7" minlength="7"class="form-control mb-3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
                    </div>
                </div> 


             </div><!-- FIN ROW -->

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

             <div class="row">
                <div class="col-md-3">
					<div class="custom-file">
                        <label for="rifimg">Rif (PDF)</label>
                        <input type="file" id="rifimg" name="imagen1" class="form-control" accept="application/pdf" title="Formato PDF" >
                    </div>
				</div>

                <div class="col-md-3">
					<div class="custom-file">
                        <label for="rmimg">Reg.Mercantil:</label>
						<input type="file" id="rmimg" name="imagen2" class="form-control" accept="application/pdf" title="Formato PDF" >  
					</div>
				</div>

                <div class="col-md-3">
					<div class="custom-file">
                        <label for="cedimg1">Cedula Socio:</label>
						<input type="file" id="cedimg1"  name="imagen3"  class="form-control" accept="application/pdf" title="Formato PDF" >
					</div>
				</div>

                <div class="col-md-3">
					<div class="custom-file">
                        <label for="cedimg2">Cedula Socio:</label> 
						<input type="file" id="cedimg2"  name="imagen4"  class="form-control mb-6" accept="application/pdf" title="Formato PDF" >
					</div>
				</div>
             </div><!-- FIN ROW -->
        </div>
    
        <!-- step two -->
        <div class="step">
            <div class="divider">
                <div class="divider-text">Datos Bancarios</div>
            </div>
            <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="titular">Titular </label>
                    <input type="text" name="titular" id="titular" class="form-control">
                </div>
			</div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="nrodoc">Nro. Documento:</label>
                    <input type="text" name="nrodoc" id="nrodoc" class="form-control mb-3">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="idbco">Banco:</label>
                        <select id="idbco" class="form-select" name="idbco" required>
                        <option value="" disabled selected>-- Banco --</option>
                        <?php
                        $query = $mysqli -> query ("SELECT idbco, banco FROM bancos WHERE tipo='1' AND idestatus='1'");
                        while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="'.$valores['idbco'].'">'.$valores['banco'].'</option>';
                    } ?>
                    </select>
                </div>
			</div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="idtipocuenta">Tipo Cta:</label>
                    <select id="idtipocuenta" class="form-select" name="idtipocuenta" required>
                    <option value="" disabled selected>-- Cuenta --</option>
                    <?php
                        $query=$mysqli->query ("SELECT *FROM tipocuenta WHERE idestatus='1'");
                        while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="'.$valores['idtipocuenta'].'">'.$valores['tipocuenta'].'</option>';
                    } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="nrocuenta">Nro. Cuenta: <span><small>(Solo Nùmeros, 20 Digitos)</small></span> </label>
                    <input type="text" name="nrocuenta" id="nrocuenta" value="<?php echo $nrocuenta;?>" minlength="20" maxlength="20" value="" class="form-control" 
                    onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="cuenta_ext">Posee cuenta Internacional</label>
                    <select name="cuenta_ext" class="form-select" id="cuenta_ext">
                    <option value="" disabled selected>-- Cuenta --</option>
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                </div>
            </div>

            <div id="ext" hidden>
                <div class="col-md-3">
					<div class="form-group">
						<label for="idpais" class="control-label mb-1">Pais:</label>
						<select id="idpais" class="form-select" name="idpais" required>
                        <option value="" disabled selected>-- Pais --</option>
							<?php
							$query = $mysqli -> query ("SELECT idpais, pais FROM paises WHERE idestatus='1' AND idpais!='232';");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idpais'].'">'.$valores['pais'].'</option>';
							} ?>
						</select>
					</div>
				</div>
                <div class="col-md-3">
					<div class="form-group">
						<label for="idbcoint">Banco:</label>
						<select id="idbcoint" class="form-select" name="idbcoint" required>
                        <option value="" disabled selected>--Banco--</option>
							<?php
							$query = $mysqli -> query ("SELECT idbco, banco FROM bancos WHERE tipo='2' AND idestatus='1';");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idbco'].'">'.$valores['banco'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>

                <div class="col-md-6">
					<div class="form-group">
						<label for="nrocuentaint">Nro. Cuenta:</label>
						<input type="text" name="nrocuentaint" id="nrocuentaint" value="<?php echo $nrocuentaint;?>" minlength="8" maxlength="20"  value="" class="form-control form-control-sm " 
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<!-- 3ra -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="ach">ACH:</label>
						<input type="text" name="ach" id="ach" value="<?php echo $ach;?>" class="form-control form-control-sm ">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="swit">SWIT:</label>
						<input type="text" name="swit" id="swit" value="<?php echo $swit;?>" class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="aba">ABA:</label>
						<input type="text" name="aba" id="aba" value="<?php echo $aba;?>" class="form-control form-control-sm" required>
					</div>
				</div>
				<!-- 4ta -->
				<div class="col-md-8">
					<div class="form-group">
						<label for="dircta">Dirección Cuenta:</label>
						<input type="text" name="dircta" id="dircta" value="<?php echo $dircta;?>" class="form-control form-control-sm " 
						minlength="7" style="text-transform:uppercase;" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="telefono">Teléfono:</label>
						<!--input type="text" name="telefono" id="telefono" value="< ?php echo $telefono;?>" class="form-control form-control-sm " required-->
						<input type="text" name="telefono" id="telefono" minlength="11" maxlength="11" value="<?php echo $telefono;?>" class="form-control form-control-sm" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="codpostalint">Cod.Postal:</label>
						<!--input type="text" name="codpostalint" id="codpostalint" value="< ?php echo $codpostalint;?>" class="form-control form-control-sm " required-->
						<input type="text" name="codpostalint" id="codpostalint" maxlength="5" minlength="5" value="<?php echo $codpostalint;?>" class="form-control form-control-sm " onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>

            </div>





            </div> <!-- FIN ROW -->
        </div>
    
        <!-- step three -->
        <div class="step">
            <p class="text-center mb-4">We will never sell it</p>
            <div class="mb-3">
                <input type="text" placeholder="Full name" oninput="this.className = ''" name="fullname">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Mobile" oninput="this.className = ''" name="mobile">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Address" oninput="this.className = ''" name="address">
            </div>
        </div>
    
        <!-- start previous / next buttons -->
        <div class="row">
            <div class="text-center">
                <div class="form-footer ">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
                </div>
            </div>
        </div>
        <!-- end previous / next buttons -->
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
<script>
$(document).ready(function() {

   $('input').blur(function() {
        if (!$(this).val()) {
            $(this).removeClass('invalid buena');
        } else {
            $(this).removeClass('invalid').addClass('buena');
        }
    });

    $('select').change(function() {
        if (!$(this).val()) {
            $(this).removeClass('invalid buena');
        } else {
            $(this).removeClass('invalid').addClass('buena');
        }
    });

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
    $('#idtipocuenta').select2({
        theme: 'bootstrap-5',
        width: '100%',
    });
})
</script>
</body>
</html>