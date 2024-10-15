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
<div class="row"> <!--  FILA PRINCIPAL DE ARRIBA -->
<div class="col-lg-3 mb-4 order-0">
  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body admin text-center">
               <br>
                <h2 class="fw-bold"><i class="fi fi-rs-plus"></i></h2>
                <h5>Añadir Paciente</h5>
                
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
                <br>
                <h2 class="fw-bold admin text-center"><i class="fi fi-rr-file-edit"></i></h2>
                <h5>Agendar Cita</h5>
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
                <br>
                <h2 class="fw-bold text-center"><i class="fi fi-rr-download"></i></h2>
                <h5>Emitir Informes</h5>
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
                <br>
                <h2 class="fw-bold text-center"><i class="fi fi-rr-chart-histogram"></i></h2>
                <h5>Balance de Procesos</h5>
            </div>
        </div>
    </div>
  </div>
</div>
</div><!-- FIN FILA PRINCIPAL DE ARRIBA -->

<hr class="mt-3">
<div class="row">
 <div class="col-md-8"> <!-- SEGUNDO BLOQUE DE PESTAÑAS -->
    <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#calendario" aria-controls="calendario" aria-selected="true">
                Calendario Citas
            </button>
            </li>
            <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">
                Directorio Medico
            </button>
            </li>
            <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="false">
                pacientes
            </button>
            </li>
            <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="false">
                Aseguradoras
            </button>
            </li>

        </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active " id="calendario" role="tabpanel">
            <div id="calendar"></div>
    </div>

    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel"> <!-- INICIO CONTENIDO DE PESTAÑA -->

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



    </div> <!--FIN  CONTENIDO DE PESTAÑA -->
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


 <div class="row"><!-- INICIO DE TERCERA FILA  -->
    <div class="col-md-4">


    <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary"><i class="fi fi-rs-file-invoice-dollar"></i>&nbsp;&nbsp; Balance General</h5>
                <div class="alert alert-secondary" role="alert">Por Pagar: 8.475 Bs</div>
                <div class="alert alert-secondary" role="alert">En Cuenta: 48.475 Bs</div>
                <div class="alert alert-secondary" role="alert">Pendiente: 10.745 Bs</div>
                <div class="text-center">
                <a class="btn btn-primary" role="button" href="#">Ver Detallado</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
    <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary"><i class="fi fi-rr-newspaper"></i>&nbsp;&nbsp; Informe Emitidos</h5>
                <div class="alert alert-secondary" role="alert">Por Pagar: 8.475 Bs</div>
                <div class="alert alert-secondary" role="alert">En Cuenta: 48.475 Bs</div>
                <div class="alert alert-secondary" role="alert">Pendiente: 10.745 Bs</div>
                <div class="text-center">
                <a class="btn btn-primary" role="button" href="#">Ver Detallado</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
    <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary"><i class="fi fi-rs-membership"></i>&nbsp;&nbsp; Detalles del Plan</h5>
                <div class="alert alert-secondary" role="alert">Por Pagar: 8.475 Bs</div>
                <div class="alert alert-secondary" role="alert">En Cuenta: 48.475 Bs</div>
                <div class="alert alert-secondary" role="alert">Pendiente: 10.745 Bs</div>
                <div class="text-center">
                <a class="btn btn-primary" role="button" href="#">Ver Detallado</a>
                </div>
            </div>
        </div>
    </div>

</div><!-- FIN DE TERCERA FILA  -->

</div> <!-- FIN SEGUNDO BLOQUE DE PESTAÑAS -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary"><i class="fi fi-rs-pending"></i>&nbsp;&nbsp; Citas Para hoy: <span class=""><?php echo date('d-m-Y')?> </span></h5>
                
                <div class="horario-front">
                    <div class="flex-container">
                        <div class="text-content">
                            <p>Nombre: Miguel Acosta <br> C.I: 18789654 <br> Dr: Carlos Marquez</p>
                        </div>
                        <div class="time-content">
                            <div class="hora">10:00 PM</div>
                        </div>
                    </div>
                </div>

                <div class="horario-front">
                    <div class="flex-container">
                        <div class="text-content">
                            <p>Nombre: Miguel Acosta <br> C.I: 18789654 <br> Dr: Carlos Marquez</p>
                        </div>
                        <div class="time-content">
                            <div class="hora">10:00 PM</div>
                        </div>
                    </div>
                </div>
                

                <div class="horario-front">
                    <div class="flex-container">
                        <div class="text-content">
                            <p>Nombre: Miguel Acosta <br> C.I: 18789654 <br> Dr: Carlos Marquez</p>
                        </div>
                        <div class="time-content">
                            <div class="hora">12:00 PM</div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                <a class="btn btn-primary" role="button" href="#">Ver Todas </a>
                </div>
            </div>
        </div>
        <hr>
        <!-- <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary">Balance General</h5>
                <div class="alert alert-secondary" role="alert">Por Pagar: 8.475 Bs</div>
                <div class="alert alert-secondary" role="alert">En Cuenta: 48.475 Bs</div>
                <div class="alert alert-secondary" role="alert">Pendiente: 10.745 Bs</div>
                <div class="text-center">
                <a class="btn btn-primary" role="button" href="#">Ver Detallado</a>
                </div>
            </div>
        </div> -->

        



    </div>
</div>

<script>
    $('#espe_med').select2({
        theme: 'bootstrap-5',
        width: '100%',
    });
    $('#calendar').evoCalendar({
        'language': 'es',
        'todayHighlight': true, //Fecha de Hoy Resaltada
        'sidebarDisplayDefault': false, //Barra de los Meses
        //'sidebarToggler': false, //Boton de la Barra
        
        'eventDisplayDefault': false, //Eventos Resaltados
        'onlyOneEvent': true, //Solo un Evento al Día
        calendarEvents: [
      {
        id: 'bHay68s', // Event's ID (required)
        name: "New Year", // Event name (required)
        date: "October/15/2024", // Event date (required)
        type: "holiday", // Event type (required)
        everyYear: true // Same event every year (optional)
      },
      {
        name: "Vacation Leave",
        badge: "02/13 - 02/15", // Event badge (optional)
        date: ["October/13/2020", "October/15/2024"], // Date range
        description: "Vacation leave for 3 days.", // Event description (optional)
        type: "event",
        color: "#63d867" // Event custom color (optional)
      }
    ]
    });

</script>