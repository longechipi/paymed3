<?php
session_start();
$usuario = $_SESSION['usuario'];
require('../../conexion.php');
/* _____________________ Asigno variables _________________________*/
if (isset($_GET['id'])) {
	$idaseg = $_GET['id'];
	$sql = ("SELECT a.idaseg, a.idlogin, a.rif, a.razsocial, a.movil, a.telefono, a.correo, 
										a.idpais, b.pais, a.idestado, c.estado, a.idmunicipio, d.municipio, a.idparroquia, e.parroquia,
										a.calleav, a.casaedif, a.piso, a.oficina, a.urbanizacion, a.codpostal, a.idestatus, a.fechahora_sist, a.fecharegistro
					FROM aseguradores a, paises b, estado c, municipios d, parroquias e
					WHERE a.idaseg='" . $idaseg . "'
					AND a.idpais=b.idpais and a.idestado=c.idestado and a.idmunicipio=d.idmunicipio and a.idparroquia=e.idparroquia");

	$objaseg = $mysqli->query($sql);
	$arraseg = mysqli_fetch_array($objaseg);
	//$idlogin = $arraseg['idlogin'];

	$sqlct = ("SELECT * FROM asegura_negocia WHERE idaseg='" . $idaseg . "' ORDER BY idneg DESC");
	$resulct = $mysqli->query($sqlct);

	$tprif        = substr($arraseg['rif'], 0, 1);
	$rif          = substr($arraseg['rif'], 1, 9);
	$razsocial    = $arraseg['razsocial'];
	$fecmod       = $arraseg['fechahora_sist'];
	$fecreg       = $arraseg['fecharegistro'];
	$movil        = $arraseg['movil'];
	$telefono     = $arraseg['telefono'];
	$correo       = $arraseg['correo'];
	$idpais       = $arraseg['idpais'];
	$pais         = $arraseg['pais'];
	$idestado     = $arraseg['idestado'];
	$estado       = $arraseg['estado'];
	$idmunicipio  = $arraseg['idmunicipio'];
	$municipio    = $arraseg['municipio'];
	$idparroquia  = $arraseg['idparroquia'];
	$parroquia    = $arraseg['parroquia'];
	$calleav      = $arraseg['calleav'];
	$casaedif     = $arraseg['casaedif'];
	$piso         = $arraseg['piso'];
	$oficina      = $arraseg['oficina'];
	$urbanizacion = $arraseg['urbanizacion'];
	$codpostal    = $arraseg['codpostal'];
	$idestatus    = $arraseg['idestatus'];
}
/* _____________________ Actualiza _________________________*/
if (isset($_POST['submit'])) {
	$idaseg = $_POST['idaseg'];

	$rif       = $_POST['tprif'] . $_POST['rif'];
	$razsocial = $_POST['razsocial'];

	$coda     =$_POST['coda'];
	$telefono =$coda.''.$_POST['telefono'];
	$correo   = $_POST['correo'];

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
	if (isset($_POST['onoffswitch'])) {
		$idestatus = '1';
	} else {
		$idestatus = '0';
	}
	$str = "UPDATE aseguradores SET rif='" . strtoupper($rif) . "',razsocial='" . strtoupper($razsocial) . "',movil='" . $movil . "',telefono='" . $telefono . "',
		correo='" . strtoupper($correo) . "',idpais='" . $idpais . "',idestado='" . $idestado . "',idmunicipio='" . $idmunicipio . "',idparroquia='" . $idparroquia . "',
		calleav='" . strtoupper($calleav) . "',casaedif='" . strtoupper($casaedif) . "',piso='" . strtoupper($piso) . "',oficina='" . strtoupper($oficina) . "',urbanizacion='" . strtoupper($urbanizacion) . "',codpostal='" . $codpostal . "',idestatus='" . $idestatus . "'
		 WHERE idaseg='" . $idaseg . "'";

	$conexion = $mysqli->query($str);
	echo '<script language="javascript">alert("¡Actualizaciòn Exitosa!");
					    															window.location.href="rpt_seg.php"; </script>';
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
	<!-- -->
	<link rel="stylesheet" href="css/onoff.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
							<h1>Convenio con la Compañía de Seguros (BAREMO)</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
								<li class="breadcrumb-item active">Registro</li>
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
						<h3 class="card-title">Convenio con la Compañía de Seguros (BAREMO)</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>
						</div>
					</div>
					<div class="card-body">
						<form action="regbaremoseg.php" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-3">
									<label for="rif">Código de Seguro</label>
									<div class="form-group">
										<input type="text" value="SEG-000<?php echo $idaseg; ?>" class="form-control form-control-sm " disabled>
										<input type="hidden" name="nocli" value="<?php echo $idaseg; ?>">
									</div>
								</div>

								<div class="col-md-9">
									<div class="form-group">
										<label for="razsocial">Razón Social:</label>
										<input style="text-transform:uppercase;" style="text-transform:uppercase;" type="text" name="razsocial" id="razsocial" value="<?php echo $razsocial; ?>" class="form-control form-control-sm " disabled>
									</div>
								</div>
								<!-- //*! -->
								<div class="col-md-11">
						          <div class="form-group">
						            <label for="movil">Valido desde:</label>
						            <input type="date" class="form-control form-control-sm" 
						            	   name="desde" required>
						          </div>
						        </div>
								<!--  -->
								<div class="col-md-11">
						          <div class="form-group">
						            <label for="movil">Valido hasta:</label>
						            <input type="date" class="form-control form-control-sm" 
						            	   name="hasta" required>
						          </div>
						        </div>
								<!--  -->
								<div class="col-md-11">
						          <div class="form-group">
						            <label for="movil">Tipo de Baremo:</label>
						            <select class="form-control form-control-sm" name="tpbaremo" required>
						            	<option value="Paymed">Paymed</option>
						            	<option value="Propio">Propio</option>
						            </select>
						          </div>
						        </div>
								<!--  -->
								<div class="col-md-11">
						          <div class="form-group">
						            <label for="movil">Baremo (PDF):</label>
						            <input type="file" class="form-control form-control-sm" 
						            	   name="imagen_des">
						          </div>
						        </div>
								<!--  -->
								<div class="col-md-11">
						          <div class="form-group">
						            <label for="movil">Porcentaje de Descuento:</label>
						            <input type="text" name="baremodesc" minlength="1" maxlength="2"
						            	   class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
						          </div>
						        </div>
								<!--  -->
							<div class="col-md-1">
								<div class="form-group" style="padding-top:30px;">
									<label for="descripcion"> </label>
									<input style="background: #188AE1;border-color: #188AE1; padding:1px 10px;" type="submit" name="submit" value="+" class="btn btn-main btn-primary btn-lg uppercase">
								</div>
							</div>
							</div>
							<br>
							<div class="col-md-12">
								<style type="text/css">
									.tftable {
										font-size: 12px;
										color: #333333;
										width: 100%;
										border-width: 1px;
										border-color: #729ea5;
										border-collapse: collapse;
									}

									.tftable th {
										font-size: 12px;
										background-color: #acc8cc;
										border-width: 1px;
										padding: 8px;
										border-style: solid;
										border-color: #729ea5;
										text-align: left;
									}

									.tftable tr {
										background-color: #d4e3e5;
									}

									.tftable td {
										font-size: 12px;
										border-width: 1px;
										padding: 8px;
										border-style: solid;
										border-color: #729ea5;
									}

									.tftable tr:hover {
										background-color: #ffffff;
									}
								</style>
								<table class="tftable" border="1">
									<tr>
										<th>Tipo</th>
										<th>Baremo / Validez</th>
										<th>%Descuento</th>
										<th>Archivo</th>
										<th align="center">Eliminar</th>
									</tr>
									<?php while ($rowct = mysqli_fetch_array($resulct)) { ?>
										<tr>
											<td><?php echo $rowct['tipobaremo']; ?></td>
											<td><?php echo $rowct['descripcion']; ?></td>
											<td><?php echo $rowct['descbaremo']; ?>%</td>
											<td><a href="imgdocs/<?php echo $rowct['archivo'] ?>" target="_blank" ><?php if($rowct['archivo']==''){echo 'BAREMO PAYMED';}
												  else{echo $rowct['archivo'];} ?>	</a></td>
											<td align="center">
												<a class="btn btn-danger btn-sm" href="delbaremoseg.php?idseg=<?php echo $rowct['idaseg']; ?>&idlin=<?php echo $rowct['idneg']; ?>">
													<i class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php } ?>
								</table>
							</div>
							<div align="right" class="col-md-12" style="padding-top: 20px">
								<a href="updsegservicios.php?id=<?php echo $idaseg;?>" 
								   class="btn btn-main btn-primary btn-lg uppercase" 
								   style="background: #F89921;border-color: #F89921">Anterior</a>
								<a href="rpt_seg.php" 
								   class="btn btn-main btn-primary btn-lg uppercase" 
								   style="background: #F89921;border-color: #F89921">Finalizar</a>
							</div>
						</form>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
		</div>
		<div class="row">
			<div align="center" class="col-12">
				<a href="rpt_seg.php" class="btn btn-secondary">Atrás</a>
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

</body>

</html>