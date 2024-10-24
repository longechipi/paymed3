<!-- MODAL PARA EL STATUS -->
<div class="modal fade" id="miModal" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Opciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL -->
<!-- <script>
    $(document).ready(function() {
        $('#change').submit(function(e) {
            e.preventDefault();
            var datos = $('#change').serialize();
            $.ajax({
                type: "POST",
                url: "../model/reg_cita/re-agendar.php",
                data: datos,
                success: function(res) {
                    if(res == 1){
                        Swal.fire({
                            title: 'Exito',
                            text: 'Cambio de Estatus Exitoso',
                            icon: 'success',
                            confirmButtonColor: "#007ebc",
                            confirmButtonText: 'Aceptar'
                        })
                        const modal = new bootstrap.Modal(document.getElementById('miModal'));
                        modal.hide();

                   }else{
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Error al Actualizar",
                        showConfirmButton: false,
                        timer: 1500
                    });
                   }
                }
            });
        });
    });
</script> -->