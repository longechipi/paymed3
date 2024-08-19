<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');
	/* _____________________ Asigno variables _________________________*/
	if (isset($_GET['id'])) {
		$idaseg=$_GET['id'];
		$sql = ("SELECT a.idaseg, a.idlogin, a.idtiposeg,a.rif, a.razsocial, a.movil, a.ttelf, a.telefono, a.correo, 
										a.idpais, b.pais, a.idestado, c.estado, a.idmunicipio, d.municipio, a.idparroquia, e.parroquia,
										a.calleav, a.casaedif, a.piso, a.oficina, a.urbanizacion, a.codpostal, a.idestatus, a.fechahora_sist, a.fecharegistro
					FROM aseguradores a, paises b, estado c, municipios d, parroquias e
					WHERE a.idaseg='".$idaseg."'
					AND a.idpais=b.idpais and a.idestado=c.idestado and a.idmunicipio=d.idmunicipio and a.idparroquia=e.idparroquia");

  				$objaseg=$mysqli->query($sql);
  				$arraseg = mysqli_fetch_array($objaseg);
  				//$idlogin = $arraseg['idlogin'];

  				$tprif        = substr($arraseg['rif'], 0,1);
  				$rif          = substr($arraseg['rif'], 1,9);
  				$idtiposeg    = $arraseg['idtiposeg'];
  				$razsocial    = $arraseg['razsocial'];
  				$fecmod       = $arraseg['fechahora_sist'];
				  $fecreg       = $arraseg['fecharegistro']; 
  				$movil        = $arraseg['movil'];
  				$tipotlf      = $arraseg['ttelf'];
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
	if(isset($_POST['submit'])){
		$idaseg=$_POST['idaseg'];

		$rif         =$_POST['tprif'].$_POST['rif'];
		$razsocial   =$_POST['razsocial'];

		$ttf         =$_POST['ttf'];
		$coda        =$_POST['coda'];
		$telefono    =$coda.''.$_POST['telefono'];
		$correo      =$_POST['correo'];
		
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
		$idestatus    =$_POST['idestatus'];

		$str="UPDATE aseguradores SET rif='".strtoupper($rif)."',razsocial='".strtoupper($razsocial)."',ttelf='".$ttf."',telefono='".$telefono."',
		correo='".strtolower($correo)."',idpais='".$idpais."',idestado='".$idestado."',idmunicipio='".$idmunicipio."',idparroquia='".$idparroquia."',
		calleav='".strtoupper($calleav)."',casaedif='".strtoupper($casaedif)."',piso='".strtoupper($piso)."',oficina='".strtoupper($oficina)."',urbanizacion='".strtoupper($urbanizacion)."',codpostal='".$codpostal."',idestatus='".$idestatus."'
		 WHERE idaseg='".$idaseg."'";
		 //echo $str;exit();
			$conexion=$mysqli->query($str);
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
            <h1>Seguros</h1>
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
              <h3 class="card-title">Seguros</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
			<input type="hidden" name="idaseg" value="<?php echo $idaseg;?>">
			<input type="hidden" id="onoffswitch" value="<?php echo $idestatus;?>">
			
			<div class="row">
				<div class="col-md-3">
					<label for="rif">Código de Seguro</label>
					<div class="form-group">
						<input type="text" value="SEG-000<?php echo $idaseg;?>" 
						       class="form-control form-control-sm " disabled>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="razsocial">Fecha de Registro:</label>
						<input type="text" value="<?php echo $fecreg;?>" class="form-control form-control-sm " disabled>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="razsocial">Última Modificación:</label>
						<input type="text" value="<?php echo $fecmod;?>" class="form-control form-control-sm " disabled>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="descripcion">Estatus:</label>
						<select id="idestatus" class="form-control form-control-sm " name="idestatus" required>
							<option value="<?php echo $idestatus;?>">
								<?php 
										$queryest = ("SELECT estatus FROM estatus WHERE idestatus='".$idestatus."'");
										$arrest   = $mysqli->query($queryest); $rowest = mysqli_fetch_array($arrest);
										echo $rowest['estatus'];?></option>
							<?php
								$query = $mysqli -> query ("SELECT idestatus, estatus FROM estatus");
									while ($valores = mysqli_fetch_array($query)) {
										echo '<option value="'.$valores['idestatus'].'">'.$valores['estatus'].'</option>';
							} ?>
						</select>
					</div>
				</div>
				<!-- 1ra  -->
				<div class="col-md-1">
					<div class="form-group">
						<label for="rif">RIF:</label>
						<select class="form-control form-control-sm " id="tprif" name="tprif">
                  			<option value="<?php echo $tprif;?>"><?php echo $tprif;?></option>
                  			<option value="N">N</option>
                  			<option value="J">J</option>
                  			<option value="G">G</option>
                		</select>
					</div>
				</div>
				<div class="col-md-2">
					<label for="rif" style="visibility: hidden;">.</label>
					<div class="form-group">
						<input type="text" name="rif" id="rif" value="<?php echo $rif;?>" minlength="9" maxlength="9" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-7">
					<div class="form-group">
						<label for="razsocial">Razón Social:</label>
						<input type="text" name="razsocial" id="razsocial" value="<?php echo $razsocial;?>" style="text-transform:uppercase;" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="descripcion">Tipo Proveedor:</label>
						<select id="idtiposeg" class="form-control form-control-sm " name="idtiposeg" required>
							<option value="<?php echo $idtiposeg;?>">
								<?php $sql = ("SELECT tiposeg FROM tiposeguro WHERE idtiposeg= '".$idtiposeg."'");
												$result=$mysqli->query($sql); $vale = mysqli_fetch_array($result);
										echo $vale['tiposeg'];?></option>
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
						<label for="descripcion">Estado:</label>
						<select id="id_estado" class="form-control form-control-sm " name="idestado" required>
							<option value="<?php echo $idestado;?>"><?php echo $estado;?></option>
						</select>
					</div>
				</div> 
				<div class="col-md-3">
					<div class="form-group">
						<label for="descripcion">Municipio:</label>
						<select id="id_municipio"class="form-control form-control-sm " name="idmunicipio" required>
							<option value="<?php echo $idmunicipio;?>"><?php echo $municipio;?></option>
						</select>	
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="descripcion">Parroquia:</label>
						<select id="id_parroquia" class="form-control form-control-sm "name="idparroquia" required>
							<option value="<?php echo $idparroquia;?>"><?php echo $parroquia;?></option>
						</select>	
					</div>
				</div>
				<!-- 7ta  -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="urbanizacion">Urbanización:</label>
						<input type="text" name="urbanizacion" id="urbanizacion" value="<?php echo $urbanizacion;?>" style="text-transform:uppercase;" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="calleav">Calle/Avenida:</label>
						<input type="text" name="calleav" id="calleav" value="<?php echo $calleav;?>" style="text-transform:uppercase;" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="casaedif">Casa/Edif.:</label>
						<input type="text" name="casaedif" style="text-transform:uppercase;" id="casaedif" value="<?php echo $casaedif;?>" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="piso">Piso:</label>
						<input type="text" maxlength="2" name="piso" id="piso" value="<?php echo $piso;?>" style="text-transform:uppercase;" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="oficina">Oficina:</label>
						<input type="text" name="oficina" id="oficina"  maxlength="8" value="<?php echo $oficina;?>" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="codpostal">Cod.Postal:</label>
						<input type="text" name="codpostal" id="codpostal" value="<?php echo $codpostal;?>" maxlength="4" minlength="4" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control form-control-sm " required>
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
