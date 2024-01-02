<?php
require_once __DIR__ . '/vendor/autoload.php';
// error_reporting(1);
// ini_set('display_errors','1');
// error_reporting(E_ALL);
include '../config/config.inc.php';

$appointment = FETCH_all("SELECT * FROM `register` WHERE `id` = ?", $_REQUEST['id']);
$message.='<div style="border: 1px;">
<table style="width:100%; font-family:arial; font-size:15px;" cellpadding="0" cellspacing="0">
              <tr>
                   <td style="width:100%; text-align:center;"><h2 style="color:#285D6B;">'.$appointment['mothername'].' Register Details</h2></td>
             </tr>
              <tr>
             <td colspan="4"><hr></td>
             </tr>
              </table>
              <br><br>
<table style="font-family:arial; font-size:15px;" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                   <td style="width:25%;"><strong>Name :</strong></td>
				 <td style="width:25%;">'.$appointment['name'].'</td>
				 <td style="width:25%;"><strong>Mobile no :</strong></td>
				 <td style="width:25%;">'.$appointment['mobileno'].'</td>
				 
             </tr>
             <tr>
             <td colspan="4">&nbsp;</td>
             </tr>
             <tr>
                   <td style="width:25%;"><strong>Email :</strong></td>
				 <td style="width:25%;">'.$appointment['email'].'</td>
				 <td style="width:25%;"><strong>Address :</strong></td>
				 <td style="width:25%;">'.$appointment['address'].'</td>
				 
             </tr>
			   <tr>
             <td colspan="4">&nbsp;</td>
             </tr>
             <tr>
                   <td style="width:25%;"><strong>Token :</strong></td>
				 <td style="width:25%;">'.$appointment['token'].'</td>
				 <td style="width:25%;"><strong>Device Key :</strong></td>
				 <td style="width:25%;">'.$appointment['device_key'].'</td>
				 
             </tr>
			<tr>
             <td colspan="4">&nbsp;</td>
             </tr>
             <tr>
                   <td style="width:25%;"><strong>Password :</strong></td>
				 <td style="width:25%;">'.$appointment['password'].'</td>
				 <td style="width:25%;"><strong>Confirm Password :</strong></td>
				 <td style="width:25%;">'.$appointment['new_password'].'</td>
				 
             </tr>
             	<tr>
             <td colspan="4">&nbsp;</td>
             </tr>
             <tr>
                   <td style="width:25%;"><strong>Country :</strong></td>
				 <td style="width:25%;">'.$appointment['country'].'</td>
				 <td style="width:25%;"><strong>State :</strong></td>
				 <td style="width:25%;">'.$appointment['state'].'</td>
				 
             </tr>
             	<tr>
             <td colspan="4">&nbsp;</td>
             </tr>
             <tr>
                   <td style="width:25%;"><strong>District :</strong></td>
				 <td style="width:25%;">'.$appointment['district'].'</td>
				 <td style="width:25%;"><strong>Status :</strong></td>
				 <td style="width:25%;">'.$appointment['status'].'</td>
				 
             </tr>
             	<tr>
             <td colspan="4">&nbsp;</td>
             </tr>
            </table>
              <br>
			  
			  </div>';             

$mpdf = new mPDF();
$mpdf->SetDisplayMode('default');
$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
$filename = "test.txt";

$file = fopen($filename, "w");
fwrite($file, $message);
$mpdf->SetTitle($appointment['mothername']);
$mpdf->keep_table_proportions = false;
$mpdf->shrink_this_table_to_fit = 0;
$mpdf->SetAutoPageBreak(true, 10);
$mpdf->WriteHTML(file_get_contents($filename));
//$mpdf->SetWatermarkImage('jiovio.png', 0.10, 'F');
//$mpdf->showWatermarkImage = true;
$mpdf->setAutoBottomMargin = 'stretch';
//$mpdf->setHTMLFooter('<div style="border-top: 0.1mm solid #000000;"><table width="100%"><tr><td colspan="2" align="center"><b>Healthcare</b></td></tr><tr><td><b>E-mail : </b>'.gethospital('emailid',$appointment['hospitalid']).'</td><td align="right"><b>For Support</b><br>'.gethospital('contactno',$appointment['hospitalid']).'</td></tr></table>');
$filename=$appointment['mothername'].'.pdf';
$mpdf->Output($filename, 'I');
?>
