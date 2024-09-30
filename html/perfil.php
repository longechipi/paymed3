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
$a = "SELECT * FROM medicos WHERE idlogin=$idlogin";
$ares = $mysqli->query($a);
$row = $ares->fetch_array();
$idmed = $row['idmed'];
$codcolemed = $row['codcolemed'];
$mpss = $row['mpss'];

?>
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
<div class="row">
<div class="col-lg-12 mb-12 order-0">
<div class="card">
<div class="d-flex align-items-end row">
<div class="col-12">
<div class="card-body">
<h5 class="card-title text-primary mb-3">Perfil</h5>

<div class="row">
<div class="col-xl-12">
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
		<div class="tab-pane fade show active" id="datos" role="tabpanel">
			<form id="upd_datos">
				<input type="hidden" name="idlogin" value="<?php echo $idlogin; ?>">
				<div class="row"> <!--INICIO ROW 1 -->
					<div class="divider">
						<div class="divider-text">Datos de Principales</div>
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

					<div class="col-md-2">
						<div class="form-group">
							<label for="rif">RIF:</label>
							<select class="form-select" id="tprif" name="tprif">
								<option value="<?php echo substr($row['rif'], 0, 1); ?>"><?php echo substr($row['rif'], 0, 1); ?></option>
								<option value="N">N</option>
								<option value="J">J</option>
								<option value="G">G</option>
							</select>
						</div>
					</div>

					<div class="col-md-3 mb-3">
						<div class="form-group">
							<label for="rif"></label>
							<input type="text" name="rif" id="rif" value="<?php echo $row['rif']; ?>" maxlength="9" minlength="9" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required />
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="tpdoc">Nac</label>
							<select class="form-select" id="tpdoc" name="tpdoc">
								<option value="<?php echo substr($row['nrodoc'], 0, 1); ?>"><?php echo substr($row['nrodoc'], 0, 1); ?></option>
								<option value="V">V</option>
								<option value="E">E</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="nrodoc">Nro. Documento:</label>
							<input type="text" name="nrodoc" id="nrodoc" value="<?php echo $row['nrodoc']; ?>" maxlength="8" minlength="7" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required />
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="fnacimiento">Fec.Nacimiento:</label>
							<input type="date" name="fnacimiento" id="fnacimiento" value="<?php echo $row['fnacimiento']; ?>" class="form-control" required />
						</div>
					</div>

					<div class="col-md-1">
						<div class="form-group">
							<label for="edad">Edad:</label>
							<input type="text" name="edad" id="edad" value="<?php echo $row['edad']; ?>" class="form-control" required />
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="idsexo">Sexo:</label>
							<select id="idsexo" class="form-select" name="idsexo" required>

								<?php
								//require('admin/conexion.php');
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
								//require('admin/conexion.php');
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
							<label for="descripcion">País:</label>
							<select id="idpais" class="form-select" name="idpais" required>
								<option value="">-- Pais --</option>
								<?php
								//require('admin/conexion.php');
								$query = $mysqli->query("SELECT idpais, pais, idestatus FROM paises WHERE idestatus =1 AND idpais = 232");
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
		<div class="tab-pane fade" id="bancos" role="tabpanel">
			<form id="form2">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="apellido1">Titular </label>
							<input type="text" name="titular" id="titular" value="<?php echo $row['apellido1'].' '. $row['apellido2'].' '.  $row['nombre1'].' '. $row['nombre2'];?>" class="form-control" readonly>
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
					$sqldat = ("SELECT  a.idlogin, a.titular, a.nrodoc, a.idbco, b.banco, a.idtipocuenta, 
					c.tipocuenta, a.nrocuenta, a.idestatus 
					FROM datbconac a, bancos b, tipocuenta c
					WHERE a.idbco=b.idbco AND a.idtipocuenta=c.idtipocuenta AND a.idlogin = '".$idlogin."';");
					$objdat=$mysqli->query($sqldat); 
					$arrdat=$objdat->fetch_array();
					 $titular=$arrdat['titular'];
					 $idbco=$arrdat['idbco'];
					 $banco=$arrdat['banco'];
					 $idtipocuenta=$arrdat['idtipocuenta'];
					 $tipocuenta=$arrdat['tipocuenta'];
					 $nrocuenta=$arrdat['nrocuenta'];
					 $sqldati = ("SELECT a.iddatbcoint, a.titular, a.idpais, c.pais,  a.nrodoc, a.idbco, b.banco, a.ach, 
	     					a.nrocuenta, a.swit, a.aba, a.dircta, a.telefono, a.codpostal, a.idestatus 
						FROM datbcoint  a, bancos b, paises c
						WHERE a.idbco=b.idbco AND a.idpais=c.idpais AND a.idlogin = '".$idlogin."';");
						$objdati=$mysqli->query($sqldati); 
						$arrdati=$objdati->fetch_array();
						if (!isset($arrdati)) {
							$titularint=$idpais=$pais=$nrodocint=$idbcoint=$bancoint=$ach=$nrocuentaint=$swit=$aba=$dircta=$telefono=$codpostalint='';
						}else{
							$titularint=$arrdati['titular'];
							$idpais=$arrdati['idpais'];
							$pais=$arrdati['pais'];
							$nrodocint=$arrdati['nrodoc'];
							$idbcoint=$arrdati['idbco'];
							$bancoint=$arrdati['banco'];
							$ach=$arrdati['ach'];
							$nrocuentaint=$arrdati['nrocuenta'];
							$swit=$arrdati['swit'];
							$aba=$arrdati['aba'];
							$dircta=$arrdati['dircta'];
							$telefono=$arrdati['telefono'];
							$codpostalint=$arrdati['codpostal'];
							$idestatus=$arrdati['idestatus'];
						}

					?>
					<div class="divider">
						<div class="divider-text">Datos Transferencia Nacional</div>
					</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="idbco">Banco:</label>
						<select id="idbco" class="form-select mb-3" name="idbco" required>
							<option value="<?php echo $idbco;?>"><?php echo $banco;?></option>
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
							<option value="<?php echo $idtipocuenta;?>"><?php echo $tipocuenta;?></option>
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

						<input type="text" name="nrocuenta" id="nrocuenta" minlength="20" maxlength="20" value="<?php echo $nrocuenta;?>" 
						class="form-control" 
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  required>
					</div>
				</div>

				<div class="divider">
						<div class="divider-text">Datos Transferencia Internacional</div>
					</div>

				<div class="col-md-3 mb-3">
					<div class="form-group">
						<label for="idpais" class="control-label">Pais:</label>
						<select id="idpais" class="form-control" name="idpais" required>
							<option value="<?php echo $idpais;?>"><?php echo $pais;?></option>
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
						<select id="idbcoint" class="form-control" name="idbcoint" required>
							<option value="<?php echo $idbcoint;?>"><?php echo $bancoint;?></option>
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
						<input type="text" name="nrocuentaint" id="nrocuentaint" minlength="8" maxlength="20"  value="<?php echo $nrocuentaint;?>" class="form-control" 
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<!-- 3ra -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="ach">ACH:</label>
						<input type="text" name="ach" id="ach" value="<?php echo $ach;?>" class="form-control mb-3">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="swit">SWIT:</label>
						<input type="text" name="swit" id="swit" value="<?php echo $swit;?>" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="aba">ABA:</label>
						<input type="text" name="aba" id="aba" value="<?php echo $aba;?>" class="form-control" required>
					</div>
				</div>
				<!-- 4ta -->
				<div class="col-md-8">
					<div class="form-group">
						<label for="dircta">Dirección Cuenta:</label>
						<input type="text" name="dircta" id="dircta" value="<?php echo $dircta;?>" class="form-control" 
						minlength="7" style="text-transform:uppercase;" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="telefono">Teléfono:</label>
						<input type="text" name="telefono" id="telefono" minlength="11" maxlength="11" value="<?php echo $telefono;?>" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="codpostalint">Cod.Postal:</label>
						<input type="text" name="codpostalint" id="codpostalint" maxlength="5" minlength="5" value="<?php echo $codpostalint;?>" class="form-control " onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				</div>

				<div class="text-center mt-4">
						<button type="submit" id="btn_upd_banco" class="btn btn-primary"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
						<a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
					</div>

			</form>
		</div>
		<div class="tab-pane fade" id="especialidades" role="tabpanel">
			
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<label for="apellido1">Especialidades:</label>
							<select class="form-select" id="idespmed" name="idespmed" onchange="asignaesp(this.value)" >
								<option value="" disabled selected>Seleccione</option>
								<?php
								$query = $mysqli -> query ("SELECT idesppresu, especialidad FROM presupuesto_especialidades");
								while ($valores = mysqli_fetch_array($query)) {
								echo '<option value="'.$valores['idesppresu'].'">'.$valores['especialidad'].'</option>';
										} ?>
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
						<table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
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
									echo '<td><a href="javascript:borrar('.$row['idespmed'].')"><i class="fi fi-rs-trash"></i></a></td>';
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
								echo '<td><a href="javascript:borrar('.$rowc['idclinica'].')"><i class="fi fi-rs-trash"></i></a></td>';
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
		
		</div>

		<div class="tab-pane fade" id="documentos" role="tabpanel">
			<div class="divider">
                    <div class="divider-text">Documentación Médica</div>
            </div>
			<form enctype="multipart/form-data" action="updoc.php" method="post">
				<input type="text" id="idmed" name="idmed" value="<?php echo $idmed; ?>" hidden/> 
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="codcolmed">Código Colegio Médico</label>
						<input type="text" name="codcolemed" id="codcolemed" minlength="9" maxlength="9" value="<?php echo $codcolemed; ?>" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required />
						</div>  
					</div>

					<div class="col-md-6">
						<div class="form-group">
						<label for="codcolmed">MPSS</label>
						<input type="text" name="mpsscod" id="mpsscod"  minlength="5" maxlength="5" value="<?php echo $mpss; ?>" class="form-control mb-4" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required />
						</div>  
					</div>


					<div class="col-md-3">
						<label for="cedula">Cédula</label>
						<div class="custom-file">
							<input type="file" id="cedula" name="imagen" class="form-control" accept="application/pdf" required>  
							<label id="cedula"  class="custom-file-label" for="cedula"></label> 
						</div>
					</div>
					<div class="col-md-3">
					<label for="rif">RIF</label>
						<div class="custom-file">
							<input type="file" id="rif" name="imagen1" class="form-control" accept="application/pdf" required>
							
						</div>
					</div>
					
					<div class="col-md-3">
					<label for="colemed">Carnet C.M.</label>
						<div class="custom-file">
							<input type="file" id="colemed"  name="imagen2"  class="form-control" accept="application/pdf" required>
							
						</div>
					</div>
					<div class="col-md-3">
					<label for="colemed">MPSS</label>
						<div class="custom-file">
							<input type="file" id="mpss"  name="imagen3"  class="form-control" accept="application/pdf" required>
							
						</div>
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
						$sql = ("SELECT iddocument, idmed, imagen FROM drdocument WHERE idmed='$idmed'; ");
						$objimg=$mysqli->query($sql);
						while($rowdoc = mysqli_fetch_array($objimg)) { ?>
						<tr>
						<td>
							
						<a href="drdocument/<?php echo $rowdoc['imagen'];?>" target="_blank"><?php echo $rowdoc['imagen']; ?></a>
						</td>
						<td align="center">
							<button type="button" onclick="fdeldoc(<?php echo $rowdoc['iddocument'];?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
							
						</td>
						</tr>
					<?php } ?>

					</tbody>

				 </table>
			</div>

		</div>

		<div class="tab-pane fade" id="servicios" role="tabpanel">
			<div class="divider">
                    <div class="divider-text">Servicios Afiliados</div>
            </div>
			<?php 
			 $sql = ("SELECT idservaf, servicio, idestatus FROM serviciosafiliados where idestatus='1'; ");
			 $result=$mysqli->query($sql);
			// busco imagenes de firma, si tiene 
			$sql = ("SELECT iddocument, idmed, imagen, quees FROM drdocument WHERE idmed='".$idmed."' AND quees='firma'; ");
			$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
			$firmaimg=$arr['imagen'];
			// busco imagenes de sello, si tiene 
			$sql = ("SELECT iddocument, idmed, imagen, quees FROM drdocument WHERE idmed='".$idmed."' AND quees='sello'; ");
			$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
			$selloimg=$arr['imagen'];
			
			
			?>
			<div class="row">
				<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
					<input type="hidden" id="idmed" name="idmed" value="<?php echo $idmed; ?>">
					<input type="hidden" name="nrodoc" value="<?php echo $nrodoc; ?>">
					<div style="text-align: left;">
						<div class="row">
						<?php while($row = mysqli_fetch_array($result)) { 
							$sqlbusca="SELECT COUNT(*) as cant FROM convafixmedico WHERE idmed= '".$idmed."' and   idservaf = '".$row['idservaf']."'; ";
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

					<div class="row">
						<div class="col-md-6">
							<h5>Firma:</h5>
							<div class="custom-file">
								<input type="file" id="firma" name="imagen" class="form-control" accept="image/png, image/jpeg" >  
								<label id="firma"  class="custom-file-label" for="firma"></label> 
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
							<img src="<?php echo $firmaimg ?>" alt="Sin Imagen Seleccionada!!!" style="width:200px;height:200px;">
						</div>
						<div align="center" class="col-md-6">
							<img src="<?php echo $selloimg ?>" alt="Sin Imagen Seleccionada!!!" style="width:200px;height:200px;">
						</div>

						<div align="right" class="col-md-12"><br>
							<input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Actualizar" class="btn btn-main btn-primary btn-lg uppercase">
						</div>
					</div>

				</form>
			</div>














		</div>

	</div>
</div>
</div>
</div>



</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('../layouts/footer.php') ?>
<div class="content-backdrop fade"></div>
</div>
</div>
</div>
<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<?php include('../layouts/modals/add-horarios.php')?>
<?php include('../layouts/script.php') ?>
<script>
$('#upd_datos').submit(function(e){
e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/perfil/udp_datos.php",
        data: $("#upd_datos").serialize(),
        success: function(data){
			console.log(data);
            // if(data == 1){
            //     Swal.fire({
            //         title: 'Registro Exitoso!',
            //         text: 'Se ha registrado correctamente la Clinica',
            //         icon: 'success',
            //         confirmButtonColor: "#007ebc",
            //         confirmButtonText: 'Aceptar'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             window.location.href = "regcli.php";
            //         }
            //     });
            // }else{
            //     Swal.fire({
            //         title: 'Error!',
            //         text: 'Ocurrio un Error al Registrar la Clinica',
            //         icon: 'error',
            //         confirmButtonText: 'Aceptar'
            //     });
            // }
        }
    }) 
})

$('#form2').submit(function(e){
e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/perfil/upd_bancos.php",
        data: $("#form2").serialize(),
        success: function(data){
			console.log(data);
            // if(data == 1){
            //     Swal.fire({
            //         title: 'Registro Exitoso!',
            //         text: 'Se ha registrado correctamente la Clinica',
            //         icon: 'success',
            //         confirmButtonColor: "#007ebc",
            //         confirmButtonText: 'Aceptar'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             window.location.href = "regcli.php";
            //         }
            //     });
            // }else{
            //     Swal.fire({
            //         title: 'Error!',
            //         text: 'Ocurrio un Error al Registrar la Clinica',
            //         icon: 'error',
            //         confirmButtonText: 'Aceptar'
            //     });
            // }
        }
    }) 
})

$("#idpais").change(function() {
		$.get("../model/reg_clinica/pais.php", "idpais=" + $("#idpais").val(), function(data) {
		$("#id_estado").html(data);
	});
});

$("#id_estado").change(function() {
		$.get("../model/reg_clinica/estado.php", "id_estado=" + $("#id_estado").val(), function(data) {
		$("#id_municipio").html(data);
	});
});

$("#id_municipio").change(function() {
		$.get("../model/reg_clinica/municipio.php", "id_municipio=" + $("#id_municipio").val(), function(data) {
		$("#id_parroquia").html(data);
	});
});

$('#id_estado, #id_parroquia, #id_municipio, #idpais, #idespmed').select2({
	theme: 'bootstrap-5',
	width: '100%',
});
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
	$('#user2').DataTable({
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
	$('#user3').DataTable({
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
</script>
</body>

</html>