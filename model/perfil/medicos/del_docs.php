<?php 
require('../../../conf/conexion.php');
$id = $_POST['id'];
$idmed = $_POST['idmed'];
$a = "SELECT imagen FROM drdocument WHERE iddocument = $id AND idmed = $idmed";
$result = $mysqli->query($a);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ruta_imagen = $row['imagen'];
    unlink('../../../upload/doc_medicos/' . $ruta_imagen);
    $a = "DELETE FROM drdocument WHERE iddocument = $id AND idmed = $idmed";
    $ares = $mysqli->query($a);
    if ($ares) {
        echo '1';
    } else {
        echo '2';
    }
} else {
    echo '3';
}