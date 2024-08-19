<?php  //ALTER TABLE `consultas_trat` ADD `observaciones` LONGTEXT NOT NULL COMMENT 'Indicaciones para aplicar las medicinas' AFTER `dias`;
    session_start();
	  require('../../conexion.php');
    date_default_timezone_set('America/Caracas');
    if (!isset($_SESSION['idregistro'])) {
      echo '<script language="javascript">alert("¡Error En Datos!");window.location.href="../../../login.html"; </script>';
    }
    header('Content-Type: text/html; charset=UTF-8');
    $idrg = $_SESSION['idregistro'];
    if (isset($_POST['correo1'])) {$correo1= $_POST['correo1'];}else{$correo1='';}
    if (isset($_POST['correo2'])) {$correo2= $_POST['correo2'];}else{$correo2='';}
    // Actualizo los estatus de cita culminada
    $idcita_aux= $_POST['idcita_aux'];
    /* Actualizo Estatus de la Cita, como culminada */
    $sqlupdcita="UPDATE citas SET idestatus='7' WHERE idcita='".$idcita_aux."';";
    $conexion=$mysqli->query($sqlupdcita); 
    /* Indicador de fin del registro de la consulta */
    $fechaconsulta= date('d/m/Y'); $horaconsulta= date("h:i:sa");
    $str="UPDATE consultas_med SET fechadia='".$fechaconsulta."', hora='".$horaconsulta."', fin='1'
    WHERE idcita='".$idcita_aux."'";

    if (isset($_POST['observaciones'])) {
      $observaciones= $_POST['observaciones'];
      $strupdobser=("UPDATE consultas_med SET observaciones='".$observaciones."' WHERE idregistro ='".$idrg."';");
      $conex=$mysqli->query($strupdobser);
    }else{$observaciones='';}
    /* Verifico Si Tiene Examen de Laboratorio */
    $sqlhaylab = ("SELECT a.idpaci FROM consultas_med a, examenesx b
                WHERE a.idpaci=b.idpac and a.idcita=b.idcita and b.tipo='Laboratorio' and idregistro='".$idrg."';");
    $objhaylab=$mysqli->query($sqlhaylab); 
    $rowhaylab=mysqli_num_rows($objhaylab);   //$arrhayimg = mysqli_fetch_array($objhayimg);
    //echo $arrhayimg['haydatos'];
    // Verifico si tiene Examen de Imagenologia
    $sqlhayimg = ("SELECT a.idpaci FROM consultas_med a, examenesx b
                WHERE a.idpaci=b.idpac and a.idcita=b.idcita and b.tipo='Imagenologia' and idregistro='".$idrg."';");
    $objhayimg=$mysqli->query($sqlhayimg); 
    $rowhayimg=mysqli_num_rows($objhayimg);   //$arrhayimg = mysqli_fetch_array($objhayimg);
    //echo $arrhayimg['haydatos'];
    
    // Busco el dia actual de la semana para saber cual es la clinica
     $dias= array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado"); //echo $dias[date('w')].'----' ;exit();
     $diaactual=$dias[date('w')];
    //  $sqlhist = ("SELECT * FROM consultas_med WHERE idregistro='".$idrg."'");
    // Busco datos del medico, paciente y de la consulta

    $sqlhist = ("SELECT a.idpaci, a.idcita, b.idmed, d.nrohistoria ,concat(b.nombre1,' ', b.apellido1) as nombremedico, b.rif, b.codcolemed, b.mpss, b.correo, concat(b.codarea,'-', b.telefono) as telefonolocal, a.*, concat(c.nombre1,' ', c.apellido1) as nombrepaciente, c.cedula, c.edad, a.fechadia as fechaconsulta, a.hora as horaconsulta, c.correo as correopaciente
    FROM consultas_med a, medicos b, pacientes c, historias d
    WHERE a.idmed=b.idmed and a.idpaci=c.idpaci and c.idpaci=d.idpaci and a.idregistro='".$idrg."';");
    
    $arrhist=$mysqli->query($sqlhist); 	$rowhist = mysqli_fetch_array($arrhist);
    //Para el Correo
    $cedula=$rowhist["cedula"];$nombrepaciente=$rowhist["nombrepaciente"];$correopaciente=$rowhist["correopaciente"];
    
    $sqlcita = ("SELECT fechacita FROM citas where  idcita='".$rowhist['idcita']."';");
    $objcita=$mysqli->query($sqlcita);
    $arrdia = mysqli_fetch_array($objcita);
    $ano =substr($arrdia['fechacita'],0,4);
    $mes =substr($arrdia['fechacita'],5,2);
    $dia =substr($arrdia['fechacita'],8,2);
    $fechacita =$dia.'/'.$mes.'/'.$ano;
    // Armo -nombre del PDF
    $nombrepdf=$rowhist['nombrepaciente']."-".substr($rowhist['fechaconsulta'],0,2).substr($rowhist['fechaconsulta'],3,2).substr($rowhist['fechaconsulta'],6,4)."-Informe-Medico.pdf";
    //echo $sqlhist.'--'.'<br>'.$nombrepdf;exit();
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
    $rowhayrec=mysqli_num_rows($arrhistt);    // Para verificar si tienes tratamiento

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
    //$ruta="https://paymed.dsinternacional.com/admin/pages/forms/img/";
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
                      //$especialidad = "Radiología"; //utf8_encode($rowesp["especialidad"]);
                      $especialidad = $rowesp["especialidad"];
                    $html.='-'.$especialidad; //ucwords(strtolower($especialidad));
                    }
        
        $html.='</header>
        <footer>'.ucwords(strtolower($nombrecentrosalud)).',  '.ucwords(strtolower($calleav)).' '.ucwords(strtolower($casaedif)).'<br>'.ucwords(strtolower($estado)).'-'.ucwords(strtolower($pais)).'
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
                <center><p style="font-family:cursive;font-size:21px;">INFORME MEDICO</p></center>
                <!-- -->
                <table  id="pt12" style="width:100%" >
                      <tbody>
                          <tr> 
                              <td>';
                          if($rowhist["estatura"]!='0') { // si tiene tiene valor campo estatura
                            $html.='<span style="font-weight: bold;">Estatura:</span>'.$rowhist["estatura"];
                          }
                          if($rowhist["peso"]!='0') { // si tiene tiene valor campo peso
                            $html.='<span style="font-weight: bold;"> Peso:</span>'.$rowhist["peso"];
                           } 
                      $html.='</td>
                          </tr>
                          <tr>'; 
                            if($rowhist["presion"]!='') { // si tiene tiene valor campo presion
                              $html.='<td><span style="font-weight: bold;">Presion Arterial:</span>'.$rowhist["presion"].'</td>';
                            }
                        $html.='</tr>
                          <tr>';
                            if($rowhist["fumador"]!='') { // si tiene tiene valor campo fumador
                              $html.='<td><span style="font-weight: bold;">Fuma:</span>'.$rowhist["fumador"].'</td>';
                              }
                        $html.='  </tr>
                      </tbody>
                </table>
                <div>
                  
                <table style="width:100%" cellpadding="0" >
                      <tbody>
                          <tr>
                            <td style="text-align: left"><span style="font-weight: bold;">Motivo: </span>'." ".ucwords(strtolower($rowhist["motivo"])).'</td>
                          </tr>';
                          if(!empty($rowhist['antecedentes'])){ 
                            $html.='<tr>
                                <td style="text-align: left"><span style="font-weight: bold;">Antecedentes:</span>'.ucwords(strtolower($rowhist["antecedentes"])).'</td>
                              </tr>';
                          }
                          if(!empty($rowhist['exfisico'])){ 
                          $html.='<tr>
                              <td style="text-align: left"><span style="font-weight: bold;">Examen Físico:</span>'.ucwords(strtolower($rowhist["exfisico"])).'</td>
                            </tr>';
                          }
                          $html.='<tr>
                            <td style="text-align: left"><span style="font-weight: bold;">Hallazgos y Diagnóstico:</span>'.ucfirst(strtolower($rowhist["hallazgos"])).'</td>

                          </tr>';
                          //$html.='<tr><td style="text-align: left"><span style="font-weight: bold;">Examenes de Laboratorio:</span><br>';
                          //--if(!empty($rowhist["laboratorio"] ) ) { // si tiene examenes, los busco
                            $sqlexalab = ("SELECT a.tipo , b.nombre FROM examenesx a, laboratorios b
                                          where a.idtbl=b.idlab and a.idpac='".$rowhist['idpaci']."' AND idcita='".$rowhist['idcita']."'
                                          and tipo='Laboratorio';");
                            $objexalab=$mysqli->query($sqlexalab);
                            $rowlab = $objexalab->num_rows;
                            if ($rowlab!='0') {
                              $html.='<tr><td style="text-align: left"><span style="font-weight: bold;">Examenes de Laboratorio:</span><br>';
                              while ($rowexalab = mysqli_fetch_array($objexalab)) {
                                $html.='--'.$rowexalab["nombre"].'<br>';
                              }
                              $html.=ucwords(strtolower($rowhist["laboratorio"])).'</td>
                                    </tr>';
                            }
                          //--} 
                          //$html.='<tr><td style="text-align: left"><span style="font-weight: bold;">Examenes Imagenologia:</span><br>';
                          // -if(!empty($rowhist['imagenologia'])){ 
                            $sqlexaimg = ("SELECT a.tipo , b.servicio, b.zona, b.estudio FROM examenesx a, servimage b
                                          where a.idtbl=b.idimage and a.idpac='".$rowhist['idpaci']."' AND idcita='".$rowhist['idcita']."'
                                          and tipo='Imagenologia';");
                            $objexaimg=$mysqli->query($sqlexaimg);
                            $rowimg = $objexaimg->num_rows;
                            if ($rowimg!='0') {
                              $html.='<tr><td style="text-align: left"><span style="font-weight: bold;">Examenes Imagenologia:</span><br>';
                              while ($rowexaimg = mysqli_fetch_array($objexaimg)) {
                                //$html.='--'.$rowexaimg["servicio"].'-'.$rowexaimg["zona"].'-'.$rowexaimg["estudio"].'<br>';
                                $html.='-'.$rowexaimg["servicio"].','.$rowexaimg["estudio"].'<br>';
                              }
                              $html.=ucwords(strtolower($rowhist["imagenologia"])).'</td>
                              </tr>';
                            }
                          // -}

                          if(!empty($rowhist['anatomia'])){ 
                          $html.='<tr>
                                    <td style="text-align: left"><span style="font-weight: bold;">Anatomia Patologica:</span>'.ucwords(strtolower($rowhist["anatomia"])).'</td>
                                  </tr>';
                          } 

                          if(!empty($rowhist['interconsultas'])){
                          $html.='<tr>
                                    <td style="text-align: left"><span style="font-weight: bold;">Interconsultas:</span>'.ucwords(strtolower($rowhist["interconsultas"])).'</td>
                                  </tr>';
                          } 

                          if(!empty($rowhist['otros'])){
                          $html.='<tr>
                                    <td style="text-align: left"><span style="font-weight: bold;">Otros Examenes:</span>'.ucwords(strtolower($rowhist["otros"])).'</td>
                                  </tr>';
                          }
                          $html.='<tr>
                                    <td>
                                      <span style="font-weight: bold;">Tratamiento:</span><br>';
                                        while ($rowhistt = mysqli_fetch_array($arrhistt)) {
                                          $html.='<label> -'.$rowhistt["medicamento"].' tomar: '.$rowhistt["dosis"].' cada: '.$rowhistt["horas"].' horas por: '.$rowhistt["dias"].'dias </label><br>';
                                        } 
                            $html.='</td>
                                  </tr>';
                            if ($observaciones!='') {
                            $html.='<tr>
                                    <td style="text-align: left"><span style="font-weight: bold;">observaciones:</span><br>'.$observaciones.'</td>
                                  </tr>';
                            }      
                  $html.='</tbody>
                  </table><br><br>
                <!-- -->
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
       
        // Forzar descarga del PDF 
        //$dompdf->stream($nombrepdf, [ "Attachment" => true]);
        /* new nd */
        $contenido = $dompdf->output();
        // Asignamos nombre de archivo con la función RAND()
        //$nombreDelDocumento = rand()."_hola-mundo.pdf";
        // antes $bytes = file_put_contents($nombrepdf, $contenido);
        $ruta ="descarga/";
        $bytes = file_put_contents('descarga/'.$nombrepdf, $contenido);
        //echo "salio"; exit();
        //
        if ($rowhayrec!='0') {              // Si tiene Recipe, armo el pdf
          include("gerrec.php"); 
        }
        if ($rowhaylab!='0') {              // Si tiene Examen de Laboratorio, armo el pdf
          include("gerlab.php");
        }
        if ($rowhayimg!='0') {              // Si tiene Examen de Imagenologia, armo el pdf
          include("gerimg.php");
        }
        include("sendinfmed.php");  //Envio de correo del informe medico
        
        echo '<script language="javascript">alert("¡Proceso OK!");window.location.href="rpt_citas.php";</script>';
?>
