<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');
	if(isset($_POST['submit'])){
		//datos 
		$fecharegistro = date("d-m-Y");
		$rif =$_POST['tprif'].$_POST['rif'];
		$razsocial =$_POST['razsocial'];
		$idtiposeg =$_POST['idtiposeg'];
		
		$idpais =$_POST['idpais'];
		$idestado =$_POST['idestado'];
		$idmunicipio =$_POST['idmunicipio'];
		$idparroquia =$_POST['idparroquia'];

		$urbanizacion =$_POST['urbanizacion'];
		$calleav =$_POST['calleav'];
		$casaedif =$_POST['casaedif'];
		$piso =$_POST['piso'];
		$oficina =$_POST['oficina'];
		$codpostal =$_POST['codpostal'];
		/* Inserto en Login para luego leer el idlogin */
		$str="INSERT INTO loginn (correo, cargo, cedula, clave, privilegios) 
		      VALUES ('".$correo."','Seguros','".$rif."','".$rif."','3')";
			$conexion=$mysqli->query($str);

		$sqllast = ("SELECT max(idlogin) from loginn;");
	    $objlast=$mysqli->query($sqllast); $arrlast=$objlast->fetch_array();  
    	$idlogin=$arrlast[0];
		/* Fin */

		$sqlvalrif = ("SELECT count(idaseg) as sihay FROM aseguradores WHERE rif='".strtoupper($rif)."'");
	    $objvalrif=$mysqli->query($sqlvalrif); $arrvalrif=$objvalrif->fetch_array();  
    	$tiene=$arrvalrif['sihay'];

    if($tiene>0){

    		echo '<script language="javascript">alert("¡El RIF que intenta registrar ya existe!");
																			      window.location.href="regseg.php"; </script>';
    }else{

    		$str="INSERT INTO aseguradores (idlogin, idtiposeg, rif, razsocial, idpais, idestado, idmunicipio, idparroquia, calleav, casaedif, piso, oficina, urbanizacion, codpostal, idestatus, fecharegistro) 
		VALUES ('".$idlogin."','".$idtiposeg."','".strtoupper($rif)."', '".strtoupper($razsocial)."','".$idpais."','".$idestado."','".$idmunicipio."','".$idparroquia."','".strtoupper($calleav)."','".strtoupper($casaedif)."','".strtoupper($piso)."','".strtoupper($oficina)."','".strtoupper($urbanizacion)."','".$codpostal."','1','".$fecharegistro."')";
				$conexion=$mysqli->query($str);

				$sqllasta = ("SELECT max(idaseg) from aseguradores");
			    $objlasta=$mysqli->query($sqllasta); $arrlasta=$objlasta->fetch_array();  
		    	$idsegu=$arrlasta[0];

				echo '<script language="javascript">alert("¡Registro Exitoso!");
																			      window.location.href="updsegcontacto.php?id='.$idsegu.'"; </script>';
    }
		
		
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
            <h1>Registro de Compañía de Seguros</h1>
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
              <h3 class="card-title">Registro de Compañía de Seguros</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
			<div class="row">
				<!-- 1ra  -->
				<div class="col-md-1">
					<div class="form-group">
						<label for="rif">RIF:</label>
						<select class="form-control form-control-sm" id="tprif" name="tprif">
                  			<option value="N">N</option>
                  			<option value="J">J</option>
                  			<option value="G">G</option>
                		</select>
					</div>
				</div>
				<div class="col-md-2">
					<label for="rif"><span style="color:#fff">.</span></label>
					<div class="form-group">
					<input type="text" name="rif" id="rif"  maxlength="9" minlength="9" class="form-control form-control-sm " 
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<div class="col-md-7">
					<div class="form-group">
						<label for="razsocial">Razón Social:</label>
						<input type="text" name="razsocial" style="text-transform:uppercase;" 
						 onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122 && event.keyCode = 32) event.returnValue = false;" required id="razsocial" class="form-control form-control-sm " >
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="descripcion">Tipo Proveedor:</label>
						<select id="idtiposeg" class="form-control form-control-sm " name="idtiposeg" required>
							<option value="">-- Seleccione --</option>
							<?php
							$query = $mysqli -> query ("SELECT idtiposeg , tiposeg FROM tiposeguro WHERE idestatus='1' ORDER BY tiposeg ASC");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idtiposeg'].'">'.$valores['tiposeg'].'</option>';
							} ?>
						</select>
					</div>
				</div> 
				<!-- 2da -->
			
				<!-- Pais / Estado / Municipio / Parroquia -->
				<div class="col-md-3">
					<div class="form-group">
						<label for="descripcion">País:</label>
						<select id="idpais" class="form-control form-control-sm " name="idpais" required>
							<option value="">-- Pais --</option>
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
						<label for="descripcion">Estado:</label>
						<select id="id_estado" class="form-control form-control-sm " name="idestado" required>
							<option value="">-- Estado --</option>
						</select>
					</div>
				</div> 
				<div class="col-md-3">
					<div class="form-group">
						<label for="descripcion">Municipio:</label>
						<select id="id_municipio"class="form-control form-control-sm " name="idmunicipio" required>
							<option value="">-- Municipio --</option>
						</select>	
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="descripcion">Parroquia:</label>
						<select id="id_parroquia" class="form-control form-control-sm "name="idparroquia" required>
							<option value="">-- Parroquia --</option>
						</select>	
					</div>
				</div>
				<!-- 7ta  -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="urbanizacion">Urbanización:</label>
						<input type="text"  style="text-transform:uppercase;" name="urbanizacion" id="urbanizacion" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="calleav">Calle/Avenida:</label>
						<input type="text" style="text-transform:uppercase;" name="calleav" id="calleav" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="casaedif">Casa/Edif.:</label>
						<input type="text" style="text-transform:uppercase;" name="casaedif" id="casaedif" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="piso">Piso:</label>
						<input type="text" maxlength="2"  name="piso" id="piso" style="text-transform:uppercase;" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="oficina">Oficina:</label>
						<input type="text" name="oficina" maxlength="8" id="oficina" style="text-transform:uppercase;" class="form-control form-control-sm " required>
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
				<input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Continuar" class="btn btn-main btn-primary btn-lg uppercase">
			</div>	
		</form> 
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
	  <div class="row">
        <div align="center" class="col-12">
          <a href="rpt_seg.php" class="btn btn-secondary">Salir</a>          
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
