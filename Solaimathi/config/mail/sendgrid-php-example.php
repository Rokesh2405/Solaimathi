<?php

//include '../config.inc.php';
require 'vendor/autoload.php';
//Dotenv::load(__DIR__);

function sendgridmail($to, $message, $subject, $from, $attachment, $attchment_name) {
    $sendgrid_username = getsendgrid('username', '1');

    $sendgrid_password = getsendgrid('password', '1');
    if (getsendgrid('semail', '1') != '') {
        $from = getsendgrid('semail', '1');
    }
    if (getsendgrid('saddress', '1') != '') {
        $fromname = getsendgrid('saddress', '1');
    }

    $sendgrid = new SendGrid($sendgrid_username, $sendgrid_password, array("turn_off_ssl_verification" => true));
    $email = new SendGrid\Email();
    $email->addTo($to)->
            setFrom($from)->
            setSubject($subject)->
            setText('')->
            setFromname($fromname)->
            setHtml($message)->
            addSubstitution("%yourname%", array("Mr. Owl"))->
            addSubstitution("%how%", array("Owl"))->
            addHeader('X-Sent-Using', 'SendGrid-API')->
            addHeader('X-Transport', 'web'); /* ->
      addAttachment($attachment, $attchment_name); */
    $response = $sendgrid->send($email);
}

function sendgridmail1($to, $message, $subject, $from, $attachment, $attchment_name) {
    $sendgrid_username = getsendgrid('username', '1');

    $sendgrid_password = getsendgrid('password', '1');
    //$from = getprofile('recoveryemail', '1');
    //$from = 'tp.selvakumar@gmail.com';
    $sendgrid = new SendGrid($sendgrid_username, $sendgrid_password, array("turn_off_ssl_verification" => true));
    $email = new SendGrid\Email();
    $email->addTo($to)->
            setFrom($from)->
            setSubject($subject)->
            setText('')->
            setHtml($message)->
            addSubstitution("%yourname%", array("Mr. Owl"))->
            addSubstitution("%how%", array("Owl"))->
            addHeader('X-Sent-Using', 'SendGrid-API')->
            addHeader('X-Transport', 'web'); /* ->
      addAttachment($attachment, $attchment_name); */

    $response = $sendgrid->send($email);
}

function sendgridmailresponse($to, $message, $subject, $attachment, $attchment_name) {
    $sendgrid_username = getsendgrid('username', '1');

    $sendgrid_password = getsendgrid('password', '1');
    $from = getprofile('recoveryemail', '1');
    //$from = 'tp.selvakumar@gmail.com';
    $sendgrid = new SendGrid($sendgrid_username, $sendgrid_password, array("turn_off_ssl_verification" => true));
    $email = new SendGrid\Email();
    $email->addTo($to)->
            setFrom($from)->
            setSubject($subject)->
            setText('')->
            setHtml($message)->
            addSubstitution("%yourname%", array("Mr. Owl"))->
            addSubstitution("%how%", array("Owl"))->
            addHeader('X-Sent-Using', 'SendGrid-API')->
            addHeader('X-Transport', 'web'); /* ->
      addAttachment($attachment, $attchment_name); */

    $response = $sendgrid->send($email);
    //var_dump($response);
    //return $response;
}
