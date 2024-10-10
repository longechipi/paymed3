<header>
    <script src="../../libs/sweetalert/sweetalert.js"></script>
</header>

<?php 
$correo = $_POST['correo'];

function limpiarCorreo($correo) {
    $correo = trim($correo);
    $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
    return $correo;
}
$correoLimpio = limpiarCorreo($correo);

if (!filter_var($correoLimpio, FILTER_VALIDATE_EMAIL)) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text:"¡El correo no es correcto!",
            confirmButtonText: "Volver",
            confirmButtonColor: "#005e43",
            }).then(function() {
                window.location.href = "../../index.html";
            });
        </script>';
} else {
  //-------- Recuperacion del Correo ----------//
  require_once('../../conf/conexion.php');
  $fecha  =date('d/m/Y');
  $a="SELECT correo FROM loginn WHERE correo='$correoLimpio'";
  $ares = $mysqli->query($a);
    if ($ares->num_rows > 0) {
        //------- Existe el Correo -------//
        $clave_tmp = mt_rand(10000000, 99999999);
        $b="UPDATE loginn SET clave = '$clave_tmp' WHERE correo='$correoLimpio'";
        $bres = $mysqli->query($b);
        if ($bres) {
            //-------- Si funciona envia Correo -------//
            include('../../mail/recupera_pass.php');
            echo '<script>
                Swal.fire({
                    title: "Correo Enviado",
                    text: "Se envio por correo su Clave Temporal",
                    icon: "success",
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: "Aceptar",
                }).then(function() {
                        window.location.href = "../../index.html";
                    });
                </script>';
        }else{
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text:"Ocurrio un error al Actualizar la clave Temporal, comunicarse con Sistemas",
                    confirmButtonText: "Volver",
                    confirmButtonColor: "#005e43",
                    }).then(function() {
                        window.location.href = "../../index.html";
                    });
                </script>';
        }
    }else{
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text:"¡El correo no existe en nuestro Sistema!",
                confirmButtonText: "Volver",
                confirmButtonColor: "#005e43",
                }).then(function() {
                    window.location.href = "../../index.html";
                });
            </script>';
    }
  
}


?>