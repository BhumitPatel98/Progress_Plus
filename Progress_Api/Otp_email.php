<?php 
 $html="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>\Progress Plus</title><style>div, p, a, li, td{-webkit-text-size-adjust: none;font-family: Open Sans, Helvetica, Arial, Verdana, sans-serif;}body{font-family: Open Sans, Helvetica, Arial, Verdana, sans-serif;}table{mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;}img{display: block;}a{text-decoration: none;font-family: Open Sans, Helvetica, Arial, Verdana, sans-serif;color: inherit !important;}p{margin: 0px;padding: 0px;font-family:inherit;}.tpl-content{padding: 0px !important;}.width_100{max-width: 800px;width: 100%;}img{max-width: 100%;height: auto;}@media only screen and (max-width: 820px){.width_100{width: 100%;}}@media only screen and (max-width: 720px){.img-center img{margin: 0 auto !important;}.img-right img{float: none !important;text-align: right;text-align: -webkit-right;}.img-left img{float: none !important;text-align: left;text-align: -webkit-left;}.erase{display: none;height: 0px;}.text-center{float: none !important;text-align: center;text-align: -webkit-center;}.text-left{float: none !important;text-align: left;text-align: -webkit-left;}.text-right{float: none !important;text-align: right;text-align: -webkit-right;}.padding-top{padding-top: 10px;}.padding-top-60{padding-top: 60px !important;height: auto;display: block;}.padding-bottom-60{padding-bottom: 60px !important;height: auto;display: block;}}@media only screen and (max-width: 420px){.width_100percent{width: 100% !important;max-width: 100%;margin: 0 auto !important;height: auto!important;}.width_90percent{width: 90% !important;max-width: 90%;margin: 0 auto !important;height: auto!important;}.display-block{display: block !important;height: auto !important;margin: 0 auto !important;width: 100% !important;padding-left: 0px !important;padding-right: 0px !important;}.full-width-img img{width: 100%;height: auto;}.logo-icon img{max-width: 75%;height: auto;}.padding{padding: 10px 0px;}br{display: none;}}</style></head><body marginwidth='0' marginheight='0' style='margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0; width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;' offset='0' topmargin='0' leftmargin='0'><div id='edit_link' class='hidden' style='display: none; left: 350px; top: 151px;'><div class='close_link' style='display: none;'></div><input id='edit_link_value' class='createlink' placeholder='Your URL' style='display: none;' type='text'><div id='change_image_wrapper'><div id='change_image'><p id='change_image_button'>Change &nbsp; <span class='pixel_result'>164 x 29</span></p></div><input value='' id='change_image_link' type='button'><input value='' id='remove_image' type='button'></div><div id='tip'></div></div><table class='width_100' style='border-collapse:collapse;' data-module='Profile-Uadated 2' width='800' cellspacing='0' cellpadding='0' border='0' align='center'><tr><td data-bgcolor='Profile-Uadated 2' width='100%' valign='middle' bgcolor='#4a83ff' align='center'><table style='border-collapse: collapse;' width='100%' cellspacing='0' cellpadding='0' border='0' align='center'><tr><td style='line-height:1px;' width='100%' height='51'></td></tr><tr><td style='line-height:1px;' width='100%' height='51'></td></tr><tr><td class='' width='100%' valign='middle' align='center'><table class='width_90percent' style='border-collapse: collapse; max-width:90%; -webkit-border-radius: 10px; border-radius: 10px;' data-bgcolor='Box Color' width='400' cellspacing='0' cellpadding='0' border='0' bgcolor='#FFFFFF' align='center'><tr><td class='' width='100%' valign='middle' align='center'><table class='width_90percent' style='border-collapse: collapse; max-width:90%;' width='300' cellspacing='0' cellpadding='0' border='0' align='center'><tr><td style='line-height:1px; padding-top: 30px;' width='100%' valign='middle' align='center' ><a href='http://birdsofindia.co.in/' target='_blank' style='display: inline-block; color: rgb(235, 77, 0);'><img src='img/logo.png' alt='Logo' class='' style='height: 75px;width: 188px;' border='0'></a></td></tr><tr><td data-size='Title' data-min='12' data-max='20' data-color='Title' style='margin:0px; padding:20px 0; font-size:16px; color:#000000; font-family: Open Sans, Helvetica, Arial, Verdana, sans-serif; font-weight:bold;' class='' width='100%' valign='middle' align='center'>We have received request to reset your password.</td></tr><tr><td class='display-block padding' style='line-height:1px;' width='100%' height='20'><br></td></tr><tr><td data-size='Description' data-min='12' data-max='20' data-color='Description' style='margin:0px; padding:0px; font-size:12px; color:#000000; font-family: Open Sans, Helvetica, Arial, Verdana, sans-serif; font-weight:normal; line-height:24px; ' class='' width='100%' valign='middle' align='center'><p><b> Dear ".$name."</b></p><p><b>".$otp."</b>  is Your One Time Password to Reset Password On Progress Plus. </p><p>Please Note Otp Is Valid For 30 Mins Only.</p> </td></tr><tr><td class='display-block padding' style='line-height:1px;' width='100%' height='30'><br></td></tr></table></td></tr></table></td></tr><tr><td style='line-height:1px;' width='100%' height='42'></td></tr><tr><td style='line-height:1px;' width='100%' height='37'></td></tr></table></td></tr></table></body></html>";

?>
<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('Asia/Calcutta');

require_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = $html;
//$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
include_once("mail_config.php");

$mail->SetFrom('sagarjagani9@gmail.com', 'Progress Plus');

$mail->AddReplyTo('sagarjagani9@gmail.com', 'Progress Plus');

$mail->Subject    = "Otp To Reset Progress Plus Password";

//$mail->AltBody    = "testing email from Current Server"; // optional, comment out and test

$mail->MsgHTML($body);

$mail->AddAddress($Email, $name);

//$mail->addAttachment('images/1.png');



if(!$mail->Send()) {
 
} else {
}

?>