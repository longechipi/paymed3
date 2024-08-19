<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');
  if (isset($_GET['id'])) {
	 $idmed=$_GET['id'];
	 $sql = ("SELECT CONCAT(apellido1,' ', nombre1) AS nombre FROM medicos WHERE idmed='".$idmed."'; ");
   $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
   $nombre=$arr['nombre'];
   /*Busco Doc*/
   /*
   $sql = ("SELECT iddocument, idmed, imagen FROM drdocument WHERE idmed='".$idmed."'; ");
   $objimg=$mysqli->query($sql);
   */
   //$row_cnt = $objimg->num_rows; 
   //$arrimg=$objimg->fetch_array();
   /*
   if ($row_cnt!='0') {
    $imagen=$arrimg['imagen'];
   }else{
    $imagen='Vavio';
   }
    */
  } // End isset 
  if(isset($_POST['submit'])){
    $idmed=$_POST['idmed'];
    $sql = ("SELECT CONCAT(apellido1,' ', nombre1) AS nombre FROM medicos WHERE idmed='".$idmed."'; ");
    $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
    $nombre=$arr['nombre'];
    if (isset($_FILES['imagen'])){
      $cantidad= count($_FILES["imagen"]["tmp_name"]);
      //echo $cantidad; exit();
      //if(empty($norden)){$norden=0;}

      for ($i=0; $i<$cantidad; $i++){
        //Comprobamos si el fichero es una imagen
        if ($_FILES['imagen']['type'][$i]=='image/png' || $_FILES['imagen']['type'][$i]=='application/pdf'){

        //Subimos el fichero al servidor
            //$fileName = time().'_'.$_FILES['imagen']['name'][$i];
            $fileName = $_FILES['imagen']['name'][$i];
            $sourcePath = $_FILES['imagen']['tmp_name'][$i];
            $targetPath = "drdocument/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
              $imagen = $fileName;
              $validar=true;
            }   
            $str="INSERT INTO drdocument(iddocument, idmed, imagen) VALUES(null, '".$idmed."','".$imagen."');";
            $conexion=$mysqli->query($str);
        }
        else $validar=false;
      }
    }
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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	
		$(document).ready(function(){
      var idmed  = document.getElementById("idmed").value;
      jQuery.ajax({
                type: "POST",   
                url: "armatbl_js.php",
                data: {idmed: idmed},
                success:function(data){ 
                  console.log(data);
                  if (data!='1') {
                    document.getElementById("tblesp").innerHTML = data;
                  }
                }
            });// End Ajax
		}); // End Ready
		function asignaesp(id){
      var idmed  = document.getElementById("idmed").value;
			jQuery.ajax({
                type: "POST",   
                url: "findesp_js.php",
                data: {id: id, idmed: idmed},
                success:function(data){

                var arrdata = data.split(';');
                var id =arrdata[0];
                var data =arrdata[1];
                
				          if (id!='1') {
                    var idmed  = document.getElementById("idmed").value;
			               document.getElementById("tblesp").insertRow(-1).innerHTML =
                      '<tr><td>'+data+'</td><td><button type="button" onclick="fdel('+id+')" class="btn btn-danger">X</button></td></tr>';
                  }
                }
            });// End Ajax
		}
    /*___________________________________________________________________________________*/
    function fdel(id){
      jQuery.ajax({
                type: "POST",   
                url: "delesp_js.php",
                data: {id: id},
                success:function(data){
                  alert(data);
                //document.getElementById("tblesp").insertRow(-1).innerHTML ='<td>'+data+'</td><td><button type="button" onclick="fdel('+id+')" class="btn btn-danger">X</button></td>';
                //document.getElementById("totpagar").innerHTML = '$'+totalapagarf;
              }
                
      });// End Ajax
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
          <div class="col-sm-6">
            <h1>Especialidades</h1>
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
              <h3 class="card-title"><?php echo $nombre;?></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<!--form enctype="multipart/form-data" action="< ?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()"-->
      <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
       <input type="hidden" id="idmed" name="idmed" value="<?php echo $idmed; ?>"> 
			<div class="row">
				<!-- 1ra -->
				<div class="col-md-3">
					<div class="form-group">
						<label for="idtipo">Especialidades:</label>
						<select class="form-control custom-select form-control-sm" id="idespmed" name="idespmed" onchange="asignaesp(this.value)" >
							<option value="">-- Seleccione --</option>
                  			<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("SELECT idespmed, especialidad FROM especialidadmed  WHERE idestatus='1'; ");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idespmed'].'">'.$valores['especialidad'].'</option>';
						} ?>
                		</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<!--label for="idtipo">Seleccionadas:</label-->
						<table id="tblesp" class="table table-sm">
						  <thead>
							<tr>
							  <th scope="col">Especialidad Seleccionada</th>
							  <th scope="col">Acción</th>
							</tr>
						  </thead>
						  <tbody>
							
							<!-- <tr><td>Mark</td><th scope="row">X</th></tr> -->
						  </tbody>
						</table>
					</div>
				</div>
        
        <div class="col-md-6">
          <center><h4>Documentos - Adjuntar</h4></center>
            <div class="form-group">
              <label for="exampleInputFile">Documento(PDF):</label>
              <input type="file" name="imagen[]" accept="application/pdf" value="" multiple>
            </div>
            <!--
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="imagen" id="validatedCustomFile" required>
              <label class="custom-file-label" for="validatedCustomFile">Seleccione Archivo...</label>
              <!--div class="invalid-feedback">Example invalid custom file feedback</div- ->
            </div-->
            <?php while($rowdoc = mysqli_fetch_array($objimg)) { ?>
              <p><?php echo $rowdoc['imagen']; ?></p>
            <?php } ?>
        </div>
				<!-- 2da -->
			<div align="right" class="col-md-12">
				<input type="submit" name="submit" value="Adjuntar" class="btn btn-dark mb-2">
			</div>	
		</form> 
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
	  <div class="row">
        <div align="center" class="col-6">
          <a href="rpt_med.php" class="btn btn-secondary">Atrás</a>          
        </div>
        <div align="center" class="col-6">
                  <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Siguiente" class="btn btn-main btn-primary btn-lg uppercase">
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
