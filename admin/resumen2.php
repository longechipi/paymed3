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
<!-- TOTAL DE MEDICOS EN SISTEMA -->
<div class="col-lg-3 mb-4 order-0">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">MEDICOS</h5>
                <h3><?php echo $totalMedicos['total_med'];?></h3>
                <p class="mb-4"></p>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- TOTAL DE PACIENTES EN SISTEMA -->
<div class="col-lg-3 mb-4 order-0">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">PACIENTES</h5>
                <h3><?php echo $totalPacientes['total_pacientes'];?></h3>
                <p class="mb-4"></p>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- TOTAL DE SEGUROS EN SISTEMA -->
<div class="col-lg-3 mb-4 order-0">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">ASEGURADORAS</h5>
                <h3><?php echo $totalSeguros['total_seguros'];?></h3>
                <p class="mb-4"></p>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- TOTAL DE SEGUROS EN SISTEMA -->
<div class="col-lg-3 mb-4 order-0">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">CITAS TOTALES</h5>
                <h3><?php echo $totalCitas['total_citas'];?></h3>
                <p class="mb-4"></p>
            </div>
        </div>
    </div>
  </div>
</div>