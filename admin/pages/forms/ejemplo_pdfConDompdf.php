<?php
	require('../../conexion.php');
  date_default_timezone_set('America/Caracas');
   // $idrg = $_GET['idrg'];
    // Busco datos del medico, paciente y de la consulta
    $sqlhist = ("SELECT * FROM  pacientes  WHERE idpaci ='1';");
    $arrhist=$mysqli->query($sqlhist); 	$rowhist = mysqli_fetch_array($arrhist);

    // Librerias de PDF
    require_once "dompdf/autoload.inc.php";
    use Dompdf\Dompdf; //para incluir el namespace de la librería   
    $dompdf = new Dompdf(); //crear el objeto de la clase Dompdf

        $html='<!DOCTYPE html>
        <html>
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        </head>
        <!--body class="hold-transition sidebar-mini"-->
        <body>
        <div class="wrapper">
          <div class="content-wrapper">

          <section class="content">
              

              <div class="card">
                <div  class="card-header">
                  <h3 class="card-title">Nombre:&nbsp;<span style="font-weight:italic;">'.$rowhist["nombre1"].'</span>&nbsp;&nbsp;&nbsp;Cédula:&nbsp;&nbsp;<span style="font-weight:italic;">'.$rowhist["cedula"].'</span>&nbsp;&nbsp;&nbsp;Edad:&nbsp;<span style="font-weight:italic;">'.$rowhist["edad"].'</span> </span>&nbsp;&nbsp;Fecha:&nbsp;<span style="font-weight:italic;">'.$rowhist["fecreg"].'</span></h3><hr>
                </div>
                <!--div class="card-body p-0"-->
                <div>
                
                <div>
                </div>
                
              </div> 

            </section>
          </div>
          
        </div>

        </body>
        </html>';
        //echo $html;
        // Genero PDF
             
        // Componer el HTML
        //$html = '<h1>Hola</h1>'; //el html que necesites en formato texto, puedes incluirlo desde una vista de tu MVC
              
        // Añadir el HTML a dompdf
        $dompdf->loadHtml($html);
              
        //Establecer el tamaño de hoja en DOMPDF
        $dompdf->setPaper('A4', 'portrait');
       
        // Renderizar el PDF
        $dompdf->render();
       
        // Forzar descarga del PDF
        $dompdf->stream("mypdf.pdf", [ "Attachment" => true]);
?>
