<?php
	require('../../conexion.php');
    session_start();
    $idlogin=$_SESSION['idlogin'];
    
    $idpac = $_GET['idpac'];
    // Busco datos de paciente
    $sql = ("SELECT apellido1, nombre1, cedula, edad FROM pacientes WHERE idpaci='".$idpac."'");
    $obj = $mysqli->query($sql); $arr = $obj->fetch_array();
    $nombrefull = $arr['apellido1'].' '.$arr['nombre1']; 
    $cedula = $arr['cedula']; 
    $edad = $arr['edad']; 

    //$sqlhist = ("SELECT idregistro, fechadia FROM consultas_med WHERE idpaci='".$idpac."'");
    $sqlhist = ("SELECT c.* FROM loginn a, medicos b, consultas_med c 
                  WHERE a.idlogin=b.idlogin AND b.idmed= c.idmed AND c.idpaci='".$idpac."';");
    //$sqlhist = ("SELECT b.apellido1, b.nombre1, b.cedula, b.edad, a.* FROM consultas_med a, pacientes b  WHERE a.idpaci=b.idpaci AND a.idpaci='".$idpac."';");
    $arrhist=$mysqli->query($sqlhist); 	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | PayMed</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  
  <!-- Viejo link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"-->
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
  .button1 {
    display: inline-block;
    padding: 3px 7px;
    font-size: 14px;
    cursor: pointer;
    text-align: center; 
    text-decoration: none;
    outline: none;
    color: #fff;
    background-color: #ED7855;
    border: none;
    border-radius: 9px;
    box-shadow: 0 7px #999;
  }

  .button1:hover {background-color: #EBB76E}

  .button1:active {
    background-color: #EBB76E;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
  }

  .form-control {
  font-family: system-ui, sans-serif;
  font-size: 1.4rem;
  font-weight: bold;
  line-height: 1.1;
  display: grid;
  grid-template-columns: 1em auto;
  gap: 0.5em;
}
</style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<!--  -->
<?php include("menuppal.php"); ?>
<!-- -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Consultas Previas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
              <li class="breadcrumb-item active">Listado de Consultas Previas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  <section class="content">
      <!-- Default box -->
      <div class="card">
        <div style="background: #F89921"  class="card-header">
          <h3 class="card-title">Nombre: <?php echo $nombrefull.'   ';?> Cédula: <?php echo $cedula.'   ';?> Edad: <?php echo $edad;?></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <!--button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button-->
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 11%">
                          Fecha
                      </th>
                      <th style="width: 11%">
                          Informe
                      </th>
                      <th style="width: 11%">
                          Imagenologia
                      </th>
                      <th style="width: 11%">
                          Laboratorio
                      </th>
                      <th style="width: 11%">
                           Récipe
                      </th>
                      <th style="width: 11%">
                          Todos
                      </th>
                  </tr>
              </thead>
              <tbody>
				  <?php while($rowhist = mysqli_fetch_array($arrhist)) { ?>
                <tr>
                    <!--td><a href="rpt_resumen_hist.php?idrg=< ?php echo $rowhist['idregistro'];?>">< ?php echo $rowhist['fechadia'];?></a></td-->
                    <!--Ori <td><a href="gerhistpdf.php?idrg=< ?php echo $rowhist['idregistro'];?>">< ?php echo $rowhist['fechadia'];?></a></td>   -->
                    <td><h3><b><?php echo $rowhist['fechadia'];?></b></h3></td>
                    <td>
                      <a href="gerhistpdf.php?idrg=<?php echo $rowhist['idregistro'];?>">
                        <button type="button" class="button1"><img src="img/medical-examination.png"  width="30" height="30" title="Informe médico"></button>
                      </a>
                    </td>
                    <td>
                      <a href="gerimgpdf.php?idrg=<?php echo $rowhist['idregistro'];?>">
                        <button type="button" class="button1" title="Informe Imagenologia"><img src="img/codificacion.png"  width="20" height="30"> </button>
                      </a>
                    </td>
                    <td>
                      <a href="gerlabpdf.php?idrg=<?php echo $rowhist['idregistro'];?>">
                        <button type="button" class="button1" title="Informe Laboratorio"><img src="img/Laboratorio.png"  width="20" height="30"> </button>
                      </a>
                    </td>
                    <td>
                      <a href="gerrecpdf.php?idrg=<?php echo $rowhist['idregistro'];?>">
                        <button type="button" class="button1" title="Récipe"><img src="img/especialista.png"  width="20" height="30"> </button>
                      </a>
                    </td>
                    <td><button type="button" class="button1" title="Especialista"><img src="img/all.png"  width="20" height="30"> </button></td>
                </tr>
				  <?php } ?>
              </tbody>
          </table>
        </div>
        <!-- /.card-body  -->
      </div>
      <!-- /.card -->
      <div  class="col-md-12"><small>* Si desea envar por correo, Escriba Correo, luego seleccione</small><br>
          <input type="email" id="inputcorreo" value="" title="Correo a Enviar Documento" placeholder="Ejemplo@test.com" >

          <label class="form-control">
            <input type="checkbox" id="idcheckbox" onclick="xcorreo()" />
              Enviar Por Correo ?
          </label>
          
      </div>
      <div align="center" class="col-md-12">
				<a class="btn btn-danger btn-sm" href="../../index.php?usr=1"><i class="fas fa-backward"></i> Regresar</a>				
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
<!-- jquery-validation new -->
<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page script -->


<script type="text/javascript">
$(document).ready(function () {
  //alert();document.getElementById('inputcorreo').style.display = 'none';
  
});
function xcorreo(){
  var checkBox = document.getElementById("idcheckbox");
  if (document.getElementById('inputcorreo').value == '') {
    document.getElementById("idcheckbox").checked = false;
    alert("Error: Debe Registrar Un Correo"); return false;
  }else{
    if (checkBox.checked == true){
      //document.getElementById('inputcorreo').style.display = 'block';
      //document.getElementById("inputcorreo").disabled = false;
      var correo = document.getElementById("inputcorreo").value;
      var correovalidado = validarEmail(correo);  // Valido correo
      if (!correovalidado) {
        document.getElementById('inputcorreo').value = '';
        document.getElementById("idcheckbox").checked = false;
        alert("Error: Correo Errado!");
        return false;
      }else{// Registro El Correo a Ser Enviado
        jQuery.ajax({
                type: "POST",   
                url: "regcorreo_js.php",
                data: {correo: correo},
                success:function(data){
                  console.log(data);
                }
            });// End Ajax

      }// Fin de no CorreoValido
    }else{
      document.getElementById('inputcorreo').value = '';
      //document.getElementById('inputcorreo').style.display = 'none';
      //document.getElementById("inputcorreo").disabled = true;
    }
  }
} // End Funcion
// Valida Correo
function validarEmail(email) {
    // Expresión regular para validar un correo electrónico
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regex.test(email);
} 

</script>
</body>
</html>