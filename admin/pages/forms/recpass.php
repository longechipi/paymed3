<?php
	session_start();
	//$usuario=$_SESSION['usuario'];
	require('../../conexion.php');
	//datos 
	$fecha  =date('d/m/Y');
	$correo =$_POST['correo'];
	
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
	/*-------------*/
	$sql = ("SELECT count(*) as hay from loginn WHERE correo='".$correo."';");
  	$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
	$hay=$arr[0];

	if ($hay!='0') { // Envio correo 
		$sql="UPDATE loginn SET clave='123' WHERE correo='".$correo."' ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);
	/*-------------*/
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
    $mail->addAddress($correo);     //Add a recipient
    $mail->addReplyTo('no-reply@noreply.com', 'Informacion');
    //$mail->addCC('ingenieria.ds2010@gmail.com');
    $mail->addCC('caballero.nestor.10@gmail.com');
    //$mail->addBCC('ingenieria.ds2010@gmail.com');

    //Attachments
    //$mail->addAttachment('../img/app_banner_logo.png');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Clave PayMed' ;
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
		                                        
		                        <div class="column-per-100 outlook-group-fix" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%;">
		                           <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
		                              <tbody>
		                                 <tr>
		                                    <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; background-color: #ffffff; border-radius: 10px; vertical-align: top; padding: 30px 25px;" bgcolor="#ffffff" valign="top">
		                                       <table border="0" cellpadding="0" cellspacing="0" role="presentation" style width="100%">
		                                          <tr>
		                                             <td align="left" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; word-break: break-word;">
		                                                <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 26px; font-weight: bold; line-height: 30px; text-align: left; color: #4F4F4F;">Clave Actualizada!</div>
		                                             </td>
		                                          </tr>
		                                          <tr>
		                                             <td align="left" class="link-wrap" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; padding-bottom: 20px; word-break: break-word;">
		                                                <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 20px; font-weight: 400; line-height: 25px; text-align: left; color: #4F4F4F;"><br>Ahora Su Clave Es: 123 </div>
		                                             </td>
		                                          </tr>
		                                          <tr>
		                                             <td align="left" class="link-wrap" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; padding-bottom: 20px; word-break: break-word;">
		                                                <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 16px; font-weight: 300; line-height: 25px; text-align: left; color: #4F4F4F;"><strong>GRACIAS...</strong> <br><br></div>
		                                             </td>
		                                          </tr>
		                                          <tr>
		                                             <td align="left" class="link-wrap" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; padding-bottom: 20px; word-break: break-word;">
		                                                <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px; text-align: left; color: #4F4F4F;"><br> Si tiene alguna duda, por favor, <a target="_blank" style="font-weight: bold;color: #2E9CC3;" href="https://paymed.dsinternacional.com/#contact-us">Contáctenos</a>! <br></div>
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
		</td>
		</tr>
		</tbody>
		</table>
		</div>
		</div>
		</body>
		</html>';

    	$mail->send();
    	echo "<script language='javascript'> alert('¡Se Envio Un Correo Con La Nueva Clave!'); window.location.href='../../../login.html'; </script>";
    	echo '1';
	} catch (Exception $e) {
    	echo "Error en el envío del correo: {$mail->ErrorInfo}";
	}
		/*---------------------------*/
	}else{
		echo "<script language='javascript'> alert('¡ERROR... Correo No Existe En Nuestra Data!'); window.location.href='../../../login.html'; </script>";
	} // fin if
?>