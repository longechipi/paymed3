<?php
  session_start();
  date_default_timezone_set('America/Caracas');
  $usuario = $_SESSION['usuario'];
  $idlogin = $_SESSION['idlogin'];
  require('../../conexion.php');
  /* Verifico Si es Medico o Asistente */
  $sql = ("SELECT cargo, idtrabajacon, trabajacon FROM loginn WHERE idlogin='".$idlogin."'; ");
  $objlog=$mysqli->query($sql);
  $arrlog = mysqli_fetch_array($objlog);
  $cargo=$arrlog[0];$idtrabajacon=$arrlog[1];
  if ($cargo=='Medico') {
    $sql = ("SELECT idmed, idlogin FROM medicos WHERE idlogin='".$idlogin."'; ");
    $objmed=$mysqli->query($sql);
    $arrmed = mysqli_fetch_array($objmed);
    $idmed=$arrmed[0];
    $idlogin1=$arrmed[1];//Se usa esta variable auxiliar, ya que en el Select del horario no actualiza $idlogin cuando es Asistente
  }else if ($cargo=='Asistente1' || $cargo=='Asistente2') {
    if (isset($_SESSION['idloginmed'])) {$idlogin = $_SESSION['idloginmed'];}else{$idlogin = $_SESSION['idlogin'];}
    // Antes $sql = ("SELECT idmed, idlogin FROM medicos WHERE idlogin='".$idtrabajacon."'; ");
    $sql = ("SELECT idmed, idlogin FROM medicos WHERE idlogin='".$idlogin."'; ");
    $objmed=$mysqli->query($sql);
    $arrmed = mysqli_fetch_array($objmed);
    $idmed=$arrmed[0];
    $idlogin1=$arrmed[1]; //Se usa esta variable auxiliar, ya que en el Select del horario no actualiza $idlogin cuando es Asistente
    //echo $idlogin.'---'.$idmed; exit();
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
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
  <!-- Calendario ND -->
  <link rel="stylesheet" href="../../css/styles.css">
  <!-- Sweealert-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!--script src="https://code.jquery.com/jquery-1.9.1.min.js"></script-->
  <script src="jquery/jquery-3.2.1.min.js"></script>
    <script>
    
     $( document ).ready(function() {
        document.getElementById('cantconsultas').style.visibility = 'hidden';
        document.getElementById('horaconsulta').style.visibility = 'hidden';
        //alert( "document loaded" );
        //$('#modalhour').modal('show')
      });
    function fvuelve() {
      document.getElementById('btncont').disabled = true;
      document.getElementById('idclinica').value='';
      document.getElementById('cantconsultas').innerHTML = '';
      document.getElementById('ul-lispacdia').innerHTML = '';
      /**/
      const sele= document.getElementById("selecthoras");
      for (let i = sele.options.length; i >= 0; i--) {
         sele.remove(i);
      }
      
    }
    function fcontinuar() {
      let fechaconsulta=document.getElementById('fechaconsulta').value;
      let selecthoras=document.getElementById('selecthoras').value;
      let idclinica=document.getElementById('idclinica').value;
      
      let variableapasar =fechaconsulta+selecthoras+idclinica;
      
      window.location.href="preregpac.php?iid="+variableapasar;
    }
    </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Modal -->
  <div class="modal fade" id="modalhour" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" 
  data-keyboard="false">
  <form id="formmodal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="font: bold;" >...</h5>
          
          <div class="form-group"><br><br>
              <label for="apellido1">Seleccione Clinica:</label>
              <select  name="idclinica" id="idclinica" class="form-control mtitu" onchange="pacdeldia(this.value)" required>
              <option value="">-- Seleccione --</option>
              <?php
              //require('admin/conexion.php');
              //$query = $mysqli -> query ("SELECT idclinica, razsocial from clinicas WHERE idestatus='1'; ");

              $query = $mysqli -> query ("SELECT b.idclinica, b.nombrecentrosalud FROM clinicamedico a, clinicas b WHERE a.idclinica=b.idclinica AND a.idmed='".$idmed."';");
              while ($valores = mysqli_fetch_array($query)) {
              echo '<option value="'.$valores['idclinica'].'">'.$valores['nombrecentrosalud'].'</option>';} ?>
              </select>
         </div>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <!--span aria-hidden="true">&times;</span-->
          </button>
        </div>
        <div class="modal-body">
          <p style="font-family:bold; font-size:30px;">Consultas Para Clinica: <span id="cantconsultas">0</span> </p>
          
          <!-------------->
          <div class="form-group">
            <!--label for="exampleFormControlSelect1">Example select</label-->
            <p style="font-family:bold; font-size:25px;">Horas Disponible:</p>
            <select class="form-control" id="selecthoras">
              
            </select>
          </div>
          <!-------------->
          <p style="font-family:bold; font-size:20px;">Pacientes Dia:</p>
          <ul id="ul-lispacdia" class="list-group">
            
          </ul>
          <!-- -->
        </div>
        <div class="modal-footer">
          <button type="button" onclick="fvuelve()" class="btn btn-secondary" data-dismiss="modal">Volver</button>
          <button id="btncont" type="button" onclick="fcontinuar()" class="btn btn-primary" disabled>Continuar</button>
        </div>
      </div>
    </div>
    </form>
  </div>
  <!-- Fin Modal -->
<div class="wrapper">
     
      <!-- Sidebar Menu -->              
<?php include("menuppal.php"); ?>
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
              <li class="breadcrumb-item"><a href="../../../login.html">Salir</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
        <?php // include("resumen.php"); ?>
        <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">

            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Horario Consulta
                </h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
         <?php 
          /*busco Horario */
          
          $sqldias="SELECT b.dia, b.desde, b.hasta, c.nombrecentrosalud
                    FROM  medicos a, horariomed b, clinicas c
                    WHERE a.idmed=b.idmed and b.idclinica=c.idclinica and a.idlogin='".$idlogin1."'; ";
                    
          $objdias=$mysqli->query($sqldias);
          
          //$conexion=$mysqli->query($sql);
          // ------------------------------------------------------------$deast=$mysqli->query($sql);        
          while($task=$objdias->fetch_array()){ ?>                   
              <li>
                <!-- drag handle -->
                <span class="handle">
                  <i class="fas fa-ellipsis-v"></i>
                  <i class="fas fa-ellipsis-v"></i>
                </span>
                <!-- checkbox -->
                <!--
                <div  class="icheck-primary d-inline ml-2">
                  <input type="checkbox" value="" name="todo1" id="todoCheck1">
                  <label for="todoCheck1"></label>
                </div>
                -->
                <!-- todo text -->
                <span class="text"><?php echo $task['dia'];?>: </span>
                <span class="text"><?php echo $task['desde'];?></span>
                <span class="text"><?php echo $task['hasta'];?>-</span>
                <span class="text">-<?php echo $task['nombrecentrosalud'];?></span>
                <!-- Emphasis label -->
                <small class="badge badge-danger">Alta</small>
                <!-- General tools such as edit or delete-->
                <!--
                <div class="tools">
                  <a href="modevento.php?idcita=< ?php echo $task['idcita'];?>"><i class="fas fa-edit"></i></a>
                  <i class="fas fa-trash-o"></i>
                </div>
                -->
              </li>
                  <?php } ?>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="../../index.php?usr=1"><button type="button" class="btn btn-info float-right">Volver</button></a>
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
            <input type="hidden" id="idmed" value="<?php echo $idmed;?>">
            <input type="hidden" id="fechaconsulta" value="">
            <!-- Map card -->
            
            <!-- /.card -->

            <!-- Calendar -->
            <div align="center" class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title"><i class="far fa-calendar-alt"></i>.<span><i class="fa fa-check"></i>Haga Clic para Selección de día de Consulta:</span>  </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-bars"></i></button>
                    <div class="dropdown-menu float-right" role="menu">
                      <!--a href="regevento.php" class="dropdown-item">Nuevo Evento</a-->
                      <a href="regevento.php" class="dropdown-item">Nuevo Evento</a>
                      <a href="#" class="dropdown-item">Resetear</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">Ver calendario</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar 
        Original 
                <div id="calendar" style="width: 100%"></div> 
        -->
        <div class="calendar">
        <div class="calendar__info">
          <div class="calendar__prev" id="prev-month">&#9664;</div>
          <div class="calendar__month" id="month"></div>
          <div class="calendar__year" id="year"></div>
          <div class="calendar__next" id="next-month">&#9654;</div>
        </div>

        <div class="calendar__week">
          <div class="calendar__day calendar__item">Lun</div>
          <div class="calendar__day calendar__item">Mar</div>
          <div class="calendar__day calendar__item">Mie</div>
          <div class="calendar__day calendar__item">Jue</div>
          <div class="calendar__day calendar__item">Vie</div>
          <div class="calendar__day calendar__item">Sab</div>
          <div class="calendar__day calendar__item">Dom</div>
          <!-- Ori
          <div class="calendar__day calendar__item">Mon</div>
          <div class="calendar__day calendar__item">Tue</div>
          <div class="calendar__day calendar__item">Wed</div>
          <div class="calendar__day calendar__item">Thu</div>
          <div class="calendar__day calendar__item">Fri</div>
          <div class="calendar__day calendar__item">Sat</div>
          <div class="calendar__day calendar__item">Sun</div>
          -->
        </div>

        <div class="calendar__dates" id="dates"></div>
      </div>
        <!-- fin calendario-->
              </div>
              <!-- /.card-body  -->
            </div>
            
            

            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>


    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php // include("../../foo_admin.php"); ?>

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
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
