<header>
    <script src="../../../libs/sweetalert/sweetalert.js"></script>
</header>

<?php 
require('../../../conf/conexion.php');
$idmed = $_POST['idmed'];
$codcolemed = $_POST['codcolemed'];
$mpsscod = $_POST['mpsscod'];
$idlogin = $_POST['idlogin'];

$a = "SELECT nrodoc FROM medicos WHERE idmed='$idmed'";
$ares=$mysqli->query($a);
$datos = $ares->fetch_assoc();
$nrodoc = $datos['nrodoc'];
$date = date('Y-m-d');

$b ="UPDATE medicos SET codcolemed='$codcolemed', mpss='$mpsscod' WHERE idmed='$idmed'";
$bres=$mysqli->query($b); 

//--------- Carga de Archivo para la Cedula --------//
if (isset($_FILES['imagen'])) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
    $allowedPdfTypes = ['application/pdf'];
    if (in_array($_FILES['imagen']['type'], $allowedImageTypes) || in_array($_FILES['imagen']['type'], $allowedPdfTypes)) {
        $fileName = $_FILES['imagen']['name'];
        $sourcePath = $_FILES['imagen']['tmp_name'];
        $targetPath = "../../../upload/doc_medicos/" . "CI-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

        if (move_uploaded_file($sourcePath, $targetPath)) {
            $imagen = "CI-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
            $validar = true;
        }
        $c = "INSERT INTO drdocument(idmed, imagen, quees) VALUES('$idmed', '$imagen','Cedula');";
        $cres = $mysqli->query($c);
    } else {
        $validar = false;
    }
}

//--------- Carga de Archivo para el Rif --------//
if (isset($_FILES['imagen1'])) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
    $allowedPdfTypes = ['application/pdf'];
    if (in_array($_FILES['imagen1']['type'], $allowedImageTypes) || in_array($_FILES['imagen1']['type'], $allowedPdfTypes)) {
        $fileName = $_FILES['imagen1']['name'];
        $sourcePath = $_FILES['imagen1']['tmp_name'];
        $targetPath = "../../../upload/doc_medicos/" . "RIF-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

        if (move_uploaded_file($sourcePath, $targetPath)) {
            $imagen = "RIF-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
            $validar = true;
        }
        $d = "INSERT INTO drdocument(idmed, imagen, quees) VALUES('$idmed', '$imagen', 'RIF');";
        $dres = $mysqli->query($d);
    } else {
        $validar = false;
    }
}

//--------- Carga de Archivo para Colegio Medico--------//
if (isset($_FILES['imagen2'])) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
    $allowedPdfTypes = ['application/pdf'];
    if (in_array($_FILES['imagen2']['type'], $allowedImageTypes) || in_array($_FILES['imagen2']['type'], $allowedPdfTypes)) {
        $fileName = $_FILES['imagen2']['name'];
        $sourcePath = $_FILES['imagen2']['tmp_name'];
        $targetPath = "../../../upload/doc_medicos/" . "CM-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

        if (move_uploaded_file($sourcePath, $targetPath)) {
            $imagen = "CM-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
            $validar = true;
        }
        $e = "INSERT INTO drdocument(idmed, imagen, quees) VALUES('$idmed', '$imagen', 'CM');";
        $eres = $mysqli->query($e);
    } else {
        $validar = false;
    }
}

//--------- Carga de Archivo para el MPSS--------//
if (isset($_FILES['imagen3'])) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
    $allowedPdfTypes = ['application/pdf'];
    if (in_array($_FILES['imagen3']['type'], $allowedImageTypes) || in_array($_FILES['imagen3']['type'], $allowedPdfTypes)) {
        $fileName = $_FILES['imagen3']['name'];
        $sourcePath = $_FILES['imagen3']['tmp_name'];
        $targetPath = "../../../upload/doc_medicos/" . "MPSS-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

        if (move_uploaded_file($sourcePath, $targetPath)) {
            $imagen = "MPSS-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
            $validar = true;
        }
        $f = "INSERT INTO drdocument(idmed, imagen, quees) VALUES('$idmed', '$imagen', 'MPSS');";
        $fres = $mysqli->query($f);
    } else {
        $validar = false;
    }
}

if($idlogin ==1){
    echo '<script>
    Swal.fire({
        title: "Informacion Actualizada!",
        text: "Documentos e Información actualizados con Exito",
        icon: "success",
        confirmButtonColor: "#007ebc",
        confirmButtonText: "Aceptar"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "../../../html/rpt_med.php";
        }
    });
</script>';
}else{
    echo '<script>
        Swal.fire({
            title: "Informacion Actualizada!",
            text: "Documentos e Información actualizados con Exito",
            icon: "success",
            confirmButtonColor: "#007ebc",
            confirmButtonText: "Aceptar"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../../../html/perfil.php";
            }
        });
    </script>';
}

