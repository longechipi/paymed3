<?php  
    //ALTER TABLE `medicos`  ADD `codcolemed` VARCHAR(22) NOT NULL COMMENT 'Codigo Colegio Medico'  AFTER `nrodoc`,  ADD `mpss` VARCHAR(22) NOT NULL COMMENT 'Codigo Ministerio de Salud'  AFTER `codcolemed`;
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');
  //echo 'IDMED:'.$_GET['id'];
  //echo 'post:'.$_POST['submit']; exit();
  
  if (isset($_GET['id'])) {
	   $idmed=$_GET['id'];
	   $sql = ("SELECT CONCAT(apellido1,' ', nombre1) AS nombre, codcolemed, mpss, nrodoc FROM medicos WHERE idmed='".$idmed."'; ");
     
    $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
    $nombre=$arr['nombre'];
    $codcolemed=$arr['codcolemed'];
    $mpsscod=$arr['mpss'];
    $nrodoc=$arr['nrodoc'];
  } else{
    echo '<script language="javascript">window.location.href="../../index.php?usr=1"; </script>';     
  }
  /*Busco Doc*/
  $sql = ("SELECT iddocument, idmed, imagen FROM drdocument WHERE idmed='".$idmed."'; ");
  $objimg=$mysqli->query($sql);
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
  <style type="text/css">.cursor-pointer{
    cursor: pointer;
  }</style>
  <style type="text/css">
                  .tftable {
                    font-size: 12px;
                    color: #333333;
                    width: 50%;
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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	
		$(document).ready(function(){

			$("#cedula").on('change', function() {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);        
			})
			$("#rif").on('change', function() {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);        
			})
			$("#colemed").on('change', function() {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);        
			})
			$("#mpss").on('change', function() {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);        
			})
			/*Ori */
			$("#fuSubirExcel").on('change', function() {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);        
			})
		}); // End Ready
    function fdeldoc(id) {
        var idmed = document.getElementById("idmed").value;
        jQuery.ajax({
              type: "POST",   
              url: "deldoc_js.php",
              data: {id: id},
              success:function(data){
                //if (data!='1') {return false;}
                //location.reload();  // Por ahora
                window.location.href="adddoc.php?id="+idmed;
              }
        });
      }
		function fnext() {
        var idmed = document.getElementById("idmed").value;

        var codcolemed = document.getElementById("codcolemed").value;
        let lencodcolemed = codcolemed.length;
        if (lencodcolemed!='9') {Swal.fire({icon: 'error', title: 'Codigo Colegio Medico'}); return false;}

        var mpsscod = document.getElementById("mpsscod").value;
        let lenmpss = mpsscod.length;
        if (lenmpss!='5') {Swal.fire({icon: 'error', title: 'Codigo MPSS'}); return false;}
        if (codcolemed==''){
          Swal.fire({
              icon: 'error',
              title: 'Codigo Colegio Medico'
            });
          return false;
        }else if (mpsscod=='') {
          Swal.fire({
              icon: 'error',
              title: 'Codigo MPSS'
            });
          return false;
        }
        
        jQuery.ajax({
                  type: "POST",   
                  url: "updcodmedmpss_js.php",
                  data: {idmed: idmed, codcolemed: codcolemed, mpsscod: mpsscod },
                  success:function(data){

                    if (data!='1') {return false;}
                    //window.location.href="adddoc.php?id="+idmed;
                  }
                });
        
        window.location.href="conafi.php?id="+idmed;
      } // fin fnext
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
            <h1>Documentos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
              <li class="breadcrumb-item active">Documentos</li>
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
              <h3 class="card-title">Dr./Dra.: <?php echo $nombre; ?> <span><img width="799px" height="37" src="img/l4.png"> </span></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<!--form enctype="multipart/form-data" action="< ?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()"-->
      <!--form enctype="multipart/form-data" action="< ?php echo $_SERVER['PHP_SELF'] ?>" method="post"-->
      <form enctype="multipart/form-data" action="updoc.php" method="post">
       <input type="hidden" id="idmed" name="idmed" value="<?php echo $idmed; ?>"> 
			<div class="row">
				<!-- 1ra -->
			<div class="col-md-12">
				<center><h4><strong>Documentos - Adjuntar</strong></h4></center>
				<hr>
			</div>	
      <!-- Linea 1 -->
          <div class="col-md-6">
            <div class="form-group">
              <h4  style="color: #454545;font-weight: bold;">Código Colegio Médico:</h4>
              <input type="text" name="codcolemed" id="codcolemed" minlength="9" maxlength="9" value="<?php echo $codcolemed; ?>" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
            </div>  
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <h4 style="color: #454545;font-weight: bold;">MPSS: </h4>
              <input type="text" name="mpsscod" id="mpsscod"  minlength="5" maxlength="5" value="<?php echo $mpsscod; ?>" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
            </div>  
          </div>
			<!-- Linea 2 -->
		<div class="col-md-3">
			<h5>Cédula:</h5>
			<div class="custom-file">
				<input type="file" id="cedula" name="imagen" class="custom-file-input" accept="application/pdf" required>  
				<label id="cedula"  class="custom-file-label" for="cedula"></label> 
			</div>
		</div>
		<div class="col-md-3">
			<h5>RIF:</h5>
			<div class="custom-file">
				<input type="file" id="rif" name="imagen1" class="custom-file-input" accept="application/pdf" required>
				<label id="rif" class="custom-file-label" for="rif"></label> 
			</div>
		</div>
		
		<div class="col-md-3">
			<h5>Carnet C.M.:</h5>
			<div class="custom-file">
				<input type="file" id="colemed"  name="imagen2"  class="custom-file-input" accept="application/pdf" required>
				<label id="colemed" class="custom-file-label" for="colemed"></label> 
			</div>
		</div>
		<div class="col-md-3">
			<h5>MPSS:</h5>
			<div class="custom-file">
				<input type="file" id="mpss"  name="imagen3"  class="custom-file-input" accept="application/pdf" required>
				<label id="mpss" class="custom-file-label" for="mpss"></label> 
			</div>
		</div>
			
            <!--
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="imagen" id="validatedCustomFile" required>
              <label class="custom-file-label" for="validatedCustomFile">Seleccione Archivo...</label>
              <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div-->
            
            <?php //while($rowdoc = mysqli_fetch_array($objimg)) { ?>
              <!--
              <p><span>
                <button type="button" onclick="fdeldoc(<?php echo $rowdoc['iddocument'];?>)" class="btn btn-danger btn-sm">X</button>
              </span><span><?php // echo $rowdoc['imagen']; ?></span></p>
              -->
            <?php // } ?>
            <div align="right" class="col-md-12">
              <br>
              <input style="background: #3BA0A7;border-color: #3BA0A7" type="submit" name="submit" value="Adjuntar" class="btn btn-main btn-primary btn-sm uppercase">      
            </div>
            <div class="col-md-12" align="center">
              <br>
              <table class="tftable" border="1">
                  <tr>
                    <th>Documento</th>
                    <th align="center">Eliminar</th>
                  </tr>
                  <?php while($rowdoc = mysqli_fetch_array($objimg)) { ?>
                    <tr>
                      <td>
                        
                      <a HREF="drdocument/<?php echo $rowdoc['imagen'];?>" target="_blank"><?php echo $rowdoc['imagen']; ?></a>
                      </td>
                      <td align="center">
                        <button type="button" onclick="fdeldoc(<?php echo $rowdoc['iddocument'];?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        
                      </td>
                    </tr>
                  <?php } ?>
                </table>

              </div>

        <!--/div-->
				<!-- 2da -->
			<div align="right" class="col-md-12">
			<br><br>
				<!--input type="submit" name="submit" value="Adjuntar" class="btn btn-dark mb-2"-->
         <button style="background: #F89921;border-color: #F89921" onclick="fnext()" class="btn btn-main btn-primary btn-lg uppercase">Siguiente</button>
			</div>	
		</form> 
            <!-- /.card-body -->
          </div>
          <hr>
          <!-- _______________________________________________________________________________________________________________ -->
          
          <br>
          <div class="row">
        <div align="center" class="col-6">
          <a href="javascript: history.go(-1)" class="btn btn-secondary">Atrás</a>
        </div>
        <div align="center" class="col-6">
          <a href="../../index.php?usr=1" class="btn btn-warning">Salir</a>
        </div>
    </div> 
          <!-- /.card -->
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
