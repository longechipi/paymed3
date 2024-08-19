<?php
session_start();
$usuario = $_SESSION['usuario'];
require('../../conexion.php');
if (isset($_GET['id'])) {
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
}
// * * * * * * * * * * * * * * * * * * * * * * * * * * *
if (isset($_POST['submit'])) {
	//datos 
	$idclinica   = $_POST['idclinica'];
	$rif         = $_POST['tprif'] . $_POST['rif'];
	$razsocial   = $_POST['razsocial'];
	$nbcm        = $_POST['nbcm'];
	$correoppal  = $_POST['correoppal'];
	$tipo        = $_POST['tipo'];
	$tipoprov    = $_POST['idtipoprov'];
	$descripcion = $_POST['descripcion'];

	$idpais      = $_POST['idpais'];
	$idestado    = $_POST['idestado'];
	$idmunicipio = $_POST['idmunicipio'];
	$idparroquia = $_POST['idparroquia'];

	$urbanizacion = $_POST['urbanizacion'];
	$calleav      = $_POST['calleav'];
	$casaedif     = $_POST['casaedif'];
	$piso         = $_POST['piso'];
	$oficina      = $_POST['oficina'];
	$codpostal    = $_POST['codpostal'];
	$idestatus    = $_POST['idestatus'];

	$str = "UPDATE clinicas SET rif='" . strtoupper($rif) . "',razsocial='" . strtoupper($razsocial) . "', nombrecentrosalud='" . strtoupper($nbcm) . "',descrip='" . strtoupper($descripcion) . "',idtipo='" . $tipo . "',idtppr='" . $tipoprov . "',idpais='" . $idpais . "',idestado='" . $idestado . "',idmunicipio='" . $idmunicipio . "',idparroquia='" . $idparroquia . "',correoppal='" . strtoupper($correoppal) . "',calleav='" . strtoupper($calleav) . "',casaedif='" . strtoupper($casaedif) . "',piso='" . strtoupper($piso) . "',oficina='" . strtoupper($oficina) . "',urbanizacion='" . strtoupper($urbanizacion) . "',codpostal='" . $codpostal . "', idestatus='" . $idestatus . "' WHERE idclinica='" . $idclinica . "';";
	$conexion = $mysqli->query($str);
	echo '<script language="javascript">alert("¡Actualizado Con Exito!");
																					window.location.href="rpt_clin.php"; </script>';
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PAYMED GLOBAL, LLC</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<script src="jquery/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#idpais").change(function() {
				$.get("pais_js.php", "idpais=" + $("#idpais").val(), function(data) {
					$("#id_estado").html(data);
					console.log(data);
				});
			});

			$("#id_estado").change(function() {
				$.get("estados_js.php", "id_estado=" + $("#id_estado").val(), function(data) {
					$("#id_municipio").html(data);
					console.log(data);
				});
			});

			$("#id_municipio").change(function() {
				$.get("munic_js.php", "id_municipio=" + $("#id_municipio").val(), function(data) {
					$("#id_parroquia").html(data);
					console.log(data);
				});
			});


		});
	</script>
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- -->
		<?php include("menuppal.php"); ?>
		<!--  -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Modificación de Clínicas</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
								<li class="breadcrumb-item active">Actualizar</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<!--div class="row">
        <div class="col-md-12"-->
				<div class="card card-primary">
					<div style="background: #F89921" class="card-header">
						<h3 class="card-title">Actualización de Datos de la Clínicas </h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>
						</div>
					</div>
					<div class="card-body">
						<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
							<input type="hidden" name="idclinica" value="<?php echo $idclinica; ?>">
							<div class="row">
								<div class="col-md-3">
									<label for="rif">Código de Clinica</label>
									<div class="form-group">
										<input type="text" value="CLI-000<?php echo $idclinica; ?>" class="form-control form-control-sm " disabled>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="razsocial">Fecha de Registro:</label>
										<input type="text" value="<?php echo $fecreg; ?>" class="form-control form-control-sm " disabled>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="razsocial">Última Modificación:</label>
										<input type="text" value="<?php echo $fecmod; ?>" class="form-control form-control-sm " disabled>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="descripcion">Estatus:</label>
										<select id="idestatus" class="form-control form-control-sm " name="idestatus" required>
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
								<div class="col-md-1">
									<div class="form-group">
										<label for="rif">No de</label>
										<select class="form-control form-control-sm " id="tprif" name="tprif">
											<option value="<?php echo $tprif; ?>"><?php echo $tprif; ?></option>
											<option value="N">N</option>
											<option value="J">J</option>
											<option value="G">G</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<label for="rif">RIF</label>
									<div class="form-group">
										<input type="text" name="rif" id="rif" value="<?php echo $rif; ?>" minlength="9" maxlength="9" class="form-control form-control-sm " required>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label for="razsocial">Razón Social:</label>
										<input type="text" name="razsocial" id="razsocial" value="<?php echo $razsocial; ?>" class="form-control form-control-sm " 
										 style="text-transform:uppercase;" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="razsocial">Nombre del Centro:</label>
										<input type="text" name="nbcm" id="nbcm" value="<?php echo $nbdcm; ?>" class="form-control form-control-sm "  
										style="text-transform:uppercase;" required>
									</div>
								</div>

								<!-- 2da -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="correoppal">Correo Master:</label>
										<input type="text" name="correoppal" id="correoppal" value="<?php echo $correoppal; ?>" class="form-control form-control-sm " required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="tipo">Tipo de Empresa:</label>
										<select id="idtipo" class="form-control form-control-sm " name="tipo" required>
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
										<select class="form-control form-control-sm " id="idtipoprov" name="idtipoprov">
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
								<div class="col-md-12">
									<div class="form-group">
										<label for="descripcion">Descripción:</label>
										<input type="text" name="descripcion" id="descripcion" style="text-transform:uppercase;" 
										value="<?php echo $descripcion; ?>" class="form-control form-control-sm " required>
									</div>
								</div>
								<!-- Pais / Estado / Municipio / Parroquia -->
								<div class="col-md-3">
									<div class="form-group">
										<label for="descripcion">País:</label>
										<select id="idpais"class="form-control form-control-sm " name="idpais" required>
											<option value="<?php echo $idpais; ?>"><?php echo $pais; ?></option>
											<?php
											//require('admin/conexion.php');
											$query = $mysqli->query("SELECT idpais, pais FROM paises WHERE idestatus='1'; ");
											while ($valores = mysqli_fetch_array($query)) {
												echo '<option value="' . $valores['idpais'] . '">' . $valores['pais'] . '</option>';
											} ?>
										</select>
										<!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="descripcion">Estado:</label>
										<select id="id_estado" class="form-control form-control-sm " name="idestado" required>
											<option value="<?php echo $idestado; ?>"><?php echo $estado; ?></option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="descripcion">Municipio:</label>
										<select id="id_municipio" class="form-control form-control-sm " name="idmunicipio" required>
											<option value="<?php echo $idmunicipio; ?>"><?php echo $municipio; ?></option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="descripcion">Parroquia:</label>
										<select id="id_parroquia" class="form-control form-control-sm " name="idparroquia" required>
											<option value="<?php echo $idparroquia; ?>"><?php echo $parroquia; ?></option>
										</select>
									</div>
								</div>
								<!-- 7ta  -->
								<div class="col-md-3">
									<div class="form-group">
										<label for="urbanizacion">Urbanización:</label>
										<input type="text" name="urbanizacion"  style="text-transform:uppercase;" id="urbanizacion" value="<?php echo $urbanizacion; ?>" class="form-control form-control-sm " required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="calleav">Calle/Avenida:</label>
										<input type="text" name="calleav" id="calleav"   style="text-transform:uppercase;"value="<?php echo $calleav; ?>" class="form-control form-control-sm " required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="casaedif">Casa/Edif.:</label>
										<input type="text" name="casaedif" style="text-transform:uppercase;" id="casaedif" value="<?php echo $casaedif; ?>" class="form-control form-control-sm ">
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="piso">Piso:</label>
										<input type="text" name="piso" maxlength="2" id="piso" value="<?php echo $piso; ?>" class="form-control form-control-sm ">
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="oficina">Oficina:</label>
										<input type="text"  maxlength="8" name="oficina" id="oficina" value="<?php echo $oficina; ?>" class="form-control form-control-sm ">
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="codpostal">Cod.Postal:</label>
										<input type="text" maxlength="4" minlength="4" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control form-control-sm " name="codpostal" id="codpostal" value="<?php echo $codpostal; ?>" required>
									</div>
								</div>
								<!-- 8va  -->
								<div align="right" class="col-md-12">
									<input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Actualizar" class="btn btn-main btn-primary btn-lg uppercase">
								</div>
						</form>

						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
		</div>
		<div class="row">
			<div align="center" class="col-12">
				<a href="rpt_clin.php" class="btn btn-secondary">Atrás</a>
			</div>
		</div>
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<?php include("foo_admin.php"); ?>

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
	</aside>
	<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="../../plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../../dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="../../dist/js/demo.js"></script>
	<script>
		function validacion(){
			costo = document.getElementById("costo").value;
			if( isNaN(costo) ) {
				alert('Error Costo!!!');
				return false;
			}
		}
	</script>

</body>

</html>