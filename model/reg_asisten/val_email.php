<?php 
require('../../conf/conexion.php');
$correo =$_POST['correo'];
$sqlasist = "SELECT nrodoc, apellidos, nombres, movil, correo, cargo, tpasist FROM asistentes  WHERE correo='".$correo."';";
$objasist=$mysqli->query($sqlasist); $arrasist=$objasist->fetch_array(); 
if(isset($arrasist[0])){ // Si Existe Asistente
    $nrodoc		=$arrasist['nrodoc'];
    $apellidos	=$arrasist['apellidos'];
    $nombres	=$arrasist['nombres'];
    $movil		=$arrasist['movil'];
    $cargo		=$arrasist['cargo'];
    $tpasist	=$arrasist['tpasist'];
    echo $nrodoc.'|'.$apellidos.'|'.$nombres.'|'.$movil.'|'.$cargo.'|'.$tpasist; exit();
} 
/* busco Login a ver si tiene registro <> Asistente  */
$sqllogin = ("SELECT count(*) as hay FROM loginn  WHERE correo='".$correo."' and cargo not like '%Asistente%';");
$objlogin=$mysqli->query($sqllogin); $arrlogin=$objlogin->fetch_array(); $hay=$arrlogin[0];
if ($hay!='0') { 
    echo '99'; exit();	
}
echo '1';

?>