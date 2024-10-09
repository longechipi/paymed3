<?php 
//----- TOTAL DE MEDICOS ------//
$a = ("SELECT COUNT(*) as total_med FROM medicos ");
$ares=$mysqli->query($a);
$totalMedicos=$ares->fetch_array();
//----- TOTAL DE PACIENTES ------//
$b = ("SELECT COUNT(*) as total_pacientes FROM pacientes");
$bres=$mysqli->query($b);
$totalPacientes=$bres->fetch_array();
//----- TOTAL DE SEGUROS ------//
$c = ("SELECT COUNT(*) as total_seguros FROM aseguradoras");
$cres=$mysqli->query($c);
$totalSeguros=$cres->fetch_array();
//----- TOTAL DE CITAS ------//
$d = "SELECT COUNT(*) as total_citas FROM citas";
$dres=$mysqli->query($d);
$totalCitas=$dres->fetch_array();
?>
<div class="row">
<div class="col-lg-3 mb-4 order-0">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body admin text-center">
                <h5 class="card-title text-primary ">Directorio Médico</h5>
                <h2 class="fw-bold"><?php echo $totalMedicos['total_med'];?></h2>
                <h4 class="icono"><i class="fi fi-rr-stethoscope"></i></h4>
                
            </div>
        </div>
    </div>
  </div>
</div>

<div class="col-lg-3 mb-4 order-1">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body admin text-center">
                <h5 class="card-title text-primary">Aseguradoras</h5>
                <h2 class="fw-bold text-center"><?php echo $totalSeguros['total_seguros'];?></h2>
                <h4 class="icono"><i class="fi fi-rs-shield-check"></i></h4>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="col-lg-3 mb-4 order-2">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body admin text-center">
                <h5 class="card-title text-primary">PACIENTES</h5>
                <h2 class="fw-bold text-center"><?php echo $totalPacientes['total_pacientes'];?></h2>
                <h4 class="icono"><i class="fi fi-ts-users-medical"></i></h4>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="col-lg-3 mb-4 order-3">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body admin text-center">
                <h5 class="card-title text-primary">CITAS TOTALES</h5>
                <h2 class="fw-bold text-center"><?php echo $totalCitas['total_citas'];?></h2>
                <h4 class="icono"><i class="fi fi-tr-calendar-clock"></i></h4>
            </div>
        </div>
    </div>
  </div>
</div>
</div>
<hr class="mt-3">
<div class="row">
<div class="col-md-8">
    <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
                Directorio Médico
            </button>
            </li>
            <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">
                Pacientes
            </button>
            </li>
            <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="false">
                Compañia de Seguro
            </button>
            </li>
        </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active " id="navs-pills-top-home" role="tabpanel">
            <div class="col-md-6">
                <span class="text-black">Buscar por Especialidad</span>
                <select name="espe_med" id="espe_med" class="form-select">
                    <option value="" disabled selected>Especialidades</option>
                    <?php 
                    $a = "SELECT * FROM especialidadmed WHERE idestatus = 1";
                    $ares=$mysqli->query($a);
                    while ($arow = mysqli_fetch_array($ares)) {
                        echo '<option value="'.$arow['idespmed'].'">'.$arow['especialidad'].'</option>';
                    }
                    ?>
                </select>
            </div>
        <div class="order-4 d-flex justify-content-between col-12 gap-5">
            <div class="card mt-5 card-body admin text-center">
                <div class="row p-5 ">
                    <div class="col-md-12">
                        <img class="img-fluid img-thumbnail" src="../assets/img/avatars/6.png" alt="asdasd" srcset="">
                        <h5 class="card-title text-primary mt-5">Dr. Juan Perez</h5>
                            <h6 class="card-subtitle mb-2 text-white">Oftalmología</h6>
                            <p class="card-text">
                                <i class="fi fi-rr-phone-call"></i> <i class="fi fi-rr-envelope"></i> 
                                <br>
                                <a class="btn btn-primary" role="button" href="#">Ver Mas </a>
                            </p>
                    </div>
                </div>
            </div>

            <div class="card mt-5 card-body admin text-center">
                <div class="row p-5 ">
                    <div class="col-md-12">
                        <img class="img-fluid img-thumbnail" src="../assets/img/avatars/6.png" alt="asdasd" srcset="">
                        <h5 class="card-title text-primary mt-5">Dr. Juan Perez</h5>
                            <h6 class="card-subtitle mb-2 text-white">Oftalmología</h6>
                            <p class="card-text">
                                <i class="fi fi-rr-phone-call"></i> <i class="fi fi-rr-envelope"></i> 
                                <br>
                                <a class="btn btn-primary" role="button" href="#">Ver Mas </a>
                            </p>
                    </div>
                </div>
            </div>
            
            <div class="card mt-5 card-body admin text-center">
                <div class="row p-5 ">
                    <div class="col-md-12">
                        <img class="img-fluid img-thumbnail" src="../assets/img/avatars/6.png" alt="asdasd" srcset="">
                        <h5 class="card-title text-primary mt-5">Dr. Juan Perez</h5>
                            <h6 class="card-subtitle mb-2 text-white">Oftalmología</h6>
                            <p class="card-text">
                                <i class="fi fi-rr-phone-call"></i> <i class="fi fi-rr-envelope"></i> 
                                <br>
                                <a class="btn btn-primary" role="button" href="#">Ver Mas </a>
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
    <p>
        Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
        cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
        cheesecake fruitcake.
    </p>
    <p class="mb-0">
        Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
        cotton candy liquorice caramels.
    </p>
    </div>
        <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
        <p>
            Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
            cupcake gummi bears cake chocolate.
        </p>
        <p class="mb-0">
            Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
            roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
            jelly-o tart brownie jelly.
        </p>
        </div>
    </div>
    </div>
</div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary">Citas Para hoy <?php echo date('d-m-Y')?></h5>
                <div class="alert alert-primary" role="alert">Nombre: Jean Castillo <br> C.I: V17610797 <br> Dr: Carlos Perez</div>
                <div class="alert alert-primary" role="alert">Nombre: Miguel Acosta <br> C.I: 18789654 <br> Dr: Carlos Marquez</div>
                <div class="alert alert-primary" role="alert">Nombre: Pedro Carreño <br> C.I: V1278457 <br> Dr: Jhoana Perez</div>
                <div class="text-center">
                <a class="btn btn-primary" role="button" href="#">Ver Todas </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary">Balance General</h5>
                <div class="alert alert-secondary" role="alert">Por Pagar: 8.475 Bs</div>
                <div class="alert alert-secondary" role="alert">En Cuenta: 48.475 Bs</div>
                <div class="alert alert-secondary" role="alert">Pendiente: 10.745 Bs</div>
                <div class="text-center">
                <a class="btn btn-primary" role="button" href="#">Ver Detallado</a>
                </div>
            </div>
        </div>



    </div>
</div>

<script>
    $('#espe_med').select2({
        theme: 'bootstrap-5',
        width: '100%',
    });
</script>