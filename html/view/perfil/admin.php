<?php 
$a ="SELECT * FROM loginn WHERE idlogin = $idlogin";
$ares = $mysqli->query($a);
$row = $ares->fetch_array();
?>
<style>
    /* Puedes personalizar los estilos según tus preferencias */
.fa-eye {
    cursor: pointer;
}
</style>
<div class="row">
<form id="upd_datos">
    <input type="text" name="idlogin" id="idlogin" value="<?php echo $idlogin; ?>" hidden>
    <div class="row"> <!--INICIO ROW 1 -->
        <div class="divider">
            <div class="divider-text">Datos de Principales</div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="apellidos">Apellidos: </label>
                <input type="text" name="apellidos" id="apellidos" value="<?php echo $row['apellidos']; ?>" class="form-control" style="text-transform:uppercase;" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122)) event.returnValue = false;" required />
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="form-group">
                <label for="nombres">Nombres </label>
                <input type="text" name="nombres" id="nombres" value="<?php echo $row['nombres']; ?>" class="form-control" style="text-transform:uppercase;" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122)) event.returnValue = false;" required/>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="form-group">
                <label for="cedula">Cedula </label>
                <input type="text" name="cedula" id="cedula" value="<?php echo $row['cedula']; ?>" class="form-control" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required />
            </div>
        </div>

        <div class="col-md-3 mb-2">
            <div class="form-group">
                <label for="telf">Teléfono </label>
                <input type="text" name="telf" id="telf" value="<?php echo $row['telefono']; ?>" class="form-control" style="text-transform:uppercase;"  onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required/>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" name="correo" id="correo" class="form-control" value="<?php echo $row['correo']; ?>" readonly>
                <small>Por razones de seguridad el correo no puede cambiarse</small>
            </div>
        </div>

        <div class="col-md-2">
    <div class="form-group">
        <label for="rif">Contraseña</label>
        <div class="input-group">
            <input type="password" name="clave" id="clave" class="form-control" value="<?php echo $row['clave']; ?>">
            <div class="input-group-append">
                <span class="input-group-text" id="togglePassword">
                    <i class="fi fi-rr-eye"></i>
                </span>
            </div>
        </div>

    </div>
</div>

<div class="col-md-3 mb-3">
    <div class="form-group">
        <label for="rif">Repetir Contraseña</label>
        <div class="input-group">
            <input type="password" name="clave2" id="clave2" class="form-control" value="<?php echo $row['clave']; ?>">
            <div class="input-group-append">
                <span class="input-group-text" id="togglePassword2">
                    <i class="fi fi-rr-eye"></i>
                </span>
            </div>
        </div>
    </div>
</div>
    </div> <!--FIN ROW 1 -->
    <div class="text-center mt-6">
        <button type="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> GUARDAR</button>
        <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
    </div>
</form>
</div>
<script>


$(document).ready(function() {
    $("#togglePassword").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).parent().prev()[0]);
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $("#togglePassword2").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).parent().prev()[0]);   

        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    $("#upd_datos").submit(function(e) {
        e.preventDefault();
        const idlogin = $("#idlogin").val();
        const clave = $("#clave").val();
        const clave2 = $("#clave2").val();
        if(clave != clave2){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Las contraseñas no coinciden',
                confirmButtonColor: "#007ebc",
                confirmButtonText: "Aceptar"
            });
            return false;
        }
        $.ajax({
            url: "../model/perfil/admin/act_datos.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(data) {
                console.log(data)
                if (data == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Datos Actualizados',
                        confirmButtonColor: "#007ebc",
                        confirmButtonText: "Aceptar"
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrio un Error al actualizar su Contraseña',
                        confirmButtonColor: "#007ebc",
                        confirmButtonText: "Aceptar"
                    });
                }
            }
        });
    });
});


    
</script>