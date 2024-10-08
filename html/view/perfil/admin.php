<?php 
$a ="SELECT * FROM loginn WHERE idlogin = $idlogin";
$ares = $mysqli->query($a);
$row = $ares->fetch_array();
?>
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
                <input type="email" name="correo" id="correo" class="form-control" value="<?php echo $row['correo']; ?>">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="rif">Contraseña</label>
                <input type="password" name="clave" id="clave" class="form-control" value="<?php echo $row['clave']; ?>">
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="form-group">
                <label for="rif">Repetir Contraseña</label>
                <input type="password" name="clave2" id="clave2" class="form-control" value="<?php echo $row['clave']; ?>">
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
    $("#upd_datos").submit(function(e) {
        e.preventDefault();
        const idlogin = $("#idlogin").val();
        console.log(idlogin)
        //var formData = new FormData($("#upd_datos")[0]);
        // $.ajax({
        //     url: "php/update/update_datos.php",
        //     type: "POST",
        //     data: formData,
        //     contentType: false,
        //     processData: false,
        //     success: function(data) {
        //         if (data == 1) {
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: 'Datos Actualizados',
        //                 showConfirmButton: false,
        //                 timer: 1500
        //             });
        //             setTimeout(function() {
        //                 window.location.href = "?pag=perfil";
        //             }, 1500);
        //         } else {
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'Oops...',
        //                 text: 'Error al actualizar los datos'
        //             });
        //         }
        //     }
        // });
    });
</script>