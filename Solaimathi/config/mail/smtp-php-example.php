<?php
require 'vendor/autoload.php';
Dotenv::load(__DIR__);

$sendgrid_username = 'nbaysmart';
$sendgrid_password = 'Winner123';
$to                = 'thiyakarajan.pa@gmail.com';

$transport  = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
$transport->setUsername($sendgrid_username);
$transport->setPassword($sendgrid_password);

$mailer     = Swift_Mailer::newInstance($transport);

$message    = new Swift_Message();
$message->setTo($to);
$message->setFrom($to);
$message->setSubject("test");
$message->setBody("<table><tr><td><b>and easy to do anywhere, even with PHP</b></td></tr></table>");

$header           = new Smtpapi\Header();
/*$header->addSubstitution("%yourname%", array("Mr. Owl"));
$header->addSubstitution("%how%", array("Owl"));*/

$message_headers  = $message->getHeaders();
$message_headers->addTextHeader("x-smtpapi", $header->jsonString());

try {
  $response = $mailer->send($message);
  print_r($response);
} catch(\Swift_TransportException $e) {
  print_r($e);
  print_r('Bad username / password');
}
