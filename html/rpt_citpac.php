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
                    <h5 class="card-title text-primary">Crear Citas</h5>
                    <?php 
                    $a="SELECT M.idmed, CONCAT(M.apellido1, ' ', M.nombre1) AS nom_med, HM.idclinica, C.nombrecentrosalud, HM.dia, HM.desde, HM.hasta,
                    CM.pacxdia, CM.pacconseg, CM.pacsinseg
                        FROM medicos M
                        LEFT JOIN horariomed HM ON M.idmed = HM.idmed
                        LEFT JOIN clinicas C ON HM.idclinica = C.idclinica
                        INNER JOIN clinicamedico CM ON (HM.idmed = CM.idmed AND CM.idclinica = HM.idclinica)
                        WHERE M.idmed = $idmedico";
                        $ares=$mysqli->query($a);

                    
                    ?>
                    <form id="add_citas">
                        <input type="text" name="cod_med" id="cod_med" value="<?php echo $idmedico;?>" hidden/>
                    <div class="row">
                        <div class="divider">
                            <div class="divider-text">Datos del Paciente</div>
                        </div>
                            <div class="row mb-5">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName">Buscar Paciente:</label>
                                        <input type="text" id="sear_pac" name="sear_pac" class="form-control" />
                                        <small>Permite Buscar por Cedula o por Nombre</small>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div id="display"></div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputName">Cedula:</label>
                                    <input type="text" id="cedula" name="cedula" class="form-control" readonly required/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputName">Nombre y Apellido:</label>
                                    <input type="text" id="nom_paci" name="nom_paci" class="form-control" readonly required/>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputName">Telefono:</label>
                                    <input type="text" id="telf" name="telf" class="form-control" readonly />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputName">Correo:</label>
                                    <input type="text" id="correo" name="correo" class="form-control" readonly required/>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <input type="text" id="id_med" name="id_med" class="form-control"  readonly hidden/>
                                <input type="text" id="id_paci" name="id_paci" class="form-control" readonly hidden/>
                            </div>

                        
                    </div>
                    <div class="row">
                        <div class="divider">
                            <div class="divider-text">Datos de la Cita</div>
                        </div>

                        <?php 
                        if($privilegios == 1){ ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputName">Dr(a):</label>
                                    <select class="form-select" name="dr_atiende" id="dr_atiende">
                                        <option value="" disabled selected>Seleccionar</option>
                                        <option value="1">Primer Doctor</option>
                                        <option value="2">Segundo Doctor</option>   
                                    </select>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputName">Dia de la Consulta:</label>
                                <input type="date" class="form-control" name="dia_cita" id="dia_cita" min="<?php echo date('Y-m-d'); ?>" required/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="clinica">Clinica:</label>
                                <select class="form-select" name="clinica" id="clinica" required> </select>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="form-group">
                                <label for="inputName">Hora de la Consulta:</label>
                                <select class="form-select" name="hora_cita" id="hora_cita" required>
                                    <option selected disabled value="">Seleccione</option>
                                </select>
                               
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputName">Motivo:</label>
                                <input type="text" class="form-control" name="motivo" id="motivo" required/>
                               
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputName">Paciente Asegurado</label>
                                <select class="form-select mb-4" name="pac_seg" id="pac_seg" required>
                                    <option selected disabled value="">Seleccione</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5" id="dat_seg" hidden>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputName">Seguro:</label>
                                <?php 
                                $a="SELECT idaseg, razsocial FROM aseguradores WHERE idestatus = 1"
                                ?>
                                <select class="form-select" name="seguro" id="seguro">
                                    <option selected disabled value="">Seleccione</option>
                                    <?php
                                    $ares=$mysqli->query($a);
                                    while($row=mysqli_fetch_array($ares)){
                                        echo '<option value="'.$row['idaseg'].'">'.$row['razsocial'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputName">Tipo de Consulta:</label>
                                <?php 
                                $a="SELECT idservaf, servicio FROM serviciosafiliados WHERE idestatus = 1"
                                ?>
                                <select class="form-select" name="tip_serv" id="tip_serv">
                                    <option selected disabled value="">Seleccione</option>
                                    <?php
                                    $ares=$mysqli->query($a);
                                    while($row=mysqli_fetch_array($ares)){
                                        echo '<option value="'.$row['idservaf'].'">'.$row['servicio'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        

                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> CREAR CITA</button>
                        <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
                    </div>

                    </form>
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
function busq(val) {
    //Datos para el formulario
    $('#cedula').val(val.split('--')[0]);
    $('#nom_paci').val(val.split('--')[1]);
    $('#telf').val(val.split('--')[2]);
    $('#correo').val(val.split('--')[3]);
    $('#id_paci').val(val.split('--')[4]);
    $('#id_med').val(val.split('--')[5]);
    $('#display').hide();
    $('#sear_pac').val("");
}
$(document).ready(function() {
    $("#sear_pac").keyup(function() {
      var paciente = $('#sear_pac').val();
      var cod_med = $('#cod_med').val();
      if (paciente == "") {
        $("#display").html("");
      } else {
        $.ajax({
          type: "POST",
          url: "../model/reg_cita/search_pac.php",
          data: { dat_paci: paciente, cod_med: cod_med },
          success: function(html) {
            $("#display").html(html).show();
          }
        });
      }
    });

    $('#dia_cita').change(function() {
        var dia_cita = $('#dia_cita').val();
        var id_med = $('#id_med').val();
        var id_paci = $('#id_paci').val();

        $.ajax({
            type: "POST",
            url: "../model/reg_cita/search_clinica.php",
            data: { dia_cita: dia_cita, id_med: id_med, id_paci: id_paci },
            success: function(data) {
                if(data == 2){
                    Swal.fire({
                        title: 'Error!',
                        text: 'Disculpe, usted no da consultas ese dia seleccionado',
                        icon: 'error',
                        confirmButtonColor: "#007ebc",
                        confirmButtonText: 'Aceptar'
                        })
                        $('#dia_cita').val('');
                        return
                        
                }else{
                    var clinic = JSON.parse(data);
                    var option = '<option value="" selected disabled> SELECCIONAR</option>';
                    for (var i = 0; i < clinic.length; i++) {
                    
                        option += '<option value="' + clinic[i].idclinica + '">' + clinic[i].nombrecentrosalud + '</option>';
                    }
                    $('#clinica').html(option);
                    $('#clinica').change(function() {
                        const clinica = $('#clinica').val()
                        const dia_cita = $('#dia_cita').val();
                        $.ajax({
                            type: "POST",
                            url: "../model/reg_cita/search_horas.php",
                            data: { clinica: clinica, id_med: id_med, id_paci: id_paci, dia_cita: dia_cita },
                            success: function(data) {
                                var horas = JSON.parse(data);
                                var option = '<option value="" selected disabled> SELECCIONAR</option>';
                                    for (var i = 0; i < horas.length; i++) {
                                        option += '<option value="' + horas[i] + '">' + horas[i] + '</option>';
                                    }
                                $('#hora_cita').html(option);
                            }

                        })
                    });
                }
            }
        });
    });

    $('#pac_seg').change(function() {
        var pac_seg = $('#pac_seg').val();
        const selectedOption = $(this).val();
        const requiredElements = ["seguro", "tip_serv"];
        if (pac_seg == 1) {
            $('#dat_seg').removeAttr('hidden');
            requiredElements.forEach(elementId => {
                $("#" + elementId).attr("required", true);
            });
        } else {
            $('#dat_seg').attr('hidden', true);
            requiredElements.forEach(elementId => {
                $("#" + elementId).removeAttr("required");
            });
        }
    });

    $('#add_citas').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "../model/reg_cita/add_cita.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data)
                if (data == 1) {
                    Swal.fire({
                        title: 'Cita Agregada',
                        text: 'Felicidades Agrego la Cita Exitosamente',
                        icon: 'success',
                        confirmButtonColor: "#007ebc",
                        confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "rpt_citpac.php";
                            }
                    });
                } 

                if (data == 2) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'El Paciente ya tiene una Cita Agendada con el Doctor',
                        icon: 'error',
                        confirmButtonColor: "#007ebc",
                        confirmButtonText: 'Aceptar'
                    })
                    $('#dia_cita').val('');
                    $('#clinica').val(''); 
                    $('#hora_cita').val('');
                    return
                }
                if (data == 3){
                    Swal.fire({
                        title: 'Error!',
                        text: 'Ocurrio un Error al Registrar la Cita',
                        icon: 'error',
                        confirmButtonColor: "#007ebc",
                        confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "rpt_citpac.php";
                        }
                    })
                }
                   
            
        }
    });
});


  });
</script>
</body>
</html>