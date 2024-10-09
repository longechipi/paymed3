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
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress($correo);
    $mail->addReplyTo(REPLY_TO_EMAIL, REPLY_TO_NAME);
    $mail->addCC(CC_EMAIL);

    //Attachments
    //$mail->addAttachment('../img/app_banner_logo.png');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verificacion de Correo' ;
    $mail->Body    = '
<!--
* This email was built using Tabular.
* For more information, visit https://tabular.email
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
<head>
<title></title>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--[if !mso]>-->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--<![endif]-->
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
.t1,.t63,.t72{width:420px!important}.t58,.t61{text-align:center!important}.t45,.t58,.t59{display:block!important}.t72{padding-left:30px!important;padding-right:30px!important}.t21,.t23,.t26,.t31,.t33{width:358px!important}.t38{width:398px!important}.t36{width:370px!important}.t45{mso-line-height-alt:14px!important;line-height:14px!important}.t41,.t43,.t53,.t55{width:5px!important;display:revert!important}.t46,.t57{vertical-align:middle!important;display:inline-block!important;width:100%!important}.t46{max-width:98px!important}.t57{max-width:805px!important}.t51{width:650px!important}.t74{width:440px!important}
}
</style>
<style type="text/css">@media (max-width: 480px) {[class~="x_t72"]{padding-left:30px!important;padding-right:30px!important;width:420px!important;} [class~="x_t1"]{width:420px!important;} [class~="x_t23"]{width:358px!important;} [class~="x_t33"]{width:358px!important;} [class~="x_t31"]{width:358px!important;} [class~="x_t38"]{width:398px!important;} [class~="x_t36"]{width:370px!important;} [class~="x_t63"]{width:420px!important;} [class~="x_t61"]{text-align:center!important;} [class~="x_t59"]{display:block!important;} [class~="x_t58"]{display:block!important;text-align:center!important;} [class~="x_t45"]{mso-line-height-alt:14px!important;line-height:14px!important;display:block!important;} [class~="x_t41"]{width:5px!important;display:revert!important;} [class~="x_t43"]{width:5px!important;display:revert!important;} [class~="x_t46"]{vertical-align:middle!important;display:inline-block!important;width:100%!important;max-width:98px!important;} [class~="x_t53"]{width:5px!important;display:revert!important;} [class~="x_t55"]{width:5px!important;display:revert!important;} [class~="x_t57"]{vertical-align:middle!important;display:inline-block!important;width:100%!important;max-width:805px!important;} [class~="x_t51"]{width:650px!important;} [class~="x_t21"]{width:358px!important;} [class~="x_t74"]{width:440px!important;} [class~="x_t26"]{width:358px!important;}}</style>
<!--[if !mso]>-->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&amp;display=swap" rel="stylesheet" type="text/css" />
<!--<![endif]-->
<!--[if mso]>
<xml>
<o:OfficeDocumentSettings>
<o:AllowPNG/>
<o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings>
</xml>
<![endif]-->
</head>
<body id=body class=t78 style="min-width:100%;Margin:0px;padding:0px;background-color:#FAFAFA;"><div class=t77 style="background-color:#FAFAFA;"><table role=presentation width=100% cellpadding=0 cellspacing=0 border=0 align=center><tr><td class=t76 style="font-size:0;line-height:0;mso-line-height-rule:exactly;background-color:#FAFAFA;" valign=top align=center>
<!--[if mso]>
<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false">
<v:fill color=#FAFAFA/>
</v:background>
<![endif]-->
<table role=presentation width=100% cellpadding=0 cellspacing=0 border=0 align=center id=innerTable><tr><td align=center>
<table class=t73 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=630 class=t72 style="background-color:#E6E8F0;padding:40px 60px 22px 60px;">
<![endif]-->
<!--[if !mso]>-->
<td class=t72 style="background-color:#E6E8F0;width:510px;padding:40px 60px 22px 60px;">
<!--<![endif]-->
<table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"><tr><td align=center>
<table class=t2 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=448 class=t1>
<![endif]-->
<!--[if !mso]>-->
<td class=t1 style="width:448px;">
<!--<![endif]-->
<div style="font-size:0px;"><img class=t0 style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;" width=448 height=160.53125 alt="" src="https://paymed.wgdigital.com.ve/assets/img/logos/logoP.svg"/></div></td>
</tr></table>
</td></tr><tr><td><div class=t3 style="mso-line-height-rule:exactly;mso-line-height-alt:40px;line-height:40px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t6 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td class=t5>
<![endif]-->
<!--[if !mso]>-->
<td class=t5 style="width:auto;">
<!--<![endif]-->
<h1 class=t4 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:34px;font-weight:700;font-style:normal;font-size:29px;text-decoration:none;text-transform:none;direction:ltr;color:#222A55;text-align:left;mso-line-height-rule:exactly;mso-text-raise:2px;">PayMed Global</h1></td>
</tr></table>
</td></tr><tr><td><div class=t7 style="mso-line-height-rule:exactly;mso-line-height-alt:27px;line-height:27px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t10 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td class=t9 style="padding:0 0 1px 0;">
<![endif]-->
<!--[if !mso]>-->
<td class=t9 style="padding:0 0 1px 0;">
<!--<![endif]-->
<p class=t8 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:20px;text-decoration:none;text-transform:none;direction:ltr;color:#454545;text-align:center;mso-line-height-rule:exactly;mso-text-raise:1px;">Bienvenido</p></td>
</tr></table>
</td></tr><tr><td><div class=t11 style="mso-line-height-rule:exactly;mso-line-height-alt:23px;line-height:23px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t14 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td class=t13 style="padding:0 0 1px 0;">
<![endif]-->
<!--[if !mso]>-->
<td class=t13 style="padding:0 0 1px 0;">
<!--<![endif]-->
<p class=t12 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:18px;text-decoration:none;text-transform:none;direction:ltr;color:#454545;text-align:center;mso-line-height-rule:exactly;mso-text-raise:1px;">Esta recibiendo esta notificacion para validar tu correo electronico, por favor ingresa este codigo para continuar con la validacion de los datos&nbsp;</p></td>
</tr></table>
</td></tr><tr><td><div class=t15 style="mso-line-height-rule:exactly;mso-line-height-alt:22px;line-height:22px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t24 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=510 class=t23 style="border:1px solid #E3E3E3;overflow:hidden;padding:16px 30px 16px 30px;border-radius:6px 6px 0 0;">
<![endif]-->
<!--[if !mso]>-->
<td class=t23 style="border:1px solid #E3E3E3;overflow:hidden;width:448px;padding:16px 30px 16px 30px;border-radius:6px 6px 0 0;">
<!--<![endif]-->
<table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"><tr><td align=center>
<table class=t18 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td class=t17>
<![endif]-->
<!--[if !mso]>-->
<td class=t17 style="width:auto;">
<!--<![endif]-->
<p class=t16 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:bold;font-style:normal;font-size:18px;text-decoration:none;text-transform:none;direction:ltr;color:#222A55;text-align:left;mso-line-height-rule:exactly;mso-text-raise:1px;">CODIGO DE VALIDACION</p></td>
</tr></table>
</td></tr><tr><td><div class=t19 style="mso-line-height-rule:exactly;mso-line-height-alt:14px;line-height:14px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t22 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=448 class=t21>
<![endif]-->
<!--[if !mso]>-->
<td class=t21 style="width:448px;">
<!--<![endif]-->
<p class=t20 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:30px;text-decoration:none;text-transform:none;direction:ltr;color:#454545;text-align:center;mso-line-height-rule:exactly;mso-text-raise:-2px;">'.$codigo.'</p></td>
</tr></table>
</td></tr></table></td>
</tr></table>
</td></tr><tr><td align=center>
<table class=t34 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=510 class=t33 style="border:1px solid #E3E3E3;padding:8px 30px 19px 30px;">
<![endif]-->
<!--[if !mso]>-->
<td class=t33 style="border:1px solid #E3E3E3;width:448px;padding:8px 30px 19px 30px;">
<!--<![endif]-->
<table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"><tr><td align=center>
<table class=t27 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=448 class=t26>
<![endif]-->
<!--[if !mso]>-->
<td class=t26 style="width:448px;">
<!--<![endif]-->
<p class=t25 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:16px;text-decoration:none;text-transform:none;direction:ltr;color:#454545;text-align:center;mso-line-height-rule:exactly;mso-text-raise:2px;">Para validar tu correo electronico puedes acceder directamente por el boton de Verificacion o por medio del siguiente link</p></td>
</tr></table>
</td></tr><tr><td><div class=t28 style="mso-line-height-rule:exactly;mso-line-height-alt:10px;line-height:10px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td><div class=t30 style="mso-line-height-rule:exactly;mso-line-height-alt:6px;line-height:6px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t32 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=448 class=t31>
<![endif]-->
<!--[if !mso]>-->
<td class=t31 style="width:448px;">
<!--<![endif]-->
<p class=t29 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:16px;text-decoration:none;text-transform:none;direction:ltr;color:#454545;text-align:center;mso-line-height-rule:exactly;mso-text-raise:2px;">https://paymed.wgdigital.com.ve/verificacion</p></td>
</tr></table>
</td></tr></table></td>
</tr></table>
</td></tr><tr><td align=center>
<table class=t39 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=510 class=t38 style="border:1px solid #E3E3E3;overflow:hidden;padding:10px 10px 10px 10px;border-radius:0 0 6px 6px;">
<![endif]-->
<!--[if !mso]>-->
<td class=t38 style="border:1px solid #E3E3E3;overflow:hidden;width:488px;padding:10px 10px 10px 10px;border-radius:0 0 6px 6px;">
<!--<![endif]-->
<table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"><tr><td align=center>
<table class=t37 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=488 class=t36 style="background-color:#007DBA;overflow:hidden;text-align:center;line-height:24px;mso-line-height-rule:exactly;mso-text-raise:2px;padding:18px 14px 18px 14px;border-radius:4px 4px 4px 4px;">
<![endif]-->
<!--[if !mso]>-->
<td class=t36 style="background-color:#007DBA;overflow:hidden;width:460px;text-align:center;line-height:24px;mso-line-height-rule:exactly;mso-text-raise:2px;padding:18px 14px 18px 14px;border-radius:4px 4px 4px 4px;">
<!--<![endif]-->
<a class=t35 href="https://paymedglobal.com" style="display:block;margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:24px;font-weight:700;font-style:normal;font-size:16px;text-decoration:none;direction:ltr;color:#FFFFFF;text-align:center;mso-line-height-rule:exactly;mso-text-raise:2px;" target=_blank>VERIFICACION DE CORREO</a></td>
</tr></table>
</td></tr></table></td>
</tr></table>
</td></tr><tr><td><div class=t62 style="mso-line-height-rule:exactly;mso-line-height-alt:10px;line-height:10px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t64 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=510 class=t63 style="border-bottom:2px solid #EEEEEE;border-top:2px solid #EEEEEE;padding:19px 0 25px 0;">
<![endif]-->
<!--[if !mso]>-->
<td class=t63 style="border-bottom:2px solid #EEEEEE;border-top:2px solid #EEEEEE;width:510px;padding:19px 0 25px 0;">
<!--<![endif]-->
<div class=t61 style="width:100%;text-align:left;"><div class=t60 style="display:inline-block;"><table class=t59 role=presentation cellpadding=0 cellspacing=0 align=left valign=middle>
<tr class=t58><td></td><td class=t46 width=175.07477 valign=middle>
<table role=presentation width=100% cellpadding=0 cellspacing=0 class=t44 style="width:100%;"><tr>
<td class=t41 style="width:22px;" width=22></td><td class=t42 style="background-color:transparent;"><div style="font-size:0px;"><img class=t40 style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;" width=131.07476635514018 height=102.1875 alt="" src="https://paymed.wgdigital.com.ve/assets/img/logos/logos.png"/></div></td><td class=t43 style="width:22px;" width=22></td>
</tr></table>
<!--[if !mso]>-->
<div class=t45 style="mso-line-height-rule:exactly;font-size:1px;display:none;">&nbsp;&nbsp;</div>
<!--<![endif]-->
</td><td class=t57 width=422.92523 valign=middle>
<table role=presentation width=100% cellpadding=0 cellspacing=0 class=t56 style="width:100%;"><tr>
<td class=t53 style="width:22px;" width=22></td><td class=t54><table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"><tr><td align=center>
<table class=t52 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=378.92523364485976 class=t51>
<![endif]-->
<!--[if !mso]>-->
<td class=t51 style="width:378.93px;">
<!--<![endif]-->
<p class=t50 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:16px;text-decoration:none;text-transform:none;direction:ltr;color:#007DBA;text-align:center;mso-line-height-rule:exactly;mso-text-raise:2px;"><span class=t47 style="margin:0;Margin:0;mso-line-height-rule:exactly;">Si tienes algun problema técnico para entrar en la plataforma por favor</span> <a class=t49 href="https://www.google.com" style="margin:0;Margin:0;font-weight:700;font-style:normal;text-decoration:none;direction:ltr;color:#007DBA;mso-line-height-rule:exactly;" target=_blank><span class=t48 style="margin:0;Margin:0;font-style:italic;mso-line-height-rule:exactly;">Contactanos</span></a></p></td>
</tr></table>
</td></tr></table></td><td class=t55 style="width:22px;" width=22></td>
</tr></table>
</td>
<td></td></tr>
</table></div></div></td>
</tr></table>
</td></tr><tr><td><div class=t65 style="mso-line-height-rule:exactly;mso-line-height-alt:13px;line-height:13px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t68 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td class=t67>
<![endif]-->
<!--[if !mso]>-->
<td class=t67>
<!--<![endif]-->
<p class=t66 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:13px;text-decoration:none;text-transform:none;direction:ltr;color:#949494;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;">Telf: 0212-999-99-99 / 0212-888-88-88</p></td>
</tr></table>
</td></tr><tr><td align=center>
<table class=t71 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td class=t70>
<![endif]-->
<!--[if !mso]>-->
<td class=t70>
<!--<![endif]-->
<p class=t69 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:13px;text-decoration:none;text-transform:none;direction:ltr;color:#949494;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;">Dirección fisica de paymed Global&nbsp;</p></td>
</tr></table>
</td></tr></table></td>
</tr></table>
</td></tr><tr><td align=center>
<table class=t75 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=600 class=t74 style="padding:20px 20px 20px 20px;">
<![endif]-->
<!--[if !mso]>-->
<td class=t74 style="width:560px;padding:20px 20px 20px 20px;">
<!--<![endif]-->
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
