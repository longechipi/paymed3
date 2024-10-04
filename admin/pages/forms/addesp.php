<?php  
    //ALTER TABLE `medicos`  ADD `codcolemed` VARCHAR(22) NOT NULL COMMENT 'Codigo Colegio Medico'  AFTER `nrodoc`,  ADD `mpss` VARCHAR(22) NOT NULL COMMENT 'Codigo Ministerio de Salud'  AFTER `codcolemed`;
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');
  if (isset($_GET['id'])) { //echo "_get"; exit();
	 $idmed=$_GET['id'];
	 $sql = ("SELECT CONCAT(apellido1,' ', nombre1) AS nombre, codcolemed, mpss FROM medicos WHERE idmed='".$idmed."'; ");
   $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
   $nombre=$arr['nombre'];
   $codcolemed=$arr['codcolemed'];
   $mpss=$arr['mpss'];
  } // End isset 
  if(isset($_POST['submit'])){ echo "submit"; exit();
    $idmed=$_POST['idmed'];
    $sql = ("SELECT CONCAT(apellido1,' ', nombre1) AS nombre, codcolemed, mpss FROM medicos WHERE idmed='".$idmed."'; ");
    $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
    $nombre=$arr['nombre'];
    $codcolemed=$arr['codcolemed'];
    $mpss=$arr['mpss'];    
  }
  /*Busco Doc*/
   $sql = ("SELECT iddocument, idmed, imagen FROM drdocument WHERE idmed='".$idmed."'; ");
   $objimg=$mysqli->query($sql);
  /* Busco Horario */
  $sqlclinmedi = "SELECT b.idclinica, c.idmed, b.razsocial, a.pacxdia, a.pacconseg, a.pacsinseg
                  FROM clinicamedico a, clinicas b, medicos c
                  WHERE a.idclinica =b.idclinica
                  AND a.idmed=c.idmed
                  AND c.idlogin = $idlogin";

  $objclinmedi=$mysqli->query($sqlclinmedi);
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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	
		$(document).ready(function(){
      //document.getElementById("borrar").style.cursor = "pointer";
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
                    //var xy='<tr id="'+id+'" onclick="fdel('+id+')"><td>'+data+'</td><td>X</td></tr>';alert(xy);
			               document.getElementById("tblesp").insertRow(-1).innerHTML =
                      '<tr><td>'+data+'</td><td>X</td></tr>';
                      //<tr id="'.$row['idespxmed'].'" onclick="fdel(this.id);"><td>'.$row['especialidad'].'</td><td>X</td></tr>'; 
                      location.reload();  // Por ahora
                  }
                }
            });// End Ajax
		}
    /*___________________________________________________________________________________*/
    function fdel(id){
      var idmed  = document.getElementById("idmed").value;
      
      //window.location.href="addesp.php?id="+idmed;
      jQuery.ajax({
                type: "POST",   
                url: "delesp_js.php",
                 async: false, 
                data: {id: id},
                success:function(data){
                  if (data!='0') {
                    window.location.href="addesp.php?id="+idmed;
                  }
                  //window.location.href="addespxcv.php?id="+idmed;
                  // location.reload(); // Por ahora
              }
                
      });
      // End Ajax
      //window.location.href="conafi.php?id="+idmed;
    }
    /*___________________________________________________________________________________*/
    function addhorario(argument) {
      $("#exampleModalCenter").modal()
    }
    function checkday(id){
      
      let diadesde = id.substring(5)+'desde';
      let diahasta = id.substring(5)+'hasta';
      

      //var varcheckday=document.getElementById("ludesde");
      if (document.getElementById(`${id}`).checked){
        document.getElementById(`${diadesde}`).disabled = false;  
        document.getElementById(`${diahasta}`).disabled = false;  
      }else{
        document.getElementById(`${diadesde}`).disabled = true;  
        document.getElementById(`${diahasta}`).disabled = true;
      }
    }
    function fsaveclinhorario(argument) { //reg schedule

      if (document.getElementById("idclinica").value==""){Swal.fire({icon: 'error',title: 'Seleccione Clinica' });return false;}
      if (document.getElementById("pacxdia").value=="0" || document.getElementById("pacxdia").value==""){Swal.fire({icon: 'error',title: 'Pacientes Por Dia'});return false;}
      if (document.getElementById("pacconseg").value==""){Swal.fire({icon: 'error',title: 'Pacientes Con Seguro'});return false;}
      if (document.getElementById("pacsinseg").value==""){Swal.fire({icon: 'error',title: 'Pacientes Sin Seguro'});return false;}

      if (document.getElementById("consultorio").value==""){Swal.fire({icon: 'error',title: 'Consultorio Requerido'});return false;}
      if (document.getElementById("piso").value==""){Swal.fire({icon: 'error',title: 'Piso Requerido'});return false;}

      var idclinica = document.getElementById("idclinica").value;
      var idmed = document.getElementById("idmed").value;
      var pacxdia = parseInt(document.getElementById("pacxdia").value);
      var pacconseg = document.getElementById("pacconseg").value;
      var pacsinseg = document.getElementById("pacsinseg").value;
      var consultorio = document.getElementById("consultorio").value;
      var piso = document.getElementById("piso").value;
      var telefono1 = document.getElementById("telefono1").value;
      var telefono2 = document.getElementById("telefono2").value;
      allpac=parseInt(pacconseg)+parseInt(pacsinseg);
      if (allpac!=pacxdia) {Swal.fire({icon: 'error',title: 'Pacientes Por Dia' });return false;}
      
      if (!document.getElementById('checklu').checked &&
          !document.getElementById('checkma').checked &&
          !document.getElementById('checkmi').checked &&
          !document.getElementById('checkju').checked &&
          !document.getElementById('checkvi').checked &&
          !document.getElementById('checksa').checked &&
          !document.getElementById('checkdo').checked ){Swal.fire({icon: 'error',title: 'Debe Marcar Un dia' });return false;}

      if (document.getElementById('checklu').checked){
        if (document.getElementById("ludesde").value==''){Swal.fire({icon: 'error',title: 'Error Dia Lunes'});return false;}
        if (document.getElementById("luhasta").value==''){Swal.fire({icon: 'error',title: 'Error Dia Lunes'});return false;}
      }
      if (document.getElementById('checkma').checked){
        if (document.getElementById("madesde").value==''){Swal.fire({icon: 'error',title: 'Error Dia Martes'});return false;}
        if (document.getElementById("mahasta").value==''){Swal.fire({icon: 'error',title: 'Error Dia Martes'});return false;}
      }
      if (document.getElementById('checkmi').checked){
        if (document.getElementById("midesde").value==''){Swal.fire({icon: 'error',title: 'Error Dia Miercoles'});return false;}
        if (document.getElementById("mihasta").value==''){Swal.fire({icon: 'error',title: 'Error Dia Miercoles'});return false;}
      }
      if (document.getElementById('checkju').checked){
        if (document.getElementById("judesde").value==''){Swal.fire({icon: 'error',title: 'Error Dia Jueves'});return false;}
        if (document.getElementById("juhasta").value==''){Swal.fire({icon: 'error',title: 'Error Dia Jueves'});return false;}
      }
      if (document.getElementById('checkvi').checked){
        if (document.getElementById("videsde").value==''){Swal.fire({icon: 'error',title: 'Error Dia Viernes'});return false;}
        if (document.getElementById("vihasta").value==''){Swal.fire({icon: 'error',title: 'Error Dia Viernes'});return false;}
      }
      if (document.getElementById('checksa').checked){
        if (document.getElementById("sadesde").value==''){Swal.fire({icon: 'error',title: 'Error Dia Sabado'});return false;}
        if (document.getElementById("sahasta").value==''){Swal.fire({icon: 'error',title: 'Error Dia Sabado'});return false;}
      }
      if (document.getElementById('checkdo').checked){
        if (document.getElementById("dodesde").value==''){Swal.fire({icon: 'error',title: 'Error Dia Domingo'});return false;}
        if (document.getElementById("dohasta").value==''){Swal.fire({icon: 'error',title: 'Error Dia Domingo'});return false;}
      }

      jQuery.ajax({
                type: "POST",   
                url: "reghorario_js.php",
                async : false,
                data: {idclinica: idclinica, idmed: idmed, pacxdia: pacxdia, pacconseg: pacconseg, pacsinseg: pacsinseg, consultorio: consultorio, piso: piso, telefono1: telefono1, telefono2: telefono2},
                success:function(data){
                  console.log(data);
              }
        });
      
      if (document.getElementById("checklu").checked){
        var dia='Lunes';
        var desde = document.getElementById("ludesde").value;
        var hasta = document.getElementById("luhasta").value; 
         jQuery.ajax({
                type: "POST",   
                url: "reghorario_js.php",
                async: false, 
                data: {idclinica: idclinica, idmed: idmed, dia: dia, desde: desde, hasta: hasta},
                success:function(data){
                  
              }
        });
      }
      if (document.getElementById("checkma").checked){
        var dia='Martes';
        var desde = document.getElementById("madesde").value;
        var hasta = document.getElementById("mahasta").value; 
         jQuery.ajax({
                type: "POST",   
                url: "reghorario_js.php",
                async: false, 
                data: {idclinica: idclinica, idmed: idmed, dia: dia, desde: desde, hasta: hasta},
                success:function(data){
                  
              }
        });
      }

      if (document.getElementById("checkmi").checked){
        var dia='Miercoles';
        var desde = document.getElementById("midesde").value;
        var hasta = document.getElementById("mihasta").value; 
         jQuery.ajax({
                type: "POST",   
                url: "reghorario_js.php",
                async: false, 
                data: {idclinica: idclinica, idmed: idmed, dia: dia, desde: desde, hasta: hasta},
                success:function(data){
                  
              }
        });
      }

      if (document.getElementById("checkju").checked){
        var dia='Jueves';
        var desde = document.getElementById("judesde").value;
        var hasta = document.getElementById("juhasta").value; 
         jQuery.ajax({
                type: "POST",   
                url: "reghorario_js.php",
                async: false, 
                data: {idclinica: idclinica, idmed: idmed, dia: dia, desde: desde, hasta: hasta},
                success:function(data){
                  
              }
        });
      }

      if (document.getElementById("checkvi").checked){
        var dia='Viernes';
        var desde = document.getElementById("videsde").value;
        var hasta = document.getElementById("vihasta").value; 
         jQuery.ajax({
                type: "POST",   
                url: "reghorario_js.php",
                async: false, 
                data: {idclinica: idclinica, idmed: idmed, dia: dia, desde: desde, hasta: hasta},
                success:function(data){
                  
              }
        });
      }

      if (document.getElementById("checksa").checked){
        var dia='Sabado';
        var desde = document.getElementById("sadesde").value;
        var hasta = document.getElementById("sahasta").value; 
         jQuery.ajax({
                type: "POST",   
                url: "reghorario_js.php",
                async: false, 
                data: {idclinica: idclinica, idmed: idmed, dia: dia, desde: desde, hasta: hasta},
                success:function(data){
                  
              }
        });
      }

      if (document.getElementById("checkdo").checked){
        var dia='Domingo';
        var desde = document.getElementById("dodesde").value;
        var hasta = document.getElementById("dohasta").value; 
         jQuery.ajax({
                type: "POST",   
                url: "reghorario_js.php",
                async: false, 
                data: {idclinica: idclinica, idmed: idmed, dia: dia, desde: desde, hasta: hasta},
                success:function(data){
                  
              }
        });
      }
      $('#exampleModalCenter').modal('hide');
      location.reload();  // Por ahora
      
      
    }
    function fdelgorario(idmed,idclinica) {

      Swal.fire({
            title: 'Seguro?',
            text: "Eliminar Horario!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar!'
          }).then((result) => {
            if (result.isConfirmed) {
              jQuery.ajax({
                  type: "POST",   
                  url: "delhorario_js.php",
                   async: false, 
                  data: {idclinica: idclinica, idmed: idmed},
                  success:function(data){
                    if (data!='1') {return false;}
                  }
                });
                Swal.fire(
                  'Deleted!',
                  'Horario Eliminado.',
                  'success'
                )
            }
            window.location.href="addesp.php?id="+idmed;
            //location.reload();  // Por ahora
          })
      }

      function fnext() {
        var idmed = document.getElementById("idmed").value;
        /*
        var codcolemed = document.getElementById("codcolemed").value;
        let lencodcolemed = codcolemed.length;
        if (lencodcolemed!='9') {Swal.fire({icon: 'error', title: 'Codigo Colegio Medico'}); return false;}

        var mpss = document.getElementById("mpss").value;
        let lenmpss = mpss.length;
        if (lenmpss!='5') {Swal.fire({icon: 'error', title: 'Codigo MPSS'}); return false;}
        if (codcolemed==''){
          Swal.fire({
              icon: 'error',
              title: 'Codigo Colegio Medico'
            });
          return false;
        }else if (mpss=='') {
          Swal.fire({
              icon: 'error',
              title: 'Codigo MPSS'
            });
          return false;
        }
        */
        /*
        jQuery.ajax({
                  type: "POST",   
                  url: "updcodmedmpss_js.php",
                  data: {idmed: idmed},
                  success:function(data){
                    if (data!='1') {return false;}
                    window.location.href="adddoc.php?id="+idmed;
                  }
                });
        */
        window.location.href="adddoc.php?id="+idmed;
      } // fin fnext
</script>
</head>
<body class="hold-transition sidebar-mini">
  <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <!--div class="modal-dialog modal-dialog-centered" role="document"-->
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Registre Clinica y Horario - Dr(a). <?php echo $nombre; ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label for="apellido1">Clinicas:</label>
              <select  name="idaseg" id="idclinica" class="form-control mtitu" required>
              <option value="">-- Seleccione --</option>
              <?php
              //require('admin/conexion.php');
              //$query = $mysqli -> query ("SELECT idclinica, razsocial from clinicas WHERE idestatus='1'; ");
              $query = $mysqli -> query ("SELECT a.idclinica, a.razsocial 
                                          from clinicas a
                                          WHERE a.idclinica not in(select b.idclinica from clinicamedico b where b.idmed='".$idmed."') AND a.idestatus='1'; ");
              while ($valores = mysqli_fetch_array($query)) {
              echo '<option value="'.$valores['idclinica'].'">'.$valores['razsocial'].'</option>';} ?>
              </select>
            </div>

            <div class="form-group">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Pacientes Por Dia:</th>
                    <th scope="col"><input type="text" id="pacxdia" value="0" size="3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"></th>
                  </tr>
                  <tr>
                    <th scope="col">Pacientes Con Seguro:</th>
                    <th scope="col"><input type="tex" id="pacconseg" value="0" size="3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"></th>
                  </tr>
                  <tr>
                    <th scope="col">Pacientes Sin Seguro:</th>
                    <th scope="col"><input type="text" id="pacsinseg" value="0" size="3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"></th>
                  </tr>
                </thead>
              </table>
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="consultorionro">Consultorio: </label>
                    <input type="text" name="" id="consultorio" value="" class="form-control form-control-sm">
                  </div>      
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="piso">Piso: </label>
                    <input type="text" name="" id="piso" value="" class="form-control form-control-sm">
                  </div>      
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="telefono1">Telefono 1: </label>
                    <input type="text" name="" id="telefono1" value="" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                  </div>      
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="telefono2">Telefono 2: </label>
                    <input type="text" name="" id="telefono2" value="" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                  </div>      
                </div>

              </div>  
            </div>

          </div>
          <div class="col-md-7">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Desde:</th>
                  <th scope="col">Hasta</th>
                  <th scope="col" colspan="2" >Dia</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="time" id="ludesde" name="ludesde" disabled> </td>
                  <td><input type="time" id="luhasta" name="luhasta" disabled> </td>
                  <th scope="row">Lun </th>
                  <td><div class="form-check">
                        <input class="form-check-input position-static" type="checkbox" name="checklu" id="checklu" onclick="checkday(this.id)" aria-label="...">
                      </div>
                  </td>
                </tr>
                
                <tr>
                  <td><input type="time" id="madesde" name="madesde" disabled> </td>
                  <td><input type="time" id="mahasta" name="mahasta" disabled> </td>
                  <th scope="row">Mar</th>
                  <td><div class="form-check">
                        <input class="form-check-input position-static" type="checkbox" name="checkma" id="checkma" onclick="checkday(this.id)" value="" aria-label="...">
                      </div>
                  </td>
                </tr>

                <tr>
                  <td><input type="time" id="midesde" name="midesde" disabled> </td>
                  <td><input type="time" id="mihasta" name="mihasta" disabled> </td>
                  <th scope="row">Mie</th>
                  <td><div class="form-check">
                        <input class="form-check-input position-static" type="checkbox" name="checkmi" id="checkmi" onclick="checkday(this.id)" aria-label="...">
                      </div>
                  </td>
                </tr>

                <tr>
                  <td><input type="time" id="judesde" name="judesde" disabled> </td>
                  <td><input type="time" id="juhasta" name="juhasta" disabled> </td>
                  <th scope="row">Jue</th>
                  <td><div class="form-check">
                        <input class="form-check-input position-static" type="checkbox" name="checkju" id="checkju" onclick="checkday(this.id)" aria-label="...">
                      </div>
                  </td>
                </tr>

                <tr>
                  <td><input type="time" id="videsde" name="videsde" disabled> </td>
                  <td><input type="time" id="vihasta" name="vihasta" disabled> </td>
                  <th scope="row">Vie</th>
                  <td><div class="form-check">
                        <input class="form-check-input position-static" type="checkbox" name="checkvi" id="checkvi" onclick="checkday(this.id)" aria-label="...">
                      </div>
                  </td>
                </tr>

                <tr>
                  <td><input type="time" id="sadesde" name="sadesde" disabled> </td>
                  <td><input type="time" id="sahasta" name="sahasta" disabled> </td>
                  <th scope="row">Sab</th>
                  <td><div class="form-check">
                        <input class="form-check-input position-static" type="checkbox" name="checksa" id="checksa" onclick="checkday(this.id)" aria-label="...">
                      </div>
                  </td>
                </tr>

                <tr>
                  <td><input type="time" name="dodesde" id="dodesde" disabled> </td>
                  <td><input type="time" name="dohasta" id="dohasta" disabled> </td>
                  <th scope="row">Dom</th>
                  <td><div class="form-check">
                        <input class="form-check-input position-static" type="checkbox" name="checkdo" id="checkdo" onclick="checkday(this.id)" aria-label="...">
                      </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="fsaveclinhorario()" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
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
              <h3 class="card-title">Dr./Dra.: <?php echo $nombre; ?> <span><img width="799px" height="37" src="img/l3.png"> </span></h3>

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
        <!-- Cero Linea -->
        <!--
          <div class="col-md-6">
            <div class="form-group">
              <h4 for="mpss" style="color: #454545;font-weight: bold;">Codigo Colegio Medico:</h4>
              <input type="text" name="codcolemed" id="codcolemed"  value="<?php echo $codcolemed; ?>" class="form-control form-control-sm"  onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
            </div>  
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <h4 for="mpss" style="color: #454545;font-weight: bold;">MPSS: </h4>
              <input type="text" name="mpss" id="mpss" value="<?php echo $mpss; ?>" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
            </div>  
          </div>
          -->
				<!-- 1ra -->
        <br>
				<div class="col-md-6">
					<div class="form-group">
						<label for="idtipo">Seleccione Especialidad:</label>
						<select class="form-control custom-select form-control-sm" id="idespmed" name="idespmed" onchange="asignaesp(this.value)" >
							<option value="">-- Seleccione --</option>
                  			<?php
							$query = $mysqli -> query ("SELECT idesppresu, especialidad FROM presupuesto_especialidades");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idesppresu'].'">'.$valores['especialidad'].'</option>';
						            } ?>
            </select>
					</div>
				</div>
				<div class="col-md-6">
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
						  </tbody>
						</table>
					</div>
				</div>
      <!--      . . . . . . . . . . . . . . . .  -->  
        
		</form> 
            <!-- /.card-body -->
          </div>
          <hr>
          <!-- _______________________________________________________________________________________________________________ -->
          <div class="row">
              <div class="col-md-1" align="center">
                <small style="color: #cb1010;font-weight: bold;">Borrar</small>
              </div>
              <div class="col-md-5">
                <h4 style="color: #454545;font-weight: bold;">Clinica</h4>
              </div>
              <div class="col-md-6">
                <h4 style="color: #454545;font-weight: bold;">Horario</h4>
              </div>
              <!-- -->
              <?php while($rowclinmedi = mysqli_fetch_array($objclinmedi)) { ?>
              <div class="col-md-1" align="center">
                <button onclick="fdelgorario(<?php echo $rowclinmedi['idmed'];?>,<?php echo $rowclinmedi['idclinica'];?>)" class="btn btn-danger btn-sm" title="Borrar Horario"><i class="fa fa-trash"></i></button>
              </div>
              <div class="col-md-2">
                <h5><?php echo $rowclinmedi['razsocial'];?></h5>
              </div>
              <div class="col-md-9">
                <p>
                <?php 
                $idmedhorario=$rowclinmedi["idmed"];
                $idclinicahorario=$rowclinmedi["idclinica"];

                $sqlhorario="SELECT a.idhorario, a.idmedcli, a.idclinica, b.razsocial, a.idmed, a.dia, a.desde, a.hasta 
                  FROM horariomed a, clinicas b
                  WHERE a.idclinica =b.idclinica
                  AND a.idclinica='".$idclinicahorario."'
                  AND a.idmed='".$idmedhorario."';";
                  $objhorario=$mysqli->query($sqlhorario);
                  
                  while($rowhorario = mysqli_fetch_array($objhorario)) {
                    $desde=date("g:iA", strtotime($rowhorario['desde']));
                    $hasta=date("g:iA", strtotime($rowhorario['hasta']));?>
                    <span>
                      <?php echo $rowhorario['dia'].' : '.$desde.'-'.$hasta;?>/
                      </span>
                      
                  <?php } ?>
                  </p>
              </div>
            <?php } ?>
              <!-- -->
              <div class="col-md-12">
                <button type="button" class="btn btn-secondary btn-lg btn-block" onclick="addhorario()">Añadir Horario de Atencion</button>
              </div>
          </div>
          <br>
          <div align="right" class="col-12">
                  <!--input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Siguiente" class="btn btn-main btn-primary btn-lg uppercase"-->
                  <button style="background: #F89921;border-color: #F89921" onclick="fnext()" class="btn btn-main btn-primary btn-lg uppercase">Siguiente</button>
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
