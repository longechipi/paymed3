<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <?php 
                $idasist=$_GET['gp1'];
                $sql = ("SELECT idasist, idlogin, nrodoc, apellidos, nombres, movil, correo, cargo, tpasist, idestatus 
                FROM asistentes	WHERE idasist='$idasist'"); 	
                $obj = $mysqli->query($sql); $row = mysqli_fetch_array($obj);
                $idlogin1  =$row['idlogin'];
                $apellidos =$row['apellidos'];
                $nombres 	 =$row['nombres'];
                $fullname =$apellidos.', '.$nombres;
                $nrodoc 	 =$row['nrodoc'];
                $correo 	 =$row['correo'];
                $movil 		 =$row['movil'];
                $tpasist 	 =$row['tpasist'];
                $nombrecargo 	=$row['cargo'];
                $idestatus 	=$row['idestatus'];
                if ($idestatus=='1') {$estatus='Activo';}else{$estatus='Inactivo';}
                ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Editando Asistente: <?php echo $fullname; ?></h5>
                    <form id="updcuenta">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="apellidos">Apellidos: </label>
                                <input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>"  class="form-control mb-3" style="text-transform:uppercase;" onkeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122)) event.returnValue = false;">
                                <input type="text" name="idasis" id="idasis" class="form-control" value="<?php echo $idasist; ?>" hidden>
                                <input type="text" name="idlogin" id="idlogin" class="form-control" value="<?php echo $idlogin1; ?>" hidden>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nombres">Nombres: </label>
                                    <input type="text" name="nombres" id="nombres" value="<?php echo $nombres; ?>"  class="form-control" style="text-transform:uppercase;" onkeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122)) event.returnValue = false;" >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nrodoc">Cedula:</label>
                                    <input type="text" name="nrodoc" id="nrodoc" value="<?php echo $nrodoc; ?>" maxlength="8" minlength="7" class="form-control"
                                    onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nombrecargo">Cargo:</label>
                                    <input type="text" name="nombrecargo"  value="<?php echo $nombrecargo;?>" class="form-control mb-3" readonly>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="movil">Movil:</label>
                                    <input type="text" name="movil" id="movil" value="<?php echo $movil;?>" maxlength="11" minlength="11" class="form-control mb-3"
                                    onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="correo">Correo:</label>
                                    <input type="email" name="correo"  value="<?php echo $correo;?>" id="correo" class="form-control" readonly>
                                    <small>Por Razones de Seguridad, el correo no puede cambiarse</small>
                                </div>
                            </div>	



                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="tpasist">Estatus:</label>
                                    <select class="form-select mb-3" id="idestatus" name="idestatus" >
                                        <option value="<?php echo $idestatus;?>"><?php echo $estatus;?></option>
                                        <?php if ($idestatus != 1): ?>
                                            <option value="1">Activo</option>
                                        <?php endif; ?>
                                        <option value="2">Inactivo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
                            <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
                            </div>
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
$(document).ready(function(){
    $('#updcuenta').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/reg_asisten/updasist.php",
        data: $("#updcuenta").serialize(),
        success: function(data){
            console.log(data)
            if(data == 1){
                Swal.fire({
                    title: 'Actualización Exitosa!',
                    text: 'Se Actualizo correctamente el Asistente',
                    icon: 'success',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "rpt_asixmed.php";
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Actualizar el Asistente',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        }
    })
})
})
</script>

</body>
</html>