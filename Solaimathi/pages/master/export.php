<?php include ('../../config/config.inc.php');
//Customer Report
if($_REQUEST['type']=='customer') {
$filename = "customer_report.csv";
$fp = fopen('php://output', 'w');

$header=array("Date","Customer Name","Mobileno","Emailid","Total Ordes");

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);


$s='';


if($_REQUEST['customername']!='')
{
$s1[]="`name` LIKE '%".$_REQUEST['customername']."%' ";
}
if($_REQUEST['mobileno']!='')
{
$s1[]="`mobileno` ='".$_REQUEST['mobileno']."' ";
}								 

if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}
$m=1;
if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}
if($s!='') { 
$message1 = $db->prepare("SELECT * FROM `customer` WHERE `id`!='0' AND $s");
}
else{
$message1 = $db->prepare("SELECT * FROM `customer` WHERE `id`!='0'");	
}

$message1->execute();
while($message = $message1->fetch(PDO::FETCH_ASSOC)) 
{
	$orders = $db->prepare("SELECT * FROM `orders` WHERE `customer_id`='".$message['id']."'");		
$orders->execute();
$ordersnum = $orders->rowCount();
													 
if($message['cudate']!='')
{
$date=date('d-m-Y h:i:s',strtotime($message['date']));  
}
else
{
$date='-';  
}   

if($message['name']!='') {
$cusname=$message['name'];
}
else
{
$cusname='-';	
}

if($message['mobileno']!='') {
$cusmobileno=$message['mobileno'];
}
else
{
$cusmobileno='-';	
}

if($message['emailid']!='') {
$cusemailid=$message['emailid'];
}
else
{
$cusemailid='-';	
}


      $res=array($date,$cusname,$cusmobileno,$cusemailid,$ordersnum);  
     fputcsv($fp, $res);
} 
exit;	
}
//Order Report
if($_REQUEST['type']=='order') {
$filename = "customer_report.csv";
$fp = fopen('php://output', 'w');

$header=array("Orderid","User Name","Store","User Mobileno","Order On","Status","Total","Items");

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);


$s='';

 if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$s1[]="(date(`date`)>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND date(`date`)<='".date('Y-m-d',strtotime($_REQUEST['todate']))."')";
}
if($_REQUEST['subadmin']!='')
{
$s1[]="`subadmin`='".$_REQUEST['subadmin']."'";
}
if($_REQUEST['vendorid']!='')
{
$s1[]="`vendor_id`='".$_REQUEST['vendorid']."'";
}
if($_REQUEST['customerid']!='')
{
$s1[]="`customer_id`='".$_REQUEST['customerid']."'";
}

if($_REQUEST['payment_mode']!='')
{
$s1[]="`payment_mode`='".$_REQUEST['payment_mode']."'";
}


if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}

$sno=1;
if($s!='') { 
 $message1 = $db->prepare("SELECT * FROM `orders` WHERE `id`!='0' AND $s ORDER BY `date` DESC");
}
else{
$message1 = $db->prepare("SELECT * FROM `orders` WHERE `id`!='0' ORDER BY `date` DESC");	
}

 $message1->execute();
while($fdepart = $message1->fetch(PDO::FETCH_ASSOC)) {

$items = $db->prepare("SELECT * FROM `norder` WHERE `order_id`='".$fdepart['id']."'");
$items->execute();
$itemscount = $items->rowCount();
													 
  
if(getcustomer('name',$fdepart['customer_id'])!=''){
	$cusname=getcustomer('name',$fdepart['customer_id']);
}
else
{
	$cusname='-';
}
if(getvendor('name',$fdepart['vendor_id'])!=''){
	$vendor=getvendor('name',$fdepart['vendor_id']);
}
else
{
	$vendor='-';
}

if(getcustomer('mobileno',$fdepart['customer_id'])!=''){
	$cusmobile=getcustomer('mobileno',$fdepart['customer_id']);
}
else
{
	$cusmobile='-';
}

if($fdepart['date']!=''){
	$cudate=date('D, M d, Y h:i A',strtotime($fdepart['date']));
}
else
{
	$cudate='-';
}

if($fdepart['deliver_status']!=''){
	$deliver_status=$fdepart['deliver_status'];
}
else
{
	$deliver_status='-';
}
if($fdepart['grand_total']!=''){
	$grand_total='Rs.'.$fdepart['grand_total'];
}
else
{
	$grand_total='-';
}
$orid=$fdepart['id'];
 $res=array($orid,$cusname,$vendor,$cusmobile,$cudate,$deliver_status,$grand_total,$itemscount);  
 
     fputcsv($fp, $res);
} 
exit;	
}
//Commission Report
if($_REQUEST['type']=='commission') {
$filename = "commission_report.csv";
$fp = fopen('php://output', 'w');

$header=array("Date","Orderid","Subadmin","Vendor","Payment Mode","Amount","Admin Commission","Subadmin Commission","Vendor Amount","Status");

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);

$s='';

 if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$s1[]="(date(`date`)>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND date(`date`)<='".date('Y-m-d',strtotime($_REQUEST['todate']))."')";
}

if($_REQUEST['status']!='')
{
$s1[]="`commission_status`='".$_REQUEST['status']."'";
}


if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}

$sno=1;
if($s!='') { 
 $message1 = $db->prepare("SELECT * FROM `orders` WHERE `id`!='0' AND $s ORDER BY `date` DESC");
}
else{
$message1 = $db->prepare("SELECT * FROM `orders` WHERE `id`!='0' ORDER BY `date` DESC");	
}

 $message1->execute();
while($commsilist = $message1->fetch(PDO::FETCH_ASSOC)) {


if($commsilist['date']!=''){
	$cudate=date('d-m-Y',strtotime($commsilist['date']));
}
else
{
	$cudate='-';
}
if($commsilist['id']!=''){
	$orderid="#CORD".$commsilist['id'];
}
else
{
	$orderid='-';
}

if(getsubadmin('name',getvendor('subadmin',$commsilist['vendor_id']))!=''){
	$subadmin=getsubadmin('name',getvendor('subadmin',$commsilist['vendor_id']));
}
else
{
	$subadmin='-';
}

if(getvendor('name',$commsilist['vendor_id'])!=''){
	$vendor=getvendor('name',$commsilist['vendor_id']);
}
else
{
	$vendor='-';
}

if($commsilist['payment_mode']!=''){
	if($commsilist['payment_mode']=='2') {  $paymentmode="Credit/Debit Card"; } if($commsilist['payment_mode']=='3') {  $paymentmode="UPI Payment"; }  if($commsilist['payment_mode']=='1') {  $paymentmode="Cash On Delivery"; }
}
else
{
	$paymentmode='-';
}

if($commsilist['grand_total']!='') {
	$grand_total=$commsilist['grand_total'];
}
else
{
	$grand_total='';
}

if($commsilist['grand_total']!='') {
	$grand_total=$commsilist['grand_total'];
}
else
{
	$grand_total='';
}

$admincomm=getusers('commission_amt',$_SESSION['GRUID']);
$admin_amt=$commsilist['grand_total']*($admincomm/100);
$ssubadmincomm=getsubadmin('commission_amt',getvendor('subadmin',$commsilist['vendor_id']));
$subadmin_amt=$commsilist['grand_total']*($ssubadmincomm/100);									
$admin_commission=$commsilist['grand_total']-$admin_amt;
$subadmin_commission=$admin_commission-$subadmin_amt;
	
if($commsilist['commission_status']=='1') { $cmstatus="Paid"; }
									else { $cmstatus="Un Paid";}
									
 $res=array($cudate,$orderid,$subadmin,$vendor,$paymentmode,$grand_total,$admin_amt,$subadmin_amt,$subadmin_commission,$cmstatus);  
 
     fputcsv($fp, $res);
} 
exit;	
}

//Expense Report
if($_REQUEST['type']=='expense') {
$filename = "expense_report.csv";
$fp = fopen('php://output', 'w');

$header=array("Date","Expense Type","Rate","Comment");

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$s1[]="(`date`>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND `date`<='".date('Y-m-d',strtotime($_REQUEST['todate']))."')";
}
if($_REQUEST['expense_type']!='')
{
$s1[]="`expense_type`='".$_REQUEST['expense_type']."'";
}


if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}
if($s!='') { 
$message1 = $db->prepare("SELECT * FROM `expense` WHERE `id`!='0' AND $s");
}
else{
$message1 = $db->prepare("SELECT * FROM `expense` WHERE `id`!='0'");	
}

$message1->execute();
while($message = $message1->fetch(PDO::FETCH_ASSOC)) 
{
    if($message['date']!='')
     {
       $date=date("d-m-Y",strtotime($message['date']));  
     }
     else
     {
       $date='-';  
     }   
 
if($message['expense_type']!='') {
$exptype=getexpensetype('expense_type',$message['expense_type']);
}
else
{
$exptype='-';
}

	 
if($message['amount']!='') {
$amount=$message['amount'];
}
else
{
$amount='-';	
}

if($message['comment']!='') {
$comment=$message['comment'];
}
else
{
$comment='-';	
}
      $res=array($date,$exptype,$amount,$comment);  
     fputcsv($fp, $res);
}
exit;	
}


?>