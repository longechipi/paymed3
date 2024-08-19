<?php
	session_start();
	require('../../conexion.php');
	date_default_timezone_set("America/Caracas");

	//$idregistrador=$_SESSION['idlogin'];
	$usuario=$_SESSION['usuario'];
	$cargo = $_SESSION['cargo'];
	$alta     = date('d/m/Y');

	if(isset($_GET['pac'])){
		$paso=1;
   	$idcita = $_GET['pac'];
		/* Busco si tiene Cita registrada  */
   	$sqldatosatras = ("SELECT count(*) as hay, fecsint, kglb, peso, cmpie, estatura, presion, fumador, motivo, antecedentes, exfisico, hallazgos, fechadia FROM consultas_med
   			WHERE idcita='".$idcita."'"); //echo $sqldatosatras; exit();
   	$objdatosatras = $mysqli->query($sqldatosatras); $arrdatosatras = $objdatosatras->fetch_array();
   	if($arrdatosatras['hay']>0){ // Si existe, cargo los datos
   		
   		$fecsint 			= $arrdatosatras['fecsint'];
   		$kglb					= $arrdatosatras['kglb'];
   		$peso 				= $arrdatosatras['peso'];
   		$cmpie 				= $arrdatosatras['cmpie'];
   		$estatura 		= $arrdatosatras['estatura'];
   		$presion 			= $arrdatosatras['presion'];
   		$fumador 			= $arrdatosatras['fumador'];
   		$motivo 			= $arrdatosatras['motivo'];
   		$antecedentes = $arrdatosatras['antecedentes'];
   		$exfisico			= $arrdatosatras['exfisico'];
   		$hallazgos 		= $arrdatosatras['hallazgos'];
   		$fechadia			= $arrdatosatras['fechadia'];
		}else{
				   	$fecsint= $kglb= $peso= $cmpie= $estatura= $presion= $fumador= $motivo= $antecedentes= $exfisico= $hallazgos = $fechadia='';
		} // end sset($_GET['x']
  //} 	// end isset pac
   	//$sqldatos = ("SELECT * FROM citas WHERE idcita='".$idcita."'");
   	$sqldatos = ("SELECT a.*, b.cedula FROM citas a, pacientes b WHERE a.idpaci=b.idpaci and a.idcita='".$idcita."'");
   	$objdatos = $mysqli->query($sqldatos); $arrdatos = $objdatos->fetch_array();
   	$idpaci = $arrdatos['idpaci']; 
   	/*      */
   			if ($cargo=='Asistente1' || $cargo=='Asistente2') {
            // busco idtrabajacon en loginn para poder vincular con idmed
            $sqlasist = ("SELECT idlogin, idtrabajacon FROM loginn WHERE correo='".$usuario."'");
            $objasist = $mysqli->query($sqlasist); $arrasist = $objasist->fetch_array();
            $idregistrador = $arrasist['idlogin'];       // Leo el idlogin del Asistente para registrarlo en la pacientes
            $idtrabajacon = $arrasist['idtrabajacon'];   // Leo el idlogin del Medico para quien trabaja
            //echo $cargo.'/'; echo $idtrabajacon; exit();
            // Si esta seteada la session, es el idlogin del medico seleccionado para el asistente logeado
   					if (isset($_SESSION['idloginmed'])) {$idlogin_session = $_SESSION['idloginmed'];}else{$idlogin_session = $_SESSION['idlogin'];}
            // busco idmed para insertarlo en paciente
            // antes $sqlmed = ("SELECT idmed FROM medicos WHERE idlogin='".$idtrabajacon."'");
            $sqlmed = ("SELECT idmed FROM medicos WHERE idlogin='".$idlogin_session."'");
            $objmed = $mysqli->query($sqlmed); $arrmed = $objmed->fetch_array();
            $idmed = $arrmed['idmed']; //echo $idmed.'/'.$idtrabajacon.'/'.$idregistrador; exit();

         }else if ($cargo=='Medico') {
         		$idregistrador ='';
            // busco idmed para insertarlo en consultas_med
            $sqlmed = ("SELECT idmed FROM medicos WHERE correo='".$usuario."'");
            $objmed = $mysqli->query($sqlmed); $arrmed = $objmed->fetch_array();
            $idmed = $arrmed['idmed'];
         }
	}
	
	if(isset($_POST['submit'])){
		//datos  
		$fechadia = date('d/m/Y');
		$idcita   =$_POST['idcita'];
		$idmed   	=$_POST['idmed'];$idregistrador  	=$_POST['idregistrador'];
		$idpac    =$_POST['idpac'];
		$kglb     =$_POST['kglb'];
		$peso     =$_POST['peso'];
		$cmpie    =$_POST['cmpie'];
		$estatura =$_POST['estatura'];
		$presion  =$_POST['presion'];
		$fumador     =$_POST['fumador'];
		$fecsint  =$_POST['fecsint'];  // Fecha de Sintomatologia
		$motivo   =$_POST['motivo'];
		$antecedentes =$_POST['antecedentes'];
		$exfisico  =$_POST['exfisico'];
		$hallazgos =$_POST['hallazgos'];
		// Verifico si la cita ya fue generada y saber si registro o actualizo
		$sqlestacita = ("SELECT count(*) as estalacita FROM consultas_med WHERE idcita='".$idcita."'");
    $objestacita = $mysqli->query($sqlestacita); $arrestacita = $objestacita->fetch_array();
    if ($arrestacita['estalacita']=='0') {
     	$str="INSERT INTO consultas_med (idpaci, idmed, idregistrador, idcita, fecsint, kglb, peso, cmpie, estatura,	presion, fumador, motivo, antecedentes,	exfisico,	hallazgos, fechadia, fin) 
			VALUES ('".$idpac."','".$idmed."','".$idregistrador."','".$idcita."','".$fecsint."', '".$kglb."','".$peso."','".$cmpie."' ,'".$estatura."','".$presion."','".$fumador."','".strtoupper($motivo)."','".strtoupper($antecedentes)."','".strtoupper($exfisico)."','".strtoupper($hallazgos)."','".$fechadia."','0')";
     }else{
     	$str="UPDATE consultas_med SET fecsint='".$fecsint."',
     																kglb='".$kglb."',
     																peso='".$peso."',
     																cmpie='".$cmpie."',
     																estatura='".$estatura."',
     																presion='".$presion."',
     																fumador='".$fumador."',
     																motivo='".$motivo."',
     																antecedentes='".$antecedentes."',
     																exfisico='".$exfisico."',
     																hallazgos='".$hallazgos."'
     																 WHERE idcita='".$idcita."';";
     }
     
		$conexion=$mysqli->query($str);
		/* Capturo ultimo id  de consultas_med para usar en el envio mail de la historia*/
		$sqllastid = ("SELECT MAX(idregistro) FROM consultas_med;");
		$objlastid = $mysqli->query($sqllastid); $arrlastid = $objlastid->fetch_array();
    $_SESSION['idregistro'] = $arrlastid[0];

		/* Genero y Registro Nro de Historia, si no la tiene */
		$sqlhist = ("SELECT count(*) as esta FROM historias WHERE idpaci='".$idpac."'");
		$objhist = $mysqli->query($sqlhist); $arrhist = $objhist->fetch_array();
    $esta = $arrhist[0];
    if ($esta=='0') {
    	$sql="SELECT a.nrohistoria FROM historias a where a.idhist = (select MAX(b.idhist) FROM historias b);"; 
    	$obj = $mysqli->query($sql); $arr = $obj->fetch_array();
    	$nrohist = $arr[0]+1;
    	$nrohist = '000'.$nrohist;
 			$str="INSERT INTO historias(idhist, nrohistoria, idpaci, idestatus)
								VALUES (null, '".$nrohist."', '".$idpac."', '1' )";
			$conexion=$mysqli->query($str);
    }
		echo '<script language="javascript">window.location.href="reghist_2.php?pac='.$idcita.'";</script>';
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
	<!-- SweetAlert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <h1>Registro de Consulta Médica:</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
              <li class="breadcrumb-item active">Registro de Consulta Medica</li>
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
              <h3 class="card-title">Registro de Consulta Médica:</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" 
					  method="post" onsubmit="return validacion()">
			<div class="row">
				                <div class="col-md-3">
                           <div class="form-group">
                              <label for="historia">Nro de Historia:</label>
                              <input type="hidden" name="idpac" value="<?php echo $idpaci;?>">
                              <input type="hidden" name="idcita" value="<?php echo $idcita;?>">
                              <input type="hidden" name="idmed" value="<?php echo $idmed;?>">
                              <input type="hidden" name="idregistrador" value="<?php echo $idregistrador;?>">
                              <input type="text" name="historia" id="historia" class="form-control form-control-sm " readonly value="<?php if($paso==1){echo $arrdatos['historia'];}?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="cedula">Cédula:</label>
                              <input type="text" name="cedula" id="cedula" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm " readonly 
                              value="<?php if($paso==1){echo $arrdatos['cedula'];}?>">
                           </div>
                        </div>
                        
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="nombre">Nombre:</label>
                              <input type="text" name="nombre" id="nombre" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm " readonly 
                              value="<?php if($paso==1){echo $arrdatos['apellido'].' '.$arrdatos['nombre'];}?>">
                           </div>
                        </div>

                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Fecha:</label>
                              <input type="text" class="form-control form-control-sm " readonly 
                              			 value="<?php echo $alta;?>">
                           </div>
                        </div>

				<div class="col-md-1">
					<div class="form-group">
						<label for="kglb">Kg./Lb.:</label>
						<select class="form-control form-control-sm" id="kglb" name="kglb">
							<option value="<?php echo $kglb;?>"><?php echo $kglb;?></option>
              <option value="Kilo">Kilo</option>
              <option value="Libra">Libra</option>
            </select>
					</div>
				</div>
				<div class="col-md-1">
					<label for="peso">Peso:</label>
					<div class="form-group">
					<input type="text" name="peso" id="peso"  maxlength="5" minlength="2" 
								 value="<?php echo $peso;?>" class="form-control form-control-sm " 
						onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="cmpie">Cm./Pie.:</label>
						<select class="form-control form-control-sm" id="cmpie" name="cmpie">
							<option value="<?php echo $cmpie;?>"><?php echo $cmpie;?></option>
              <option value="cm">Cms</option>
              <option value="pie">Pies</option>
            </select>
					</div>
				</div>
				<div class="col-md-2">
					<label for="estatura">Estatura:</label>
					<div class="form-group">
					<input type="text" name="estatura" id="estatura"  maxlength="4" minlength="2" class="form-control form-control-sm " 
						value="<?php echo trim($estatura);?>	" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
					</div>
				</div>
				<div class="col-md-2">
					<label for="rif">Presión Arterial:</label>
					<div class="form-group">
						<input type="text" name="presion" id="presion" value="<?php echo $presion;?>" maxlength="6" minlength="6" class="form-control form-control-sm">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="fumador">¿Fumador?:</label>
						<select class="form-control form-control-sm" id="fumador" name="fumador">
							<option value="<?php echo $fumador;?>"><?php echo $fumador;?></option>
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="razsocial">Fecha Sintomatología:</label>
						<input type="date" name="fecsint" id="fecsint"  value="<?php echo $fecsint;?>" class="form-control form-control-sm " onblur="verifecha()" >
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="razsocial">Motivo de Consulta:</label>
						<textarea name="motivo" id="motivo" class="form-control form-control-sm text-start" style="text-transform:uppercase;text-align:left;" rows="6" required><?php echo $motivo; ?></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="razsocial">Antecedentes Médicos:</label>
						<textarea name="antecedentes" id="antecedentes" class="form-control form-control-sm text-start" style="text-transform:uppercase;" rows="6"><?php echo $antecedentes;?></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="razsocial">Examen Físico:</label>
						<textarea name="exfisico" id="exfisico" class="form-control form-control-sm " style="text-transform:uppercase;" rows="6"><?php echo $exfisico; ?></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="razsocial">Hallazgos o Diagnóstico:</label>
						<textarea name="hallazgos" id="hallazgos" class="form-control form-control-sm " style="text-transform:uppercase;" rows="6" required><?php echo $hallazgos;?></textarea>
					</div>
				</div>

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
          <a href="rpt_citas.php" class="btn btn-secondary">Atrás</a>          
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
<!-- AdminLTE ds -->
<script src="js/ds.js"></script>
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
