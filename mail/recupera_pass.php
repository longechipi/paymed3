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
    $mail->Subject = 'Recuperacion de Contraseña' ;
    $mail->Body    = '<!--
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
.t1,.t44,.t53{width:420px!important}.t39,.t42{text-align:center!important}.t26,.t39,.t40{display:block!important}.t53{padding-left:30px!important;padding-right:30px!important}.t17,.t19{width:358px!important}.t26{mso-line-height-alt:14px!important;line-height:14px!important}.t22,.t24,.t34,.t36{width:5px!important;display:revert!important}.t27,.t38{vertical-align:middle!important;display:inline-block!important;width:100%!important}.t27{max-width:98px!important}.t38{max-width:805px!important}.t32{width:650px!important}.t55{width:440px!important}
}
</style>
<style type="text/css">@media (max-width: 480px) {[class~="x_t53"]{padding-left:30px!important;padding-right:30px!important;width:420px!important;} [class~="x_t1"]{width:420px!important;} [class~="x_t19"]{width:358px!important;} [class~="x_t44"]{width:420px!important;} [class~="x_t42"]{text-align:center!important;} [class~="x_t40"]{display:block!important;} [class~="x_t39"]{display:block!important;text-align:center!important;} [class~="x_t26"]{mso-line-height-alt:14px!important;line-height:14px!important;display:block!important;} [class~="x_t22"]{width:5px!important;display:revert!important;} [class~="x_t24"]{width:5px!important;display:revert!important;} [class~="x_t27"]{vertical-align:middle!important;display:inline-block!important;width:100%!important;max-width:98px!important;} [class~="x_t34"]{width:5px!important;display:revert!important;} [class~="x_t36"]{width:5px!important;display:revert!important;} [class~="x_t38"]{vertical-align:middle!important;display:inline-block!important;width:100%!important;max-width:805px!important;} [class~="x_t32"]{width:650px!important;} [class~="x_t17"]{width:358px!important;} [class~="x_t55"]{width:440px!important;}}</style>
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
<body id=body class=t59 style="min-width:100%;Margin:0px;padding:0px;background-color:#FAFAFA;"><div class=t58 style="background-color:#FAFAFA;"><table role=presentation width=100% cellpadding=0 cellspacing=0 border=0 align=center><tr><td class=t57 style="font-size:0;line-height:0;mso-line-height-rule:exactly;background-color:#FAFAFA;" valign=top align=center>
<!--[if mso]>
<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false">
<v:fill color=#FAFAFA/>
</v:background>
<![endif]-->
<table role=presentation width=100% cellpadding=0 cellspacing=0 border=0 align=center id=innerTable><tr><td align=center>
<table class=t54 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=630 class=t53 style="background-color:#E6E8F0;padding:40px 60px 22px 60px;">
<![endif]-->
<!--[if !mso]>-->
<td class=t53 style="background-color:#E6E8F0;width:510px;padding:40px 60px 22px 60px;">
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
<p class=t8 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:18px;text-decoration:none;text-transform:none;direction:ltr;color:#454545;text-align:center;mso-line-height-rule:exactly;mso-text-raise:1px;">Hemos detectado que ha olvidado su contraseña. Por favor, utilice la contraseña temporal que le hemos proporcionado para acceder a su cuenta. Recuerde actualizarla lo antes posible para garantizar la seguridad de su información.</p></td>
</tr></table>
</td></tr><tr><td><div class=t11 style="mso-line-height-rule:exactly;mso-line-height-alt:22px;line-height:22px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t20 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=510 class=t19 style="border:1px solid #E3E3E3;overflow:hidden;padding:14px 30px 16px 30px;border-radius:6px 6px 0 0;">
<![endif]-->
<!--[if !mso]>-->
<td class=t19 style="border:1px solid #E3E3E3;overflow:hidden;width:448px;padding:14px 30px 16px 30px;border-radius:6px 6px 0 0;">
<!--<![endif]-->
<table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"><tr><td align=center>
<table class=t14 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td class=t13>
<![endif]-->
<!--[if !mso]>-->
<td class=t13 style="width:auto;">
<!--<![endif]-->
<p class=t12 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:bold;font-style:normal;font-size:18px;text-decoration:none;text-transform:none;direction:ltr;color:#222A55;text-align:left;mso-line-height-rule:exactly;mso-text-raise:1px;">CONTRASEÑA TEMPORAL</p></td>
</tr></table>
</td></tr><tr><td><div class=t15 style="mso-line-height-rule:exactly;mso-line-height-alt:14px;line-height:14px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t18 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=448 class=t17>
<![endif]-->
<!--[if !mso]>-->
<td class=t17 style="width:448px;">
<!--<![endif]-->
<p class=t16 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:30px;text-decoration:none;text-transform:none;direction:ltr;color:#454545;text-align:center;mso-line-height-rule:exactly;mso-text-raise:-2px;">'.$clave_tmp.'</p></td>
</tr></table>
</td></tr></table></td>
</tr></table>
</td></tr><tr><td><div class=t43 style="mso-line-height-rule:exactly;mso-line-height-alt:5px;line-height:5px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t45 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=510 class=t44 style="border-bottom:2px solid #EEEEEE;border-top:2px solid #EEEEEE;padding:19px 0 25px 0;">
<![endif]-->
<!--[if !mso]>-->
<td class=t44 style="border-bottom:2px solid #EEEEEE;border-top:2px solid #EEEEEE;width:510px;padding:19px 0 25px 0;">
<!--<![endif]-->
<div class=t42 style="width:100%;text-align:left;"><div class=t41 style="display:inline-block;"><table class=t40 role=presentation cellpadding=0 cellspacing=0 align=left valign=middle>
<tr class=t39><td></td><td class=t27 width=175.07477 valign=middle>
<table role=presentation width=100% cellpadding=0 cellspacing=0 class=t25 style="width:100%;"><tr>
<td class=t22 style="width:22px;" width=22></td><td class=t23 style="background-color:transparent;"><div style="font-size:0px;"><img class=t21 style="display:block;border:0;height:auto;width:100%;Margin:0;max-width:100%;" width=131.07476635514018 height=102.1875 alt="" src="https://paymed.wgdigital.com.ve/assets/img/logos/logos.png"/></div></td><td class=t24 style="width:22px;" width=22></td>
</tr></table>
<!--[if !mso]>-->
<div class=t26 style="mso-line-height-rule:exactly;font-size:1px;display:none;">&nbsp;&nbsp;</div>
<!--<![endif]-->
</td><td class=t38 width=422.92523 valign=middle>
<table role=presentation width=100% cellpadding=0 cellspacing=0 class=t37 style="width:100%;"><tr>
<td class=t34 style="width:22px;" width=22></td><td class=t35><table role=presentation width=100% cellpadding=0 cellspacing=0 style="width:100% !important;"><tr><td align=center>
<table class=t33 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=378.92523364485976 class=t32>
<![endif]-->
<!--[if !mso]>-->
<td class=t32 style="width:378.93px;">
<!--<![endif]-->
<p class=t31 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:400;font-style:normal;font-size:16px;text-decoration:none;text-transform:none;direction:ltr;color:#007DBA;text-align:center;mso-line-height-rule:exactly;mso-text-raise:2px;"><span class=t28 style="margin:0;Margin:0;mso-line-height-rule:exactly;">Si tienes algun problema técnico para entrar en la plataforma por favor</span> <a class=t30 href="https://www.google.com" style="margin:0;Margin:0;font-weight:700;font-style:normal;text-decoration:none;direction:ltr;color:#007DBA;mso-line-height-rule:exactly;" target=_blank><span class=t29 style="margin:0;Margin:0;font-style:italic;mso-line-height-rule:exactly;">Contactanos</span></a></p></td>
</tr></table>
</td></tr></table></td><td class=t36 style="width:22px;" width=22></td>
</tr></table>
</td>
<td></td></tr>
</table></div></div></td>
</tr></table>
</td></tr><tr><td><div class=t46 style="mso-line-height-rule:exactly;mso-line-height-alt:13px;line-height:13px;font-size:1px;display:block;">&nbsp;&nbsp;</div></td></tr><tr><td align=center>
<table class=t49 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td class=t48>
<![endif]-->
<!--[if !mso]>-->
<td class=t48>
<!--<![endif]-->
<p class=t47 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:13px;text-decoration:none;text-transform:none;direction:ltr;color:#949494;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;">Telf: 0212-999-99-99 / 0212-888-88-88</p></td>
</tr></table>
</td></tr><tr><td align=center>
<table class=t52 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td class=t51>
<![endif]-->
<!--[if !mso]>-->
<td class=t51>
<!--<![endif]-->
<p class=t50 style="margin:0;Margin:0;font-family:Poppins,BlinkMacSystemFont,Segoe UI,Helvetica Neue,Arial,sans-serif;line-height:22px;font-weight:500;font-style:normal;font-size:13px;text-decoration:none;text-transform:none;direction:ltr;color:#949494;text-align:center;mso-line-height-rule:exactly;mso-text-raise:3px;">Dirección fisica de paymed Global&nbsp;</p></td>
</tr></table>
</td></tr></table></td>
</tr></table>
</td></tr><tr><td align=center>
<table class=t56 role=presentation cellpadding=0 cellspacing=0 style="Margin-left:auto;Margin-right:auto;">
<tr>
<!--[if mso]>
<td width=600 class=t55 style="padding:20px 20px 20px 20px;">
<![endif]-->
<!--[if !mso]>-->
<td class=t55 style="width:560px;padding:20px 20px 20px 20px;">
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
