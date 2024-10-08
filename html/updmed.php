<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
$cod_med = $_GET['id'];
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <?php 
                    $a ="SELECT * FROM medicos WHERE idmed = $cod_med";
                    $ares=$mysqli->query($a);
                    $row = mysqli_fetch_array($ares);
                    $nom_comple = strtoupper($row['apellido1']) . ' ' .strtoupper($row['apellido2']) . ', ' .strtoupper($row['nombre1']) . ' ' . strtoupper($row['nombre2']);
                    $idpais=$row['idpais'];
                        $sql = ("SELECT pais from paises WHERE idpais='".$row['idpais']."'");
                        $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
                        $pais=$arr[0];
                        $idestado=$row['idestado'];
                        $sql = ("SELECT estado from estado WHERE idestado='".$idestado."';");
                        $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
                        $estado=$arr[0];
                        $idmunicipio=$row['idmunicipio'];
                        $sql = ("SELECT municipio from municipios WHERE idmunicipio='".$idmunicipio."';");
                        $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
                        $municipio=$arr[0];
                        $idparroquia=$row['idparroquia'];
                        $sql = ("SELECT parroquia from parroquias WHERE idparroquia='".$idparroquia."';");
                        $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
                        $parroquia=$arr[0];
                ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
                            <div class="col-lg-12 mb-12 order-0">
<div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">Editando al Dr(a):  <?php echo $nom_comple;?></h5>
                <form id="upd_datos">
				<input type="text" name="idlogin_basico" value="<?php echo $row['idlogin']; ?>" hidden>
				<input type="text" name="idmed_basico" value="<?php echo $row['idmed']; ?>" hidden>
				<div class="row"> <!--INICIO ROW 1 -->
					<div class="divider">
						<div class="divider-text">Datos Personales</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="apellido1">Primer Apellido: </label>
							<input type="text" name="apellido1" id="apellido1" value="<?php echo $row['apellido1']; ?>" class="form-control" style="text-transform:uppercase;" required />
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<div class="form-group">
							<label for="apellido1">Segundo Apellido: </label>
							<input type="text" name="apellido2" id="apellido2" value="<?php echo $row['apellido2']; ?>" class="form-control" style="text-transform:uppercase;" />
						</div>
					</div>

					<div class="col-md-3 mb-3">
						<div class="form-group">
							<label for="nombre1">Primer Nombre: </label>
							<input type="text" name="nombre1" id="nombre1" value="<?php echo $row['nombre1']; ?>" class="form-control" style="text-transform:uppercase;" required />
						</div>
					</div>

					<div class="col-md-3 mb-3">
						<div class="form-group">
							<label for="mombre2">Segundo Nombre: </label>
							<input type="text" name="nombre2" id="nombre2" value="<?php echo $row['nombre2']; ?>" class="form-control" style="text-transform:uppercase;" />
						</div>
					</div>
					<div class="col-md-5">
					<label for="rif">RIF:</label>
						<div class="input-group">
							<select class="form-select" id="tprif" name="tprif">
								<option value="<?php echo substr($row['rif'], 0, 1); ?>"><?php echo substr($row['rif'], 0, 1); ?></option>
								<option value="N">N</option>
								<option value="J">J</option>
								<option value="G">G</option>
							</select>
							<input type="text" name="rif" id="rif" value="<?php echo $row['rif']; ?>" maxlength="9" minlength="9" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required />
						</div>
					</div>

					

					<div class="col-md-5">
						<label for="rif">Nro. Documento</label>
						<div class="input-group">
							<select class="form-select" id="tpdoc" name="tpdoc">
								<option value="<?php echo substr($row['nrodoc'], 0, 1); ?>"><?php echo substr($row['nrodoc'], 0, 1); ?></option>
								<option value="V">V</option>
								<option value="E">E</option>
							</select>
							<input type="text" name="nrodoc" id="nrodoc" minlength="6" maxlength="9" value="<?php echo $row['nrodoc']; ?>"
							onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control" required>
						</div>
					</div>


					<div class="col-md-2">
						<div class="form-group">
							<label for="fnacimiento">Fec.Nacimiento:</label>
							<input type="date" name="fnacimiento" id="fnacimiento" value="<?php echo $row['fnacimiento']; ?>" class="form-control mb-3" onblur="calcedad(this.value)" required/> 
						</div>
					</div>

					<div class="col-md-1">
						<div class="form-group">
							<label for="edad">Edad:</label>
							<input type="text" name="edad" id="edad" value="<?php echo $row['edad']; ?>" class="form-control" required readonly/>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="idsexo">Sexo:</label>
							<select id="idsexo" class="form-select" name="idsexo" required>
								<?php
								$query = $mysqli->query("select idsexo, sexo from sexo WHERE idestatus='1'; ");
								while ($valores = mysqli_fetch_array($query)) {
									echo '<option value="' . $valores['idsexo'] . '">' . $valores['sexo'] . '</option>';
								} ?>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="idestcivil">Est.Civil:</label>
							<select id="idestcivil" class="form-select" name="idestcivil" required>
								<?php
								$query = $mysqli->query("select 	idestcivil, estcivil from estadocivil WHERE idestatus='1'; ");
								while ($valores = mysqli_fetch_array($query)) {
									echo '<option value="' . $valores['idestcivil'] . '">' . $valores['estcivil'] . '</option>';
								} ?>

							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<!--label for="movil" style="visibility: hidden;">.</label-->
							<label for="movil">Movil:</label>
							<input type="text" name="movil" id="movil" value="<?php echo $row['movil']; ?>" maxlength="14" minlength="10" class="form-control"
								onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="telefono">Teléfono:</label>
							<input type="text" name="telefono" id="telefono" minlength="10" maxlength="14" value="<?php echo $row['telefono']; ?>" class="form-control mb-3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="correo">Correo:</label>
							<input type="email" name="correo" value="<?php echo $row['correo']; ?>" id="correo" class="form-control" readonly>
							<small class="mb-3">Por razones de seguridad el correo no se puede modificar</small>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="correoalt">Correo Alterno:</label>
							<input type="email" name="correoalt" value="<?php echo $row['correoalt']; ?>" id="correoalt" class="form-control mb-3"
								style="text-transform:lowercase;">
						</div>
					</div>

				</div> <!--FIN ROW 1 -->

				<div class="row mt-3"> <!--INICIO ROW 3 -->
					<div class="col-md-3">
						<div class="form-group">
							<label for="idpais">País:</label>
							<select id="idpais" class="form-select" name="idpais" required>
							<option value="<?php echo $idpais; ?>"><?php echo $pais; ?></option>
								<?php
								$query = $mysqli->query("SELECT idpais, pais FROM paises WHERE idestatus='1';");
								while ($valores = mysqli_fetch_array($query)) {
								echo '<option value="' . $valores['idpais'] . '">' . $valores['pais'] . '</option>';
								} ?>
							</select>
						</div>
					</div>

					<div id="div-estado" class="col-md-3">
						<div class="form-group">
							<label for="correo">Estado:</label>
							<select id="id_estado" class="form-control" name="idestado">
								<option value="<?php echo $idestado;?>"><?php echo $estado;?></option>
							</select>
						</div>
					</div>

					<div id="div-municipio" class="col-md-3">
						<div class="form-group">
							<label for="correo">Municipio:</label>
							<select id="id_municipio" class="form-control" name="idmunicipio" >
								<option value="<?php echo $idmunicipio;?>"><?php echo $municipio;?></option>
							</select>
						</div>
					</div>

					<div  id="div-parroquia" class="col-md-3">
						<div class="form-group">
							<label for="correo">Parroquia:</label>
							<select id="id_parroquia" class="form-control mb-3" name="idparroquia" >
								<option value="<?php echo $idparroquia;?>"><?php echo $parroquia;?></option>
							</select>
						</div>
					</div>
				</div><!--FIN ROW 3 -->

				<div class="row mt-3"> <!--INICIO ROW 3 -->
					<div class="col-md-4">
						<div class="form-group">
							<label for="urbanizacion">Urbanización:</label>
							<input type="text" name="urbanizacion" style="text-transform:uppercase;" id="urbanizacion" value="<?php echo $row['urbanizacion']; ?>" class="form-control" required>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="calleav">Calle/Avenida:</label>
							<input type="text" name="calleav" id="calleav" style="text-transform:uppercase;" value="<?php echo $row['calleav']; ?>" class="form-control" required>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="casaedif">Casa/Edif.:</label>
							<input type="text" name="casaedif" style="text-transform:uppercase;" id="casaedif" value="<?php echo $row['casaedif']; ?>" class="form-control">
						</div>
					</div>

					<div class="col-md-1">
						<div class="form-group">
							<label for="piso">Piso:</label>
							<input type="text" name="piso" maxlength="2" id="piso" value="<?php echo $row['piso']; ?>" class="form-control">
						</div>
					</div>

					<div class="col-md-1">
						<div class="form-group">
							<label for="oficina">Oficina:</label>
							<input type="text" maxlength="8" name="oficina" id="oficina" value="<?php echo $row['oficina']; ?>" class="form-control">
						</div>
					</div>

					<div class="col-md-1">
						<div class="form-group">
							<label for="codpostal">Cod.Postal:</label>
							<input type="text" maxlength="4" minlength="4" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control" name="codpostal" id="codpostal" value="<?php echo $row['codpostal']; ?>" required>
						</div>
					</div>



					<div class="text-center mt-4">
						<button type="submit" id="btn_upd_datos" class="btn btn-primary"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
						<a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
					</div>

				</div> <!-- FIN ROW 4 -->
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
$(document).ready(function () {
    $("#upd_datos").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../model/perfil/medicos/datos_basicos.php",
            data: $(this).serialize(),
            success: function (data) {
                console.log(data)
                if(data == 1){
                    Swal.fire({
                        title: 'Actualización Exitosa!',
                        text: 'Se Actualizo correctamente los datos Basicos',
                        icon: 'success',
                        confirmButtonColor: "#007ebc",
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "rpt_med.php";
                        }
                    });
                }else{
                    Swal.fire({
                        title: 'Error!',
                        text: 'Ocurrio un Error al Actualizar los Datos Basicos ',
                        icon: 'error',
                        confirmButtonColor: "#007ebc",
                        confirmButtonText: 'Aceptar'
                    });
                }
            }
        });
    });
});
</script>
<!-- Adicionales -->
<script src="../js/direcciones.js"></script>
<script src="../js/fun_globales.js"></script>
</body>
</html>