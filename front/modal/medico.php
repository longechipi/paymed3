<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">PRE-Registro Medico</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¡Hola! ¡Qué gusto tenerte aquí! Para comenzar a disfrutar de todas las ventajas de nuestro sistema, solo necesitamos verificar tu dirección de correo electrónico. Por favor, ingrésala en el campo correspondiente. ¡Empecemos juntos esta aventura!</p>
        <form id="form">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        $('#form').submit(function(e){
            e.preventDefault();
            const correo = $('#email').val();
            if(correo === ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El campo de Correo electronico no puede estar vacio',
                })
            }else{
                $.ajax({
                    url: '../model/front/valida_email.php',
                    type: 'POST',
                    data: {correo: correo},
                    success: function(response){
                        if(response === '1'){
                            Swal.fire({
                                icon: 'success',
                                title: '¡Enhorabuena!',
                                text: 'Toda la Información será enviada al correo que proporcionaste',
                            }).then(function(){
                                window.location.href = 'index.php';
                            })
                        }else if(response === '2'){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'El correo electrónico ya está registrado en nuestro sistema',
                            })
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrio un error inesperado en nuestro sistema',
                            })
                        }
                    }
                })
            }
        })
    })
</script>