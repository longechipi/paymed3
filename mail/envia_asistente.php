<?php
   require('../../conf/env.php'); //Variables de Entorno
	require ('../../PHPMailer-master/src/Exception.php');
	require ('../../PHPMailer-master/src/PHPMailer.php');
	require ('../../PHPMailer-master/src/SMTP.php');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	$mail = new PHPMailer(true);

	if(!$_POST) exit;

	// Email verification, do not edit.
	function isEmail($email_booking) {
		return(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$email_booking ));
	}	
	
   //$correo=$arr[2];
    
try {
    //Server settings
    $mail->isSMTP();                    //Send using SMTP
    $mail->SMTPDebug = 0;               //Enable verbose debug output
    $mail->Host       = SMTP_HOST;      //Set the SMTP server to send through
    $mail->SMTPAuth   = true;           //Enable SMTP authentication
    $mail->Username   = SMTP_USERNAME;  //SMTP username
    $mail->Password   = SMTP_PASSWORD;  //SMTP password
    $mail->SMTPSecure = SMTP_SECURE;    //Enable implicit TLS encryption
    $mail->Port       = SMTP_PORT;     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    //Recipients
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress($correo);
    $mail->addReplyTo(REPLY_TO_EMAIL, REPLY_TO_NAME);
    $mail->addCC(CC_EMAIL);

    //Attachments
    //$mail->addAttachment('../img/app_banner_logo.png');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Registro de Asistente en PayMed Global' ;
    $mail->Body    = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
<head>
<title></title>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="x-apple-disable-message-reformatting" content="" />
<meta content="target-densitydpi=device-dpi" name="viewport" />
<meta content="true" name="HandheldFriendly" />
<meta content="width=device-width" name="viewport" />
<meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no" />
<style type="text/css">
table {
border-collapse: separate;
table-layout: fixed;
mso-table-lspace: 0pt;
mso-table-rspace: 0pt
}
table td {
border-collapse: collapse
}
.ExternalClass {
width: 100%
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
line-height: 100%
}
.gmail-mobile-forced-width {
display: none;
display: none !important;
}
body, a, li, p, h1, h2, h3 {
-ms-text-size-adjust: 100%;
-webkit-text-size-adjust: 100%;
}
html {
-webkit-text-size-adjust: none !important
}
body, #innerTable {
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale
}
#innerTable img+div {
display: none;
display: none !important
}
img {
Margin: 0;
padding: 0;
-ms-interpolation-mode: bicubic
}
h1, h2, h3, p, a {
line-height: inherit;
overflow-wrap: normal;
white-space: normal;
word-break: break-word
}
a {
text-decoration: none
}
h1, h2, h3, p {
min-width: 100%!important;
width: 100%!important;
max-width: 100%!important;
display: inline-block!important;
border: 0;
padding: 0;
margin: 0
}
a[x-apple-data-detectors] {
color: inherit !important;
text-decoration: none !important;
font-size: inherit !important;
font-family: inherit !important;
font-weight: inherit !important;
line-height: inherit !important
}
u + #body a {
color: inherit;
text-decoration: none;
font-size: inherit;
font-family: inherit;
font-weight: inherit;
line-height: inherit;
}
a[href^="mailto"],
a[href^="tel"],
a[href^="sms"] {
color: inherit;
text-decoration: none
}
</style>
<style type="text/css">
@media (min-width: 481px) {
.hd { display: none!important }
}
</style>
<style type="text/css">
@media (max-width: 480px) {
.hm { display: none!important }
}
</style>
<style type="text/css">
@media (max-width: 480px) {
.t1,.t13,.t71,.t75,.t78,.t80,.t9{width:420px!important}.t50,.t68,.t69{display:block!important}.t80{padding-left:30px!important;padding-right:30px!important}.t21,.t23,.t29,.t36,.t38{width:358px!important}.t43{width:398px!important}.t41{width:370px!important}.t68{text-align:center!important}.t50{mso-line-height-alt:14px!important;line-height:14px!important}.t46,.t48,.t63,.t65{width:5px!important;display:revert!important}.t51,.t67{vertical-align:middle!important;display:inline-block!important;width:100%!important}.t51{max-width:98px!important}.t67{max-width:805px!important}.t61{width:650px!important}.t54{width:654px!important}.t82{width:440px!important}
}
</style>
<style type="text/css">@media (max-width: 480px) {[class~="x_t80"]{padding-left:30px!important;padding-right:30px!important;width:420px!important;} [class~="x_t1"]{width:420px!important;} [class~="x_t23"]{width:358px!important;} [class~="x_t38"]{width:358px!important;} [class~="x_t29"]{width:358px!important;} [class~="x_t36"]{width:358px!important;} [class~="x_t43"]{width:398px!important;} [class~="x_t41"]{width:370px!important;} [class~="x_t71"]{width:420px!important;} [class~="x_t69"]{display:block!important;} [class~="x_t68"]{display:block!important;text-align:center!important;} [class~="x_t50"]{mso-line-height-alt:14px!important;line-height:14px!important;display:block!important;} [class~="x_t46"]{width:5px!important;display:revert!important;} [class~="x_t48"]{width:5px!important;display:revert!important;} [class~="x_t51"]{vertical-align:middle!important;display:inline-block!important;width:100%!important;max-width:98px!important;} [class~="x_t63"]{width:5px!important;display:revert!important;} [class~="x_t65"]{width:5px!important;display:revert!important;} [class~="x_t67"]{vertical-align:middle!important;display:inline-block!important;width:100%!important;max-width:805px!important;} [class~="x_t61"]{width:650px!important;} [class~="x_t54"]{width:654px!important;} [class~="x_t13"]{width:420px!important;} [class~="x_t78"]{width:420px!important;} [class~="x_t75"]{width:420px!important;} [class~="x_t21"]{width:358px!important;} [class~="x_t82"]{width:440px!important;} [class~="x_t9"]{width:420px!important;}}</style>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&amp;display=swap" rel="stylesheet" type="text/css" />
</head>
<body id=body class=t86 style="min-width:100%;Margin:0px;padding:0px;background-color:#FAFAFA;"><div class=t85 style="background-color:#FAFAFA;"><table role=presentation width=100% cellpadding=0 cellspacing=0 border=0 align=center><tr><td class=t84 style="font-size:0;line-height:0;mso-line-height-rule:exactly;background-color:#FAFAFA;" valign=top align=center>

<table role=presentation width=100% cellpadding=0 cellspacing=0 border=0 align=center id=innerTable><tr><td align=center>
<table class=t81 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t80 style="background-color:#E6E8F0;width:510px;padding:40px 60px 22px 60px;">

<table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"><tr><td align=center>
<table class=t2 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t1 style="width:448px;">

<div style="font-size:0px;"><img class=t0 style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;" width=448 height=160.53125 alt="" src="https://paymed.wgdigital.com.ve/assets/img/logos/logopng.png"/></div></td>
</tr></table>
</td></tr><tr><td><div class=t3 style="mso-line-height-rule:exactly;mso-line-height-alt:40px;line-height:40px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t6 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t5 style="width:auto;">

<h1 class=t4 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:34px;font-weight:700;font-style:normal;font-size:29px;text-decoration:none;text-transform:none;direction:ltr;color:#222A55;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">Notificaci&oacute;n de Registro</h1></td>
</tr></table>
</td></tr><tr><td><div class=t7 style="mso-line-height-rule:exactly;mso-line-height-alt:27px;line-height:27px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t10 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t9 style="width:510px;padding:0 0 1px 0;">

<p class=t8 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:16px;text-decoration:none;text-transform:none;direction:ltr;color:#454545;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">Hola: '.$full_name.'</p></td>
</tr></table>
</td></tr><tr><td><div class=t11 style="mso-line-height-rule:exactly;mso-line-height-alt:9px;line-height:9px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t14 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t13 style="width:510px;padding:0 0 1px 0;">

<p class=t12 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:16px;text-decoration:none;text-transform:none;direction:ltr;color:#454545;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">Esta recibiendo esta notificaci&oacute;n de correo debido a que se registro como Asistente del Dr(a): '.$nom_medico.'</p></td>
</tr></table>
</td></tr><tr><td><div class=t15 style="mso-line-height-rule:exactly;mso-line-height-alt:2px;line-height:2px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t24 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t23 style="border:1px solid #E3E3E3;overflow:hidden;width:448px;padding:16px 30px 16px 30px;border-radius:6px 6px 0 0;">

<table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"><tr><td align=center>
<table class=t18 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t17 style="width:auto;">

<p class=t16 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:bold;font-style:normal;font-size:18px;text-decoration:none;text-transform:none;direction:ltr;color:#222A55;text-align:left;mso-line-height-rule:exactly;mso-text-raise:1px;">HAS SIDO REGISTRADO DE ASISTENTE</p></td>
</tr></table>
</td></tr><tr><td><div class=t19 style="mso-line-height-rule:exactly;mso-line-height-alt:14px;line-height:14px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t22 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t21 style="width:448px;">
<p class=t20 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:16px;text-decoration:none;text-transform:none;direction:ltr;color:#454545;text-align:center;mso-line-height-rule:exactly;mso-text-raise:2px;">La contrase&ntilde;a se ha generado por defecto, recuerda cambiarla cuando entres en la plataforma.&nbsp;</p></td>
</tr></table>
</td></tr></table></td>
</tr></table>
</td></tr><tr><td align=center>
<table class=t39 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t38 style="border:1px solid #E3E3E3;width:448px;padding:17px 30px 19px 30px;">
<table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"><tr><td align=center>
<table class=t30 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t29 style="width:448px;">
<p class=t28 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:16px;text-decoration:none;text-transform:none;direction:ltr;color:#454545;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;"><span class=t25 style="margin:0;Margin:0;font-weight:700;mso-line-height-rule:exactly;">USUARIO</span><span class=t26 style="margin:0;Margin:0;font-weight:700;mso-line-height-rule:exactly;">:</span><span class=t27 style="margin:0;Margin:0;font-weight:400;mso-line-height-rule:exactly;"> '.$correo.'</span></p></td>
</tr></table>
</td></tr><tr><td><div class=t35 style="mso-line-height-rule:exactly;mso-line-height-alt:6px;line-height:6px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t37 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t36 style="width:448px;">
<p class=t34 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:16px;text-decoration:none;text-transform:none;direction:ltr;color:#454545;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;"><span class=t32 style="margin:0;Margin:0;mso-line-height-rule:exactly;"><span class=t31 style="margin:0;Margin:0;font-weight:700;mso-line-height-rule:exactly;">CONTRASE&Ntilde;A:</span></span><span class=t33 style="margin:0;Margin:0;font-weight:400;mso-line-height-rule:exactly;"> '.$clave.'</span></p></td>
</tr></table>
</td></tr></table></td>
</tr></table>
</td></tr><tr><td align=center>
<table class=t44 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t43 style="border:1px solid #E3E3E3;overflow:hidden;width:488px;padding:10px 10px 10px 10px;border-radius:0 0 6px 6px;">
<table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"><tr><td align=center>
<table class=t42 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t41 style="background-color:#007DBA;overflow:hidden;width:460px;text-align:center;line-height:24px;mso-line-height-rule:exactly;mso-text-raise:2px;padding:18px 14px 18px 14px;border-radius:4px 4px 4px 4px;">
<a class=t40 href="https://paymedglobal.com" style="display:block;margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:24px;font-weight:700;font-style:normal;font-size:16px;text-decoration:none;direction:ltr;color:#FFFFFF;text-align:center;mso-line-height-rule:exactly;mso-text-raise:2px;" target=_blank>ACCEDER A PAYMED GLOBAL</a></td>
</tr></table>
</td></tr></table></td>
</tr></table>
</td></tr><tr><td><div class=t70 style="mso-line-height-rule:exactly;mso-line-height-alt:10px;line-height:10px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t72 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t71 style="border-bottom:2px solid #EEEEEE;border-top:2px solid #EEEEEE;width:510px;padding:19px 0 25px 0;">
<table class=t69 role=presentation cellpadding=0 cellspacing=0 align=left valign=middle>
<tr class=t68><td></td><td class=t51 width=175.07477 valign=middle>
<table role=presentation width=100% cellpadding=0 cellspacing=0 class=t49 style="width:100%;"><tr>
<td class=t46 style="width:22px;" width=22></td><td class=t47 style="background-color:transparent;"><div style="font-size:0px;"><img class=t45 style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;" width=131.07476635514018 height=102.1875 alt="" src="https://paymed.wgdigital.com.ve/assets/img/logos/logos.png"/></div></td><td class=t48 style="width:22px;" width=22></td>
</tr></table>

<div class=t50 style="mso-line-height-rule:exactly;font-size:1px;display:none;">&nbsp;&nbsp;</div>
</td><td class=t67 width=422.92523 valign=middle>
<table role=presentation width=100% cellpadding=0 cellspacing=0 class=t66 style="width:100%;"><tr>
<td class=t63 style="width:22px;" width=22></td><td class=t64><table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"><tr><td align=center>
<table class=t55 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t54 style="width:378.93px;">
<p class=t53 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:700;font-style:normal;font-size:16px;text-decoration:none;text-transform:none;direction:ltr;color:#222A55;text-align:center;mso-line-height-rule:exactly;mso-text-raise:2px;">Recuerda colocar una contrase&ntilde;a segura <a class=t52 href="https://tabular.email" style="margin:0;Margin:0;font-weight:700;font-style:normal;text-decoration:none;direction:ltr;color:#222A55;mso-line-height-rule:exactly;" target=_blank></a></p></td>
</tr></table>
</td></tr><tr><td><div class=t60 style="mso-line-height-rule:exactly;mso-line-height-alt:9px;line-height:9px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t62 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t61 style="width:378.93px;">
<p class=t59 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:16px;text-decoration:none;text-transform:none;direction:ltr;color:#007DBA;text-align:center;mso-line-height-rule:exactly;mso-text-raise:2px;"><span class=t56 style="margin:0;Margin:0;mso-line-height-rule:exactly;">Si tienes algun problema t&eacute;cnico para entrar en la plataforma por favor</span> <a class=t58 href="https://www.google.com" style="margin:0;Margin:0;font-weight:700;font-style:normal;text-decoration:none;direction:ltr;color:#007DBA;mso-line-height-rule:exactly;" target=_blank><span class=t57 style="margin:0;Margin:0;font-style:italic;mso-line-height-rule:exactly;">Contactanos</span></a></p></td>
</tr></table>
</td></tr></table></td><td class=t65 style="width:22px;" width=22></td>
</tr></table>
</td>
<td></td></tr>
</table></td>
</tr></table>
</td></tr><tr><td><div class=t73 style="mso-line-height-rule:exactly;mso-line-height-alt:13px;line-height:13px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t76 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t75 style="width:510px;">
<p class=t74 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:13px;text-decoration:none;text-transform:none;direction:ltr;color:#949494;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;">Telf: 0212-999-99-99 / 0212-888-88-88</p></td>
</tr></table>
</td></tr><tr><td align=center>
<table class=t79 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t78 style="width:510px;">
<p class=t77 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:13px;text-decoration:none;text-transform:none;direction:ltr;color:#949494;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;">Direcci&oacute;n fisica de paymed Global&nbsp;</p></td>
</tr></table>
</td></tr></table></td>
</tr></table>
</td></tr><tr><td align=center>
<table class=t83 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>

<td class=t82 style="width:560px;padding:20px 20px 20px 20px;">
<table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"></table></td>
</tr></table>
</td></tr></table></td></tr></table></div><div class="gmail-mobile-forced-width" style="white-space: nowrap; font: 15px courier; line-height: 0;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
</div></body>
</html>';

    $mail->send();
    //echo "<script language='javascript'> alert('¡Se ha creado su registro!'); window.location.href='index.php'; </script>";
    //echo '1';
	} catch (Exception $e) {
    echo "Error en el envío del correo: {$mail->ErrorInfo}";
	}
?>
