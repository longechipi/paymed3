<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Historial Médico del Paciente </h5>
                    <form id="historial">
                        <div class="row ">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <label for="ced">Buscar por Cédula del Paciente</label>
                                <input type="text" name="ced" id="ced" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"/>
                                <input type="text" name="idmed" id="idmed" value="<?php echo $idmedico; ?>" hidden/>
                               <div class="text-center mt-4">
                               <button type="submit" class="btn btn-primary">Consultar</button>
                               </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </form>
                    <div class="row" id="datos_paci" hidden>
                        <div class="table-responsive">
                            <table class="table table-hover" id="pacientes" cellspacing="0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Ultima Consulta</th>
                                        <th>Hora</th>
                                        <th>Cedula</th>
                                        <th>Nombre del Paciente</th>
                                        <th>Edad</th>
                                        <th>SINTOMAS</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                       

                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>
                    </div>
                    <?php include('../layouts/footer.php')?>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<?php include('../layouts/script.php')?>
<script>
    $(document).ready(function(){
        $('#historial').submit(function(e){
            e.preventDefault();
            const ced = $('#ced').val();
            const idmed = $('#idmed').val();
            $.ajax({
                url: '../model/historia_med/search.php',
                type: 'POST',
                data: {ced:ced , idmed:idmed},
                success: function(data){
                    const parsedData = JSON.parse(data);
                    if(parsedData[0].message =="OK"){
                        $('#datos_paci').removeAttr('hidden');
                        $('#pacientes').DataTable().destroy();
                        $('#pacientes tbody').html(data);
                        $('#pacientes').DataTable({
                            data: parsedData,
                            columns: [{
                                data: 'FECHACONSU'
                            }, {
                                data: 'HORACONSU'
                            }, {
                                data: 'CEDULA'
                            }, {
                                data: 'NOM_PACI'
                            }, {
                                data: 'EDAD'
                            },],
                            "columnDefs": [{
                                "targets": 5,
                                orderable: false,
                                "render": function(data, type, row, meta){
                                    return '<a class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="HISTORIAL DE LA CONSULTA" href="historia_paci.php?idcita=' + row['IDCITA'] + '" rel="noopener noreferrer">VER HISTORIAL</a>'
                                }
                            }],
                        "language": {
                            "sProcessing": "Procesando...",
                            "sLengthMenu": "Mostrar _MENU_ registros",
                            "sZeroRecords": "No se encontraron resultados",
                            "sEmptyTable": "Ningún dato disponible en esta tabla",
                            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
                        },
                        drawCallback: function () {
                            let tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                            let tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl, {
                            boundary: document.body,
                            container: 'body',
                            trigger: 'hover'
                            }));

                            tooltipList.forEach((tooltip) => { $('.tooltip').hide(); });

                        }
                            
                        });
                    }
                    if(parsedData[0].message =="OTRODR"){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'El Paciente esta Registrado con otro Doctor',
                            confirmButtonColor: "#007ebc",
                            confirmButtonText: "Aceptar",
                        });
                        $('#ced').val("");
                        return
                    }

                    if(parsedData[0].message =="SINCONSULTA"){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'El Paciente esta Registrado pero no Tiene consultas Previas',
                            confirmButtonColor: "#007ebc",
                            confirmButtonText: "Aceptar",
                        });
                        $('#ced').val("");
                        return
                    }

                    if(parsedData[0].message =="NOEXISTE"){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'El Paciente no esta Registrado en el Sistema',
                            confirmButtonColor: "#007ebc",
                            confirmButtonText: "Aceptar",
                        });
                        $('#ced').val("");
                        return
                    }
                   
                    
                    
                }
            });
        });
    });
</script>
</body>
</html>