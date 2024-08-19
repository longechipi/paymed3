<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');

	
	if(isset($_POST['submit'])){
		//datos 
		$alta        = date('d/m/Y');
		$rif         =$_POST['tprif'].$_POST['rif'];
		$razsocial   =$_POST['razsocial'];
		$nbcs        =$_POST['nbcs'];
		$correoppal  =$_POST['correoppal'];
		$idtipo      =$_POST['idtipo'];
		$idtipoprov  =$_POST['idtipoprov'];
		$descripcion =$_POST['descripcion'];

		$idpais      =$_POST['idpais'];
		$idestado    =$_POST['idestado'];
		$idmunicipio =$_POST['idmunicipio'];
		$idparroquia =$_POST['idparroquia'];

		$urbanizacion =$_POST['urbanizacion'];
		$calleav      =$_POST['calleav'];
		$casaedif     =$_POST['casaedif'];
		$piso         =$_POST['piso'];
		$oficina      =$_POST['oficina'];
		$codpostal    =$_POST['codpostal'];
		/* Inserto en Login para luego leer el idlogin */
		$str="INSERT INTO loginn (idlogin, correo, cargo, cedula, clave, privilegios) 
		VALUES (NULL, '".$correoppal."', 'Clinica', '".$rif."','".$rif."','5' );";
		$conexion=$mysqli->query($str);

		$sqllast = ("SELECT max(idlogin) from loginn;");
	    $objlast=$mysqli->query($sqllast); $arrlast=$objlast->fetch_array();  
    	$idlogin=$arrlast[0];
		/* Fin */
		
		$str="INSERT INTO clinicas (idlogin, rif, razsocial, nombrecentrosalud, descrip, idtipo, idtppr, idpais, idestado, idmunicipio, idparroquia, correoppal, calleav, casaedif, piso, oficina, urbanizacion, codpostal, idestatus, fecharegistro) 
		VALUES ('".$idlogin."','".strtoupper($rif)."','".strtoupper($razsocial)."','".strtoupper($nbcs)."','".$descripcion."', '".$idtipo."','".$idtipoprov."','".$idpais."','".$idestado."','".$idmunicipio."','".$idparroquia."','".strtoupper($correoppal)."','".strtoupper($calleav)."','".strtoupper($casaedif)."','".strtoupper($piso)."','".strtoupper($oficina)."','".strtoupper($urbanizacion)."','".$codpostal."','1','".$alta."')";
		//echo $str; exit();
		$conexion=$mysqli->query($str);
		echo '<script language="javascript">alert("¡Registro Exitoso!");
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
	
		$(document).ready(function(){
			$("#idpais").change(function(){				
				$.get("pais_js.php","idpais="+$("#idpais").val(), function(data){
					$("#id_estado").html(data);
					console.log(data);
				});
			});

			$("#id_estado").change(function(){				
				$.get("estados_js.php","id_estado="+$("#id_estado").val(), function(data){
					$("#id_municipio").html(data);
					console.log(data);
				});
			});

			$("#id_municipio").change(function(){
				$.get("munic_js.php","id_municipio="+$("#id_municipio").val(), function(data){
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
            <h1>Registro de Clínicas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
              <li class="breadcrumb-item active">Registro de Clínicas</li>
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
              <h3 class="card-title">Registro de Clínicas</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" 
					  method="post" onsubmit="return validacion()">
			<div class="row">
				<div class="col-md-1">
					<div class="form-group">
						<label for="rif">No de</label>
						<select class="form-control form-control-sm"  id="tprif" name="tprif">
                  			<option value="N">N</option>
                  			<option value="J">J</option>
                  			<option value="G">G</option>
                		</select>
					</div>
				</div>
				<div class="col-md-2">
					<label for="rif">RIF:</label>
					<div class="form-group">
					<input type="text" name="rif" id="rif"  maxlength="9" minlength="9" class="form-control form-control-sm " 
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label for="razsocial">Razón Social:</label>
						<input type="text" name="razsocial" id="razsocial" class="form-control form-control-sm " style="text-transform:uppercase;" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="nbcs">Nombre Centro de Salud:</label>
						<input type="text" name="nbcs" id="nbcs" class="form-control form-control-sm "style="text-transform:uppercase;" >
						<!--
						onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" required>
						-->
					</div>
				</div>
				<!-- 2da -->
				<div class="col-md-6">
					<div class="form-group">
						<label for="correoppal">Correo Master:</label>
						<input type="email" name="correoppal" id="correoppal" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="idtipo">Tipo de Empresa:</label>
						<select class="form-control form-control-sm" id="idtipo" name="idtipo">
							<option value="">-- Seleccione --</option>
               <?php
							$query = $mysqli -> query ("SELECT idtipoempresa, tipoempresa FROM tipoempresa  WHERE idestatus='1'");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idtipoempresa'].'">'.$valores['tipoempresa'].'</option>';
						} ?>
            </select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="idtipo">Tipo de Proveedor:</label>
						<select class="form-control form-control-sm" id="idtipoprov" name="idtipoprov">
							<option value="">-- Seleccione --</option>
              <?php
							$srtsql = $mysqli -> query ("SELECT idtppr, tipoprov FROM tipoproveedor  WHERE idestatus='1'");
							while ($valsql = mysqli_fetch_array($srtsql)) {
							echo '<option value="'.$valsql['idtppr'].'">'.$valsql['tipoprov'].'</option>';
						} ?>
                		</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="descripcion">Descripción (breve):</label>
						<input type="text" name="descripcion" id="descripcion" style="text-transform:uppercase;" 
						 class="form-control form-control-sm " required>
					</div>   
				</div>
				<!-- 3ra -->			
				<!-- Pais / Estado / Municipio / Parroquia -->
				<div class="col-md-3">
					<div class="form-group">
						<label for="descripcion">País:</label>
						<select id="idpais" class="form-control form-control-sm" name="idpais" required>
							<option value="">-- Pais --</option>
							<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("SELECT idpais, pais, idestatus FROM paises WHERE idestatus ='1';");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idpais'].'">'.$valores['pais'].'</option>';
							} ?>
						</select>
					</div>
				</div> 
				<div class="col-md-3">
					<div class="form-group">
						<label for="descripcion">Estado:</label>
						<select id="id_estado" class="form-control form-control-sm" name="idestado" required>
							<option value="">-- Seleccione --</option>
						</select>
					</div>
				</div> 
				<div class="col-md-3">
					<div class="form-group">
						<label for="descripcion">Municipio:</label>
						<select id="id_municipio" class="form-control form-control-sm" name="idmunicipio" required>
							<option value="">-- Municipio --</option>
						</select>	
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="descripcion">Parroquia:</label>
						<select id="id_parroquia" class="form-control form-control-sm" name="idparroquia" required>
							<option value="">-- Parroquia --</option>
						</select>	
					</div>
				</div>
				<!-- 7ta  -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="urbanizacion">Urbanización:</label>
						<input type="text" name="urbanizacion" style="text-transform:uppercase;"  id="urbanizacion" class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="calleav">Calle/Avenida:</label>
						<input type="text" name="calleav" id="calleav" style="text-transform:uppercase;"  class="form-control form-control-sm"required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="casaedif">Casa/Edif.:</label>
						<input type="text" maxlength="8" name="casaedif" id="casaedif" class="form-control form-control-sm " style="text-transform:uppercase;"  required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="piso">Piso:</label>
						<input type="text" name="piso" id="piso" maxlength="2" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="oficina">Oficina:</label>
						<input type="text" style="text-transform:uppercase;"  name="oficina" id="oficina" maxlength="8" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="codpostal">Cod.Postal:</label>
						<input type="text" name="codpostal" id="codpostal"  maxlength="4" minlength="4" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control form-control-sm " required>
					</div>
				</div>

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
