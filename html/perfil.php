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
			$a="SELECT * FROM medicos WHERE idlogin=$idlogin";
			$ares = $mysqli->query($a);
			$row=$ares->fetch_array();

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
			<button type="button" class="nav-link active"	role="tab"	data-bs-toggle="tab" data-bs-target="#datos" aria-controls="datos" aria-selected="true"> Datos Basicos </button>
		</li>
		<li class="nav-item">
			<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false"> Datos Bancarios </button>
		</li>
		<li class="nav-item">
			<button type="button"	class="nav-link" role="tab"	data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="false"> Especialidades </button>
		</li>
		<li class="nav-item">
			<button type="button"	class="nav-link" role="tab"	data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="false"> Documentos </button>
		</li>
		<li class="nav-item">
			<button type="button"	class="nav-link" role="tab"	data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="false"> Servicios Afiliados </button>
		</li>
	</ul>
	<hr>
	<div class="tab-content">
		<div class="tab-pane fade show active" id="datos" role="tabpanel">
		<form id="upd_cli">
			<input type="hidden" name="idclinica" value="<?php echo $idlogin; ?>">
						<div class="row"> <!--INICIO ROW 1 -->
						<div class="divider">
							<div class="divider-text">Datos de Principales</div>
						</div>
							<div class="col-md-3">
									<div class="form-group">
										<label for="apellido1">Primer Apellido: </label>
										<input type="text" name="apellido1" id="apellido1" value="<?php echo $row['apellido1'];?>"  class="form-control" style="text-transform:uppercase;"  required/>
									</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="form-group">
									<label for="apellido1">Segundo Apellido: </label>
									<input type="text" name="apellido2" id="apellido2" value="<?php echo $row['apellido2'];?>" class="form-control" style="text-transform:uppercase;" />
								</div>
							</div>

							<div class="col-md-3 mb-3">
								<div class="form-group">
									<label for="nombre1">Primer Nombre: </label>
									<input type="text" name="nombre1" id="nombre1" value="<?php echo $row['nombre1'];?>" class="form-control" style="text-transform:uppercase;" required />
								</div>
							</div>

							<div class="col-md-3 mb-3">
								<div class="form-group">
									<label for="mombre2">Segundo Nombre: </label>
									<input type="text" name="nombre2" id="nombre2" value="<?php echo $row['nombre2'];?>" class="form-control" style="text-transform:uppercase;" />
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label for="rif">RIF:</label>
									<select class="form-select" id="tprif" name="tprif">
										<option value="<?php echo substr($row['rif'],0,1);?>"><?php echo substr($row['rif'],0,1); ?></option>
										<option value="N">N</option>
										<option value="J">J</option>
										<option value="G">G</option>
									</select>
								</div>
							</div>

							<div class="col-md-3 mb-3">
								<div class="form-group">
									<label for="rif"></label>
										<input type="text" name="rif" id="rif" value="<?php echo $row['rif'];?>" maxlength="9" minlength="9" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required />
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label for="tpdoc">Nac</label>
									<select class="form-select" id="tpdoc" name="tpdoc">
										<option value="<?php echo substr($row['nrodoc'],0,1);?>"><?php echo substr($row['nrodoc'],0,1);?></option>
										<option value="V">V</option>
										<option value="E">E</option>
								</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="nrodoc">Nro. Documento:</label>
									<input type="text" name="nrodoc" id="nrodoc" value="<?php echo $row['nrodoc'];?>" maxlength="8" minlength="7" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required />
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label for="fnacimiento">Fec.Nacimiento:</label>
									<input type="date" name="fnacimiento" id="fnacimiento" value="<?php echo $row['fnacimiento'];?>" class="form-control" required />
								</div>
							</div>

							<div class="col-md-1">
								<div class="form-group">
									<label for="edad">Edad:</label>
									<input type="text" name="edad" id="edad" value="<?php echo $row['edad'];?>" class="form-control" required />
								</div>
							</div>

						</div> <!--FIN ROW 1 -->
							
					
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
		<div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
			<p>
				Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
				cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
				cheesecake fruitcake.
			</p>
			<p class="mb-0">
				Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
				cotton candy liquorice caramels.
			</p>
		</div>
		<div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
			<p>
				Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
				cupcake gummi bears cake chocolate.
			</p>
			<p class="mb-0">
				Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
				roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
				jelly-o tart brownie jelly.
			</p>
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
		<?php include('../layouts/script.php') ?>

		</body>

		</html>