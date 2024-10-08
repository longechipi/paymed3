<?php
$a = "SELECT * FROM medicos WHERE idlogin=$idlogin";
$ares = $mysqli->query($a);
$row = $ares->fetch_array();
$idmed = $row['idmed'];
$codcolemed = $row['codcolemed'];
$mpss = $row['mpss'];

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
<div class="nav-align-top mb-4">
	<ul class="nav nav-pills mb-2" role="tablist">
		<li class="nav-item">
			<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#datos" aria-controls="datos" aria-selected="true"> Datos Basicos </button>
		</li>
		<li class="nav-item">
			<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#bancos" aria-controls="bancos" aria-selected="false"> Datos Bancarios </button>
		</li>
		<li class="nav-item">
			<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#especialidades" aria-controls="especialidades" aria-selected="false"> Especialidades </button>
		</li>
		<li class="nav-item">
			<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#documentos" aria-controls="documentos" aria-selected="false"> Documentos </button>
		</li>
		<li class="nav-item">
			<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#servicios" aria-controls="servicios" aria-selected="false"> Servicios Afiliados </button>
		</li>
	</ul>
	<hr>
	<div class="tab-content">
		<!-- PESTAÑA DE DATOS BASICOS -->
		<div class="tab-pane fade show active" id="datos" role="tabpanel">
			<form id="upd_datos">
				<input type="text" name="idlogin_basico" value="<?php echo $idlogin; ?>" hidden>
				<input type="text" name="idmed_basico" value="<?php echo $idmed; ?>" hidden>
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
			<script>
				$(document).ready(function () {
					$("#upd_datos").submit(function (e) {
						e.preventDefault();
						$.ajax({
							type: "POST",
							url: "../model/perfil/medicos/datos_basicos.php",
							data: $(this).serialize(),
							success: function (data) {
								if(data == 1){
									Swal.fire({
										title: 'Actualización Exitosa!',
										text: 'Se Actualizo correctamente los datos Basicos',
										icon: 'success',
										confirmButtonColor: "#007ebc",
										confirmButtonText: 'Aceptar'
									}).then((result) => {
										if (result.isConfirmed) {
											window.location.href = "perfil.php";
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
		</div><!-- FIN PESTAÑA DE DATOS BASICOS -->
		<!-- PESTAÑA DE DATOS BANCARIOS -->
		<div class="tab-pane fade" id="bancos" role="tabpanel">
			<form id="upd_banco">
				<input type="text" name="idmed_banco" id="idmed_banco" value="<?php echo $idlogin; ?>" hidden />
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="apellido1">Titular </label>
							<input type="text" name="titular" id="titular" value="<?php echo strtoupper($row['apellido1']).' '. strtoupper($row['apellido2']).' '. strtoupper($row['nombre1']).' '. strtoupper($row['nombre2']); ?>" class="form-control" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="nrodoc">Nro. Documento:</label>
							<input type="text" name="nrodoc" id="nrodoc" value="<?php echo $row['nrodoc'];?>" class="form-control mb-3" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<?php 
					//--------- DATA DE CUENTAS NACIONALES ---------//
					$a1 = ("SELECT  a.idlogin, a.titular, a.nrodoc, a.idbco, b.banco, a.idtipocuenta, 
					c.tipocuenta, a.nrocuenta, a.idestatus 
					FROM datbconac a, bancos b, tipocuenta c
					WHERE a.idbco=b.idbco AND a.idtipocuenta=c.idtipocuenta AND a.idlogin = $idlogin;");
					$a1res=$mysqli->query($a1);
					$row_cnt_nac = $a1res->num_rows;
					if($row_cnt_nac > 0){
						$row1=$a1res->fetch_array();
					}
					//--------- DATA SI TIENE CUENTA INTERNACIONAL --------//
					$a2 = "SELECT CI.*, P.pais, B.banco
							FROM datbcoint CI
							INNER JOIN paises P ON CI.idpais = P.idpais
							INNER JOIN bancos B ON CI.idbco = B.idbco
							WHERE idlogin = $idlogin
							AND B.idestatus = 1
							AND P.idestatus = 1";
					$a2res=$mysqli->query($a2);
					$row_cnt = $a2res->num_rows;
					if($row_cnt > 0){
						$row2=$a2res->fetch_array();
					}	

					?>
					<div class="divider">
						<div class="divider-text">Datos Transferencia Nacional</div>
					</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="idbco">Banco:</label>
						<select id="idbco" class="form-select mb-3" name="idbco" required>
							<?php
							echo $row_cnt_nac > 0 ? '<option value="'.$row1['idbco'].'">'.$row1['banco'].'</option>' : '<option value="" selected disabled>Seleccionar</option>';
							?>
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
							<?php echo $row_cnt_nac > 0 ? '<option value="'.$row1['idtipocuenta'].'">'.$row1['tipocuenta'].'</option>' : '<option value="" selected disabled>Seleccionar</option>'; ?>
						<?php
							$query = $mysqli -> query ("SELECT idtipocuenta, tipocuenta FROM tipocuenta WHERE idestatus='1'; ");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idtipocuenta'].'">'.$valores['tipocuenta'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nrocuenta">Nro. Cuenta: <span><small>(Solo Nùmeros, 20 Digitos)</small></span> </label>
							<?php echo $row_cnt_nac > 0 ? '<input type="text" name="nrocuenta" id="nrocuenta" minlength="20" maxlength="20" value="'.$row1['nrocuenta'].'" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>' : '<input type="text" name="nrocuenta" id="nrocuenta" minlength="20" maxlength="20" placeholder="0000-0000-00-0000000000" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>';?>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label for="nrocuenta">¿Posee Cuenta Internacional?</label>
						<select name="bank_inter" class="form-select" id="bank_inter" required>
							<option value="" selected disabled>Seleccionar</option>
							<option value="0">No</option>
							<option value="1">Si</option>
						</select>
					</div>
				</div>
			<div class="row" id="cuenta_inter" hidden>
				<div class="divider">
					<div class="divider-text">Datos Transferencia Internacional</div>
				</div>
			
				<div class="col-md-3 mb-3">
					<div class="form-group">
						<label for="idpais" class="control-label">Pais:</label>
						<select id="idpais" class="form-control" name="idpais" >
							<?php echo $row_cnt > 0 ? '<option value="'.$row2['idpais'].'">'.$row2['pais'].'</option>' : '<option value="" selected disabled>Seleccionar</option>'; ?>
							<?php
							$query = $mysqli -> query ("SELECT idpais, pais FROM paises WHERE idestatus='1';");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idpais'].'">'.$valores['pais'].'</option>';
							} ?>
						</select>
					</div>
				</div> 

				<div class="col-md-3">
					<div class="form-group">
						<label for="idbcoint">Banco:</label>
						<select id="idbcoint" class="form-select" name="idbcoint" >
						<?php echo $row_cnt > 0 ? '<option value="'.$row2['idbco'].'">'.$row2['banco'].'</option>' : '<option value="" selected disabled>Seleccionar</option>'; ?>
							<?php
							$query = $mysqli -> query ("SELECT idbco, banco FROM bancos WHERE tipo='2' AND idestatus='1' ; ");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idbco'].'">'.$valores['banco'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nrocuentaint">Nro. Cuenta:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="nrocuentaint" id="nrocuentaint" minlength="8" maxlength="11" value="'.$row2['nrocuenta'].'" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>' : '<input type="text" name="nrocuentaint" id="nrocuentaint" minlength="8" maxlength="11" placeholder="00000000000" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>'; ?>
					</div>
				</div>
				<!-- 3ra -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="ach">ACH:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="ach" id="ach" value="'.$row2['ach'].'" class="form-control">' : '<input type="text" name="ach" id="ach" placeholder="00000000000" class="form-control">';?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="swit">SWIT:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="swit" id="swit" value="'.$row2['swit'].'" class="form-control">' : '<input type="text" name="swit" id="swit" placeholder="00000000000" class="form-control">';?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="aba">ABA:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="aba" id="aba" value="'.$row2['aba'].'" class="form-control">' : '<input type="text" name="aba" id="aba" placeholder="00000000000" class="form-control">';?>
					</div>
				</div>
				<!-- 4ta -->
				<div class="col-md-8">
					<div class="form-group">
						<label for="dircta">Dirección Cuenta:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="dircta" id="dircta" value="'.$row2['dircta'].'" class="form-control">' : '<input type="text" name="dircta" id="dircta" placeholder="Dirección de la Cuenta" class="form-control">';?>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="telf_inter">Teléfono:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="telf_inter" id="telf_inter" maxlength="10" minlength="10" value="'.$row2['telefono'].'" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>' : '<input type="text" name="telf_inter" id="telf_inter" maxlength="10" minlength="10" placeholder="0000000000" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>';?>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="codpostalint">Cod.Postal:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="codpostalint" id="codpostalint" maxlength="5" minlength="5" value="'.$row2['codpostal'].'" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>' : '<input type="text" name="codpostalint" id="codpostalint" maxlength="5" minlength="5" placeholder="00000" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>';?>
					</div>
				</div>
				</div>
			</div>

			<div class="text-center mt-4">
				<button type="submit" id="btn_upd_banco" class="btn btn-primary"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
				<a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
			</div>
			</form>
			<script>
				$(document).ready(function () {
					$("#bank_inter").change(function () {
						const selectedOption = $(this).val();
						const requiredElements = ["telf_inter", "codpostalint", "dircta", "aba", "swit", "ach", "nrocuentaint"];
						if (selectedOption === "1") {
							$("#cuenta_inter").removeAttr("hidden");
							requiredElements.forEach(elementId => {
								$("#" + elementId).attr("required", true);
							});
						} else {
							$("#cuenta_inter").attr("hidden", true);
							requiredElements.forEach(elementId => {
								$("#" + elementId).removeAttr("required");
							});
						}
					});
					$("#upd_banco").submit(function (e) {
						e.preventDefault();
						$.ajax({
							type: "POST",
							url: "../model/perfil/medicos/datos_bancarios.php",
							data: $(this).serialize(),
							success: function (data) {
								console.log(data)
								if(data == 1){
									Swal.fire({
										title: 'Actualización Exitosa!',
										text: 'Se Actualizo correctamente los datos Bancarios',
										icon: 'success',
										confirmButtonColor: "#007ebc",
										confirmButtonText: 'Aceptar'
									}).then((result) => {
										if (result.isConfirmed) {
											window.location.href = "perfil.php";
										}
									});
								}else{
									Swal.fire({
										title: 'Error!',
										text: 'Ocurrio un Error al Actualizar los Datos Bancarios ',
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

		</div><!-- FIN PESTAÑA DE DATOS BANCARIOS -->
		<!-- PESTAÑA DE DATOS DE ESPECIALIDADES -->
		<div class="tab-pane fade" id="especialidades" role="tabpanel">
			<div class="divider">
				<div class="divider-text">Especialidades Médicas</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="apellido1">Especialidad</label>
						<select class="form-select" id="idespmed" name="idespmed">
							<option value="" disabled selected>Seleccione</option>
							<?php
							$a3 = $mysqli -> query ("SELECT idespmed, especialidad FROM especialidadmed WHERE idestatus = 1");
							while ($row3 = mysqli_fetch_array($a3)) {
							echo '<option value="'.$row3['idespmed'].'">'.$row3['especialidad'].'</option>'; } ?>
						</select>
					</div>
				</div>
				<div class="col-md-7">
				<?php 
				$b = "SELECT  c.idespmed, c.especialidad FROM medicos a, medicos_esp b, especialidadmed c
				WHERE a.idmed= $idmed and a.idmed=b.idmed and b.idespmed =c.idespmed and a.idestatus='1'";
				$bres=$mysqli->query($b);
				?>
				<div class="table-responsive">
					<table class="table table-hover" id="tblesp" cellspacing="0" style="width: 100%;">
					<thead>
						<tr>
							<th>Especialidad Seleccionada</th>
							<th>Acción</th>
						</tr>
						</thead>
						<tbody>
							<?php
								while ($row = $bres->fetch_array(MYSQLI_ASSOC)) {
								echo '<tr>';
								echo '<td>'.$row['especialidad'].'</td>';
								echo '<td><button class="btn btn-primary" type="button" onclick="borrar('.$row['idespmed'].')" id="del-'.$row['idespmed'].'"><i class="fi fi-rr-delete-user"></i></button></td>';
								echo '</tr>';
								}
							?>
						</tbody>
					</table>
					</div>
					
				</div>
				</div> <!-- FIN DE ROW 2 -->
				<div class="row"> 
				<div class="divider">
					<div class="divider-text">Horarios de Atención</div>
				</div>
				<div class="text-center mb-5">
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
					<i class="fi fi-rs-disk"></i> Agregar Horarios de Atención
					</button>
					
				</div>
				
				<div class="table-responsive">
				<table class="table table-hover" id="user2" cellspacing="0" style="width: 100%;">
				<thead>
					<tr>
						<th>Clinica</th>
						<th>Horario de Atención</th>
						<th>Accion</th>
					</tr>
				</thead>
					<tbody>
						<?php
						$c = "SELECT HM.idclinica, HM.idmed, C.razsocial, HM.dia, HM.desde, HM.hasta
								FROM horariomed HM
								INNER JOIN clinicas C ON C.idclinica = HM.idclinica
								WHERE idmed= 2";
							$cres=$mysqli->query($c);
							while ($rowc = $cres->fetch_array(MYSQLI_ASSOC)) {
								$desde=date("g:iA", strtotime($rowc['desde']));
								$hasta=date("g:iA", strtotime($rowc['hasta']));
							echo '<tr>';
							echo '<td>'.$rowc['razsocial'].'</td>';
							echo '<td>'.$rowc['dia'].' : '.$desde.'-'.$hasta.'</td>';
							echo '<td><button class="btn btn-primary" type="button" onclick="borrarcli('.$rowc['idclinica'].')" id="del-'.$rowc['idclinica'].'"><i class="fi fi-rr-delete-user"></i></button></td>';
							echo '</tr>';
							}
						?>
				</table>

				</div>


				</div>
		
			<div class="text-center mt-4">
				<a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer">
					<i class="fi fi-rr-undo"></i> VOLVER 
				</a>
			</div>
		<script>
			$("#idespmed").change(function () {
				const idespmed = $("#idespmed").val();
				const idmed = $("#idmed").val();
				$.ajax({
					type: "POST",
					url: "../model/perfil/medicos/datos_especialidades.php",
					data: { idespmed: idespmed, idmed: idmed },
					success: function (data) {
						if(data == 2){
							Swal.fire({
								title: 'Error!',
								text: 'La especialidad seleccionada ya esta incluida anteriormente',
								icon: 'error',
								confirmButtonColor: "#007ebc",
								confirmButtonText: 'Aceptar'
							});
							return false;
						}
						const arrdata = data.split('-');
						const id =arrdata[0];
						const espe =arrdata[1];
						document.getElementById("tblesp").insertRow(-1).innerHTML = '<tr><td>'+espe+'</td><td><button class="btn btn-primary" type="button" onclick="borrar('+id+')" id="del-'+id+'"><i class="fi fi-rr-delete-user"></i></button></td></tr>';
					}
				});
			});
			function borrar(id) {
				const idmed = $("#idmed").val();
				$.ajax({
					type: "POST",
					url: "../model/perfil/medicos/del_espe.php",
					data: { id: id, idmed: idmed },
					success: function (data) {
						var tabla = document.getElementById("tblesp");
						var filas = tabla.getElementsByTagName("tr");
						for (var i = 0; i < filas.length; i++) {
							var celdas = filas[i].getElementsByTagName("td");
							if (celdas.length > 0) {
								var boton = celdas[celdas.length - 1].getElementsByTagName("button")[0];
									if (boton.getAttribute("onclick").includes(id)) {
										tabla.deleteRow(i);
										break;
									}
							}
						}
					}
				});
			}

			function borrarcli(id) {
				const idmed = $("#idmed").val();
				$.ajax({
					type: "POST",
					url: "../model/perfil/medicos/del_cli.php",
					data: { id: id, idmed: idmed },
					success: function (data) {
						var tabla = document.getElementById("user2");
						var filas = tabla.getElementsByTagName("tr");
						for (var i = 0; i < filas.length; i++) {
							var celdas = filas[i].getElementsByTagName("td");
							if (celdas.length > 0) {
								var boton = celdas[celdas.length - 1].getElementsByTagName("button")[0];
									if (boton.getAttribute("onclick").includes(id)) {
										tabla.deleteRow(i);
										break;
									}
							}
						}
					}
				});
			}

			$('#idespmed').select2({
				theme: 'bootstrap-5',
				width: '100%',
			});
		</script>
		</div><!-- FIN PESTAÑA DE DATOS DE ESPECIALIDADES -->
		<!-- PESTAÑA DE DATOS DE DOCUMENTOS -->
		<div class="tab-pane fade" id="documentos" role="tabpanel">
			<div class="divider">
                <div class="divider-text">Documentación Médica</div>
            </div>
			<form enctype="multipart/form-data" action="../model/perfil/medicos/add_doc.php" method="post">
				<input type="text" id="idmed" name="idmed" value="<?php echo $idmed; ?>" hidden/> 
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="codcolmed">Código Colegio Médico</label>
						<input type="text" name="codcolemed" id="codcolemed" minlength="9" maxlength="9" value="<?php echo $codcolemed; ?>" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  />
						</div>  
					</div>

					<div class="col-md-6">
						<div class="form-group">
						<label for="codcolmed">MPSS</label>
						<input type="text" name="mpsscod" id="mpsscod"  minlength="5" maxlength="5" value="<?php echo $mpss; ?>" class="form-control mb-4" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  />
						</div>  
					</div>


					<div class="col-md-3">
						<label for="cedula">Cédula</label>
						<div class="custom-file">
						<input type="file" id="cedula" name="imagen" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf">
						</div>
					</div>
					<div class="col-md-3">
					<label for="rif">RIF</label>
						<div class="custom-file">
						<input type="file" id="rif" name="imagen1" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf">
						</div>
					</div>
					
					<div class="col-md-3">
					<label for="colemed">Carnet C.M.</label>
						<div class="custom-file">
						<input type="file" id="colemed" name="imagen2" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf">
						</div>
					</div>
					<div class="col-md-3">
					<label for="colemed">MPSS</label>
						<div class="custom-file">
							<input type="file" id="mpss" name="imagen3" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf">
						</div>
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary mt-4"><i class="fi fi-rs-cloud-upload"></i> Cargar</button>
					</div>


				</div>
			</form>
			<div class="table-responsive">
				 <table class="table table-hover" id="user3" cellspacing="0" style="width: 100%;">
					<thead>
						<tr>
							<th>Documento</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sql = ("SELECT iddocument, idmed, imagen, quees FROM drdocument WHERE idmed='$idmed' AND quees NOT IN ('firma', 'sello')");
						$objimg=$mysqli->query($sql);
						while($rowdoc = mysqli_fetch_array($objimg)) { ?>
						<tr>
						<td>
							
						<a href="../upload/doc_medicos/<?php echo $rowdoc['imagen'];?>" target="_blank"><?php echo $rowdoc['imagen']; ?></a>
						</td>
						<td align="center">
							<button type="button" onclick="fdeldoc(<?php echo $rowdoc['iddocument'];?>)" class="btn btn-primary btn-sm"><i class="fi fi-rr-delete-user"></i></button>
							
						</td>
						</tr>
					<?php } ?>

					</tbody>

				 </table>
			</div>
		<script>
		function fdeldoc(id) {
			const idmed = $("#idmed").val();
			$.ajax({
				type: "POST",
				url: "../model/perfil/medicos/del_docs.php",
				data: { id: id, idmed: idmed },
				success: function (data) {
					if(data == 1){
						Swal.fire({
							title: "Documento Eliminado",
							text: "Elimino con Exito el Documento y el Registro seleccionado",
							icon: "success",
							confirmButtonColor: "#007ebc",
							confirmButtonText: "Aceptar"
						})
						var tabla = document.getElementById("user3");
						var filas = tabla.getElementsByTagName("tr");
						for (var i = 0; i < filas.length; i++) {
							var celdas = filas[i].getElementsByTagName("td");
							if (celdas.length > 0) {
								var boton = celdas[celdas.length - 1].getElementsByTagName("button")[0];
									if (boton.getAttribute("onclick").includes(id)) {
										tabla.deleteRow(i);
										break;
									}
							}
						}
					}else{
						Swal.fire({
							icon: "error",
							title: "Error al Eliminar",
							text:"Ocurrio un error al Eliminar el Documento",
							confirmButtonText: "Volver",
							confirmButtonColor: "#005e43",
						})
					}
					if(data == 3){
						Swal.fire({
							icon: "error",
							title: "No se encuentra el documento",
							text:"Ocurrio un error al Eliminar el Documento",
							confirmButtonText: "Volver",
							confirmButtonColor: "#005e43",
							}).then(function() {
								window.location.href = "../../../html/perfil.php";
							});

					}
				}
			});
		}
		</script>
		</div><!-- FIN PESTAÑA DE DATOS DE DOCUMENTOS -->
		<!-- PESTAÑA DE DATOS DE SERVICIOS -->
		<div class="tab-pane fade" id="servicios" role="tabpanel">
			<div class="divider">
                <div class="divider-text">Servicios Afiliados</div>
            </div>
			<?php 
			 $sql = "SELECT idservaf, servicio, idestatus FROM serviciosafiliados where idestatus='1'";
			 $result=$mysqli->query($sql);
			// busco imagenes de firma, si tiene 
			$sql = ("SELECT iddocument, idmed, imagen, quees FROM drdocument WHERE idmed='$idmed' AND quees='firma'; ");
			$obj=$mysqli->query($sql); 
			if($obj->num_rows > 0){
				$arr=$obj->fetch_array();
				$firmaimg=$arr['imagen'];
			}else{
				$firmaimg='';
			}
			// busco imagenes de sello, si tiene 
			$sql = ("SELECT iddocument, idmed, imagen, quees FROM drdocument WHERE idmed='$idmed' AND quees='sello'; ");
			$obj=$mysqli->query($sql); 
				if($obj->num_rows > 0){
				$arr=$obj->fetch_array();
				$selloimg=$arr['imagen'];
			}else{
				$selloimg='';
			}
			?>
			<div class="row">
				<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
					<input type="text" id="idmed" name="idmed" value="<?php echo $idmed; ?>" hidden>
					<div style="text-align: left;">
						<div class="row">
						<?php while($row = mysqli_fetch_array($result)) { 
							$sqlbusca="SELECT COUNT(*) as cant FROM convafixmedico WHERE idmed= '".$idmed."' and  idservaf = '".$row['idservaf']."'; ";
							$obj=$mysqli->query($sqlbusca);
							$arrlast=$obj->fetch_array();
							$cant=$arrlast[0];
						?>
							<div class="col-md-3">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="<?php echo $row['idservaf'];?>"  onclick="fcheckafilia(this.id)" 
									<?php if ($cant!='0') { ?>
									checked
									<?php } ?>
									>
									<label class="form-check-label" for="<?php echo $row['idservaf'];?>">
										<?php echo $row['servicio'];?>
									</label>
								</div>
							</div>
						<?php } ?>
							
						</div>
					</div>

					<div class="row mt-5">
						<div class="col-md-6">
							<h5>Firma:</h5>
							<div class="custom-file">
								<input type="file" id="firma" name="imagen" class="form-control" accept="image/png, image/jpeg" >  
								<label id="firma" class="custom-file-label" for="firma"></label> 
								<small style="color: red" >Formato permitido: Png/Jpg</small>
							</div>
						</div>
						<div class="col-md-6">
							<h5>Sello:</h5>
							<div class="custom-file">
								<input type="file" id="sello" name="imagen1" class="form-control" accept="image/png, image/jpeg" >  
								<label id="sello"  class="custom-file-label" for="sello"></label> 
								<small style="color: red" >Formato permitido: Png/Jpg</small>
							</div>
						</div>
						<!-- Imagenes -->
						<div align="center" class="col-md-6">
							<img class="img-fluid" src="<?php echo $firmaimg ? "../upload/documentos_medicos/".$firmaimg : "../assets/img/elements/sinfoto.jpg"; ?>" alt="Sin Imagen Seleccionada!!!" class="img-fluid">
						</div>
						<div align="center" class="col-md-6">
							<img class="img-fluid" src="<?php echo $selloimg ? "../upload/documentos_medicos/".$selloimg : "../assets/img/elements/sinfoto.jpg"; ?>" alt="Sin Imagen Seleccionada!!!" class="img-fluid">
						</div>
					</div>

				</form>
			</div>
		</div>
		<script>
			function fcheckafilia(id){
				const idmed = $("#idmed").val();
            jQuery.ajax({
                type: "POST",   
                url: "../model/perfil/medicos/serv_afiliados_med.php",
                data: {id: id, idmed: idmed},
                success:function(data){ 
                  console.log(data);
                  if (data!='1') {
                  }
                }
            });
        }
		</script>
	</div>
</div>