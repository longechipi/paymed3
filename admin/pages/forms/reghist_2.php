<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	$cargo= $_SESSION['cargo'];
	require('../../conexion.php');
	date_default_timezone_set("America/Caracas");
	$hora     = date("h:i:sa");
	$alta     = date('d/m/Y');

	if(isset($_GET['pac'])){
  	$paso=1;
   	$idcita = $_GET['pac'];
   	//$sqldatos = ("SELECT * FROM citas WHERE idcita='".$idcita."'");
   	$sqldatos = ("SELECT a.*, b.cedula FROM citas a, pacientes b WHERE a.idpaci=b.idpaci and a.idcita='".$idcita."'");  	
    $objdatos = $mysqli->query($sqldatos); $arrdatos = $objdatos->fetch_array();
    $idpaci = $arrdatos['idpaci']; 
    /* Busco idcita y idpaci, saber que tipo de examenes tiene 
		$sqlexamen = ("SELECT idexam, idpac, idcita, tipo, idtbl, idestatus FROM examenesx WHERE idpac='".$idpaci."' and idcita='".$idcita."';");
		$objexamen = $mysqli->query($sqlexamen); $arrexamen = $objexamen->fetch_array();
    $idpaci = $arrexamen['idpac'];
    $tipo = $arrexamen['tipo'];
		echo $idpaci.'-'.$tipo; exit();*/
    /* Busco Nro Historia  */
		$sqlhist = ("SELECT nrohistoria FROM historias WHERE idpaci='".$idpaci."'");
		$objhist = $mysqli->query($sqlhist); $arrhist = $objhist->fetch_array();
    $nrohistoria = $arrhist[0];
    /*  
    if ($cargo=='Asistente1' || $cargo=='Asistente2') {
        // busco idtrabajacon en loginn para poder vincular con idmed
        $sqlasist = ("SELECT idlogin, idtrabajacon FROM loginn WHERE correo='".$usuario."'");

        $objasist = $mysqli->query($sqlasist); $arrasist = $objasist->fetch_array();
        $idregistrador = $arrasist['idlogin'];       // Leo el idlogin del Asistente para registrarlo en la pacientes
        $idtrabajacon = $arrasist['idtrabajacon'];   // Leo el idlogin del Medico para quien trabaja
        //echo $cargo.'/'; echo $idtrabajacon; exit();
        // busco idmed para insertarlo en paciente
        $sqlmed = ("SELECT idmed FROM medicos WHERE idlogin='".$idtrabajacon."'");
        $objmed = $mysqli->query($sqlmed); $arrmed = $objmed->fetch_array();
        $idmed = $arrmed['idmed']; //echo $idmed.'/'.$idtrabajacon.'/'.$idregistrador; exit();

     }else if ($cargo=='Medico') {
        // busco idmed para insertarlo en consultas_med
        $sqlmed = ("SELECT idmed FROM medicos WHERE correo='".$usuario."'");
        $objmed = $mysqli->query($sqlmed); $arrmed = $objmed->fetch_array();
        $idmed = $arrmed['idmed'];
     }*/


  }
	
	if(isset($_POST['submit'])){

		//datos 		
		$fechadia      = date('d/m/Y');
		$idpac         =$_POST['idpac'];
		//$idmed   	=$_POST['idmed'];$idregistrador  	=$_POST['idregistrador'];
		$idcita        =$_POST['idcita'];
		$laboratorio   =$_POST['laboratorio'];   // adicional a lo registrado en tbl examenesx, si lo amerita
		$imagenologia  =$_POST['imagenologia'];  // adicional a lo registrado en tbl examenesx, si lo amerita
		
		$codserv      =$_POST['codserv'];			
		$codzona      =$_POST['codzona'];	
		$codestudio   =$_POST['codestudio'];
		$selectlab   =$_POST['selectlab']; // idlaboratorio


		$anatomia      =$_POST['anatomia'];
		$interconsultas        =$_POST['interconsultas'];
		$otros         =$_POST['otros'];	 

		/*$str="UPDATE consultas_med SET laboratorio='".strtoupper($laboratorio)."', codserv='".$codserv."', codzona='".$codzona."', codestudio='".$codestudio."',anatomia='".strtoupper($anatomia)."', interconsultas='".strtoupper($interc)."', otros='".strtoupper($otros)."',hora='".$hora."' WHERE idpaci='".$idpac."' AND fechadia='".$fechadia."'";*/
		
		$str="UPDATE consultas_med SET laboratorio='".strtoupper($laboratorio)."', imagenologia='".strtoupper($imagenologia)."', 
		codserv='".$codserv."', codzona='".$codzona."', codestudio='".$codestudio."',
		anatomia='".strtoupper($anatomia)."', interconsultas='".strtoupper($interconsultas)."', otros='".strtoupper($otros)."',hora='".$hora."' 
					WHERE idpaci='".$idpac."' AND fechadia='".$fechadia."'";
		$conexion=$mysqli->query($str);		 
		echo '<script language="javascript">window.location.href="reghist_3.php?pac='.$idcita.'";</script>';
			                                  
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
  <!-- SweetAlert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	
		$(document).ready(function(){
			/**/
			const nrohistoria = document.getElementById("nrohistoria").value;
			Swal.fire({
  			icon: 'info',
  			title: 'Historia Nro:'+nrohistoria,
  			text: '***'
			})
			
			$("#codserv").change(function(){				
				$.get("servimg_js.php","codserv="+$("#codserv").val(), function(data){
					$("#codzona").html(data);
					console.log(data);
				});
			});

			$("#codzona").change(function(){				
				$.get("servzona_js.php","codzona="+$("#codzona").val(), function(data){
					$("#codestudio").html(data);
					console.log(data);
				});
			});
/*
			$("#id_municipio").change(function(){
				$.get("munic_js.php","id_municipio="+$("#id_municipio").val(), function(data){
					$("#id_parroquia").html(data);
					console.log(data);
				});
			});*/

			// Busco si tiene examenes registrados al cargar la pagina, es posible pulso Btn Atras
			const idpac = document.getElementById("idpac").value;
			const idcita = document.getElementById("idcita").value;
			buscaexamenes(idpac, idcita);
			buscadescri(idpac, idcita);  //Busca las descripciones de los examenes, entre otras
		});
</script>
<style type="text/css">

	table td {
	
	padding-top: 2px;
  padding-bottom: 2px;
  padding-left: 10px;
  padding-right: 2px;

  background-color: #feffe3;
}
</style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper 
	padding: 9px; -->
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
            <h1>Registro de Estudios Médico</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
              <li class="breadcrumb-item active">Registro de Consulta Médica</li>
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
              <h3 class="card-title">Registro de Consulta Médica</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
					  <!--input type="hidden" id="nrohistoria" value="< ?php echo $nrohistoria;?>"-->
					  <input type="hidden" id="idpac" name="idpac" value="<?php echo $idpaci;?>">
            <input type="hidden" id="idcita" name="idcita" value="<?php echo $idcita;?>">
			<div class="row">
				                <div class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Nro de Historia:</label>
                              <!--input type="email" name="correo" id="correo" class="form-control form-control-sm " readonly value="< ?php if($paso==1){echo $arrdatos['historia'];}?>"-->
                              <input type="text" name="nrohistoria" id="nrohistoria" class="form-control form-control-sm " readonly value="<?php if($paso==1){echo $nrohistoria;}?>">
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
                              <label for="nombre">Nombre: </label>
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

				<div class="col-md-4">
					<div class="form-group">
						<label for="selectlab">Laboratorio:</label>
            <select class="form-control form-control-sm" id="selectlab" name="selectlab" >
              <option value="">Seleccione</option>
                 <?php
                 //require('admin/conexion.php');
                 $query = $mysqli->query("SELECT idlab, nombre FROM laboratorios WHERE idestatus='1';");
                 while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="' . $valores['idlab'] . '">' . $valores['nombre'] . '</option>';
                 } ?>
              </select>
					</div>
				</div>
				<div class="col-md-7">
					<label>Examenes Laboratorio:</label>
					<div class="form-group">
						<table id="tbllaboratorio"  border="0">
        				<tr id="rowtbllab">
        					
        				</tr>
        		</table>
        		<!--h6 id="titulolab" style="color: blue;"><center>Examenes Laboratorios </center></h6-->

					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group"><br>
						<button type="button" id="btnaddexam" class="btn btn-success" title="Añadir Examen">+</button>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<!--h6>Estudios de Laboratorio:</h6-->
						<label for="laboratorio">Estudios de Laboratorio:</label>
						<textarea name="laboratorio" id="laboratorio" class="form-control form-control-sm" style="text-transform:uppercase;" rows="2" ></textarea>
					</div>
				</div>
				
				<div class="col-md-12 center">
				<!--center><h3 style="font-family: bold; " >Imagenologia</h3> </center-->
				<label>Imagenologia</label>
				</div>

      <div class="col-md-3">
           <div class="form-group">
              <label for="codserv">Servicio:</label>
              <select class="form-control form-control-sm" id="codserv" name="codserv">
              	<option value="">Seleccione</option>
                 <?php
                 //require('admin/conexion.php');
                 $query = $mysqli->query("SELECT codserv, servicio FROM servimage WHERE idestatus='1' GROUP BY 1,2;");
                 while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="' . $valores['codserv'] . '">' . $valores['servicio'] . '</option>';
                 } ?>
              </select>
              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
           </div>
        </div>
        <div  class="col-md-4">
           <div class="form-group">
              <label for="codzona">Zona:</label>
              <select id="codzona" class="form-control form-control-sm" name="codzona">
                 
              </select>
              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
           </div>
        </div>
        <div class="col-md-4">
           <div class="form-group">
              <label for="codestudio">Estudio:</label>
              <select id="codestudio" class="form-control form-control-sm " name="codestudio">
                    
              </select>
              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span
              	style="width:100%" -->
           </div>
        </div>
        <div class="col-md-1">
					<div class="form-group"><br>
						<button type="button" id="btnaddexamimg" class="btn btn-success" title="Añadir Examen Imagenologia">+</button>
					</div>
				</div>
        
        <div class="col-md-12">
        <table id="tblimagenologia"  border="0">
        	<tr id="rowtblimagenologia"></tr>
        </table>
      	</div>
      	<div class="col-md-12">
					<div class="form-group">
						<label for="imagenologia">Estudios de Imagenologia:</label>
						<textarea name="imagenologia" id="imagenologia" class="form-control form-control-sm" style="text-transform:uppercase;" rows="2" ></textarea>
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<label for="razsocial"> Anatomia Patologica:</label>
						<textarea name="anatomia" id="anatomia" class="form-control form-control-sm " style="text-transform:uppercase;" rows="6" ></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="interconsultas">Interconsultas:</label>
						<textarea name="interconsultas" id="interconsultas" class="form-control form-control-sm " style="text-transform:uppercase;" rows="6" ></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="otros">Otros:</label>
						<textarea name="otros" id="otros" class="form-control form-control-sm " style="text-transform:uppercase;" rows="6" ></textarea>
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
          <!--a href="rpt_citas.php" class="btn btn-secondary">Atrás</a-->
          <!--a href="javascript: history.go(-1)" class="btn btn-secondary">Atrás</a--> 
          <a href="reghist.php?pac=<?php echo $idcita;?>&x=y" class="btn btn-secondary">Atrás</a>        
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
