<?php
session_start();
date_default_timezone_set('America/Caracas');
$usuario = $_SESSION['usuario'];
//$idlogin = $_SESSION['idlogin'];
if (isset($_SESSION['idloginmed'])) {$idlogin = $_SESSION['idloginmed'];}else{$idlogin = $_SESSION['idlogin'];}
$cargo = $_SESSION['cargo'];
//echo $idlogin.'--'.$idloginmed.'--'.$cargo;
require('../../conexion.php');
$fechahoy=date('Y-m-d');
$ffechahoy = date("d/m/Y", strtotime($fechahoy));

// $dia=date('d'); $mes=date('m'); $ano=date('Y'); echo $fechahoy; 
require('borracitas.php'); // Elimino las citas q pasaron 24 horas
//*SELECT MEDICOS 
$sqlmed = ("SELECT idmed FROM medicos WHERE correo='".$usuario."'");
$arrmed = $mysqli->query($sqlmed);
$rowmed = mysqli_fetch_array($arrmed);
$idmed  = $rowmed['idmed'];
// Si es Asistente busco idlogin de su jefe (Medico)
//if ($cargo=='Asistente1' || $cargo=='Asistente2') {
    // busco idtrabajacon en loginn para poder vincular con idmed
//   $sqlasist = ("SELECT idlogin, idtrabajacon FROM loginn WHERE correo='".$usuario."'");
//   $objasist = $mysqli->query($sqlasist); $arrasist = $objasist->fetch_array();
   //$idregistrador = $arrasist['idlogin'];       // Leo el idlogin del Asistente para registrarlo en la cita
//   $idlogin = $arrasist['idtrabajacon'];   // Leo el idlogin del Medico para quien trabaja
//}
//echo $idlogin; exit();

if (isset($_POST['submit'])) {
    $f1 = $_POST['f1'];
    $f2 = $_POST['f2'];
    $where="";
    if(!empty($_POST['f2'])and!empty($_POST['f1'])){
        $donde="1";
        $where=" WHERE  a.idmed = b.idmed AND a.idpaci = c.idpaci AND fechacita   BETWEEN '".$f1."' AND '".$f2."' AND b.idlogin='".$idlogin."'  ORDER BY a.nombre ASC";
        if(strtotime(date($f1))>strtotime(date($f2))){
            $where=" WHERE  a.idmed = b.idmed AND a.idpaci = c.idpaci AND fechacita   BETWEEN '".$f2."' AND '".$f1."' AND b.idlogin='".$idlogin."'  ORDER BY a.nombre ASC";
        }
    }else if (empty($where)){
        $donde="3";
        $where="WHERE  a.idmed = b.idmed AND a.idestatus IN(3,6,7) AND b.idlogin='".$idlogin."'   ORDER BY a.nombre ASC ";
    }
} 
if (isset($_POST['submit_fec'])) {  // Por Cedula
    $nrocedula = $_POST['nrocedula'];
    $where="WHERE  a.idmed = b.idmed AND a.idestatus IN(3,6,7) 
            AND c.cedula='".$nrocedula."' 
            AND b.idlogin='".$idlogin."' 
            ORDER BY a.nombre ASC ";
}
if ($where=='') {
    $donde="4";
    //$sql = ("SELECT * FROM citas a , medicos b WHERE a.idmed = b.idmed AND a.idestatus ='3' ORDER BY a.nombre ASC  ");
    $sql = ("SELECT a.*, c.cedula, b.idmed, b.idlogin, b.idcomp, b.nrodoc, b.codcolemed, b.mpss, b.rif, b.nombre1, b.nombre2, b.apellido1, b.apellido2 FROM citas a , medicos b,  pacientes c
             WHERE a.idmed = b.idmed  AND a.idpaci = c.idpaci  AND a.idestatus IN(3,6,7) AND fechacita='".$fechahoy."' AND b.idlogin='".$idlogin."' ORDER BY a.nombre ASC");
} else {
    $donde="5";
    $sql = ("SELECT a.*, c.cedula, b.idmed, b.idlogin, b.idcomp, b.nrodoc, b.codcolemed, b.mpss, b.rif, b.nombre1, b.nombre2, b.apellido1, b.apellido2  
            FROM citas a , medicos b, pacientes c $where");
}

//echo $donde.'--'.$sql; exit();
$result = $mysqli->query($sql);
//echo $sql."      ".$f1."  ".$f2." ".$donde; exit();
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
    <!-- Sweetalert  -->
    <!--script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .buttonr {
            background-color: #F89921;
            /* Orange */
            border: #F89921;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px 2px;
            cursor: pointer;
            border-radius: 2px;
        }

        .btns {
            border: none;
            background-color: #F89921;
            color: #FFF;
            border-radius: 9px;
            padding: 10px;
            margin: 0 10px 15px 10px;
        }

        #nrocedula{
            width: 10%;
            height: 25px;
            margin: 0 auto;
            margin-top:10px;
            border: none;
            border:solid 1px #ccc;
            border-radius: 10px;
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
                            <h1>Listado Citas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
                                <li class="breadcrumb-item active">Citas</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- //*FILTRO -->
                <div class="cotainer" style="display: flex;">
                    <label>Filtro Citas </label>
                    <button class="fa fa-filter btns" onclick="view()"></button>
                </div>
                <div style="visibility:visible;">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <table class="table table-striped projects" id="windows">
                            <thead>
                                <tr>
                                    <th style="width:15% ;">Fecha Inicio:</th>
                                    <th style="width:15% ;">Fecha fin:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> <input type="date" min="2022-01-01"  class="form-control" name="f1"> </td>
                                    <td> <input type="date" min="2022-01-01" class="form-control" name="f2"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div align="right" id="btns">
                            <input value="Buscar" class="btns" type="submit" name="submit">
                            <input value="Reset" class="btn btn-danger" type="submit" name="cancel">
                        </div>
                    </form>

                </div>
                <!--
                <div align="center" class="col-md-12">
                    <form action="preregpac.php">
                        <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Citasfgh" class="btn btn-main btn-primary btn-lg uppercase">
                    </form>
                </div><br>
                    -->
                <!-- Default box -->
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <span>Cedula : <input type="text" name="nrocedula" id="nrocedula" placeholder="V11123123" >
                    <input style="background: #fadb61;border-color: #F89921" type="submit" name="submit_fec" value="Buscar" class="btn btn-main btn-suscess btn-sm uppercase" >
                    <input style="background: #f03232;border-color: #F89921" type="submit" name="reset" value="Reset" class="btn btn-main btn-suscess btn-sm uppercase" >
                    </span>
                </form>
                <div class="card">
                    <div style="background: #F89921" class="card-header">
                        <h3 class="card-title">Listado de Citas :<span style="color:cyan;"><?php echo $ffechahoy;?></span></h3>

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
                                    <th>Hist.:</th>
                                    <th>cédula:</th>
                                    <th>Paciente:</th>
                                    <th>Fecha/Sol:</th>
                                    <th>Fecha/Hora:</th>
                                    <th>Telefono:</th>
                                    <th>Clinica:</th>
                                    <th>Medico:</th>
                                    <th>Conf.:</th>
                                    <!--th class="text-center">Telefono</th-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $hoy = strtotime(date('Y-m-d'));
                                       //echo $startDate; echo $currentDate;exit();
                                while ($row = mysqli_fetch_array($result)) { $idclinica=$row['idclinica'];
                                    $fechasolimostrar = date("d-m-Y", strtotime($row['fechasoli']));

                                    $varfechacita=$row['fechacita'];
                                    $fechacita = strtotime(date('Y-m-d', strtotime($varfechacita) ) );
                                    $fechacitamostrar = date("d-m-Y", strtotime($varfechacita));




                                    $sqlclin = ("SELECT nombrecentrosalud FROM clinicas WHERE idclinica='".$idclinica."'");
                                    $arrclin = $mysqli->query($sqlclin);
                                    $rowclin = mysqli_fetch_array($arrclin);
                                    $nombrecentrosalud =$rowclin[0];
                                    /* Busco Historia */
                                    $idpaci=$row['idpaci'];
                                    $sqlhist = ("SELECT nrohistoria FROM historias WHERE idpaci='".$idpaci."'");
                                    $objhist = $mysqli->query($sqlhist); $arrhist = $objhist->fetch_array();
                                    if ($arrhist[0]==null) {
                                        $nrohistoria='S/H';
                                    }else{
                                        $nrohistoria = $arrhist[0];
                                    }

                                    ?>
                                    <tr>
                                        <td class="project_progress"><?php echo $nrohistoria; ?></td>
                                        <td class="project_progress"><?php echo $row['cedula']; ?></td>
                                        <td class="project_progress"><?php echo $row['nombre'] . " " . $row['apellido']; ?></td>
                                        <td class="project_progress"><?php echo $fechasolimostrar; ?></td>
                                        <td class="project_progress"><?php echo $fechacitamostrar . ' / ' . $row['horacita']; ?></td>
                                        <td class="project_progress"><?php echo $row['telefono']; ?></td>
                                        <td class="project_progress"><?php echo $nombrecentrosalud; ?></td>
                                        <td class="project-progress"><?php echo $row['nombre1'] . " " . $row['apellido1']; ?></td>
                                        <td><!-- Default checked -->
                                            <div class="custom-control custom-checkbox">
                                               <?php if ($row['idestatus']=='6') { ?>
                                                <input type="checkbox" class="custom-control-input" id="Checked<?php echo $row['idcita']?>" onclick="fconfcita(this.id)" Checked>      
                                                <label class="custom-control-label" for="Checked<?php echo $row['idcita']?>"></label>
                                               <?php }else if($row['idestatus']=='3'){ ?>
                                                <input type="checkbox" class="custom-control-input" id="Checked<?php echo $row['idcita']?>" onclick="fconfcita(this.id)" >
                                                <label class="custom-control-label" for="Checked<?php echo $row['idcita']?>"></label>
                                               <?php } ?>
                                            </div>
                                        </td>
                                        <?php if($row['idestatus']!='7'){ ?>
                                            <td class="project-actions text-right">
                                                <?php if($fechacita < $hoy ) {?>
                                                <a class="btn btn-info btn-sm" onclick="showerrormess()" title="Imposible Reagendar Cita"><i class="fa fa-book"></i></a>
                                                <a class="btn btn-success btn-sm" onclick="showerrormess()" title="Imposible Registrar Cita"> <i class="fa fa-eye"></i></a>
                                                <?php }else{ ?>
                                                    <a class="btn btn-info btn-sm" href="reagci.php?cit=<?php echo $row['idcita'];?>" title="Reagendar Cita"><i class="fa fa-book"></i></a>
                                                        <?php if($cargo == 'Asistente1') {
															// A la espera por aclarar que tipo de asistente podra registrar citas
															?>
                                                            <a class="btn btn-success btn-sm"  title="Reg. Informe" disabled> <i class="fa fa-eye"></i></a>
                                                        <?php }else{ ?>    
                                                            <a class="btn btn-success btn-sm"  title="Reg. Informe" onclick="verfeccita(<?php echo $row['idcita'];?>)"> <i class="fa fa-eye"></i></a>
                                                        <?php } ?>    
                                                <?php } ?>
                                                <!-- Ori a class="btn btn-success btn-sm" href="reghist.php?pac=< ?php echo $row['idcita']; ?>" title="Registrar Cita">
                                                    <i class="fa fa-eye"></i></a-->
                                                <!-- Ori a class="btn btn-success btn-sm"  title="Registrar Cita" onclick="verfeccita(< ?php echo $row['idcita'];?>)"> <i class="fa fa-eye"></i></a-->

                                                <!--a class="btn btn-primary btn-sm" href="updhist.php?idc=< ?php echo $row['idcita']; ?>"> <i class="fa fa-edit"></i></a-->
                                                <a class="btn btn-primary btn-sm" href="rpt_historias.php?idpac=<?php echo $row['idpaci']; ?>" title="Informes Medicos"> <i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm" href="src_del_cita.php?idc=<?php echo $row['idcita']; ?>"  title="Eliminar Cita">
                                                    <i class="fas fa-trash"></i> </a>
                                            </td>
                                        <?php }else if($row['idestatus']=='7'){ ?>
                                            <td class="project-actions text-right">
                                                <i class="fa fa-check-square" aria-hidden="true"></i>
                                                <!-- por ahora a class="btn btn-info btn-sm" href="printcita.php?idc=< ?php echo $row['idcita']; ?>"><i class="fas fa-receipt"></i> </a-->
                                                <a class="btn btn-primary btn-sm" href="rpt_historias.php?idpac=<?php echo $row['idpaci']; ?>" title="Informes Medicos"> <i class="fa fa-edit"></i></a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
    <!-- ND jQuery -->
    <script src="js/scripts.js"></script>
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
    <!-- AdminLTE ds -->
	<script src="js/ds.js"></script>
    <!-- Page script -->
    <script>
        var clic = 1;

        function view() {
            if (clic == 1) {
                document.getElementById("windows").style.visibility = "hidden";
                document.getElementById("btns").style.visibility = "hidden";
                clic = clic + 1;
            } else {
                document.getElementById("windows").style.visibility = "visible";
                document.getElementById("btns").style.visibility = "visible";
                clic = 1;
            }
        }
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