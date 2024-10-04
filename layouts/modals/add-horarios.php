<!-- Modal -->
<?php 
$a_cli = "SELECT * FROM medicos WHERE idmed = $idmed";
$ares=$mysqli->query($a_cli); 
$row = $ares->fetch_assoc();
?>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Clinica y Horarios para el Dr(a): <?php echo $row['apellido1'].' '. $row['apellido2'].' '.  $row['nombre1'].' '. $row['nombre2'];?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
        <form id="horario">
          <input type="text" name="idmed_hora" id="idmed_hora" class="form-control" value="<?php echo $idmed; ?>" hidden>
            <div class="row">
                <div class="divider">
                    <div class="divider-text">Clinica </div>
            </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="apellido1">Clinicas:</label>
                          <select name="idclinica" id="idclinica" class="form-select" required>
                            <option value="" selected disabled>Seleccione</option>
                            <?php
                            $query = $mysqli -> query 
                            ("SELECT a.idclinica, a.razsocial 
                            from clinicas a
                            WHERE a.idclinica not in(select b.idclinica from clinicamedico b where b.idmed='$idmed') AND a.idestatus='1';");
                            while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="'.$valores['idclinica'].'">'.$valores['razsocial'].'</option>';} ?>
                          </select>
                    </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="consultorionro">Consultorio: </label>
                    <input type="text" name="consultorio" id="consultorio" class="form-control" />
                  </div>      
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="piso">Piso: </label>
                    <input type="text" name="piso" id="piso" class="form-control" />
                  </div>      
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="telefono1">Telf 1: </label>
                    <input type="text" name="telefono1" id="telefono1" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" />
                  </div>      
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="telefono2">Telf 2: </label>
                    <input type="text" name="telefono2" id="telefono2" class="form-control mb-3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" />
                  </div>      
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="pacxdia">Paciente por día</label>
                    <input type="text" class="form-control" name="pacxdia" id="pacxdia" value="0" size="3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="pacconseg">Pacientes Con Seguro</label>
                    <input type="text" class="form-control" name="pacconseg" id="pacconseg" value="0" size="3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="pacsinseg">Pacientes Sin Seguro</label>
                    <input type="text" class="form-control" name="pacsinseg" id="pacsinseg" value="0" size="3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" />
                  </div>
                </div>


            </div> <!-- FIN ROW -->
            <div class="row">
                <div class="divider">
                    <div class="divider-text">Horarios </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="apellido1">Dias:</label>
                        <select  name="dias" id="dias" class="form-select" required>
                            <option value="" disabled selected>Seleccione</option>
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miercoles">Miercoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sabado">Sabado</option>
                            <option value="Domingo">Domingo</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4" id="horas" hidden>
                    <div class="form-group d-flex gap-5">
                        <div>
                            <label for="desde">Desde:</label>
                            <input type="time" name="desde" id="desde" class="form-control">
                        </div>
                        <div>
                            <label for="hasta">Hasta:</label>
                            <input type="time" name="hasta" id="hasta" class="form-control">
                            
                        </div>
                        <div>
                            <button id="add_hora" class="btn btn-primary mt-5"> Agregar </button>
                        </div>
                    </div>
                </div>
                <div>
                  <table class="table" id="tabla-hora">
                    <thead>
                        <tr>
                          <th>Dia</th>
                          <th>Desde</th>
                          <th>Hasta</th>
                        </tr>
                    </thead>
                      <tbody></tbody>
                  </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" name="submit" class="btn btn-primary"> Cargar</button>
            </div>
        </form>
        
      </div>

    </div>
  </div>
</div>

<script>
$('#dias').change(function(){
    const dias = $(this).val();
    $('#horas').removeAttr('hidden');
}); 
$('#add_hora').click(function(e){
    e.preventDefault();
    const desde = $('#desde').val();
    const hasta = $('#hasta').val();
    const dias = $('#dias').val();
    if(desde == '' || hasta == ''){
        alert('Tiene que Seleccionar el Horario de Atención');
        return;
    }
    const html = `<tr><td>${dias}</td><td>${desde}</td><td>${hasta}</td></tr>`;
    $('#tabla-hora').append(html);
});
    $('#horario').submit(function(e){
      e.preventDefault();
      const pacxdia = $('#pacxdia').val();
      const pacconseg = $('#pacconseg').val();
      const pacsinseg = $('#pacsinseg').val();
      const totalPac = parseInt(pacconseg) + parseInt(pacsinseg);  
      const horarios = [];
        if(pacxdia < totalPac){
          Swal.fire({
            title: '¡Error!',
            text: '¡Los pacientes con Seguro y Sin Seguro no puede Superar a los Pacientes por día!',
            icon: 'error',
            confirmButtonColor: "#007ebc",
            confirmButtonText: 'Aceptar'
          }).then(() => {
              const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
              modal.hide();
            });
          return;
        }
            $('#tabla-hora tr').each(function() {
              const $row = $(this);
              const dias = $row.find('td:eq(0)').text();
              const desde = $row.find('td:eq(1)').text();
              const hasta = $row.find('td:eq(2)').text();
              if (dias && desde && hasta) {
                  horarios.push({
                      dias,
                      desde,
                      hasta
                  });
              }
            });

      const data = $("#horario").serialize() + '&horarios=' + JSON.stringify(horarios);
        $.ajax({
          type: "POST",
          url: "../model/perfil/medicos/add_horarios.php",
          data: data,
            success: function(data){
              if(data == 1){
                Swal.fire({
                  title: '¡Éxito!',
                  text: '¡Horarios y Clinicas Agregados Correctamente!',
                  icon: 'success',
                  confirmButtonColor: "#007ebc",
                  confirmButtonText: 'Aceptar'
                })
                location.reload();
              }
              if(data == 2){
                Swal.fire({
                  title: 'Error!',
                  text: 'La Clinica seleccionada ya esta incluida anteriormente',
                  icon: 'error',
                  confirmButtonColor: "#007ebc",
                  confirmButtonText: 'Aceptar'
                });
							return false;
              }
            }
        }) 
    });
</script>
<style>
  .swal2-container {
    z-index: 99999;
}
</style>