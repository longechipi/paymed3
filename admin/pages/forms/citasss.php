<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');
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
	
		$(document).ready(function(){
			$("#idseguro").change(function(){				
				$.get("segcli_js.php","idseguro="+$("#idseguro").val(), function(data){
					$("#idclinica").html(data);
					console.log(data);
				});
			});

			$("#idclinica").change(function(){				
				$.get("climed_js.php","idcli="+$("#idclinica").val(), function(data){
					$("#idmed").html(data);
					console.log(data);
				});
			});

			$("#idmed").change(function(){
				$.get("medesp_js.php","idmed="+$("#idmed").val(), function(data){
					$("#idespecialidad").html(data);
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
            <h1>Clinicas</h1>
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
            <div style="background: #F89921"  class="card-header">
              <h3 class="card-title">Registro</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
			<div class="row">
			
				<!-- Seguros / Clinicas / Medicos / Especialidad -->
				<div class="col-md-3">
					<div class="form-group">
						<!--label for="cc-exp" class="control-label mb-1">Estado</label-->
						<select id="idseguro" class="form-control mtitu" name="idseguro" required>
							<option value="">-- Seguros --</option>
							<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("SELECT idaseg, razsocial FROM aseguradores WHERE idestatus ='1';");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idaseg'].'">'.$valores['razsocial'].'</option>';
							} ?>
						</select>
						<!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
					</div>
				</div> 
				<div class="col-md-3">
					<div class="form-group">
						<!--label for="cc-exp" class="control-label mb-1">Estado</label-->
						<select id="idclinica" class="form-control mtitu" name="idclinica" required>
							<option value="">-- Clinicas --</option>
						</select>
						<!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
					</div>
				</div> 
				<div class="col-md-3">
					<div class="form-group">
						<!--label for="cc-exp" class="control-label mb-1">Municipio</label-->
						<select id="idmed" class="form-control" name="idmed" required>
							<option value="">-- Medicos --</option>
						</select>	
						<!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<!--label for="cc-exp" class="control-label mb-1">Municipio</label-->
						<select id="idespecialidad" class="form-control" name="idespecialidad" required>
							<option value="">-- Especialidad --</option>
						</select>	
						<!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
					</div>
				</div>
				<!-- 7ta  -->
		

				<!-- 8va  -->
			<div align="right" class="col-md-12">
				<input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Registrar..." class="btn btn-main btn-primary btn-lg uppercase">
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
