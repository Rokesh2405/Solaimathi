<?php 
include ('../../config/config.inc.php');
$cname=getcustomer('name',$_REQUEST['loanid']);
$bikename=getbike('bike_name',getcustomer('vehicle_name',$_REQUEST['loanid']));

$prinamt=getcustomer('loan_amount',$_REQUEST['loanid'])/getcustomer('noof_month_due',$_REQUEST['loanid']);
$insamt=$prinamt*(getcustomer('interest_percentage',$_REQUEST['loanid'])/100);
$dueamount=getcustomer('due_amt_per_month',$_REQUEST['loanid']);
$vehicle_type=getcustomer('vehicle_type',$_REQUEST['loanid']);
echo $cname.'#'.$bikename.'#'.$dueamount.'#'.$vehicle_type.'#'.$prinamt.'#'.$insamt;
exit;
?>