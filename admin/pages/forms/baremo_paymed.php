<?php
session_start();
$usuario = $_SESSION['usuario'];
require('../../conexion.php');

$sqlct = ("SELECT * FROM baremos_paymed ORDER BY fecharegistro ASC");
	$resulct = $mysqli->query($sqlct);
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
							<h1>Baremo Paymed</h1>
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
						<form action="regbaremopaymed.php" method="post" enctype="multipart/form-data">
							<div class="row">
								

								<div class="col-md-11">
									<div class="form-group">
										<label for="razsocial">Razón Social:</label>
										<input style="text-transform:uppercase;" style="text-transform:uppercase;" type="text" value="PAYMED GLOBAL, LLC" class="form-control form-control-sm " disabled>
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
								
								<!--  -->
								<div class="col-md-11">
						          <div class="form-group">
						            <label for="movil">Baremo (PDF):</label>
						            <input type="file" class="form-control form-control-sm" 
						            	   name="imagen_des">
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
										<th>Fecha Registro</th>
										<th>Baremo / Validez</th>
										<th>Archivo</th>
										<th align="center">Eliminar</th>
									</tr>
									<?php while ($rowct = mysqli_fetch_array($resulct)) { ?>
										<tr>
											<td><?php echo $rowct['fecharegistro']; ?></td>
											<td><?php echo $rowct['descbaremo']; ?></td>
											<td><a href="imgdocs/<?php echo $rowct['archivo'] ?>" target="_blank" ><?php echo $rowct['archivo']; ?></a></td>
											<td align="center">
												<a class="btn btn-danger btn-sm" href="delbaremo.php?idlin=<?php echo $rowct['idbaremo']; ?>">
													<i class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php } ?>
								</table>
							</div>
						</form>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
		</div>
		<div class="row">
			<div align="center" class="col-12">
				<a href="../../index.php?usr=1" class="btn btn-secondary">Atrás</a>
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