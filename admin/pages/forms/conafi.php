<?php  //ALTER TABLE `drdocument` ADD `quees` VARCHAR(44) NOT NULL COMMENT 'Que imagen es...' AFTER `imagen`;
session_start();
$usuario = $_SESSION['usuario'];
require('../../conexion.php');
if (isset($_GET['id'])) {
   $idmed=$_GET['id'];
   $sql = ("SELECT CONCAT(apellido1,' ', nombre1) AS nombre, nrodoc FROM medicos WHERE idmed='".$idmed."'; ");
   $obj=$mysqli->query($sql); 
   $arr=$obj->fetch_array();  
   $nombremed=$arr['nombre'];
   $nrodoc=$arr['nrodoc'];
   /* Armo las Opciones */
   $sql = ("SELECT idservaf, servicio, idestatus FROM serviciosafiliados where idestatus='1'; ");
    $result=$mysqli->query($sql);
   // busco imagenes de firma, si tiene 
   $sql = ("SELECT iddocument, idmed, imagen, quees FROM drdocument WHERE idmed='".$idmed."' AND quees='firma'; ");
   $obj=$mysqli->query($sql); 
   $arr=$obj->fetch_array();  
   $firmaimg=$arr['imagen'];
   // busco imagenes de sello, si tiene 
   $sql = ("SELECT iddocument, idmed, imagen, quees FROM drdocument WHERE idmed='".$idmed."' AND quees='sello'; ");
   $obj=$mysqli->query($sql); 
   $arr=$obj->fetch_array();  
   $selloimg=$arr['imagen'];

  } // End isset 
	
if (isset($_POST['submit'])) {
    $idmed= $_POST['idmed'];
    $nrodoc= $_POST['nrodoc'];
    
    // Imagen de la Firma
    if (isset($_FILES['imagen'])){
        //if ($_FILES['imagen']['type']=='image/png' || $_FILES['imagen']['type']=='application/pdf'){

        if ($_FILES['imagen']['type']=='image/png' || $_FILES['imagen']['type']=='image/jpg' || $_FILES['imagen']['type']=='image/jpeg'){
            $maxsize = 4097152 ; // 2 MB Tamaño Permitido
            $image = $_FILES["imagen"];
            if($image["size"] > $maxsize) {
                echo '<script language="javascript">alert("¡Imagen Supera Tamaño Permitido!");
                      window.location.href="conafi.php?id='.$idmed.'"; </script>';
               exit();       
            }
            //Verifico tipo de Imagen para la extencion del Nombre
            if ($_FILES['imagen']['type']=='image/png'){
                $ext="png";
            }else if ($_FILES['imagen']['type']=='image/jpg'){
                $ext="jpg";
            }else if ($_FILES['imagen']['type']=='image/jpeg'){
                $ext="jpeg";
            }
            //Subimos el fichero al servidor
            $fileName = $_FILES['imagen']['name'];
            $sourcePath = $_FILES['imagen']['tmp_name'];
            //$targetPath = "firma".$nrodoc.'.pdf';
            //$targetPath = "Firma".$nrodoc.'.png';
            $targetPath = "drdocument/"."Firma".$nrodoc.".".$ext;

            if(move_uploaded_file($sourcePath,$targetPath)){
              // Ori $imagen = $fileName;
              //$imagen = "firma".$nrodoc;  // personalizar nombre de la imagen
              $imagen = $targetPath;
              $validar=true;
            }
            // Elimino, si tiene imagen y registrar la nueva
            $strdel="DELETE FROM drdocument WHERE idmed='".$idmed."' AND quees='firma'; ";
            $conexdel=$mysqli->query($strdel);
            // inserto
            $str="INSERT INTO drdocument(iddocument, idmed, imagen, quees) VALUES(null, '".$idmed."','".$imagen."', 'firma');";
             //echo $str; exit();
            $conexion=$mysqli->query($str);
        }else{ $validar=false;
      }
    }
    // Imagen de la Sello
    if (isset($_FILES['imagen1'])){
        if ($_FILES['imagen1']['type']=='image/png' || $_FILES['imagen1']['type']=='image/jpg' || $_FILES['imagen1']['type']=='image/jpeg'){
            $maxsize = 4097152 ; // 2 MB Tamaño Permitido
            $image1 = $_FILES["imagen1"];
            if($image1["size"] > $maxsize) {
                echo '<script language="javascript">alert("¡Imagen Supera Tamaño Permitido!");
                      window.location.href="conafi.php?id='.$idmed.'"; </script>';
               exit();       
            }
            //Verifico tipo de Imagen para la extencion del Nombre
            if ($_FILES['imagen1']['type']=='image/png'){
                $ext="png";
            }else if ($_FILES['imagen1']['type']=='image/jpg'){
                $ext="jpg";
            }else if ($_FILES['imagen1']['type']=='image/jpeg'){
                $ext="jpeg";
            }
        //Subimos el fichero al servidor
            $fileName = $_FILES['imagen1']['name'];
            $sourcePath = $_FILES['imagen1']['tmp_name'];
            //$targetPath = "firma".$nrodoc.'.pdf';
            //$targetPath = "Sello".$nrodoc.'.png';
            $targetPath = "drdocument/"."Sello".$nrodoc.".".$ext;
            if(move_uploaded_file($sourcePath,$targetPath)){
              // Ori $imagen = $fileName;
              //$imagen = "firma".$nrodoc;  // personalizar nombre de la imagen
              $imagen1 = $targetPath;
              $validar=true;
            }
            // Elimino, si tiene imagen y registrar la nueva
            $strdel="DELETE FROM drdocument WHERE idmed='".$idmed."' AND quees='sello'; ";
            $conexdel=$mysqli->query($strdel);
            // inserto
            $str="INSERT INTO drdocument(iddocument, idmed, imagen, quees) VALUES(null, '".$idmed."','".$imagen1."', 'sello');";
            
            $conexion=$mysqli->query($str);
            
        }else{$validar=false;
      }
    }
    //echo '<script language="javascript">alert(" Registro Exitoso 123!!!");window.location.href="conafi.php?id="+idmed;</script>';
    echo '<script language="javascript">alert("¡Actualización Exitosa!");window.location.href="conafi.php?id='.$idmed.'"; </script>';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | PayMed</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
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
    <!-- -->
    <script src="jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#firma").on('change', function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);        
            })
            $("#sello").on('change', function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);        
            })
        });
        function fcheckafilia(id){
            var idmed  = document.getElementById("idmed").value;
            jQuery.ajax({
                type: "POST",   
                url: "regconvafi_js.php",
                data: {id: id, idmed: idmed},
                success:function(data){ 
                  console.log(data);
                  if (data!='1') {
                  }
                }
            });// End Ajax
        }
    </script>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- Main Sidebar Container -->
        <!-- -->
        <?php include("menuppal.php"); ?>
        <!-- -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Registro de Convenios de Afiliación</h1>
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
                    <div style="background: #F89921" class="card-header">
                        <!--h3 class="card-title">Registre Clinica y Horario. Dr. < ?php echo $nombre; ?></h3-->
                        <h3 class="card-title">Dr./Dra.: <?php echo $nombremed; ?> <span><img width="799px" height="37" src="img/l5.png"> </span></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <input type="hidden" id="idmed" name="idmed" value="<?php echo $idmed; ?>">
                            <input type="hidden" name="nrodoc" value="<?php echo $nrodoc; ?>">
                            <!--
                            <div class="m-3">
                                <h4>Frecuencia de Pago</h4>
                                <p>Indique la Frecuencia en la que desea recibir sus pagos, según su plan seleccionado.</p>
                                <div class="radio">
                                    <input type="radio" name="optradio"><label class="pl-2">PLAN PREMIUN, los agos ser realizan a los 3 dias con un fit del 10% </label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="optradio"> <label class="pl-2">PLAN PLATINIUM, los pagos se realizan a los 8 dias con un fit del 8%</label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="optradio"><label class="pl-2"> PLAN BASICO, los pagos se realizan a los 15 dias con un fit del 5% </label>
                                </div>
                            </div>
                            -->
                            <div class="m-4 2">
                                <h3 style="font-family:italic;"> Servicios Afiliados</h3>
                                <hr>

                                <div style="text-align: left;">
        <div class="row">
        <?php while($row = mysqli_fetch_array($result)) { 
            $sqlbusca="SELECT COUNT(*) as cant FROM convafixmedico WHERE idmed= '".$idmed."' and   idservaf = '".$row['idservaf']."'; ";
            $obj=$mysqli->query($sqlbusca);
            $arrlast=$obj->fetch_array();
            $cant=$arrlast[0];
        ?>
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="<?php echo $row['idservaf'];?>"  onclick="fcheckafilia(this.id)" 
                    <?php if ($cant!='0') { ?>
                    checked
                    <?php } ?>
                    >
                    <label class="form-check-label" for="<?php echo $row['idservaf'];?>">
                        <?php echo $row['servicio'];?>
                    </label>
                </div>
            </div>
        <?php } ?>
            
        </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Firma:</h5>
                                    <div class="custom-file">
                                        <input type="file" id="firma" name="imagen" class="custom-file-input" accept="image/png, image/jpeg" >  
                                        <label id="firma"  class="custom-file-label" for="firma"></label> 
                                        <small style="color: red" >Formato permitido: Png/Jpg</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5>Sello:</h5>
                                    <div class="custom-file">
                                        <input type="file" id="sello" name="imagen1" class="custom-file-input" accept="image/png, image/jpeg" >  
                                        <label id="sello"  class="custom-file-label" for="sello"></label> 
                                        <small style="color: red" >Formato permitido: Png/Jpg</small>
                                    </div>
                                </div>
                                <!-- Imagenes -->
                                <div align="center" class="col-md-6">
                                    <img src="<?php echo $firmaimg ?>" alt="Sin Imagen Seleccionada!!!" style="width:200px;height:200px;">
                                </div>
                                <div align="center" class="col-md-6">
                                    <img src="<?php echo $selloimg ?>" alt="Sin Imagen Seleccionada!!!" style="width:200px;height:200px;">
                                </div>

                                <div align="right" class="col-md-12"><br>
                                    <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Actualizar" class="btn btn-main btn-primary btn-lg uppercase">
                                </div>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="row">
        <div align="center" class="col-6">
          <a href="javascript: history.go(-1)" class="btn btn-secondary">Atrás</a>
        </div>

        <div align="center" class="col-6">
          <a href="../../index.php?usr=1" class="btn btn-warning">Salir</a>
        </div>
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
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {
                'placeholder': 'mm/dd/yyyy'
            })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            });

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

        })
    </script>
    
    <script type="text/javascript">
        /* viene de Pag validation.html */
        $(document).ready(function() {
            $.validator.setDefaults({
                submitHandler: function() {
                    alert("Form successful submitted!");
                }
            });
            $('#quickForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>