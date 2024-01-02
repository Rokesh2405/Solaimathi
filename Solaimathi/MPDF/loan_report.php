<?php
require_once __DIR__ . '/vendor/autoload.php';
// error_reporting(1);
// ini_set('display_errors','1');
// error_reporting(E_ALL);
include '../config/config.inc.php';

$cusdetails = FETCH_all("SELECT * FROM `customer` WHERE `id` = ?", $_REQUEST['id']);
$settingdetails = FETCH_all("SELECT * FROM `users` WHERE `id` = ?", '1');

$message.='<div style="border: 1px;">
<table style="width:100%; font-family:arial;" cellpadding="10" cellspacing="2" border="1">
              <tr>
             <td colspan="4" align="center">
              Customer Details
             </td>
             </tr>
             <tr>
             <td>Reg No</td>
             <td>'.$settingdetails['regno'].'</td>
              <td>Vehicle No</td>
             <td>'.$cusdetails['regno'].'</td>
             </tr>
             <tr>
             <td>Customer Name</td>
             <td>'.$cusdetails['name'].'</td>
              <td>Vehicle Name</td>
             <td>'.getbike('bike_name',$cusdetails['vehicle_name']).'</td>
            </tr>
              <tr>
             <td>Residence Address1</td>
             <td>'.$cusdetails['cus_street'].'</td>
              <td>Mobile</td>
             <td>'.$cusdetails['mobileno'].'</td>
            </tr>
             
              <tr>
             <td>Address2</td>
             <td>'.getcustomer('cus_area',$_REQUEST['id']).','.getcustomer('cus_city',$_REQUEST['id']).'</td>
              <td>Phone</td>
             <td>'.$cusdetails['alt_mobileno'].'</td>
            </tr>
             <tr>
             <td>Address3</td>
             <td>'.$cusdetails['cus_state'].'</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
            </tr>
              </table>
            
            <br>
            <table style="width:100%; font-family:arial;" cellpadding="10" cellspacing="2" border="1">
              <tr>
             <td colspan="4" align="center">
              Loan Details
             </td>
             </tr>
             <tr>
             <td>Loan Amount</td>
             <td>'.$cusdetails['loan_amount'].'</td>';
if(getcustomer('vehicle_type',$_REQUEST['id'])=='1') {
                                    $loantype="Bike Loan";
                                   }
                                  
                                   if(getcustomer('vehicle_type',$_REQUEST['id'])=='2') {
                                   $loantype="Car Loan";
                                   }
                                   if(getcustomer('vehicle_type',$_REQUEST['id'])=='3') {
                                    $loantype="Daily Loan";
                                   }
                                   if(getcustomer('vehicle_type',$_REQUEST['id'])=='4') {
                                    $loantype="Weekly Loan";
                                   }
                                   if(getcustomer('vehicle_type',$_REQUEST['id'])=='5') {
                                    $loantype="Monthly Loan";
                                   }

              $message .='<td>Loan Type</td>
             <td>'.$loantype.'</td>
             </tr>
             <tr>
             <td>Interest Percentage %</td>
             <td>'.$cusdetails['interest_percentage'].'</td>
              <td>EMI Amount</td>
             <td>'.$cusdetails['due_amt_per_month'].'</td>
            </tr>
             

              </table>
              <br>
            <table style="width:100%; font-family:arial;" cellpadding="10" cellspacing="2" border="1">
              <tr>
             <td colspan="8" align="center">
              EMI Details
             </td>
             </tr>
             <tr>
<th>Sno</th>
<th>Due Date</th>
<th>Emi Amount</th>
<th>Priniciple Amount</th>
<th>Interest Amount</th>
<th>Late Fee</th>
<th>Status</th>
<th>Paid Date</th>    
</tr>';
$sno=1;
 $loans = pFETCH("SELECT * FROM `loans` WHERE `loanid`=?", $_REQUEST['id']);
 while ($loansfetch = $loans->fetch(PDO::FETCH_ASSOC)) {
      $message .='<tr>
       <td>'.$sno.'</td>
        <td>'.date('d-m-Y',strtotime($loansfetch['due_date'])).'</td>
        <td>'.$loansfetch['due_amount'].'</td>
      <td>'.$loansfetch['principle_amount'].'</td>
      <td>'.$loansfetch['loan_interest'].'</td>
      <td>'.$loansfetch['interest_amount'].'</td>
      <td>Paid</td>
      <td>'.date('d-m-Y',strtotime($loansfetch['date'])).'</td>
      </tr>';
$sno++;
}

            $message .='</table>
			  </div>';             

$mpdf = new mPDF();
$mpdf->SetDisplayMode('default');
$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
$filename = "test.txt";

$file = fopen($filename, "w");
fwrite($file, $message);
$mpdf->SetTitle('Loan Report');
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
