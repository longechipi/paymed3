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

// $sqlasist = ("SELECT idasist FROM asistentes  WHERE correo='".$usuario."'; ");
// 	$objasist=$mysqli->query($sqlasist); $arrasist=$objasist->fetch_array();
// 	$idasist=$arrasist[0];


?>
<div class="row">
<!-- TOTAL DE MEDICOS EN SISTEMA -->
<div class="col-lg-3 mb-4 order-0">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">MEDICOS</h5>
                <h2 class="fw-bold text-center"><?php echo $totalMedicos['total_med'];?></h2>
                <p class="mb-4"></p>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- TOTAL DE PACIENTES EN SISTEMA -->
<div class="col-lg-3 mb-4 order-1">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">PACIENTES</h5>
                <h2 class="fw-bold text-center"><?php echo $totalPacientes['total_pacientes'];?></h2>
                <p class="mb-4"></p>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- TOTAL DE SEGUROS EN SISTEMA -->
<div class="col-lg-3 mb-4 order-2">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">ASEGURADORAS</h5>
                <h2 class="fw-bold text-center"><?php echo $totalSeguros['total_seguros'];?></h2>
                <p class="mb-4"></p>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- TOTAL DE SEGUROS EN SISTEMA -->
<div class="col-lg-3 mb-4 order-3">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">CITAS TOTALES</h5>
                <h3 class="fw-bold text-center"><?php echo $totalCitas['total_citas'];?></h3>
                <p class="mb-4"></p>
            </div>
        </div>
    </div>
  </div>
</div>
</div>
<?php if ($privilegios=='1') { // Admin ?>
<div class="row">
  <div class="col-lg-8 col-sm-12 order-0">
  <table id="myTable" class="table table-hover">
    <thead>
        <tr>
            <th>Actividad</th>
            <th>Fecha</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody></tbody>
    </table>
    
  </div>
    <div class="col-lg-4 col-sm-12 order-1">
      <!-- Boton de Medicos -->
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-12">
            <div class="card-body">
              <h5 class="card-title text-center">MEDICOS</h5>
              <p class="card-text text-center">Información de los Medicos registrados en el sistema </p>
              <p class="card-text text-center"><a class="btn btn-primary" href="#" role="button">Button</a></p>
            </div>
          </div>
        </div>
      </div> 
      <!-- Boton de Medicos --> 
       <!-- Boton de PAGOS -->
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-12">
            <div class="card-body">
              <h5 class="card-title text-center">PAGOS</h5>
              <p class="card-text text-center">Información de Pagos realizados en el sistema </p>
              <p class="card-text text-center"><a class="btn btn-primary" href="#" role="button">Button</a></p>
            </div>
          </div>
        </div>
      </div> 
      <!-- Boton de Medicos --> 
       <!-- Boton de Medicos -->
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-12">
            <div class="card-body">
              <h5 class="card-title text-center">JUNTA MÉDICA</h5>
              <p class="card-text text-center">Información de temas relevantes para la junta medica </p>
              <p class="card-text text-center"><a class="btn btn-primary" href="#" role="button">Button</a></p>
            </div>
          </div>
        </div>
      </div> 
      <!-- Boton de Medicos --> 
    </div>
</div>


<?php } ?>

