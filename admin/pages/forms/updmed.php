<?php
	session_start();
	/* Leo estatus para Verificar el Medico esta  aprobado por junta medioca */
	$estatusmedico=$_SESSION['estatusmedico'];

	$usuario=$_SESSION['usuario'];
	if (isset($_GET['id'])) {
		$idlogin=$_GET['id'];	
	}else{
		$idlogin=$_SESSION['idlogin'];
	}
	$iddr ='000'.$idlogin;
	

	require('../../conexion.php');
	if(isset($_POST['submit'])){
		//datos 
		$idmed =$_POST['idmed'];
		$apellido1 =strtoupper($_POST['apellido1']);
		$apellido2 =strtoupper($_POST['apellido2']);
		$nombre1 =  strtoupper($_POST['nombre1']);
		$nombre2 =  strtoupper($_POST['nombre2']);

		$rif =$_POST['tprif'].$_POST['rif'];
		$nrodoc =$_POST['tpdoc'].$_POST['nrodoc'];

		$fnacimiento =$_POST['fnacimiento'];
		$edad =$_POST['edad'];
		$idsexo =$_POST['idsexo'];
		$idestcivil =$_POST['idestcivil'];

		//$operadora =$_POST['operadora'];
		$movil =$_POST['movil'];
		//$codarea =$_POST['codarea'];
		$telefono =$_POST['telefono'];
		$correo =$_POST['correo'];
		$correoalt =$_POST['correoalt'];

		$idpais      =$_POST['idpais'];
		//$idestado    =$_POST['idestado'];
		if (isset($_POST['idestado'])) {$idestado=$_POST['idestado'];} else{$idestado='0';}
		//$idmunicipio =$_POST['idmunicipio'];
		if (isset($_POST['idmunicipio'])) {$idmunicipio=$_POST['idmunicipio'];} else{$idmunicipio='0';}
		//$idparroquia =$_POST['idparroquia'];
		if (isset($_POST['idparroquia'])) {$idparroquia=$_POST['idparroquia'];} else{$idparroquia='0';}

		$correoppal=''; // OJOOOOOO Por Aclarar

		$urbanizacion =$_POST['urbanizacion'];
		$calleav =$_POST['calleav'];
		$casaedif =$_POST['casaedif'];
		$piso =$_POST['piso'];
		$oficina =$_POST['oficina'];
		$codpostal =$_POST['codpostal'];
		if (isset($_POST['dirnovzla'])) {$dirnovzla=$_POST['dirnovzla'];} else{$dirnovzla='N/A';}
   		if (isset($_POST['codpostalnovzla'])) {$codpostalnovzla=$_POST['codpostalnovzla'];} else{$codpostalnovzla='N/A';}
		$idestatus ='1'; // Por definir $_POST['idestatus'];
		/* Inserto en Login para luego leer el idlogin 
		$str="INSERT INTO loginn (idlogin, correo, cargo, clave, privilegios) VALUES (NULL, '".$correo."', 'Medico', '".$rif."','2' );";
		$conexion=$mysqli->query($str);

		$sqllast = ("SELECT max(idlogin) from loginn;");
	    $objlast=$mysqli->query($sqllast); $arrlast=$objlast->fetch_array();  
    	$idlogin=$arrlast[0];*/
		/* Fin */
		
		$str="UPDATE medicos SET nrodoc='".$nrodoc."',rif='".$rif."',nombre1='".$nombre1."',nombre2='".$nombre2."',apellido1='".$apellido1."',apellido2='".$apellido2."',fnacimiento='".$fnacimiento."',edad='".$edad."',idsexo='".$idsexo."',idestcivil='".$idestcivil."', movil='".$movil."',telefono='".$telefono."',correo='".$correo."',correoalt='".$correoalt."',idpais='".$idpais."',idestado='".$idestado."',idmunicipio='".$idmunicipio."',idparroquia='".$idparroquia."',correoppal='',calleav='".$calleav."',casaedif='".$casaedif."',piso='".$piso."',oficina='".$oficina."',urbanizacion='".$urbanizacion."',codpostal='".$codpostal."',dirnovzla='".$dirnovzla."',codpostalnovzla='".$codpostalnovzla."' 
		 WHERE idmed='".$idmed."' ;";

		$conexion=$mysqli->query($str);
		// Busco ultimo inserta para Insertar en tabla de auditoria(inmuebles_r)
		/*$sql="SELECT max(idinmueble) idinmueble FROM inmuebles";
		$query=$mysqli->query($sql);	
		$arridmax = mysqli_fetch_array($query);
		$idinmueble=$arridmax['idinmueble'];
		$str="INSERT INTO inmuebles_r(id, codinm, titulo, modulo, usuario, accion) VALUES ('".$idinmueble."','".$codinm."','".$titulo."','INMUEBLE','".$usuario."', 'I');";
		$conexion=$mysqli->query($str);*/
		echo '<script language="javascript">alert("¡Actualización Exitosa!");window.location.href="medctas.php?id='.$idmed.'"; </script>';
	}else{
		/*Respaldo de Consulta Tigre 
		$sqldatmed = ("SELECT a.idmed,a.idlogin, a.idcomp, a.nrodoc, a.rif, a.nombre1, a.nombre2, a.apellido1, a.apellido2, 
       	a.fnacimiento, a.edad, a.idsexo, b.sexo, a.idestcivil, c.estcivil, a.movil, a.telefono, a.correo, 
	   	a.correoalt, a.idpais, d.pais,
	   	a.idestado, e.estado, a.idmunicipio, f.municipio, a.idparroquia, g.parroquia, a.correoppal, a.calleav, a.casaedif, a.piso, a.oficina, 
	   	a.urbanizacion, a.codpostal, a.idestatus
		FROM medicos a, sexo b, estadocivil c, paises d, estado e, municipios f, parroquias g
		WHERE a.idlogin='".$idlogin."'AND a.idsexo=b.idsexo AND a.idestcivil=c.idestcivil
		AND a.idpais=d.idpais AND a.idestado=e.idestado AND a.idmunicipio=f.idmunicipio
		AND a.idparroquia=g.idparroquia");*/

		/*Busco Datos del Medico */
		/* $sqldatmed = ("SELECT  a.idmed, a.idcomp, a.nrodoc, a.codcolemed, a.mpss, a.rif, a.nombre1, a.nombre2, a.apellido1, a.apellido2, a.fnacimiento, a.edad, a.idsexo, a.idestcivil, a.movil, a.telefono, a.correo, a.correoalt, a.idpais, a.idestado, a.idmunicipio, a.idparroquia, a.correoppal, a.calleav, a.casaedif, a.piso, a.oficina, a.urbanizacion, a.codpostal, a.idestatus
			FROM medicos a, paises b, estado c, municipios d, parroquias e, estadocivil f, sexo g
			WHERE a.idlogin='".$idlogin."'
			AND a.idpais=b.idpais
			AND a.idestado=c.idestado
			AND a.idparroquia=e.parroquia
			AND a.idestcivil=f.idestcivil
			AND a.idsexo=g.idsexo;"); */
		$sqldatmed = ("SELECT  a.idmed, a.idcomp, a.nrodoc, a.codcolemed, a.mpss, a.rif, a.nombre1, a.nombre2, a.apellido1, a.apellido2, a.fnacimiento, a.edad, a.idsexo, a.idestcivil, a.movil, a.telefono, a.correo, a.correoalt, a.idpais, a.idestado, a.idmunicipio, a.idparroquia, a.correoppal, a.calleav, a.casaedif, a.piso, a.oficina, a.urbanizacion, a.codpostal, a.dirnovzla, a.codpostalnovzla, a.idestatus, a.fechahora_sist
			FROM medicos a
			WHERE a.idlogin='".$idlogin."';");

	    $objdatmed=$mysqli->query($sqldatmed); $arrdatmed=$objdatmed->fetch_array();  
    	$idmed=$arrdatmed['idmed'];
    	$rifpval=$arrdatmed['rif']; // for valid
    	$rif=$arrdatmed['rif'];
    	$tprif = substr($arrdatmed['rif'], 0,1);
  		$rif = substr($arrdatmed['rif'], 1,9);
  		$nrodocpval=$arrdatmed['nrodoc'];  // for valid
  		$nrodoc=$arrdatmed['nrodoc'];
  		$tpdoc = substr($arrdatmed['nrodoc'], 0,1);
  		$nrodoc = substr($arrdatmed['nrodoc'], 1,9);

    	$nombre1=$arrdatmed['nombre1'];
    	$nombre2=$arrdatmed['nombre2'];
    	$apellido1=$arrdatmed['apellido1'];
    	$apellido2=$arrdatmed['apellido2'];
    	$nombre=$apellido1.' '.$nombre1;

    	$fnacimiento=$arrdatmed['fnacimiento'];
    	$edad=$arrdatmed['edad'];
    	$idsexo=$arrdatmed['idsexo'];
    		$sql = ("SELECT sexo from sexo WHERE idsexo='".$idsexo."';");
	    	$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
    		$sexo=$arr[0];
    	$idestcivil=$arrdatmed['idestcivil'];
    		$sql = ("SELECT estcivil from estadocivil WHERE idestcivil='".$idestcivil."';");
	    	$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
    		$estcivil=$arr[0];
    	//$operadora=$arrdatmed['operadora'];
    	$movil=$arrdatmed['movil'];
    	//$codarea=$arrdatmed['codarea'];
    	$telefono=$arrdatmed['telefono'];
    
    	$correo=$arrdatmed['correo'];

    	$correoalt=$arrdatmed['correoalt'];
		$idpais=$arrdatmed['idpais'];
			$sql = ("SELECT pais from paises WHERE idpais='".$idpais."';");
	    $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
    	$pais=$arr[0];
		$idestado=$arrdatmed['idestado'];
			$sql = ("SELECT estado from estado WHERE idestado='".$idestado."';");
	    $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
    	$estado=$arr[0];
		$idmunicipio=$arrdatmed['idmunicipio'];
			$sql = ("SELECT municipio from municipios WHERE idmunicipio='".$idmunicipio."';");
	    $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
    	$municipio=$arr[0];
		$idparroquia=$arrdatmed['idparroquia'];
			$sql = ("SELECT parroquia from parroquias WHERE idparroquia='".$idparroquia."';");
	    $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
    	$parroquia=$arr[0];
		
		$correoppal=$arrdatmed['correoppal'];
		$calleav=$arrdatmed['calleav'];
		$casaedif=$arrdatmed['casaedif'];
		$piso=$arrdatmed['piso'];
		$oficina=$arrdatmed['oficina'];
		$urbanizacion=$arrdatmed['urbanizacion'];
		$codpostal=$arrdatmed['codpostal'];

		$codpostalnovzla=$arrdatmed['codpostalnovzla'];
		$dirnovzla=$arrdatmed['dirnovzla'];
		$idestatus='1'; // Por Definir   $arrdatmed['idestatus'];
		//$fecha=$arrdatmed['fechahora_sist'];
		$fecha=date_create($arrdatmed['fechahora_sist']);
		$fecha=date_format($fecha,"d/m/Y");
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
			
			/*document.getElementById("msjvzla1").style.visibility = 'hidden';
			document.getElementById("msjvzla2").style.visibility = 'hidden';
			document.getElementById("msjvzla3").style.visibility = 'hidden';*/

			if ($("#idpais").val()!='232') {
            $("#div-estado").hide();
            $("#div-municipio").hide();
            $("#div-parroquia").hide();
            $("#div-urbaniza").hide();
            $("#div-caav").hide();
            $("#div-caed").hide();
            $("#div-piso").hide();
            $("#div-oficina").hide();
            $("#div-codpos").hide();
         }else{
            $("#div-dirnovzla").hide();
            $("#div-codposnovzla").hide();
         }
         $("#idpais").change(function() {
            if ($("#idpais").val()!='232') {
               $("#id_municipio").html("<option value=''>-- NO HAY DATOS --</option>");
               $("#id_parroquia").html("<option value=''>-- NO HAY DATOS --</option>");
               $("#id_estado").prop( "disabled", true );
               $("#id_municipio").prop( "disabled", true );
               $("#id_parroquia").prop( "disabled", true );

               $("#div-estado").hide();
               $("#div-municipio").hide();
               $("#div-parroquia").hide();
               
               $("#urbanizacion").val('');
               $("#calleav").val('');
               $("#casaedif").val('');
               $("#piso").val('');
               $("#codpostal").val('');

               $("#div-urbaniza").hide();
               $("#div-caav").hide();
               $("#div-caed").hide();
               $("#div-piso").hide();
               $("#div-oficina").hide();
               $("#div-codpos").hide();

               $("#div-dirnovzla").show();
               $("#div-codposnovzla").show();
            }else{
               $("#div-dirnovzla").hide();
               $("#div-codposnovzla").hide();

               $("#div-estado").show();
               $("#div-municipio").show();
               $("#div-parroquia").show();
               $("#id_estado").prop( "disabled", false );
               $("#id_municipio").prop( "disabled", false );
               $("#id_parroquia").prop( "disabled", false );

               $("#div-urbaniza").show();
               $("#div-caav").show();
               $("#div-caed").show();
               $("#div-piso").show();
               $("#div-oficina").show();
               $("#div-codpos").show();
            }
						$.get("pais_js.php", "idpais=" + $("#idpais").val(), function(data) {
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

			
		});  // End Document ok
		

		function calcedad(fecha){
			//alert(fecha);return false;
		jQuery.ajax({
                 type: "POST",  
                 url: "caledad_js.php",
                  data: {fecha: fecha},
                 success:function(data){
                 	var edad = parseInt(data);
	                 	if (edad<25 || edad>80 || isNaN(edad) ) {
	                 		document.getElementById("edad").value = 'Error';
                 			return false;
                 		}else{
									  	document.getElementById("edad").value = data;
								  	}
                 },
                  error:function (){}
                });
	}
	function valdoc(quees,nro){
		
		if (quees=='1') {
			var nroriginal=document.getElementById("rifpval").value;
			var tprif=document.getElementById("tprif").value;
			var nro=tprif+nro;
		}else if (quees=='2') {
			var nroriginal=document.getElementById("nrodocpval").value;
			var tpdoc=document.getElementById("tpdoc").value;
			var nro=tpdoc+nro;
		}
		
		jQuery.ajax({
         type: "POST",  
         url: "valnro_js.php",
         data: {quees: quees, nro: nro, nroriginal: nroriginal},
         success:function(data){
        	console.log(data);
         	hay = parseInt(data);
         	if (hay!=0) {
         		Swal.fire({
  				icon: 'error',
  				title: 'Nro Ya Registrado'
				})
         	}
         },
          error:function (){}
        });
	}
	// Valida solo letras en  Input
	function Solo_Texto(e) {
    var code;
    if (!e) var e = window.event;
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    var character = String.fromCharCode(code);
    var AllowRegex  = /^[\ba-zA-Z\s-]$/;
    if (AllowRegex.test(character)) return true;     
    return false; 
}
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
          <!--div class="col-sm-8">
            <h1>Medicos (La dirección debe ser tal cual su RIF)</h1>
          </div-->
          <div class="col-sm-12">
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
        	<div class="row" align="right">
            	<div class="w-15 p-1 col-md-12" style="font-family:courier; background-color: #eee;"><strong> ID : <?php echo $iddr; ?></strong></div>
            	<div class="w-15 p-1 col-md-12" style="font-family:courier; background-color: #eee;"><strong>Fecha Registro: <?php echo $fecha; ?></strong></div>
            </div>
          <div class="card card-primary">
            <div style="background: #F89921"  class="card-header">
              <h3 class="card-title">Dr./Dra.: <?php echo $nombre; ?> <span><img width="799px" height="37" src="img/l1.png"> </span></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
			<input type="hidden" name="idmed" value="<?php echo $idmed;?>">
			<input type="hidden" id="rifpval" value="<?php echo $rifpval;?>">
			<input type="hidden" id="nrodocpval" value="<?php echo $nrodocpval;?>">

			<div class="row">
				<!-- 1ra -->
				<div class="col-md-3">
					<div class="form-group">
						<label for="apellido1">1er Apellido: </label>
						<input type="text" name="apellido1" id="apellido1" value="<?php echo $apellido1;?>"  class="form-control form-control-sm" style="text-transform:uppercase;" 
						 onkeypress="return Solo_Texto(event);"  required>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="apellido2">2do Apellido: </label>
						<input type="text" name="apellido2" id="apellido2" value="<?php echo $apellido2;?>" class="form-control form-control-sm " style="text-transform:uppercase;"
						onkeypress="return Solo_Texto(event);">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="nombre1">1er Nombre: </label>
						<input type="text" name="nombre1" id="nombre1" value="<?php echo $nombre1;?>" class="form-control form-control-sm" style="text-transform:uppercase;"
						onkeypress="return Solo_Texto(event);"  required>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="mombre2">2do Nombre: </label>
						<input type="text" name="nombre2" id="nombre2" value="<?php echo $nombre2;?>" class="form-control form-control-sm" style="text-transform:uppercase;" 
						onkeypress="return Solo_Texto(event);">
					</div>
				</div>
				
				<!-- 2da  -->
				<div class="col-md-1">
					<div class="form-group">
						<label for="rif">RIF:</label>
						<select class="form-control form-control-sm" id="tprif" name="tprif">
                  			<option value="<?php echo $tprif;?>"><?php echo $tprif;?></option>
                  			<option value="N">N</option>
                  			<option value="J">J</option>
                  			<option value="G">G</option>
                		</select>
					</div>
				</div>
				<div class="col-md-2">
					<label for="rif">.</label>
					<div class="form-group">
						<input type="text" name="rif" id="rif" value="<?php echo $rif;?>" onblur="valdoc('1',this.value)" maxlength="9" minlength="9" class="form-control form-control-sm " 
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="tpdoc">.</label>
						<select class="form-control form-control-sm  form-control-sm" id="tpdoc" name="tpdoc">
							<option value="<?php echo $tpdoc;?>"><?php echo $tpdoc;?></option>
                  			<option value="V">V</option>
                  			<option value="E">E</option>
                		</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="nrodoc">Nro. Documento:</label>
						<input type="text" name="nrodoc" id="nrodoc" value="<?php echo $nrodoc;?>" onblur="valdoc('2',this.value)" maxlength="8" minlength="7" class="form-control form-control-sm"
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="fnacimiento">Fec.Nacimiento:</label>
						<input type="date" name="fnacimiento" id="fnacimiento" value="<?php echo $fnacimiento;?>" class="form-control form-control-sm " onchange="calcedad(this.value)" required>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="edad">Edad:</label>
						<input type="text" name="edad" id="edad" value="<?php echo $edad;?>" class="form-control form-control-sm " readonly>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label for="idsexo">Sexo:</label>
						<select id="idsexo" class="form-control  form-control-sm" name="idsexo" required>
							<option value="<?php echo $idsexo ?>"><?php echo substr($sexo, 0,3); ?></option>
							<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("select idsexo, sexo from sexo WHERE idestatus='1'; ");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idsexo'].'">'.substr($valores['sexo'], 0,3).'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="idestcivil">Est.Civil:</label>
						<select id="idestcivil" class="form-control  form-control-sm" name="idestcivil" required>
							<option value="<?php echo $idestcivil; ?>"><?php echo $estcivil; ?></option>
							<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("select 	idestcivil, estcivil from estadocivil WHERE idestatus='1'; ");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idestcivil'].'">'.$valores['estcivil'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<!-- 3ra -->
				<!--div class="col-md-1">
					<div class="form-group">
						<label for="operadora">Movil:</label>
						<select class="form-control form-control-sm" id="operadora" name="operadora">
												<option value="< ?php echo $operadora;?>">< ?php echo $operadora;?></option>
                  			<option value="0412">0412</option>
                  			<option value="0414">0414</option>
                  			<option value="0424">0424</option>
                  			<option value="0416">0416</option>
                  			<option value="0426">0426</option> 
                		</select>
					</div>
				</div-->

				<div class="col-md-2">
					<div class="form-group">
						<!--label for="movil" style="visibility: hidden;">.</label-->
						<label for="movil">Movil:</label>
						<input type="text" name="movil" id="movil" value="<?php echo $movil;?>" maxlength="14" minlength="10" class="form-control form-control-sm"
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  required>
					</div>
				</div>
				<!--div class="col-md-1">
					<div class="form-group">
						<label for="codarea">Cod:</label>
						<input type="text" name="codarea" id="codarea" minlength="3" maxlength="5" value="< ?php echo $codarea;?>" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
					</div>
				</div-->

				<div class="col-md-2">
					<div class="form-group">
						<label for="telefono">Teléfono:</label>2121231212
						<input type="text" name="telefono" id="telefono" minlength="10" maxlength="14" value="<?php echo $telefono;?>" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="correo">Correo:</label>
						<input type="email" name="correo" value="<?php echo $correo;?>" id="correo" class="form-control form-control-sm" readonly >
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="correoalt">Correo Alterno:</label>
						<input type="email" name="correoalt" value="<?php echo $correoalt;?>" id="correoalt" class="form-control form-control-sm"
						style="text-transform:lowercase;">
					</div>
				</div>
						
				<!-- 4ta -->
			
				<!-- Pais / Estado / Municipio / Parroquia -->
				<div class="col-md-3"><br>
                           <div class="form-group">
                              <label for="idpais">País:</label>
                              <select id="idpais" class="form-control form-control-sm" name="idpais" required>
                                <option value="<?php echo $idpais; ?>"><?php echo $pais; ?></option>
                                 <?php
                                 //require('admin/conexion.php');
                                 $query = $mysqli->query("SELECT idpais, pais FROM paises WHERE idestatus='1';");
                                 while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores['idpais'] . '">' . $valores['pais'] . '</option>';
                                 } ?>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <!-- -->
                        <div id="div-dirnovzla" class="col-md-8"><br>
                           <div class="form-group">
                              <label for="dirnovzla">Dirección:</label>
                              <input type="text" name="dirnovzla" id="dirnovzla" class="form-control form-control-sm " style="text-transform:uppercase;"  value="<?php echo $dirnovzla;?>">
                           </div>
                        </div>
                        <div id="div-codposnovzla" class="col-md-1"><br>
                           <div class="form-group">
                              <label for="codpostalnovzla">Cod.Postal:</label>
                              <input type="text" maxlength="5" minlength="5" name="codpostalnovzla" id="codpostalnovzla" class="form-control form-control-sm "  value="<?php echo $codpostalnovzla;?>">
                           </div>
                        </div>
                        <!-- -->
                        <div id="div-estado" class="col-md-3"><br>
                           <div class="form-group">
                              <label for="correo">Estado:</label>
                              <select id="id_estado" class="form-control form-control-sm" name="idestado">
                                    <option value="<?php echo $idestado; ?>"><?php echo $estado; ?></option>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <div id="div-municipio" class="col-md-3"><br>
                           <div class="form-group">
                              <label for="correo">Municipio:</label>
                              <select id="id_municipio" class="form-control form-control-sm" name="idmunicipio" >
                                 <option value="<?php echo $idmunicipio; ?>"><?php echo $municipio; ?></option>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <div  id="div-parroquia" class="col-md-3"><br>
                           <div class="form-group">
                              <label for="correo">Parroquia:</label>
                              <select id="id_parroquia" class="form-control form-control-sm " name="idparroquia" >
                                    <option value="<?php echo $idparroquia; ?>"><?php echo $parroquia; ?></option>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <!-- 7ta  -->
                        <div id="div-urbaniza" class="col-md-4">
                           <div class="form-group">
                              <label for="urbanizacion">Urbanización:</label>
                              <input type="text" name="urbanizacion" id="urbanizacion" style="text-transform:uppercase;" class=" form-control form-control-sm" 
                                 value="<?php echo $urbanizacion;?>">
                           </div>
                        </div>
                        <div id="div-caav" class="col-md-3">
                           <div class="form-group">
                              <label for="calleav">Calle/Avenida:</label>
                              <input type="text" name="calleav" style="text-transform:uppercase;" id="calleav" style="text-transform:uppercase;" class="form-control form-control-sm "  
                                 value="<?php echo $calleav;?>">
                           </div>
                        </div>
                        <div id="div-caed" class="col-md-2">
                           <div class="form-group">
                              <label for="casaedif">Casa/Edif.:</label>
                              <input type="text" maxlength="88" name="casaedif" id="casaedif" style="text-transform:uppercase;" class="form-control form-control-sm "
                                 value="<?php echo $casaedif;?>">
                           </div>
                        </div>
                        <div id="div-piso" class="col-md-1">
                           <div class="form-group">
                              <label for="piso">Piso:</label>
                              <input type="text" maxlength="3" name="piso" id="piso" class="form-control form-control-sm " value="<?php echo $piso;?>">
                           </div>
                        </div>
                        <div id="div-oficina" class="col-md-1">
                           <div class="form-group">
                              <label for="oficina">Ofc.:</label>
                              <input type="text" maxlength="4" name="oficina" id="oficina" class="form-control form-control-sm " value="<?php echo $oficina;?>">
                           </div>
                        </div>
                        <div id="div-codpos" class="col-md-1">
                           <div class="form-group">
                              <label for="codpostal">Cod.Postal:</label>
                              <input type="text" maxlength="4" minlength="4" name="codpostal" id="codpostal" class="form-control form-control-sm "  
                                 value="<?php echo $codpostal;?>">
                           </div>
                        </div>

				<!-- 8va  -->
			
				<div class="col-md-9">
					<h4 style="font-family:courier; background-color: #eee;">Direcciòn debe ser la Registrada ante el Seniat (RIF) </h4>
				</div>
				
				<div  class="col-md-3" align="right">
					<input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Siguiente" class="btn btn-main btn-primary btn-lg uppercase">
				</div>
			

		</form> 
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
	  <div class="row">
        <div align="center" class="col-6">
          <a href="../../index.php?usr=1" class="btn btn-secondary">Atrás</a>
        </div>

        <div align="center" class="col-6">
          <a href="../../index.php?usr=1" class="btn btn-warning">Salir</a>
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
		var idsexo = document.getElementById("idsexo").value;
		if (idsexo=='0') {Swal.fire({icon: 'error',title: 'Sexo Vacio'});return false; }
		var idestcivil = document.getElementById("idestcivil").value;
		if (idestcivil=='0') {Swal.fire({icon: 'error',title: 'Estado Civil Vacio'});return false;}

		var idpais = document.getElementById("idpais").value;
		if (idpais=='0') {Swal.fire({icon: 'error',title: 'Seleccione Un Pais'});return false;}

		var edad = document.getElementById("edad").value;
		//var codpostal = document.getElementById("codpostal").value;
		//let lencodpostal = codpostal.length;
		if (isNaN(edad)) {
			Swal.fire({icon: 'error',title: 'Edad' });
			document.getElementById("edad").value = '';
			document.getElementById("fnacimiento").value = '';
			document.getElementById("fnacimiento").focus();
			 return false;
       	}else if (edad=='0') {
       		Swal.fire({icon: 'error',title: 'Edad' });
       		document.getElementById("edad").value = '';
       		document.getElementById("fnacimiento").value = '';
					document.getElementById("fnacimiento").focus();
			 		return false;
       	}


		/* _______   ____________*/
		var quees='1';
		var nroriginal=document.getElementById("rifpval").value;
		var rif=document.getElementById("rif").value;
		var tprif=document.getElementById("tprif").value;
		var nro=tprif+rif;
		jQuery.ajax({
         type: "POST",  
          async: false, 
         url: "valnro_js.php",
         data: {quees: quees, nro: nro, nroriginal: nroriginal},
         success:function(data){

        	console.log(data);
         	hay = parseInt(data);
         	if (hay!=0) {
         		Swal.fire({
  				icon: 'error',
  				title: 'Nro Rif Ya Registrado'
				});return false;
         	}
         },
          error:function (){}
        });
		if (hay!='0') {
			document.getElementById("tprif").focus();
			return false;
		}
		/* - - - - - - - - - - - - - - - - - - */
		var quees='2';
		var nroriginal=document.getElementById("nrodocpval").value;
		var nrodoc=document.getElementById("nrodoc").value;
		var tpdoc=document.getElementById("tpdoc").value;
		var nro=tpdoc+nrodoc;
		jQuery.ajax({
         type: "POST",  
          async: false, 
         url: "valnro_js.php",
         data: {quees: quees, nro: nro, nroriginal: nroriginal},
         success:function(data){

        	console.log(data);
         	hay = parseInt(data);
         	if (hay!=0) {
         		Swal.fire({
  				icon: 'error',
  				title: 'Nro Documento Ya Registrado'
				});return false;
         	}
         },
          error:function (){}
        });
		if (hay!='0') {
			document.getElementById("tpdoc").focus();
			return false;
		}

		/*
		if (lencodpostal!='4') {
			alert();
			document.getElementById("codpostal").focus()
			return false;
		}
		*/
		//if( isNaN(costo) ) {alert('Error Costo!!!');return false;}

	}
</script>

</body>
</html>
