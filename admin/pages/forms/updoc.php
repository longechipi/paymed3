<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');

    $idmed=$_POST['idmed'];
    $sql = ("SELECT CONCAT(apellido1,' ', nombre1) AS nombre, codcolemed, mpss, nrodoc FROM medicos WHERE idmed='".$idmed."'; ");
    $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
    //$nombre=$arr['nombre'];
    $codcolemed=$_POST['codcolemed'];
    $mpsscod=$_POST['mpsscod'];
    $nrodoc=$arr['nrodoc'];
    $str="UPDATE medicos SET codcolemed='".$codcolemed."', mpss='".$mpsscod."' WHERE idmed='".$idmed."' ;";
    $conexion=$mysqli->query($str);
	 // cedula
    if (isset($_FILES['imagen'])){

        if ($_FILES['imagen']['type']=='image/png' || $_FILES['imagen']['type']=='application/pdf'){
        //Subimos el fichero al servidor
            $fileName = $_FILES['imagen']['name'];
            $sourcePath = $_FILES['imagen']['tmp_name'];
            //$targetPath = "drdocument/".$fileName;
            $targetPath = "drdocument/"."CI".$nrodoc.'.pdf';
            if(move_uploaded_file($sourcePath,$targetPath)){
              // Ori $imagen = $fileName;
              $imagen = "CI".$nrodoc.'.pdf';
              $validar=true;
            }
            $str="INSERT INTO drdocument(iddocument, idmed, imagen) VALUES(null, '".$idmed."','".$imagen."');";
            $conexion=$mysqli->query($str);
        }else{ $validar=false;
      }
    }
    // Rif
    if (isset($_FILES['imagen1'])){
        if ($_FILES['imagen1']['type']=='image/png' || $_FILES['imagen1']['type']=='application/pdf'){
        //Subimos el fichero al servidor
            $fileName = $_FILES['imagen1']['name'];
            $sourcePath = $_FILES['imagen1']['tmp_name'];
            //$targetPath = "drdocument/".$fileName;
            $targetPath = "drdocument/"."RIF".$nrodoc.'.pdf';
            if(move_uploaded_file($sourcePath,$targetPath)){
              //$imagen = $fileName;
              $imagen = "RIF".$nrodoc.'.pdf';;
              $validar=true;
            }
            $str="INSERT INTO drdocument(iddocument, idmed, imagen) VALUES(null, '".$idmed."','".$imagen."');";
            $conexion=$mysqli->query($str);
        }else{ $validar=false;
      }
    }
    // Cod Colegio Medico
    if (isset($_FILES['imagen2'])){
        if ($_FILES['imagen2']['type']=='image/png' || $_FILES['imagen2']['type']=='application/pdf'){
        //Subimos el fichero al servidor
            $fileName = $_FILES['imagen2']['name'];
            $sourcePath = $_FILES['imagen2']['tmp_name'];
            //$targetPath = "drdocument/".$fileName;
            $targetPath = "drdocument/"."CM".$nrodoc.'.pdf';
            if(move_uploaded_file($sourcePath,$targetPath)){
              //$imagen = $fileName;
              $imagen = "CM".$nrodoc.'.pdf';
              $validar=true;
            }
            $str="INSERT INTO drdocument(iddocument, idmed, imagen) VALUES(null, '".$idmed."','".$imagen."');";
            $conexion=$mysqli->query($str);
        }else{ $validar=false;
      }
    }
    // mpss
    if (isset($_FILES['imagen3'])){
        if ($_FILES['imagen3']['type']=='image/png' || $_FILES['imagen3']['type']=='application/pdf'){
        //Subimos el fichero al servidor
            $fileName = $_FILES['imagen3']['name'];
            $sourcePath = $_FILES['imagen3']['tmp_name'];
            $targetPath = "drdocument/".$fileName;
            $targetPath = "drdocument/"."MPSS".$nrodoc.'.pdf';
            if(move_uploaded_file($sourcePath,$targetPath)){
              //$imagen = $fileName;
              $imagen = "MPSS".$nrodoc.'.pdf';
              $validar=true;
            }
            $str="INSERT INTO drdocument(iddocument, idmed, imagen) VALUES(null, '".$idmed."','".$imagen."');";
            $conexion=$mysqli->query($str);
        }else{ $validar=false;
      }
    }
    //unset($_FILES['imagen']);
    
  echo '<script language="javascript">window.location.href="adddoc.php?id='.$idmed.'"; </script>'; 
  // end Submit
?>