<?php
  /*
  require('../../conexion.php');
  date_default_timezone_set('America/Caracas');
    $idrg = $_GET['idrg'];
    // Verifico si tiene datos para este documento
    $sqlhayimg = ("SELECT idregistro FROM consultas_med 
              WHERE idregistro='".$idrg."' AND codserv!='0' AND codzona!='0' AND codestudio!='0';");
    
    $objhayimg=$mysqli->query($sqlhayimg); 
    $rowcount=mysqli_num_rows($objhayimg);   //$arrhayimg = mysqli_fetch_array($objhayimg);
    
    if ($rowcount=='0') {
        echo '<script language="javascript">alert("¡Sin Informaciòn!");window.history.back(); </script>';
        exit();
    }*/
    // Busco el dia actual de la semana para saber cual es la clinica
     $dias= array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado"); //echo $dias[date('w')].'----' ;exit();
     $diaactual=$dias[date('w')];
    //  $sqlhist = ("SELECT * FROM consultas_med WHERE idregistro='".$idrg."'");
    // Busco datos del medico, paciente y de la consulta
    $sqlhist = ("SELECT a.idpaci, a.idcita, b.idmed, d.nrohistoria ,concat(b.nombre1,' ', b.apellido1) as nombremedico, b.rif, b.codcolemed, b.mpss, b.correo, concat(b.codarea,'-', b.telefono) as telefonolocal, a.*, concat(c.nombre1,' ', c.apellido1) as nombrepaciente, c.cedula, c.edad, a.fechadia as fechaconsulta, a.hora as horaconsulta
    FROM consultas_med a, medicos b, pacientes c, historias d
    WHERE a.idmed=b.idmed and a.idpaci=c.idpaci and c.idpaci=d.idpaci and a.idregistro='".$idrg."';");
    
    $arrhist=$mysqli->query($sqlhist);  $rowhist = mysqli_fetch_array($arrhist);
    // Armo -nombre del PDF
    $nombreimgpdf=$rowhist['nombrepaciente']."-".substr($rowhist['fechaconsulta'],0,2).substr($rowhist['fechaconsulta'],3,2).substr($rowhist['fechaconsulta'],6,4)."-Imagen.pdf";

    // Busco las especialidades Medicas
    $sqlesp = ("SELECT c.especialidad FROM medicos_esp a, medicos b, especialidadmed c 
                  where a.idmed=b.idmed and a.idespmed=c.idespmed and b.idmed ='".$rowhist['idmed']."';");
    $arresp=$mysqli->query($sqlesp);

    // Busco los dia que atiende y datos de Clinica donde Atiende ese dia (Pais, Estado, Municipio, Parroquia, Calle, Etc)
    $sqldias = ("SELECT c.pais, x.estado, y.municipio, z.parroquia, b.nombrecentrosalud, b.calleav, b.casaedif ,a.idclinica, a.dia, a.desde, a.hasta
                FROM horariomed a, clinicas b, paises c, estado x, municipios y, parroquias z
                where a.idclinica=b.idclinica
                AND b.idpais= c.idpais AND b.idestado=x.idestado AND b.idmunicipio = y.idmunicipio AND b.idparroquia =z.idparroquia
                AND a.idmed='".$rowhist['idmed']."';");


    $objdias=$mysqli->query($sqldias);  // $rowdias = mysqli_fetch_array($objdias);
    while ($rowdias = mysqli_fetch_array($objdias)) {
        if ($diaactual==$rowdias["dia"]) {
          //echo $rowdias['pais'].'-'.$rowdias['estado'].'-'.$rowdias['municipio'].'-'.$rowdias['parroquia'];   
          //$nombrecentrosalud=$rowdias['nombrecentrosalud'];$calleav=$rowdias['calleav'];$casaedif=$rowdias['casaedif'];
          //$pais=$rowdias['pais'];$estado=$rowdias['estado'];$municipio=$rowdias['municipio'];$parroquia=$rowdias['parroquia'];
          $idclinica=$rowdias['idclinica'];
        }   
    }
    // Busco los dias los dias que atiende y cual clinica
    //$sqldiaatiende = ("SELECT dia, desde, hasta FROM horariomed where idmed ='".$rowhist['idmed']."' AND idclinica='".$idclinica."';");
    //$objdiaatiende=$mysqli->query($sqldiaatiende);
    require('busdatoscli.php');  // Busca mas datos de la Clinica

    // busco imagenes de firma, si tiene 
   $sql = ("SELECT iddocument, idmed, imagen, quees FROM drdocument WHERE idmed='".$rowhist['idmed']."' AND quees='firma'; ");
   $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
   $firmaimg=$arr['imagen'];
   // busco imagenes de sello, si tiene 
   $sql = ("SELECT iddocument, idmed, imagen, quees FROM drdocument WHERE idmed='".$rowhist['idmed']."' AND quees='sello'; ");
   $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
   $selloimg=$arr['imagen'];

    //$sqlhistt = ("SELECT * FROM consultas_trat WHERE fechadia='".$rowhist['fechadia']."'");
    $sqlhistt = ("SELECT * FROM consultas_trat WHERE idpaci='".$rowhist['idpaci']."' AND idcita='".$rowhist['idcita']."'; ");
    $arrhistt=$mysqli->query($sqlhistt); 
    $arrhistt2=$mysqli->query($sqlhistt); 
    /* Configurando imagen para el Dompdf */
    $nombreImagen = "firma9419123.jpg";
    $nombresello = "selloejemplo.jpg";
    
    //$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
    /* img estaticas, prueba
    $nombreImagen64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
    $nombresello64 = "data:image/png;base64," . base64_encode(file_get_contents($nombresello));
    */
    $nombreImagen64 = "data:image/png;base64," . base64_encode(file_get_contents($firmaimg));
    $nombresello64 = "data:image/png;base64," . base64_encode(file_get_contents($selloimg));
    
    //$ruta="C:/xampp/htdocs/paymed/admin/pages/forms/img/";
    $ruta="https://paymed.dsinternacional.com/admin/pages/forms/img/";
    //echo $ruta.$nombresello; exit();
    

    //echo $ruta.$imagenBase64; exit();
    // Librerias de PDF
    
    use Dompdf\Dompdf; //para incluir el namespace de la librería  
    use Dompdf\Options; 
    require_once "dompdf/autoload.inc.php";
    $options = new Options();
    $options->set('chroot', realpath(''));
    //$dompdf = new Dompdf(); //crear el objeto de la clase Dompdf
    $dompdf = new Dompdf($options); // new objet de la clase Dompdf for img

        $html='<!DOCTYPE html>
        <html>
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


      <style>

table, th, td {
  border: 1px solid white;
  border-collapse: collapse;
}
tr, th, td {
   padding:2px

}
          /** Define the margins of your page **/
          @page {
          margin: 100px 25px;
          }

          header {
          position: fixed;
          top: -90px;
          left: 0px;
          right: 0px;
          height: 49px;
          /** Extra personal styles **/
          text-align: center;

          border-style: solid;
          border-color: #bbbbbb; /* grey */
           border-radius: 18px;
           padding: 7px;
          }

          footer {
          position: fixed;
          bottom: -60px;
          left: 0px;
          right: 0px;
          height: 72px;


          /** Extra personal styles **/
          text-align: center;

           border-style: solid;
           border-color: #bbbbbb; /* grey */
           border-radius: 18px;
           padding: 7px;
          
          }
      </style>

        </head>
        <!--body class="hold-transition sidebar-mini"-->
        <body>
        <!-- Define header and footer blocks before your content -->
        <header>
          Dr(a):'.$rowhist["nombremedico"].'<br>  
                    Especialidades:';
                     while ($rowesp = mysqli_fetch_array($arresp)) {
                    $html.='-'.$rowesp["especialidad"];
                    }

        $html.='</header>
        <footer>'.ucwords(strtolower($nombrecentrosalud)).',  '.ucwords(strtolower($calleav)).' '.ucwords(strtolower($casaedif)) .'<br>'.ucwords(strtolower($estado)).'-'.ucwords(strtolower($pais)).'
        .Consultorio:'.$consultorio.' Piso:'.$piso.' Telf.: '.$telefono1.'-'.$telefono2.'<br>
        HORARIO DE ATENCION: ';
            while ($rowdia = mysqli_fetch_array($objdiaatiende)) {
              $horadesde=substr($rowdia["desde"],0,5);$horahasta=substr($rowdia["hasta"],0,5);
              $html.='-'.$rowdia["dia"];
            }
            $horadesde_time = strtotime($horadesde); 
            $horadesde_f = date('h:i A', $horadesde_time);
            $horahasta_time = strtotime($horahasta); 
            $horahasta_f = date('h:i A', $horahasta_time);
            //echo date('h:i:s A', $date); 
            // Ori $html.='<br>Desde:'.$horadesde;$html.='--'.$horahasta;
            $html.='<br>Desde:'. $horadesde_f;
            $html.='--'.$horahasta_f;

        $html.=' </footer>
        <div class="wrapper">
          <div class="content-wrapper">
          <section class="content">
              <!--div class="card"-->
              <div class="container-fluid">
                <div>
                <table style="width:100%" >
                      <tbody>
                          <tr> 
                              <td style="text-align: left"><span style="font-size:17px;font-weight: bold">Nombre:</span>'.'  '.$rowhist["nombrepaciente"].'<br>
                              <span style="font-size:17px;font-weight: bold">Cédula:</span>'.'  '.$rowhist["cedula"].'<br>
                              <span style="font-size:17px;font-weight: bold">Edad:</span>'.'  '.$rowhist["edad"].'
                              </td>
                              <td style="text-align: right"><span style="font-size:17px;font-weight: bold">Fecha:</span>'.'  '.$rowhist["fechadia"].'<br>
                              <span style="font-size:17px;font-weight: bold">Hora:</span>'.'  '.$rowhist["horaconsulta"].'<br>
                              <span style="font-size:17px;font-weight: bold">Historia N#:</span>'.'  '.$rowhist["nrohistoria"].'
                              </td>
                          </tr>
                      </tbody>
                </table><hr>
                  
                </div>
                <!--div class="card-body p-0"-->
                <div>
                <div>
                <center><p style="font-family:cursive;font-size:21px;">Solicitud de imagenología</p></center>
                
                <table style="width:100%" cellpadding="0" >
                      <tbody>';

                          $html.='<tr>
                            <td style="text-align: left">
                            <span style="font-weight: bold;">Examenes Imagenologia:</span><br>';
                          //if(!empty($rowhist['imagenologia'])){ No va, ya se valido en gerinfmed.php
                            $sqlexaimg = ("SELECT a.tipo , b.servicio, b.zona, b.estudio FROM examenesx a, servimage b
                                          where a.idtbl=b.idimage and a.idpac='".$rowhist['idpaci']."' AND idcita='".$rowhist['idcita']."'
                                          and tipo='Imagenologia';");
                            $objexaimg=$mysqli->query($sqlexaimg);
                            while ($rowexaimg = mysqli_fetch_array($objexaimg)) {
                              //$html.='--'.$rowexaimg["servicio"].'-'.$rowexaimg["zona"].'-'.$rowexaimg["estudio"].'<br>';
                              $html.='-'.$rowexaimg["servicio"].','.$rowexaimg["estudio"].'<br>';
                            }
                            $html.=ucwords(strtolower($rowhist["imagenologia"])).'</td>
                                  </tr>';
                          //} 
                            $html.='
                                  <tr><td></td></tr>
                      </tbody>
                  </table><br><br>

                  <table style="width:100%" >
                      <tbody>
                          <tr>
                              <td style="text-align: right">
                                <img src="'.$nombreImagen64.' " alt="Firma Medico" width="110" height="77"><br>
                                ___________________
                                
                                <p style="font-family:cursive;font-size:14px;">Dr(a).'.$rowhist["nombremedico"].'<br>
                                <span><p style="font-family:cursive;font-size:9px;">C.M.:'.$rowhist["codcolemed"].' / MPSS :'.$rowhist["mpss"].'</span>
                                </p>
                              </td>
                              <td style="text-align: left">
                                <img src="'.$nombresello64.' " alt="Sello Medico" width="120" height="85">
                              </td>
                      </tbody>
                  </table>
                    
                  </div>
                  
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
        
        $contenido = $dompdf->output();
        
        $bytes = file_put_contents('descarga/'.$nombreimgpdf, $contenido);
        // Forzar descarga del PDF
        //$dompdf->stream($nombrepdf, [ "Attachment" => true]);
?>
