<?php
	session_start();
	require('../../conexion.php');
	$usuario=$_SESSION['usuario'];
	$idlogin=$_SESSION['idlogin'];
	if (isset($_GET['idprov'])) {
		$idprov= $_GET['idprov'];
	}else{
		echo '<script language="javascript">alert("¡Error!"); window.location.href="../../index.php?usr=1"; </script>';	
	}

	/*$sql = ("SELECT idprov from proveedores WHERE idlogin='".$idlogin."';");$obj=$mysqli->query($sql); $arr=$obj->fetch_array(); 
	$idprov=$arr[0];*/
	
	$sqldata = ("SELECT idespmed, especialidad, idestatus FROM especialidadmed WHERE idestatus='1';");
  $objdata=$mysqli->query($sqldata); //$arrdata=$objdata->fetch_array(); 

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
  <style type="text/css">
  		html,
			body,
			.intro {
			  height: 80%;
			}

			table td,
			table th {
			  text-overflow: ellipsis;
			  white-space: nowrap;
			  overflow: hidden;
			}

			.card {
			  border-radius: .5rem;
			}

			.mask-custom {
			  background: rgba(24, 24, 16, .2);
			  border-radius: 2em;
			  backdrop-filter: blur(25px);
			  border: 2px solid rgba(255, 255, 255, 0.05);
			  background-clip: padding-box;
			  box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
			}



	.checkbox-wrapper-31:hover .check {
  stroke-dashoffset: 0;
}

.checkbox-wrapper-31 {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 40px;
}

.checkbox-wrapper-31 .background {
  fill: #ccc;
  transition: ease all 0.6s;
  -webkit-transition: ease all 0.6s;
}

.checkbox-wrapper-31 .stroke {
  fill: none;
  stroke: #fff;
  stroke-miterlimit: 10;
  stroke-width: 2px;
  stroke-dashoffset: 100;
  stroke-dasharray: 100;
  transition: ease all 0.6s;
  -webkit-transition: ease all 0.6s;
}

.checkbox-wrapper-31 .check {
  fill: none;
  stroke: #fff;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-width: 2px;
  stroke-dashoffset: 22;
  stroke-dasharray: 22;
  transition: ease all 0.6s;
  -webkit-transition: ease all 0.6s;
}

.checkbox-wrapper-31 input[type=checkbox] {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  margin: 0;
  opacity: 0;
  -appearance: none;
  -webkit-appearance: none;
}

.checkbox-wrapper-31 input[type=checkbox]:hover {
  cursor: pointer;
}

.checkbox-wrapper-31 input[type=checkbox]:checked + svg .background {
  fill: #6cbe45;
}

.checkbox-wrapper-31 input[type=checkbox]:checked + svg .stroke {
  stroke-dashoffset: 0;
}

.checkbox-wrapper-31 input[type=checkbox]:checked + svg .check {
  stroke-dashoffset: 0;
}

  </style>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Theme SweetAlert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<script src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	
		$(document).ready(function(){
			/*- - - - - - - - - - - - - - - - - - - - - - - - - - */
		}); // End Ready
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
            <h1>Registro Especialidades</h1>
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
              <h3 class="card-title"><span><img width="799px" height="37" src="img/linea3.png"> </span></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
      				<!--<form enctype="multipart/form-data" action="< ?php echo $_SERVER['PHP_SELF'] ?>"  --> 
							<form enctype="multipart/form-data" action="" method="post" onsubmit="return validacion()">
								<input type="hidden" id="idprov" value="<?php echo $idprov;?>">
								<!-- -->
								<section class="intro">
  <div class="bg-image h-100" style="background-color: #6095F0;">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-9">
            <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-borderless mb-0">
                    <thead>
                      <tr>
                        <th scope="col">
                         N#
                        </th>
                        <th scope="col">ESPECIALIDAD</th>
                        <th scope="col">Sel.</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php $ln='0';
                    		while ($row = mysqli_fetch_array($objdata)) { $ln++; $idespmed = $row['idespmed'];
                    			$sql = ("SELECT count(*) as esta, idprovesp, idprov, idespmed FROM provesp WHERE idprov='".$idprov."' AND idespmed='".$idespmed."'; ");
													$obj=$mysqli->query($sql); $arr=$obj->fetch_array(); 
    											$esta=$arr[0];
                    	?>
                      <tr>  
                        <td><?php echo $ln.'.'; ?></td>
                        <td><?php echo $row['especialidad']; ?></td>

                        <th scope="row">
                        	<div class="form-check"> 
                        		<?php if ($esta!='0') { ?>
                        				<input class="form-check-input" type="checkbox" onclick="fregesp(<?php echo $row['idespmed']; ?>)" checked />
                        		<?php  }else{  ?>
                        				<input class="form-check-input" type="checkbox" onclick="fregesp(<?php echo $row['idespmed']; ?>)" />
                        		<?php	} ?>
                        	</div> 
                        		<!--
                        	<div class="checkbox-wrapper-31">
													  <input checked="" type="checkbox" >
													  <svg viewBox="0 0 35.6 35.6">
													    <circle class="background" cx="17.8" cy="17.8" r="17.8"></circle>
													    <circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle>
													    <polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline>
													  </svg>
													</div>-->
                        </th>
                        <!--td-->
                          <!--button type="button" class="btn btn-danger btn-sm px-3">
                            <i class="fas fa-times"></i>
                          </button-->
                        <!--/td-->
                      </tr>
                    	<?php } ?>
                      <!--
                      <tr>
                        
                        <td>Sonya Frost</td>
                        <td>Software Engineer</td>
                        <th scope="row">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2" />
                          </div>
                        </th>
                      </tr>
                    -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
								<!-- -->
							</form> 
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
	  <div class="row">
        <div align="right" class="col-6">
          <a href="../../index.php?usr=1" class="btn btn-secondary">Atrás</a>          
        </div>
        <div align="center" class="col-6">
          <a href="../../index.php?usr=1" style="background: #F89921;border-color: #F89921" class="btn btn-main btn-primary btn-lg uppercase" >Continuar</a>          
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
		//costo = document.getElementById("costo").value;
			//return false;
	}
</script>
</body>
</html>
