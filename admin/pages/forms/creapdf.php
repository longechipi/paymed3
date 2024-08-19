<?php
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    echo $dias[date('w')].'----' ;
    echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
exit();
//
    require_once "dompdf/autoload.inc.php";
    use Dompdf\Dompdf; //para incluir el namespace de la librería
     
    $dompdf = new Dompdf(); //crear el objeto de la clase Dompdf
           
    // Componer el HTML
    $html = '<h1>Hola</h1>'; //el html que necesites en formato texto, puedes incluirlo desde una vista de tu MVC
            
    // Añadir el HTML a dompdf
    $dompdf->loadHtml($html);
            
    //Establecer el tamaño de hoja en DOMPDF
    $dompdf->setPaper('A4', 'portrait');
     
    // Renderizar el PDF
    $dompdf->render();
     
    // Forzar descarga del PDF
    $dompdf->stream("mypdf.pdf", [ "Attachment" => false]);

?>
