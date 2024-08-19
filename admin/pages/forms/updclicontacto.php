<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');

	if (isset($_GET['id'])) {$idclinica=$_GET['id'];
		$sql = ("SELECT a.idclinica, a.idlogin, a.rif, a.razsocial, a.nombrecentrosalud,a.descrip, a.idtipo, a.idpais, a.idestado, a.idmunicipio, a.idparroquia, a.correoppal, a.calleav, a.casaedif, a.piso, a.oficina, a.urbanizacion, a.codpostal, a.idestatus, a.fechahora_sist, a.fecharegistro,
				b.pais, c.estado, d.municipio, e.parroquia, a.correoppal
				FROM clinicas a, paises b, estado c, municipios d, parroquias e
				WHERE a.idclinica='".$idclinica."'
				AND a.idpais=b.idpais AND a.idestado=c.idestado AND a.idmunicipio=d.idmunicipio AND a.idparroquia=e.idparroquia");

  		$arrcli    =$mysqli->query($sql);
  		$rowcli    = mysqli_fetch_array($arrcli);
  		/* Asigno Campos a Variables */
  		$idclinica =$rowcli['idclinica'];

  		$sqlct = ("SELECT * FROM clinicas_contacto WHERE idclinica='".$idclinica."'");
				$resulct=$mysqli->query($sqlct);	

  		$tprif     = substr($rowcli['rif'], 0,1);
  		$rif       = substr($rowcli['rif'], 1,9);

		$razsocial  =$rowcli['razsocial'];
		$nbdcm      =$rowcli['nombrecentrosalud'];
		$fecmod     =$rowcli['fechahora_sist'];
		$fecreg     =$rowcli['fecharegistro']; 
		$idestatus  =$rowcli['idestatus'];
	}
	// * * * * * * * * * * * * * * * * * * * * * * * * * * *
	if(isset($_POST['submit'])){
		//datos 
		$idclinica   =$_POST['idclinica'];
		$rif         =$_POST['tprif'].$_POST['rif'];
		$razsocial   =$_POST['razsocial'];
		$correoppal  =$_POST['correoppal'];
		$tipo        =$_POST['tipo'];
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
		$idestatus    =$_POST['idestatus'];
		
		$str="UPDATE clinicas SET rif='".strtoupper($rif)."',razsocial='".strtoupper($razsocial)."',descrip='".strtoupper($descripcion)."',idtipo='".$tipo."',idpais='".$idpais."',idestado='".$idestado."',idmunicipio='".$idmunicipio."',idparroquia='".$idparroquia."',correoppal='".strtoupper($correoppal)."',calleav='".strtoupper($calleav)."',casaedif='".strtoupper($casaedif)."',piso='".strtoupper($piso)."',oficina='".strtoupper($oficina)."',urbanizacion='".strtoupper($urbanizacion)."',codpostal='".$codpostal."', idestatus='".$idestatus."' WHERE idclinica='".$idclinica."';";
				$conexion=$mysqli->query($str);
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
            <h1>Modificación de Datos de Contacto</h1>
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
            <div style="background: #F89921"  class="card-header">
              <h3 class="card-title">Actualización de Datos de Contacto </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
		<form action="regcontacto.php" method="post">
			<div class="row">
				<div class="col-md-3">
					<label for="rif">Código de Clinica</label>
					<div class="form-group">
						<input type="text" value="CLI-000<?php echo $idclinica;?>" 
						       class="form-control form-control-sm " disabled>
						<input type="hidden" name="nocli" value="<?php echo $idclinica; ?>">
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label for="razsocial">Razón Social:</label>
						<input type="text" name="razsocial" id="razsocial" value="<?php echo $razsocial;?>" class="form-control form-control-sm " disabled>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="razsocial">Nombre del Centro:</label>
						<input type="text" name="nbcm" id="nbcm" value="<?php echo $nbdcm;?>" class="form-control form-control-sm " disabled>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="descripcion">Cargo:</label>
						<select id="cargo1" class="form-control form-control-sm" name="cargo1" required>
							<option>-- Seleccione --</option>
							<?php
								$query = $mysqli->query("SELECT idcargo,cargo FROM cargos WHERE idestatus='1'");
									while ($valores = mysqli_fetch_array($query)) {
										echo '<option value="' . $valores['idcargo'] . '">' . $valores['cargo'] . '</option>';
							} ?>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="contacto1">Persona Contacto:</label>
						<input type="text" name="contacto1" id="contacto1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="movil">Cod. Area:</label>
						<input type="text" name="coda" id="coda" maxlength="4" minlength="4" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
						                        
				<div class="col-md-2">
					<div class="form-group">
						<label for="telefono">Teléfono:</label>
						<input type="text" name="telefono" id="telefono" minlength="7" maxlength="7" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
					</div>
				</div>
				<!-- 4ta -->
				<div class="col-md-2">
					<div class="form-group">
						<label for="correo1">Correo:</label>
						<input type="text" name="correo1" id="correo1" class="form-control form-control-sm " required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="descripcion">Departamento:</label>
						<select id="dpto1" class="form-control form-control-sm" name="dpto1" required>
							<option>-- Seleccione --</option>
							<?php
							$query = $mysqli->query("SELECT idtipocontacto, tipocontacto FROM tipocontacto WHERE idestatus='1' AND idtipouser='2' ORDER BY tipocontacto ASC");
								while ($valores = mysqli_fetch_array($query)) {
									echo '<option value="' . $valores['idtipocontacto'] . '">' . $valores['tipocontacto'] . '</option>';
							} ?>
						</select>
					</div>
				</div>
				<div class="col-md-1">
						<div class="form-group" style="padding-top: 27px;" >
							<label for="descripcion"> </label>
							<input style="background: #188AE1;border-color: #188AE1;" type="submit" name="submit" value="+" 
										 class="btn btn-main btn-primary btn-lg uppercase">
						</div>
				</div>	
      </div>
      <br>
      <div class="col-md-12">
      	<style type="text/css">
					.tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
					.tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
					.tftable tr {background-color:#d4e3e5;}
					.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
					.tftable tr:hover {background-color:#ffffff;}
				</style>
				<table class="tftable" border="1">
					<tr>
						<th>Cargo</th>
						<th>Persona Contacto</th>
						<th>Telefono</th>
						<th>Correo</th>
						<th>Departamento</th>
						<th align="center">Eliminar</th>
					</tr>
					<?php while($rowct = mysqli_fetch_array($resulct)) { ?>
						<tr>
							<td><?php
										$queryti = ("SELECT cargo FROM cargos 
							  									WHERE idcargo ='" . $rowct['cargo'] . "'");
										$arreti  = $mysqli->query($queryti);
										$rowit = mysqli_fetch_array($arreti);
											echo $rowit['cargo']; ?></td>
							<td><?php echo $rowct['contacto'] ?></td>
							<td><a href="tel:<?php echo $rowct['telefono'] ?>"><?php echo $rowct['telefono'] ?></a> </td>
							<td><a href="mailto:<?php echo $rowct['correo'] ?>"><?php echo $rowct['correo'] ?></a></td>
							<td><?php
										$queryte = ("SELECT tipocontacto FROM tipocontacto 
							  									WHERE idtipocontacto='" . $rowct['dpto'] . "'");
										$arrete  = $mysqli->query($queryte);
										$rowet = mysqli_fetch_array($arrete);
												echo $rowet['tipocontacto']; ?></td>
								<td align="center">
									<a class="btn btn-danger btn-sm" href="delcontacto.php?idcli=<?php echo $rowct['idclinica'];?>&idlin=<?php echo $rowct['idcontacto'];?>">
										<i class="fa fa-trash"></i></a></td></tr>
					<?php } ?>
				</table>
			</div>
     </form> 
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
