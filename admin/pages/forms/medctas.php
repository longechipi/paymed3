<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');
	if(isset($_GET['id'])){
		$idmed=$_GET['id'];
		$sql = ("SELECT idlogin, apellido1, apellido2, nombre1, nombre2, nrodoc 
			     FROM medicos WHERE idmed='".$idmed."'; ");
	    $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
	    $allnombre=$arr['apellido1'].' '.$arr['apellido2'].' '.$arr['nombre1'].' '.$arr['nombre2'];
	    $nrodoc=$arr['nrodoc'];

	    $nombremed=$arr['apellido1'].' '.$arr['nombre1'];
	    $idlogin=$arr['idlogin'];
	    
	    /*Busco el Medico En datos de Cuentas Nacionales, si NO existe, lo Creo la semilla */
	    $sqllast = ("SELECT idlogin from datbconac WHERE idlogin='".$idlogin."';");
	    $objlast=$mysqli->query($sqllast); 
	    $rowcount=mysqli_num_rows($objlast);
	    /*  Ctas Nacionales */
	    if ($rowcount=='0') { 
	    	$sqlins = ("INSERT INTO datbconac(iddatbco, idlogin) VALUES (null, '".$idlogin."');");

	    	$conex=$mysqli->query($sqlins);
	    	$titular='';
	     	//$nrodoc='';
	     	$idbco='';
	     	$banco='Seleccione';
	     	$idtipocuenta='';
	     	$tipocuenta='Seleccione';
	     	$nrocuenta='';
	     }else{
	     	$sqldat = ("SELECT  a.idlogin, a.titular, a.nrodoc, a.idbco, b.banco, a.idtipocuenta, c.tipocuenta, a.nrocuenta, a.idestatus 
				FROM datbconac a, bancos b, tipocuenta c
				WHERE a.idbco=b.idbco AND a.idtipocuenta=c.idtipocuenta AND a.idlogin = '".$idlogin."';");
	     
	     	$objdat=$mysqli->query($sqldat); 
			$arrdat=$objdat->fetch_array();
	     	$titular=$arrdat['titular'];
	     	//$nrodoc=$arrdat['nrodoc'];
	     	$idbco=$arrdat['idbco'];
	     	$banco=$arrdat['banco'];
	     	$idtipocuenta=$arrdat['idtipocuenta'];
	     	$tipocuenta=$arrdat['tipocuenta'];
	     	$nrocuenta=$arrdat['nrocuenta'];
	     }
	     /*  Ctas Internacionales  */
	     /*Busco el Medico En datos de Cuentas Internacionales, si NO existe, lo Creo la semilla */
	    $sqllasti = ("SELECT idlogin from datbcoint WHERE idlogin='".$idlogin."';");
	    $objlasti=$mysqli->query($sqllasti); 
	    $rowcounti=mysqli_num_rows($objlasti);
	    /*  Ctas Internacionales */
	    if ($rowcounti=='0') { 
	    	$sqlinsi = ("INSERT INTO datbcoint(iddatbcoint, idlogin) VALUES (null, '".$idlogin."');");
	    	$conex=$mysqli->query($sqlinsi);
	    	$titularint='';
	     	$idpais='';
	     	$pais='Seleccione';
	     	$nrodocint='';
	     	$idbcoint='';
	     	$bancoint='Seleccione';
	     	$ach='';
	     	$nrocuentaint='';
	     	$swit='';
	     	$aba='';
	     	$dircta='';
	     	$telefono='';
	     	$codpostalint='';
	     	$idestatus='1'; 
	     }else{
	     	$sqldati = ("SELECT a.iddatbcoint, a.titular, a.idpais, c.pais,  a.nrodoc, a.idbco, b.banco, a.ach, 
	     		a.nrocuenta, 
	     		a.swit, a.aba, a.dircta, a.telefono, a.codpostal, a.idestatus 
						FROM datbcoint  a, bancos b, paises c
						WHERE a.idbco=b.idbco AND a.idpais=c.idpais AND a.idlogin = '".$idlogin."';");

	     
	     	$objdati=$mysqli->query($sqldati); $arrdati=$objdati->fetch_array();
	     	if (!isset($arrdati)) {
	     		$titularint=$idpais=$pais=$nrodocint=$idbcoint=$bancoint=$ach=$nrocuentaint=$swit=$aba=$dircta=$telefono=$codpostalint='';
	     	}else{
		     	$titularint=$arrdati['titular'];
		     	$idpais=$arrdati['idpais'];
		     	$pais=$arrdati['pais'];
		     	$nrodocint=$arrdati['nrodoc'];
		     	$idbcoint=$arrdati['idbco'];
		     	$bancoint=$arrdati['banco'];
		     	$ach=$arrdati['ach'];
		     	$nrocuentaint=$arrdati['nrocuenta'];
		     	$swit=$arrdati['swit'];
		     	$aba=$arrdati['aba'];
		     	$dircta=$arrdati['dircta'];
		     	$telefono=$arrdati['telefono'];
		     	$codpostalint=$arrdati['codpostal'];
		     	$idestatus=$arrdati['idestatus'];
	     	}
	     }

	}
	if(isset($_POST['submit'])){ // ----------------------------------------------------------------------
		// - - - - - - -- - - Datos Bancos Nacionales 
		$idlogin=$_POST['idlogin'];
		$idmed=$_POST['idmed'];
		$titular=$_POST['titular'];
	    $nrodoc=$_POST['nrodoc'];
	    $idbco=$_POST['idbco'];
	    $idtipocuenta=$_POST['idtipocuenta'];
	    $nrocuenta=$_POST['nrocuenta'];
	    
	    //$codpostal=$_POST['codpostal'];
	    $idestatus= '1';// Por ahora   $_POST['idestatusint'];
		
		$str="UPDATE datbconac SET titular='".$titular."', nrodoc='".$nrodoc."', idbco='".$idbco."', 
		idtipocuenta='".$idtipocuenta."', nrocuenta='".$nrocuenta."', idestatus='".$idestatus."'	
		WHERE idlogin='".$idlogin."' ;";
	
		$conexion=$mysqli->query($str);

		/*  - - - - - - - - -    Datos Internacionales  - - - - - - - - -  */
		//$idlogin=$_POST['idlogin'];
		$titularint=$_POST['titularint'];
	    $idpais=$_POST['idpais'];
	    
	    $nrodocint=$_POST['nrodocint'];
	    $idbcoint=$_POST['idbcoint'];
	    
	    $ach=$_POST['ach'];
	    $nrocuentaint=$_POST['nrocuentaint'];
	    $swit=$_POST['swit'];
	    $aba=$_POST['aba'];
	    $dircta=$_POST['dircta'];
	    $telefono=$_POST['telefono'];
	    $codpostalint=$_POST['codpostalint'];
	    $idestatusint= '1';// Por ahora   $_POST['idestatusint'];
		
		$str="UPDATE datbcoint SET titular='".$titularint."', idpais='".$idpais."', nrodoc='".$nrodocint."',
		idbco='".$idbcoint."', ach='".$ach."',
		nrocuenta='".$nrocuentaint."', swit='".$swit."', aba='".$aba."', dircta='".$dircta."', telefono='".$telefono."',
		codpostal='".$codpostalint."', idestatus='".$idestatusint."' WHERE idlogin='".$idlogin."' ;";
		
		$conexion=$mysqli->query($str);
		// Busco ultimo inserta para Insertar en tabla de auditoria(inmuebles_r)
		/*$sql="SELECT max(idinmueble) idinmueble FROM inmuebles";
		$query=$mysqli->query($sql);	
		$arridmax = mysqli_fetch_array($query);
		$idinmueble=$arridmax['idinmueble'];
		$str="INSERT INTO inmuebles_r(id, codinm, titulo, modulo, usuario, accion) VALUES ('".$idinmueble."','".$codinm."','".$titulo."','INMUEBLE','".$usuario."', 'I');";
		$conexion=$mysqli->query($str);*/
		//echo '<script language="javascript">alert("¡Registro Exitoso!");window.location.href="rpt_med.php"; </script>';
		//echo '<script language="javascript">alert("¡Actualizado!");window.location.href="">; </script>';
		echo '<script language="javascript">alert("¡Registro ¡Actualizado!");window.location.href="addesp.php?id='.$idmed.'"; </script>';
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
            <h1>Bancos</h1>
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
              <h3 class="card-title">Dr./Dra.: <?php echo $nombremed; ?> <span><img width="799px" height="37" src="img/l2.png"> </span></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
			<input type="hidden" id="idlogin" name="idlogin" value="<?php echo $idlogin;?>">
			<input type="hidden" name="idmed" value="<?php echo $idmed;?>">
			<div class="row">
				<div align="center" class="col-md-12">
					<h3><em><strong>Datos Transferencia Nacionales</strong></em></h3>
				</div>
				<!-- 1ra -->
				<div class="col-md-9">
					<div class="form-group">
						<label for="apellido1">Titular </label>
						<input type="text" name="titular" id="titular" value="<?php echo $allnombre;?>" class="form-control form-control-sm " readonly>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="nrodoc">Nro. Documento:</label>
						<input type="text" name="nrodoc" id="nrodoc" value="<?php echo $nrodoc;?>" class="form-control form-control-sm " readonly>
					</div>
				</div>
				
				<!-- 2da  -->
				<div class="col-md-3">
					<div class="form-group">
						<label for="idbco">Banco:</label>
						<select id="idbco" class="form-control mtitu" name="idbco" required>
							<option value="<?php echo $idbco;?>"><?php echo $banco;?></option>
							<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("SELECT idbco, banco FROM bancos WHERE tipo='1' AND idestatus='1'");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idbco'].'">'.$valores['banco'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="idtipocuenta">Tipo Cta:</label>
						<select id="idtipocuenta" class="form-control mtitu" name="idtipocuenta" required>
							<option value="<?php echo $idtipocuenta;?>"><?php echo $tipocuenta;?></option>
						<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("SELECT idtipocuenta, tipocuenta FROM tipocuenta WHERE idestatus='1'; ");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idtipocuenta'].'">'.$valores['tipocuenta'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nrocuenta">Nro. Cuenta: <span><small>(Solo Nùmeros, 20 Digitos)</small></span> </label>

						<input type="text" name="nrocuenta" id="nrocuenta" minlength="24" maxlength="24" value="<?php echo $nrocuenta;?>" 
						class="form-control form-control-sm input-cta" 
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  required>
					</div>
				</div>
				<!-- * * * * * * * * * * * * * * * * * * * * * * * *  -->
				<div align="center" class="col-md-12">
					<hr>
					<h3><em><strong>Datos Transferencia Internacional</strong></em></h3>
				</div>
				<!-- -->
				<input type="hidden" name="titularint" value="<?php echo $allnombre;?>">
				<input type="hidden" name="nrodocint" id="nrodocint" value="<?php echo $nrodocint;?>">
				<!-- Por preguntar si quedan o no, ya que redundan 
				<div class="col-md-9">
					<div class="form-group">
						<label for="titularint">Titular </label>
						<input type="text" name="titularint" id="titularint" value="< ?php echo $allnombre;?>" class="form-control form-control-sm " readonly>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="nrodocint">Nro. Documento:</label>
						<input type="text" name="nrodocint" id="nrodocint" value="< ?php echo $nrodocint;?>" class="form-control form-control-sm " required>
					</div>
				</div>
				-->
				<!-- 2da  -->
				<div class="col-md-3">
					<div class="form-group">
						<label for="idpais" class="control-label mb-1">Pais:</label>
						<select id="idpais" class="form-control mtitu" name="idpais" required>
							<option value="<?php echo $idpais;?>"><?php echo $pais;?></option>
							<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("SELECT idpais, pais FROM paises WHERE idestatus='1';");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idpais'].'">'.$valores['pais'].'</option>';
							} ?>
						</select>
						<!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
					</div>
				</div> 

				<div class="col-md-3">
					<div class="form-group">
						<label for="idbcoint">Banco:</label>
						<select id="idbcoint" class="form-control mtitu" name="idbcoint" required>
							<option value="<?php echo $idbcoint;?>"><?php echo $bancoint;?></option>
							<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("SELECT idbco, banco FROM bancos WHERE tipo='2' AND idestatus='1' ; ");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idbco'].'">'.$valores['banco'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nrocuentaint">Nro. Cuenta:</label>
						<input type="text" name="nrocuentaint" id="nrocuentaint" minlength="8" maxlength="20"  value="<?php echo $nrocuentaint;?>" class="form-control form-control-sm " 
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<!-- 3ra -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="ach">ACH:</label>
						<input type="text" name="ach" id="ach" value="<?php echo $ach;?>" class="form-control form-control-sm ">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="swit">SWIT:</label>
						<input type="text" name="swit" id="swit" value="<?php echo $swit;?>" class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="aba">ABA:</label>
						<input type="text" name="aba" id="aba" value="<?php echo $aba;?>" class="form-control form-control-sm" required>
					</div>
				</div>
				<!-- 4ta -->
				<div class="col-md-8">
					<div class="form-group">
						<label for="dircta">Dirección Cuenta:</label>
						<input type="text" name="dircta" id="dircta" value="<?php echo $dircta;?>" class="form-control form-control-sm " 
						minlength="7" style="text-transform:uppercase;" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="telefono">Teléfono:</label>
						<!--input type="text" name="telefono" id="telefono" value="< ?php echo $telefono;?>" class="form-control form-control-sm " required-->
						<input type="text" name="telefono" id="telefono" minlength="11" maxlength="11" value="<?php echo $telefono;?>" class="form-control form-control-sm" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="codpostalint">Cod.Postal:</label>
						<!--input type="text" name="codpostalint" id="codpostalint" value="< ?php echo $codpostalint;?>" class="form-control form-control-sm " required-->
						<input type="text" name="codpostalint" id="codpostalint" maxlength="5" minlength="5" value="<?php echo $codpostalint;?>" class="form-control form-control-sm " onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<!-- * * * * * * * * * * * * * * * * * * * * * * * *  -->

			<div align="right" class="col-md-12">
				<input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Siguiente" class="btn btn-main btn-primary btn-lg uppercase" title="Actualizar y Seguir...">
			</div>	
		</form> 
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
	  <div class="row">
        <div align="center" class="col-6">
          <a href="javascript: history.go(-1)" class="btn btn-secondary">Atrás</a>
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
<!-- Cleave -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.0.2/cleave.min.js"></script>
<script src="js/clevejsds.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script>
	/*function validacion(){
		costo = document.getElementById("costo").value;
		if( isNaN(costo) ) {
			alert('Error Costo!!!');
			return false;
		}
	}*/

</script>

</body>
</html>
