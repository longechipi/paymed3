<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('admin/conexion.php');

	require ('PHPMailer-master/src/Exception.php');
	require ('PHPMailer-master/src/PHPMailer.php');
	require ('PHPMailer-master/src/SMTP.php');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	$mail = new PHPMailer(true);

	if(!$_POST) exit;

	// Email verification, do not edit.
	function isEmail($email_booking) {
		return(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$email_booking ));
	}	
	
		/*Asigno variables*/
      $q_nacion     = $_POST['q_nacion'];
		$q_nced       = $q_nacion.''.$_POST['q_nced'];
		$q_fname      = $_POST['q_fname'];
		$q_lname      = $_POST['q_lname'];
		$q_email      = $_POST['q_email'];
      $q_ccv_user   = $_POST['q_ccv_user'];
      $q_ccv        = $_POST['q_ccv'];
      $q_telefonia  = $_POST['q_telefonia'];
		$q_phone      = $q_telefonia.''.$_POST['q_phone'];
		$full         = $q_fname.' '.$q_lname;

   if($q_ccv_user!=$q_ccv){
      echo '<script language="javascript">
              alert("¡El código que introdujo es INCORRECTO!");
              window.location.href="doctors.php?ccv='.$q_ccv.'"; </script>';}

      $sqlvalced = ("SELECT COUNT(nrodoc) from medicos WHERE nrodoc='".$q_nced."'");
         $objvalced=$mysqli->query($sqlvalced); $arrvalced=$objvalced->fetch_array();  
            $siesta=$arrvalced[0];

   if($siesta>0){
      echo '<script language="javascript">
              alert("¡El numero de documento que intenta registrar, YA EXISTE!");
              window.location.href="doctors.php?ccv='.$q_ccv.'"; </script>';}
   else{

      $str="INSERT INTO loginn (nombres,apellidos,fullname,cedula,correo, cargo, clave,privilegios,estatus) VALUES ('".strtoupper($q_fname)."','".strtoupper($q_lname)."','".strtoupper($full)."','".strtoupper($q_nced)."','".strtolower($q_email)."','Medico','123','2','I')";
         $conexion=$mysqli->query($str);

      $sqllast = ("SELECT max(idlogin) from loginn;");
         $objlast=$mysqli->query($sqllast); $arrlast=$objlast->fetch_array();  
            $idlogin=$arrlast[0];

      $str="INSERT INTO medicos (idlogin,nrodoc,nombre1,apellido1,telefono,correo,idestatus) VALUES ('".$idlogin."','".strtoupper($q_nced)."','".strtoupper($q_fname)."','".strtoupper($q_lname)."','".$q_phone."','".strtolower($q_email)."','3')";
         $conexion=$mysqli->query($str);


      $sql = ("SELECT idmed FROM medicos WHERE correo='".$q_email."'");
            $result=$mysqli->query($sql); $row = mysqli_fetch_array($result);
               $nomed=$row['idmed'];

      $sqlfp = ("SELECT forma, detalle FROM formpago WHERE estatus='A'");
            $resultfp=$mysqli->query($sqlfp); 
               while($rowfp = mysqli_fetch_array($resultfp)) { 

                  $ln=$ln+1;
               $msgwasa.=$ln.'. '.$rowfp['forma'].' - '.$rowfp['detalle'].'<br>';

               }  


try {
    //Server settings
    $mail->isSMTP();                                   //Send using SMTP
    $mail->SMTPDebug = 0;                              //Enable verbose debug output
    $mail->Host       = "s1113.use1.mysecurecloudhost.com";     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                          //Enable SMTP authentication
    $mail->Username   = "info@dsinternacional.com";    //SMTP username
    $mail->Password   = "dsi.2388";                    //SMTP password
    $mail->SMTPSecure = "ssl";                         //Enable implicit TLS encryption
    $mail->Port       = 465;                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('info@dsinternacional.com', 'PAYMED GLOBAL');
    $mail->addAddress($q_email);     //Add a recipient
    $mail->addReplyTo('no-reply@noreply.com', 'Informacion');
    $mail->addCC('ingenieria.ds2010@gmail.com');
    //$mail->addCC('caballero.nestor.10@gmail.com');
    //$mail->addBCC('ingenieria.ds2010@gmail.com');

    //Attachments
    //$mail->addAttachment('../img/app_banner_logo.png');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Registro del Dr(a) ' . $full . ' en la web.';
    $mail->Body    = '<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<title>PayMed - Finance for Doctors</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css"> span.productOldPrice { color: #A0131C; text-decoration: line-through;} #outlook a { padding: 0; } body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table, td { border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; } img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; } p { display: block; margin: 13px 0; } </style>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,700" rel="stylesheet" type="text/css">
<style type="text/css"> @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,700); </style>
<!--<![endif]--> 
<style type="text/css"> @media only screen and (min-width:480px) { .column-per-100 { width: 100% !important; max-width: 100%; } .column-per-25 { width: 25% !important; max-width: 25%; } .column-per-75 { width: 75% !important; max-width: 75%; } .column-per-48-4 { width: 48.4% !important; max-width: 48.4%; } .column-per-50 { width: 50% !important; max-width: 50%; } } </style>
<style type="text/css"> @media only screen and (max-width:480px) { table.full-width-mobile { width: 100% !important; } td.full-width-mobile { width: auto !important; } } noinput.menu-checkbox { display: block !important; max-height: none !important; visibility: visible !important; } @media only screen and (max-width:480px) { .menu-checkbox[type="checkbox"]~.inline-links { display: none !important; } .menu-checkbox[type="checkbox"]:checked~.inline-links, .menu-checkbox[type="checkbox"]~.menu-trigger { display: block !important; max-width: none !important; max-height: none !important; font-size: inherit !important; } .menu-checkbox[type="checkbox"]~.inline-links>a { display: block !important; } .menu-checkbox[type="checkbox"]:checked~.menu-trigger .menu-icon-close { display: block !important; } .menu-checkbox[type="checkbox"]:checked~.menu-trigger .menu-icon-open { display: none !important; } } </style>
<style type="text/css"> @media only screen and (min-width:481px) { .products-list-table img { width: 120px !important; display: block; } .products-list-table .image-column { width: 20% !important; } } a { color: #000; } .server-img img { width: 100% } .server-box-one a, .server-box-two a { text-decoration: underline; color: #2E9CC3; } .server-img img { width: 100% } .server-box-one a, .server-box-two a { text-decoration: underline; color: #2E9CC3; } .server-img img { width: 100% } .server-box-one a, .server-box-two a { text-decoration: underline; color: #2E9CC3; } </style>
</head>
<body style="background-color:#FFFFFF;">
<div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; background-color: #FFFFFF;">
<div class="body-wrapper" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; padding-bottom: 20px; box-shadow: 0 4px 10px #ddd; background: #F2F2F2; background-color: #F2F2F2; margin: 0px auto; max-width: 600px; margin-bottom: 10px;">
<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#F2F2F2;background-color:#F2F2F2;width:100%;">
<tbody>
<tr>
<td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 10px 20px; text-align: center;" align="center">
<div class="pre-header" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; height: 1px; overflow: hidden; margin: 0px auto; max-width: 560px;">
   <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
      <tbody>
         <tr>
            <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 0px; text-align: center;" align="center">
                        <div class="column-per-100 outlook-group-fix" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%;">
                           <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                              <tr>
                                 <td align="center" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; word-break: break-word;">
                                    <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 1px; font-weight: 400; line-height: 0; text-align: center; color: #F2F2F2;">Registro de Medico!</div>
                                 </td>
                              </tr>
                           </table>
                        </div>
            </td>
         </tr>
      </tbody>
   </table>
</div>
<div class="header" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; line-height: 22px; padding: 15px 0; margin: 0px auto; max-width: 560px;">
   <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
      <tbody>
         <tr>
            <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 0px; text-align: center;" align="center">
                        <div class="column-per-25 outlook-group-fix" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: middle; width: 100%;">
                           <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:middle;" width="100%">
                              <tr>
                                 <td align="center" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; word-break: break-word;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                       <tbody>
                                          <tr>
                                             <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif;width: 160px;" width="160"> <a href="https://paymed.dsinternacional.com/" target="_blank" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; padding: 0 10px;"> <img alt="Paymed" height="auto" src="https://paymed.dsinternacional.com/images/email/logo-small.png" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="160"> </a> </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </table>
                        </div>
                        <div class="column-per-75 outlook-group-fix navigation-bar" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: middle; width: 100%;">
                           <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:middle;" width="100%">
                              <tr>
                                 <td align="right" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; text-align: right; font-size: 0px; word-break: break-word;">
                                    <div class="inline-links" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif;">
                                        <a class="link" href="https://paymed.dsinternacional.com/login.html" target="_blank" style="display: inline-block; color: #808080; font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 13px; font-weight: bold; line-height: 22px; text-decoration: none; text-transform: none; padding: 0 10px;"> Mi Cuenta </a> 
                        <div class="column-per-100 outlook-group-fix" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%;">
                           <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                              <tbody>
                                 <tr>
                                    <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; background-color: #ffffff; border-radius: 10px; vertical-align: top; padding: 30px 25px;" bgcolor="#ffffff" valign="top">
                                       <table border="0" cellpadding="0" cellspacing="0" role="presentation" style width="100%">
                                          <tr>
                                             <td align="left" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; word-break: break-word;">
                                                <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 26px; font-weight: bold; line-height: 30px; text-align: left; color: #4F4F4F;">Registro de Medico!</div>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td align="left" class="link-wrap" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; padding-bottom: 20px; word-break: break-word;">
                                                <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px; text-align: left; color: #4F4F4F;"><br> Gracias por su registro! <br><br> Usted ofertó por el siguiente producto: <br></div>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td align="left" class="link-wrap" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; padding-bottom: 20px; word-break: break-word;">
                                                <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 16px; font-weight: 300; line-height: 25px; text-align: left; color: #4F4F4F;">Membresía: <a target="_blank" style="font-weight: bold;color: #2E9CC3;" href="#"><strong>Membresía VIP</strong></a> <br></div>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td align="left" class="link-wrap" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; padding-bottom: 20px; word-break: break-word;">
                                                <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 16px; font-weight: 300; line-height: 25px; text-align: left; color: #4F4F4F;">Precio: <strong>USD 70</strong> <br></div>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td align="left" class="link-wrap" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; padding-bottom: 20px; word-break: break-word;">
                                                <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px; text-align: left; color: #4F4F4F;"><br> Si tiene alguna duda, por favor, <a target="_blank" style="font-weight: bold;color: #2E9CC3;" href="https://paymed.dsinternacional.com/#contact-us">Contáctenos</a>! <br></div>
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>

            </td>
         </tr>
      </tbody>
   </table>
</div>

<div class="server-box-one" style="background-color: #fff; padding: 20px 20px 20px 10px; border-radius: 10px; box-sizing: border-box; font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; margin: 0px auto; max-width: 560px; margin-bottom: 20px;">
   <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
      <tbody>
         <tr>
            <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 0px; text-align: center;" align="center">

                        <div class="column-per-100 outlook-group-fix" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%;">
                           <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                              <tr>
                                 <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; width: 60px; margin-bottom: 10px; vertical-align: top;" class="server-img" width="60" valign="top"> <img src="https://paymed.dsinternacional.com/images/email/contact.png" alt style="width: 100%; max-width: 60px;"> </td>
                                 <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; line-height: 20px; color: #333; padding-left: 10px;">
                                    <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 16px; font-weight: bold; margin-bottom: 8px;">Datos de Registro:</div>
                                    <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 14px;"> <strong>Nro Cedula:</strong> '.$q_nced.'<br /> </div>
                                    <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 14px;"> <strong>Nombre:</strong> '.$full.'<br> </div>
                                    <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 14px;"> <strong>Telefono:</strong> '.$q_phone.'<br /> </div>
                                    <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 14px;"> <strong>Correo:</strong> '.$q_email.'<br /> </div>
                                    
                                 </td>
                              </tr>
                           </table>
                        </div>

            </td>
         </tr>
      </tbody>
   </table>
</div>

<div class="products-list margin-bottom" style="padding: 10px 0; background-color: #fff; border-radius: 10px; font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; margin: 0px auto; max-width: 560px; margin-bottom: 15px;">
   <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
      <tbody>
         <tr>
            <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 0px; text-align: center;" align="center">
                        <div class="column-per-100 outlook-group-fix" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%;">
                           <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                              <tr>
                                 <td align="left" class="products-list-table" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 10px 25px; word-break: break-word;">
                                    <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color:#999;font-family:Open Sans, Helvetica, Tahoma, Arial, sans-serif;font-size:13px;line-height:22px;table-layout:auto;width:100%;border:none;">
                                       <tr class="products-list-header" style="border-bottom: 2px solid #D8D8D8; line-height: 30px;">
                                          <th class="image-column" width="55%" align="left" style="line-height: 18px; padding-bottom: 18px; color: #333;"> Cuentas de Pago</th>
                                          <th class="price-column" width="45%" align="right" style="line-height: 18px; padding-bottom: 18px; color: #333;"></th>
                                       </tr>
                                       <tr>

                                          <td align="left" width="100%" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; vertical-align: top; line-height: 1; padding: 15px 0 20px 0; border-bottom: 1px dashed #D8D8D8; font-size: 14px;" valign="top">
                                             <div class="product-info" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; width: 100%; min-height: 80px; margin-bottom: 20px;"> <a href="#" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; display: block; color: #333; font-weight: bold; line-height: 20px; text-decoration: none;">'.$msgwasa.'</a> <br /></div>
                                          </td>

                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td align="left" class="order-info-table" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 10px 25px; word-break: break-word;">
                                    <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color:#000000;font-family:Open Sans, Helvetica, Tahoma, Arial, sans-serif;font-size:13px;line-height:22px;table-layout:auto;width:100%;border:none;">
                                       <tr>
                                          <td width="65%" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif;"> <span style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; color: #999999;">TOTAL A PAGAR </span> </td>
                                          <td width="35%" align="right" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif;"> <span style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-weight: bold;">USD 70</span> </td>
                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td align="center" vertical-align="middle" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 10px 25px; word-break: break-word;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;width:100%;line-height:100%;">
                                       <tr>
                                          <td align="center" bgcolor="#dd2c00" role="presentation" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; border: none; border-radius: 3px; cursor: auto; mso-padding-alt: 0; background: #dd2c00;" valign="middle"> <a href="https://paymed.dsinternacional.com/payments.php?idmed='.$nomed.'" style="display: inline-block; background: #dd2c00; color: #ffffff; font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 36px; margin: 0; text-decoration: none; text-transform: none; padding: 0; mso-padding-alt: 0px; border-radius: 3px;" target="_blank"> Registrar Pago </a> </td>
                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                           </table>
                        </div>
            </td>
         </tr>
      </tbody>
   </table>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="footer-wrapper" style="margin: 0px auto; max-width: 600px;">
<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #FFFFFF; width: 100%;" width="100%" bgcolor="#FFFFFF">
<tbody>
<tr>
<td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
            <div class="footer-information" style="margin:0px auto;max-width:600px;">
               <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #FFFFFF; width: 100%;" width="100%" bgcolor="#FFFFFF">
                  <tbody>
                     <tr>
                        <td style="direction:ltr;font-size:0px;padding:0px;text-align:center;">
                                    <div class="column-per-100 outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                       <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #FFFFFF; vertical-align: top;" width="100%" valign="top" bgcolor="#FFFFFF">
                                          <tbody>
                                             <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                   <div style="font-family:OpenSans, Helvetica, Tahoma, Arial, sans-serif;font-size:12px;font-weight:400;line-height:20px;text-align:center;color:#4F4F4F;">
                                                      <div>
                                                         <a href="https://paymed.dsinternacional.com/" target="_blank" style="color: #333333; line-height: 20px; text-decoration: underline;">Home</a> | 
                                                         <a href="https://paymed.dsinternacional.com/" style="color: #333333; line-height: 20px; text-decoration: underline;">Contacto</a> 
                                                         
                                                      </div>
                                                      <br /> &copy; 2022 DEVELOPMENT SOFT INTERNACIONAL
                                                      <br />
                                                   </div>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</body>
</html>';
    $mail->send();
    echo '<script language="javascript">
           alert("¡Se ha creado su registro!");
           window.location.href="index.php"; </script>';
} catch (Exception $e) {
    echo "Error en el envío del correo: {$mail->ErrorInfo}";
}                 

   }
?>