<?php 
require('../../../conf/conexion.php');
$id = $_POST['id'];
$idmed = $_POST['idmed'];

$sql = "SELECT idconvafi FROM convafixmedico WHERE idservaf='$id' AND idmed='$idmed'; ";
$objesp=$mysqli->query($sql);
$rowcounti=mysqli_num_rows($objesp);

if ($rowcounti>0) {
    $sql="DELETE FROM convafixmedico WHERE idservaf='$id' AND idmed='$idmed';";
}else{
    $sql = "INSERT INTO convafixmedico(idmed, idservaf, idestatus) VALUES ('$idmed','$id', '1')";
}
 $conex=$mysqli->query($sql);