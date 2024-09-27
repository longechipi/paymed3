<?php
	session_start();
	date_default_timezone_set('America/Caracas');
  require('conexion.php');
	$privilegios = $_SESSION['privilegios'];//echo  'index'.$privilegios; exit();
	$hubolog = $_GET["usr"];$_SESSION['usr'] = $hubolog;
  $idlogin=$_SESSION['idlogin'];
  $cargo = $_SESSION['cargo'];
  
  if (substr($cargo,0,9)=='Asistente') {
    $sqlasist = ("SELECT CONCAT(a.apellido1,' ', a.nombre1) as nombremedico, a.nrodoc, a.correo
            FROM medicos a, asistentes b, medicosxasist c 
            WHERE a.idmed=c.idmed and b.idasist=c.idasist and b.idlogin='".$idlogin."';");
    $resultasist=$mysqli->query($sqlasist);
  }
	//echo $cargo.'/'.$sqlasist; exit();

	if(empty($_SESSION['usr'])){header("Location: ../login.html"); exit(); }

	
	$sql = ("SELECT COUNT(*) as cuantos FROM citas");
	$result=$mysqli->query($sql);
	$ninm=$result->fetch_array();

	$sqll = ("SELECT COUNT(*) as cuantoss FROM aseguradoras");
	$resultt=$mysqli->query($sqll);
	$nregis=$resultt->fetch_array();
	
	$ano=date("Y");$mes=date("m");$dia=date("d"); 
	//$str = ("SELECT COUNT(*) as cantacti FROM inmuebles_r WHERE year(fechahora_sist)='".$ano."' and month(fechahora_sist)='".$mes."' and day(fechahora_sist)='".$dia."' ");
  $str = ("SELECT COUNT(*) as cantacti FROM medicos ");
	$resulta=$mysqli->query($str);
	$cantacti=$resulta->fetch_array();
  // Busco si el Cliente (Medico)ya esta activo(Estatus->'A')y habilitar o no opciones del menu
  $sqlestatus = ("SELECT estatus  FROM loginn WHERE idlogin ='".$idlogin."';");
  $objestatus = $mysqli->query($sqlestatus);
  $arrestatus = mysqli_fetch_array($objestatus);
  $estatusmedico =$arrestatus['estatus'];
  $_SESSION['estatusmedico'] =$estatusmedico ;
  /* Busc*/
	
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
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Calendario ND -->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/btnstyles.css">
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
    
     $( document ).ready(function() {
        /* antes, ya la selecion del medico se hace en el Index.php
        var id_privilegios  = $("#id_privilegios").val();
        var idmedxasis  = $("#idmedxasis").val();
        if (id_privilegios=='7' && idmedxasis=='') {
          //alert( "document loaded" );          
            //$('#exampleModal').modal('show');
        }
        /*
        /*  btn-salir */
        var btnsalir = document.getElementById('btn_salir');
        var btnconfirma = document.getElementById('btn_confirma'); 
        btnsalir.addEventListener('click',
          function () {
            window.location.href = "../login.html"
        }); // End salir
        /*  btn_confirma */
    
        btnconfirma.addEventListener('click',
          function () {
            datos = [];
            var select = document.getElementById('selectmodalidmed');
            var nombremedico = select.options[select.selectedIndex].text;
            var inputhide_usuario = document.getElementById('inputhide_usuario').value; //Asistentes
            var idmed = document.getElementById('selectmodalidmed').value;
            document.getElementById("p_namedr").innerHTML = 'Dr(a).:'+nombremedico;
            jQuery.ajax({
              type: "POST",  
              url: "changesession_js.php",
              data: {idmed: idmed, inputhide_usuario: inputhide_usuario},
              success:function(data){
              console.log(data);
              datos = data;
              const arrdatos = datos.split(';');
              console.log(arrdatos);
              document.getElementById('idmedxasis').value=arrdatos[0];
              document.getElementById('memberdesde').innerHTML='Desde :'+arrdatos[1];
              document.getElementById('memberhasta').innerHTML='Hasta :'+arrdatos[2];
              },
              error:function (){}
            }); // end jQuery
            $('#exampleModal').modal('hide');
        }); // End addEventListener
         var selemedico = document.getElementById('btnselmedico');
selemedico.addEventListener('click',
   function () {
      $('#exampleModal').modal('show');
   })
      }); // End Ready
    </script>
    <style type="text/css">
      .pointer {cursor: pointer;}
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" 
  data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Seleccione Medico</h5>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 text-center">
                <div class="form-group">
                  <!--label for="idmed">Medico:</label-->
                  <select id="selectmodalidmed" class="form-control mtitu" required>
                    <?php
                    //require('admin/conexion.php');
                    $query = $mysqli -> query ("SELECT x.idmed, x.idlogin, x.apellido1, x.nombre1 FROM asistentes a, medicosxasist c, medicos x WHERE a.idasist=c.idasist and c.idmed=x.idmed and a.idlogin='".$idlogin."' ;");
                    while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="'.$valores['idmed'].'">'.$valores['apellido1'].' '.$valores['nombre1'].'</option>';
                    } ?>
                  </select><br>
                </div>
              </div>
            </div> <!-- end row -->
          </div>  <!-- end body -->
          <div class="modal-footer">
            <button type="button" id="btn_salir" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            <button type="button" id="btn_confirma" class="btn btn-primary">Confirmar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Modal -->
<div class="wrapper">
     
      <!-- Sidebar Menu -->     		 
<?php include("menu-adm.php"); ?>
      <!-- /.sidebar-menu -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard PayMed Global</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="cerrar.php">Salir</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Sw para Modal, si es Asistente -->
    <input type="hidden" id="id_privilegios" value="<?php echo $privilegios; ?>"> 
    <input type="hidden" id="idmedxasis" value="<?php if (isset($_SESSION['idmedxasis'])) {echo $_SESSION['idmedxasis'];}?>"> 
    <!-- End Sw para Modal, si es Asistente -->
    <!-- Main content -->
    	<?php include("resumen.php"); ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("pages/forms/foo_admin.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- Calendario ND -->
<script src="js/scripts.js"></script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
 <!-- AdminLTE ds -->
  <script src="js/ds.js"></script>
</body>
</html>
