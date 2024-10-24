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
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Citas Médicas</h5>
                    <?php include('../controller/citas/data_citas.php'); ?>
                    <div id="calendario"></div>
                  <?php include('../layouts/modals/status_cita.php'); ?>
                    <script>
                        $(document).ready(function() {
                            $('#calendario').evoCalendar({
                            'theme': "Default",
                            'language': "es",
                            'eventHeaderFormat': 'd MM yyyy',
                            'language': 'es',
                            'todayHighlight': true, //Fecha de Hoy Resaltada
                            'sidebarDisplayDefault': false, //Barra de los Meses
                            'eventDisplayDefault': true, //Eventos Resaltados
                              calendarEvents: <?php echo $json_string; ?>
                            })

                            $(document).on('click', '.btn-primary', function() {
                                var citaId = $(this).data('cita-id');
                                $.ajax({
                                url: '../layouts/modals/cita_opciones.php',
                                data: {
                                    cita_id: citaId
                                },
                                method: 'POST',
                                success: function(resp) {
                                    $('#miModal').modal('show');
                                    $('.modal-body').html(resp);
                                }
                                });
                            });
                          })
                    </script>
                    

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
  $("#calendar").evoCalendar({
    theme: "Default",
    language: "es"
  });
</script>

</body>
</html>