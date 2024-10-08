<header>
    <script src="../../../libs/sweetalert/sweetalert.js"></script>
</header>
<?php 
require('../../../conf/conexion.php');
$idmed = $_POST['idmed'];
$date = date('Y-m-d');
$nrodoc = $_POST['nrodoc'];

//--------- Carga de Archivo para la Firma --------//
if (isset($_FILES['imagen'])) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
    $allowedPdfTypes = ['application/pdf'];
    if (in_array($_FILES['imagen']['type'], $allowedImageTypes) || in_array($_FILES['imagen']['type'], $allowedPdfTypes)) {
        $fileName = $_FILES['imagen']['name'];
        $sourcePath = $_FILES['imagen']['tmp_name'];
        $targetPath = "../../../upload/documentos_medicos/" . "Firma-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

        if (move_uploaded_file($sourcePath, $targetPath)) {
            $imagen = "Firma-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
            $validar = true;
        }
        $c = "INSERT INTO drdocument(idmed, imagen, quees) VALUES('$idmed', '$imagen','firma');";
        $cres = $mysqli->query($c);
    } else {
        $validar = false;
    }
}

//--------- Carga de Archivo para el Sello --------//
if (isset($_FILES['imagen1'])) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
    $allowedPdfTypes = ['application/pdf'];
    if (in_array($_FILES['imagen1']['type'], $allowedImageTypes) || in_array($_FILES['imagen1']['type'], $allowedPdfTypes)) {
        $fileName = $_FILES['imagen1']['name'];
        $sourcePath = $_FILES['imagen1']['tmp_name'];
        $targetPath = "../../../upload/documentos_medicos/" . "Sello-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

        if (move_uploaded_file($sourcePath, $targetPath)) {
            $imagen = "Sello-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
            $validar = true;
        }
        $d = "INSERT INTO drdocument(idmed, imagen, quees) VALUES('$idmed', '$imagen','sello');";
        $dres = $mysqli->query($d);
        
    } else {
        $validar = false;
    }
}
if($validar == true){
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
} else {
echo '<script>
        Swal.fire({
            title: "Error",
            text: "ocurrio un Error al Cargar los Documentos",
            icon: "error",
            confirmButtonColor: "#007ebc",
            confirmButtonText: "Aceptar"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../../../html/rpt_med.php";
            }
        });
    </script>';
}
?>

            