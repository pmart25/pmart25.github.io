<?
/**
*
*  project  NCM_Backup
*  @file send_mail.php
*  @user pablo torrico
*  email  p_torrico@hotmail.com
*  url  www.neoconceptmedia.com
*  @brief   functions for backup and send to e-mail address.
*/






function send_email ( $para, $file ) {


$boundary   = md5(uniqid(time()));

$titulo    = 'Backup DB';
$mensaje   = 'Hola';
$headers = 'From: "Testing account" webmaster@ncp.freeiz.com'."\r\n".'Reply-To: "WB" webmaster@ncp.freeiz.com'."\r\n" .'X-Mailer: PHP' . phpversion();
$headers .= 'Content-Disposition: attachment;' . "\n";
$headers .= 'Content-Type: Application/Octet-Stream; name="' . $file . "\"\n";
$headers .= 'Content-Transfer-Encoding: base64' . "\n\n";
$headers .= chunk_split(base64_encode(implode('', file($file)))) . "\n";
$headers .= '--' . $boundary . '--' . "\n";
mail($para, $titulo, $mensaje, $headers);



}

?>