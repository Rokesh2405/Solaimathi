<?php
function addcredit($ledger_name,$ledger_type,$customer_name,$other,$amount,$description,$modeofpayment,$cheque_no,$transfer_id,$getid)
{
global $db;
if ($getid == '')
{

$resa = $db->prepare("INSERT INTO debitcredit (`type`,`ledger_name`, `ledger_type`, `customer_name`, `other`, `amount`, `description`, `modeofpayment`, `cheque_no`, `transfer_id`) VALUES (?,?,?,?,?,?,?,?,?,?)");
$resa->execute(array('2',$ledger_name,$ledger_type,$customer_name,$other,$amount,$description,$modeofpayment,$cheque_no,$transfer_id));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';

}
else
{

$resa = $db->prepare("UPDATE debitcredit SET `ledger_name`=?, `ledger_type`=?, `customer_name`=?, `other`=?, `amount`=?, `description`=?, `modeofpayment`=?, `cheque_no`=?, `transfer_id`=? WHERE id=?");
$resa->execute(array($ledger_name,$ledger_type,$customer_name,$other,$amount,$description,$modeofpayment,$cheque_no,$transfer_id,$getid));

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';

}
return $res;
}

function deldepit($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM debitcredit WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
function adddepit($ledger_name,$ledger_type,$customer_name,$other,$amount,$description,$modeofpayment,$cheque_no,$transfer_id,$getid)
{
global $db;
if ($getid == '')
{

$resa = $db->prepare("INSERT INTO debitcredit (`type`,`ledger_name`, `ledger_type`, `customer_name`, `other`, `amount`, `description`, `modeofpayment`, `cheque_no`, `transfer_id`) VALUES (?,?,?,?,?,?,?,?,?,?)");
$resa->execute(array('1',$ledger_name,$ledger_type,$customer_name,$other,$amount,$description,$modeofpayment,$cheque_no,$transfer_id));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';

}
else
{

$resa = $db->prepare("UPDATE debitcredit SET `ledger_name`=?, `ledger_type`=?, `customer_name`=?, `other`=?, `amount`=?, `description`=?, `modeofpayment`=?, `cheque_no`=?, `transfer_id`=? WHERE id=?");
$resa->execute(array($ledger_name,$ledger_type,$customer_name,$other,$amount,$description,$modeofpayment,$cheque_no,$transfer_id,$getid));

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';

}
return $res;
}
function getdebit($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM debitcredit WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}

function delbalance($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM opening_balance WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
function addbalance($ledgername,$opening_balance,$getid)
{
global $db;
if ($getid == '')
{

$resa = $db->prepare("INSERT INTO opening_balance (ledger_name,opening_balance) VALUES (?,?)");
$resa->execute(array($ledgername,$opening_balance));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';

}
else
{

$resa = $db->prepare("UPDATE opening_balance SET opening_balance=?,ledger_name=? WHERE id=?");
$resa->execute(array($opening_balance,$ledgernamem,$getid));

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';

}
return $res;
}
function getbalance($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM opening_balance WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}

function delledgertype($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM ledgertype WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
function addledgertype($ledgername,$ledgertype,$status,$getid)
{
global $db;
if ($getid == '')
{
$link22 = FETCH_all("SELECT * FROM ledgertype WHERE ledgername=? AND ledgertype=?", $ledgername,$ledgertype);
if ($link22['id'] == '')
{
$resa = $db->prepare("INSERT INTO ledgertype (ledgername,ledgertype,status) VALUES (?,?,?)");
$resa->execute(array($ledgername,$ledgertype,$status));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Ledger Type Already Exist!</h4></div>';	
}

}
else
{
$link22 = FETCH_all("SELECT * FROM ledgertype WHERE ledgername=? AND `ledgertype`=? AND `id`!=?", $ledgername,$ledgertype,$getid);
if ($link22['id'] == '')
{
$resa = $db->prepare("UPDATE ledgertype SET ledgername=?,ledgertype=?,status=? WHERE id=?");
$resa->execute(array($ledgername,$ledgertype,$status,$getid));

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';
}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Ledger Type Already Exist!</h4></div>';	
}

}
return $res;
}
function getledgertype($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM ledgertype WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}

function delledgername($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM ledgername WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
function addledgername($ledgername,$status,$getid)
{
global $db;
if ($getid == '')
{
$link22 = FETCH_all("SELECT * FROM ledgername WHERE ledgername=?", $ledgername);
if ($link22['id'] == '')
{
$resa = $db->prepare("INSERT INTO ledgername (ledgername,status) VALUES(?,?)");
$resa->execute(array($ledgername,$status));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Ledger Name Already Exist!</h4></div>';	
}

}
else
{
$link22 = FETCH_all("SELECT * FROM ledgername WHERE ledgername=? AND `id`!=?", $ledgername,$getid);
if ($link22['id'] == '')
{
$resa = $db->prepare("UPDATE ledgername SET ledgername=?,status=? WHERE id=?");
$resa->execute(array($ledgername,$status,$getid));

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';
}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Ledger Name Already Exist!</h4></div>';	
}

}
return $res;
}
function getledgername($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM ledgername WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}

function addinstallment($customer_id,$type,$paid_date,$amount,$paid_status,$getid)
{
global $db;
if ($getid == '')
{
$link22 = FETCH_all("SELECT * FROM installment WHERE customerid=? AND type=? AND paid_date=?", $customer_id,$type,$paid_date);
if($_SESSION['GRUID']=='1') {
	$userid="1";
	$usertype="admin";
}
else
{
	$userid=getusers('typeid',$_SESSION['GRUID']);
$usertype=getusers('type',$_SESSION['GRUID']);
}

if ($link22['id'] == '')
{
$resa = $db->prepare("INSERT INTO installment (userid,usertype,customerid,type,paid_date,amount,paid_status) VALUES(?,?,?,?,?,?,?)");
$resa->execute(array($userid,$usertype,$customer_id,$type,$paid_date,$amount,$paid_status));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Already Paid!</h4></div>';	
}

}
else
{
$link22 = FETCH_all("SELECT * FROM installment WHERE customerid=? AND type=? AND paid_date=? AND `id`!=?", $customer_id,$type,$paid_date,$getid);
if ($link22['id'] == '')
{
$resa = $db->prepare("UPDATE installment SET customerid=?,type=?,amount=?,paid_date=?,paid_status=? WHERE id=?");
$resa->execute(array($customer_id,$type,$amount,$paid_date,$paid_status,$getid));
}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Already Paid!</h4></div>';	
}

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';

}
return $res;
}

function getinstallment($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM installment WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}

function addloan($due_date,$principle_amount,$loan_interest,$loanid,$due_amount,$dueno,$due_status,$interest_days,$interest_amount,$getid)
{
global $db;

$link22 = FETCH_all("SELECT * FROM loans WHERE loanid=? AND dueno=?", $loanid,$dueno);
if ($link22['loanid'] == '')
{
	
	if($_SESSION['GRUID']=='1') {
	$userid="1";
	$usertype="admin";
}
else
{
	$userid=getusers('typeid',$_SESSION['GRUID']);
$usertype=getusers('type',$_SESSION['GRUID']);
}

$resa = $db->prepare("INSERT INTO loans (due_date,principle_amount,loan_interest,userid,usertype,loanid,due_amount,dueno,due_status,interest_days,interest_amount) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
$resa->execute(array($due_date,$principle_amount,$loan_interest,$userid,$usertype,$loanid,$due_amount,$dueno,$due_status,$interest_days,$interest_amount));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Already exists for this Due Number!</h4></div>';	
}
return $res;
}
function delinstallment($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;

$get = $db->prepare("DELETE FROM installment WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}



function delcustomer($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;

$get1 = $db->prepare("DELETE FROM coapplicant WHERE cusid = ? ");
$get1->execute(array($c));

$get = $db->prepare("DELETE FROM customer WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
function addcustomer($application_date,$customer_title,$father_title,$father_name,$guarantor_title,$guarantor_name,$guarantor_father_title,$guarantor_father_name,$residence_type,$cus_street,$cus_area,$cus_city,$cus_state,$cus_pincode,$cus_landmark,$gua_resident_type,$gua_street,$gua_area,$gua_city,$gua_pincode,$gua_landmark,$gua_phone,$gua_cellphone,$regno,$make,$color,$vehicletype,$fair_market,$no_of_weeks,$interest_rate,$no_of_installment,$insurance_deposit,$filename4,$applicant_name,$applicant_no,$applicant_prooftype,$applicant_address,$insurance_type,$filename11,$interest_percentage,$having_insurance,$insurance_name,$insurance_amount,$filename1,$filename2,$filename3,$name,$emailid,$mobileno,$alt_mobileno,$vehicle_type,$vehicle_name,$vehicle_model,$loan_amount,$noof_owners,$ins_expiry_date,$noof_month_due,$due_amt_per_month,$proof_type,$proof_details,$address,$status,$getid)
{
global $db;
if ($getid == '')
{
$link22 = FETCH_all("SELECT * FROM customer WHERE name=?", $name);
if ($link22['name'] == '')
{


$resa = $db->prepare("INSERT INTO customer (`insurance_proof`,`application_date`,`customer_title`,`father_title`,`father_name`,`guarantor_title`,`guarantor_name`,`guarantor_father_title`,`guarantor_father_name`,`residence_type`,`cus_street`,`cus_area`,`cus_city`,`cus_state`,`cus_pincode`,`cus_landmark`,`gua_resident_type`,`gua_street`,`gua_area`,`gua_city`,`gua_pincode`,`gua_landmark`,`gua_phone`,`gua_cellphone`,`regno`,`make`,`color`,`vehicletype`,`fair_market`,`no_of_weeks`,`interest_rate`,`no_of_installment`,`insurance_deposit`,`applicant_name`,`applicant_no`,`applicant_prooftype`,`applicant_proof`,`applicant_address`,`interest_percentage`,`having_insurance`,`insurance_name`,`insurance_amount`,`name`, `emailid`,`mobileno`,`alt_mobileno`, `vehicle_type`, `vehicle_name`, `vehicle_model`, `loan_amount`, `noof_owners`, `ins_expiry_date`, `noof_month_due`, `due_amt_per_month`, `proof_type`, `proof`, `cuphoto`, `bikephoto`, `proof_details`, `address`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$resa->execute(array($filename11,$application_date,$customer_title,$father_title,$father_name,$guarantor_title,$guarantor_name,$guarantor_father_title,$guarantor_father_name,$residence_type,$cus_street,$cus_area,$cus_city,$cus_state,$cus_pincode,$cus_landmark,$gua_resident_type,$gua_street,$gua_area,$gua_city,$gua_pincode,$gua_landmark,$gua_phone,$gua_cellphone,$regno,$make,$color,$vehicletype,$fair_market,$no_of_weeks,$interest_rate,$no_of_installment,$insurance_deposit,$applicant_name,$applicant_no,$applicant_prooftype,$filename4,$applicant_address,$interest_percentage,$having_insurance,$insurance_name,$insurance_amount,$name,$emailid,$mobileno,$alt_mobileno,$vehicle_type,$vehicle_name,$vehicle_model,$loan_amount,$noof_owners,$ins_expiry_date,$noof_month_due,$due_amt_per_month,$proof_type,$filename1,$filename2,$filename3,$proof_details,$address,$status));

$lastid11=$db->lastInsertId();

if($vehicle_type=='1' || $vehicle_type=='2') {
$resa1 = $db->prepare("INSERT INTO loan_credit (`customerid`,`interest_amount`) VALUES (?,?)");
$resa1->execute(array($lastid11,$interest_percentage));
}

$getlastrecd = FETCH_all("SELECT * FROM customer WHERE `id`!=? ORDER BY `id` DESC", $lastid11);

$expid=explode('-',$getlastrecd['customerid']);

$insexpid=$expid['1']+1;
$orgcusid='FIN-'.$insexpid;

// add customer id

$changecus = $db->prepare("UPDATE customer SET `customerid`=? WHERE id=?");
$changecus->execute(array($orgcusid,$lastid11));
// add customer id

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>User Name already exists!</h4></div>';	
}

}
else
{
$link22 = FETCH_all("SELECT * FROM customer WHERE name=? AND `id`!=?", $name,$getid);
if ($link22['name'] == '')
{
$resa = $db->prepare("UPDATE customer SET `insurance_proof`=?,`application_date`=?,`customer_title`=?,`father_title`=?,`father_name`=?,`guarantor_title`=?,`guarantor_name`=?,`guarantor_father_title`=?,`guarantor_father_name`=?,`residence_type`=?,`cus_street`=?,`cus_area`=?,`cus_city`=?,`cus_state`=?,`cus_pincode`=?,`cus_landmark`=?,`gua_resident_type`=?,`gua_street`=?,`gua_area`=?,`gua_city`=?,`gua_pincode`=?,`gua_landmark`=?,`gua_phone`=?,`gua_cellphone`=?,`regno`=?,`make`=?,`color`=?,`vehicletype`=?,`fair_market`=?,`no_of_weeks`=?,`interest_rate`=?,`no_of_installment`=?,`insurance_deposit`=?,`applicant_name`=?,`applicant_no`=?,`applicant_address`=?,`applicant_prooftype`=?,`applicant_proof`=?,`interest_percentage`=?,`having_insurance`=?,`insurance_name`=?,`insurance_amount`=?,`name`=?, `emailid`=?,`mobileno`=?,  `alt_mobileno`=?, `vehicle_name`=?, `vehicle_model`=?,`vehicle_type`=?, `loan_amount`=?, `noof_owners`=?, `ins_expiry_date`=?, `noof_month_due`=?, `due_amt_per_month`=?, `proof_type`=?, `proof`=?, `cuphoto`=?, `bikephoto`=?, `proof_details`=?, `address`=?, `status`=? WHERE id=?");
$resa->execute(array($filename11,$application_date,$customer_title,$father_title,$father_name,$guarantor_title,$guarantor_name,$guarantor_father_title,$guarantor_father_name,$residence_type,$cus_street,$cus_area,$cus_city,$cus_state,$cus_pincode,$cus_landmark,$gua_resident_type,$gua_street,$gua_area,$gua_city,$gua_pincode,$gua_landmark,$gua_phone,$gua_cellphone,$regno,$make,$color,$vehicletype,$fair_market,$no_of_weeks,$interest_rate,$no_of_installment,$insurance_deposit,$applicant_name,$applicant_no,$applicant_address,$applicant_prooftype,$filename4,$interest_percentage,$having_insurance,$insurance_name,$insurance_amount,$name,$emailid,$mobileno,$alt_mobileno,$vehicle_name,$vehicle_model,$vehicle_type,$loan_amount,$noof_owners,$ins_expiry_date,$noof_month_due,$due_amt_per_month,$proof_type,$filename1,$filename2,$filename3,$proof_details,$address,$status,$getid));


$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';


}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Customer Name already exists!</h4></div>';	
}


}
return $res;
}
function getcustomer($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM customer WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}


function delsubuser($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM subuser WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
function addsubuser($name,$emailid,$mobileno,$address,$username,$password,$status,$getid)
{
global $db;
if ($getid == '')
{
$link22 = FETCH_all("SELECT * FROM subuser WHERE username=?", $username);
if ($link22['username'] == '')
{
$resa = $db->prepare("INSERT INTO subuser (name,emailid,mobileno,address,username,password,status) VALUES(?,?,?,?,?,?,?)");
$resa->execute(array($name,$emailid,$mobileno,$address,$username,$password,$status));
$lastid11=$db->lastInsertId();

//create user
$uresa = $db->prepare("INSERT INTO users (`type`,`typeid`, `name`, `val1`, `val2`, `val3`, `emailid`, `mobileno`, `orgpassword`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?)" );
$uresa->execute(array('subuser',$lastid11,$name,$username,md5($password),$status,$emailid,$mobileno,$password,$status));
//create user


$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>User Name already exists!</h4></div>';	
}

}
else
{
$link22 = FETCH_all("SELECT * FROM subuser WHERE username=? AND `id`!=?", $username,$getid);
if ($link22['username'] == '')
{
$resa = $db->prepare("UPDATE subuser SET name=?,emailid=?,mobileno=?,address=?,username=?,password=?,status=? WHERE id=?");
$resa->execute(array($name,$emailid,$mobileno,$address,$username,$password,$status,$getid));

//update user
$uresa = $db->prepare("UPDATE users SET `name`=?, `val1`=?, `val2`=?, `val3`=?, `emailid`=?, `mobileno`=?, `orgpassword`=?, `status`=? WHERE `typeid`=? AND `type`=? " );
$uresa->execute(array($name,$username,md5($password),$status,$emailid,$mobileno,$password,$status,$getid,'subuser'));
//update user


}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>User Name already exists!</h4></div>';	
}

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';

}
return $res;
}
function getsubuser($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM subuser WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}


function delexpense($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM expense WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
function addexpense($expense_type,$expense_date,$amount,$comment,$getid)
{
global $db;
if ($getid == '')
{

if($_SESSION['usertype']=='subadmin')
{
$createid=getusers('vendor',$_SESSION['GRUID']);
$createby="subadmin";
}	
else
{
$createid=$_SESSION['GRUID'];
$createby="admin";	
}

$resa = $db->prepare("INSERT INTO expense (createid,createby,expense_type,expense_date,amount,comment) VALUES(?,?,?,?,?,?)");
$resa->execute(array($createid,$createby,$expense_type,$expense_date,$amount,$comment));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';


}
else
{

$resa = $db->prepare("UPDATE expense SET expense_type=?,expense_date=?,amount=?,comment=? WHERE id=?");
$resa->execute(array($expense_type,$expense_date,$amount,$comment,$getid));

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';

}
return $res;
}
function getexpense($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM expense WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}


function delexpensetype($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM expense_type WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
function addexpensetype($expense_type,$status,$getid)
{
global $db;

 if($_SESSION['usertype']=='subadmin')
{
$createid=getusers('vendor',$_SESSION['GRUID']);
$createby="subadmin";
}	
else
{
$createid=$_SESSION['GRUID'];
$createby="admin";	
}

if ($getid == '')
{
$link22 = FETCH_all("SELECT * FROM expense_type WHERE expense_type=? AND createid=? AND createby=?", $expense_type,$createid,$createby);
if ($link22['expense_type'] == '')
{
if($_SESSION['usertype']=='subadmin')
{
$createid=getusers('vendor',$_SESSION['GRUID']);
$createby="subadmin";
}	
else
{
$createid=$_SESSION['GRUID'];
$createby="admin";	
}

$resa = $db->prepare("INSERT INTO expense_type (createid,createby,expense_type,status) VALUES(?,?,?,?)");
$resa->execute(array($createid,$createby,$expense_type,$status));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Expense Type already exists!</h4></div>';
}
}
else
{
$link22 = FETCH_all("SELECT * FROM expense_type WHERE expense_type=? AND createid=? AND createby=? AND id!=?", $expense_type,$createid,$createby,$getid);
if ($link22['expense_type'] == '')
{
$resa = $db->prepare("UPDATE expense_type SET expense_type=?,status=? WHERE id=?");
$resa->execute(array(trim($expense_type),trim($status), $getid));

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';

}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Expense Type already exists!</h4></div>';
}
}
return $res;
}
function getexpensetype($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM expense_type WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}


function delproof($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM proof WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
function addproof($proof_name,$status,$getid)
{
global $db;
if ($getid == '')
{

$resa = $db->prepare("INSERT INTO proof (proof_name,status) VALUES(?,?)");
$resa->execute(array($proof_name,$status));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';


}
else
{

$resa = $db->prepare("UPDATE proof SET proof_name=?,status=? WHERE id=?");
$resa->execute(array($proof_name,$status,$getid));

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';

}
return $res;
}
function getproof($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM proof WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}


function delbike($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM bike WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}
function addbike($vehicle_type,$bike_name,$status,$getid)
{
global $db;


if ($getid == '')
{
$link22 = FETCH_all("SELECT * FROM bike WHERE bike_name=?", $bike_name);
if ($link22['bike_name'] == '')
{
$resa = $db->prepare("INSERT INTO bike (vehicle_type,bike_name,status) VALUES(?,?,?)");
$resa->execute(array($vehicle_type,$bike_name,$status));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Bike Name already exists!</h4></div>';
}
}
else
{
$link22 = FETCH_all("SELECT * FROM bike WHERE bike_name=? AND id!=?", $bike_name,$getid);
if ($link22['bike_name'] == '')
{
$resa = $db->prepare("UPDATE bike SET vehicle_type=?,bike_name=?,status=? WHERE id=?");
$resa->execute(array(trim($vehicle_type),trim($bike_name),trim($status), $getid));

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';

}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Bike Name already exists!</h4></div>';
}
}
return $res;
}
function getbike($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM bike WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}


function delmodel($a) {
$b = str_replace(".", ",", $a);
$b = explode(",", $b);
foreach ($b as $c) {
global $db;
$get = $db->prepare("DELETE FROM model WHERE id = ? ");
$get->execute(array($c));
}
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
return $res;
}


function addmodel($vehicle_type,$bike_name,$yearof_model,$model_name,$amount,$status,$getid)
{
global $db;
if ($getid == '')
{
$link22 = FETCH_all("SELECT * FROM model WHERE bike_name=? AND vehicle_type=? AND yearof_model=? AND model_name=?", $bike_name,$vehicle_type,$yearof_model,$model_name);
if ($link22['model_name'] == '')
{

$resa = $db->prepare("INSERT INTO model (vehicle_type,bike_name,yearof_model,model_name,amount,status) VALUES (?,?,?,?,?,?)");
$resa->execute(array($vehicle_type,$bike_name,$yearof_model,$model_name,$amount,$status));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Model Name already exists!</h4></div>';
}
}
else
{
$link22 = FETCH_all("SELECT * FROM model WHERE bike_name=? AND yearof_model=? AND model_name=? AND vehicle_type=? AND id!=?", $bike_name,$yearof_model,$model_name,$vehicle_type,$getid);
if ($link22['model_name'] == '')
{
$resa = $db->prepare("UPDATE model SET vehicle_type=?,bike_name=?,yearof_model=?,model_name=?,amount=?,status=? WHERE id=?");
$resa->execute(array($vehicle_type,$bike_name,$yearof_model,$model_name,$amount,trim($status),$getid));


$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';

}
else
{
$res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Model Name already exists!</h4></div>';
}
}
return $res;
}
function getmodel($a, $b) {
global $db;
$get1 = $db->prepare("SELECT * FROM model WHERE id=?");
$get1->execute(array($b));
$get = $get1->fetch(PDO::FETCH_ASSOC);
$res = $get[$a];
return $res;
}



///////////////Register//////////////


function Imageuploadd($fileName, $Size, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH, $file, $tmpname) {

    $folder = $relPath;
//$maxlimit = $maxSize;
    $allowed_ext = "jpg,jpeg,gif,png,bmp";
    $match = "";

    if ($Size > 0) {
        $filename = strtolower($fileName);
        $filename = preg_replace('/\s/', '_', $filename);
        if ($Size < 1) {
            $errorList[] = "File size is empty.";
        }
        /* if($filesize > $maxlimit){ 
          $errorList[] = "File size is too big.";
          } */
        if (count($errorList) < 1) {
            $file_ext = preg_split("/\./", $filename);
            $allowed_ext = preg_split("/\,/", $allowed_ext);
            foreach ($allowed_ext as $ext) {
                if ($ext == end($file_ext)) {
                    $match = "1"; // File is allowed
                    $NUM = time();
                    $front_name = substr($file_ext[0], 0, 15);
                    $newfilename = $file . "." . end($file_ext);
                    $filetype = end($file_ext);
                    $save = $folder . $newfilename;
                    if (!file_exists($save)) {
                        list($width_orig, $height_orig) = getimagesize($tmpname);
                        $width_orig . "-" . $height_orig;
                        if ($maxH == null) {
                            if ($width_orig < $maxW) {
                                $fwidth = $width_orig;
                            } else {
                                $fwidth = $maxW;
                            }
                            $ratio_orig = $width_orig / $height_orig;
                            $fheight = $fwidth / $ratio_orig;

                            $blank_height = $fheight;
                            $top_offset = 0;
                        } else {
                            if ($width_orig <= $maxW && $height_orig <= $maxH) {
                                $fheight = $height_orig;
                                $fwidth = $width_orig;
                            } else {
                                if ($width_orig > $maxW) {
                                    $ratio = ($width_orig / $maxW);
                                    $fwidth = $maxW;
                                    $fheight = ($height_orig / $ratio);
                                    if ($fheight > $maxH) {
                                        $ratio = ($fheight / $maxH);
                                        $fheight = $maxH;
                                        $fwidth = ($fwidth / $ratio);
                                    }
                                }
                                if ($height_orig > $maxH) {
                                    $ratio = ($height_orig / $maxH);
                                    $fheight = $maxH;
                                    $fwidth = ($width_orig / $ratio);
                                    if ($fwidth > $maxW) {
                                        $ratio = ($fwidth / $maxW);
                                        $fwidth = $maxW;
                                        $fheight = ($fheight / $ratio);
                                    }
                                }
                            }
                            if ($fheight == 0 || $fwidth == 0 || $height_orig == 0 || $width_orig == 0) {
                                die("FATAL ERROR REPORT ERROR CODE [add-pic-line-67-orig] to <a href='https://www.nbaysmart.com/'>NBAYSMART</a>");
                            }
                            if ($fheight < 45) {
                                $blank_height = 45;
                                $top_offset = round(($blank_height - $fheight) / 2);
                            } else {
                                $blank_height = $fheight;
                            }
                        }
                        $imaall_p = imagecreatetruecolor($fwidth, $blank_height);
                        $white = imagecolorallocate($imaall_p, $colorR, $colorG, $colorB);
                        imagefill($imaall_p, 0, 0, $white);
                        switch ($filetype) {
                            case "gif":
                                $image = @imagecreatefromgif($tmpname);
                                break;
                            case "jpg":
                                $image = @imagecreatefromjpeg($tmpname);
                                break;
                            case "jpeg":
                                $image = @imagecreatefromjpeg($tmpname);
                                break;
                            case "png":
                                $image = @imagecreatefrompng($tmpname);
                                break;
                        }
                        @imagecopyresampled($imaall_p, $image, 0, $top_offset, 0, 0, $fwidth, $fheight, $width_orig, $height_orig);
                        $black = imagecolorallocatealpha($imaall_p, 158, 155, 159, 70);
                        $font = '../monofont.ttf';
                        $font_size = 15;
                        imagettftext($imaall_p, $font_size, 0, 10, 90, $black, $font, $WaterMarkText);

                        switch ($filetype) {
                            case "gif":
                                if (!@imagegif($imaall_p, $save)) {
                                    $errorList[] = "PERMISSION DENIED [GIF]";
                                }
                                break;
                            case "jpg":
                                if (!@imagejpeg($imaall_p, $save, 100)) {
                                    $errorList[] = "PERMISSION DENIED [JPG]";
                                }
                                break;
                            case "jpeg":
                                if (!@imagejpeg($imaall_p, $save, 100)) {
                                    $errorList[] = "PERMISSION DENIED [JPEG]";
                                }
                                break;
                            case "png":
                                if (!@imagepng($imaall_p, $save, 0)) {
                                    $errorList[] = "PERMISSION DENIED [PNG]";
                                }
                                break;
                        }
                        @imagedestroy($filename);
                    } else {
                        $errorList[] = "CANNOT MAKE IMAGE IT ALREADY EXISTS";
                    }
                }
            }
        }
    } else {
        $errorList[] = "NO FILE SELECTED";
    }
    if (!$match) {
        $errorList[] = "File type isn't allowed: $filename";
    }
    if (sizeof($errorList) == 0) {
        return $fullPath . $newfilename;
    } else {
        $eMessage = array();
        for ($x = 0; $x < sizeof($errorList); $x++) {
            $eMessage[] = $errorList[$x];
        }
        return $eMessage;
    }
}




////////////End////////////////////

function generateRandomString($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



function getusers($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `users` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}

function LoginCheck($a = '', $b = '', $c = '', $d = '', $e = '') {

    global $db;
    if (($a == '') || ($b == '')) {
        $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><i class="icon fa fa-close"></i>Email or Password was empty</div>';
    } else {
        if ($e == '') {
            $stmt = $db->prepare("SELECT * FROM `users` WHERE `val1`=? AND `val3`=?");
            $stmt->execute(array($a, 1));
            $ress = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($ress['id'] != '') {
                if ($ress['val2'] == md5($b)) {
                    $res = "Hurray! You will redirect into dashboard soon";
					
                    $_SESSION['GRUID'] = $ress['id'];
                    $_SESSION['Gpassword'] = $ress['orgpassword'];
                    $_SESSION['policestation'] = $ress['policestation'];
                    $_SESSION['type'] = 'admin';
                     $_SESSION['usertype'] = $ress['type'];
                     $_SESSION['usertypeid'] = $ress['typeid'];
                    @extract($ress);
                    if ($id != '') {
                        $e = date('Y-m-d H:i:s');
                        $sql = 'INSERT INTO `admin_history`(admin_uid,ip,checkintime) VALUES(?,?,?)';
                        $stmt1 = $db->prepare($sql);
                        $stmt1->execute(array($id, $c, $e));
                        $_SESSION['admhistoryid'] = $db->lastInsertId();
                        if ($d == '1') {
                            //if rememberme checkbox checked
                            setcookie('lemail', $a, time() + (60 * 60 * 24 * 10)); //Means 10 days change value of 10 to how many days as you want to remember the user details on user's computer
                            setcookie('lpass', $b, time() + (60 * 60 * 24 * 10));  //Here two coockies created with username and password as cookie names, $username,$password (login crediantials) as corresponding values
                        }
                    }
                } elseif ($ress['val3'] == 0) {
                    $res = '<div class="alert alert-danger alert-dismissible" id="hideDiv" style="font-size:14px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><i class="icon fa fa-close"></i> Your Account was deactivated by Admin</div>';
                } else {
                    $res = '<div class="alert alert-danger alert-dismissible" id="hideDiv" style="font-size:14px;"><i class="icon fa fa-close"></i> User name or Password was Incorrect</div>';
                }
            } 
            else
            {
               $res = '<div class="alert alert-danger alert-dismissible" id="hideDiv" style="font-size:14px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><i class="icon fa fa-close"></i> Your Account was deactivated by Admin</div>';  
            }
            return $res;
        }
    }
}



function logout() {
    global $db;
    $sql = $db->prepare("UPDATE `admin_history` SET `checkouttime`='" . date('Y-m-d H:i:s') . "' WHERE `id`=?");
    $sql->execute(array($_SESSION['admhistoryid']));
    // DB("UPDATE `admin_history` SET `checkouttime`='" . date('Y-m-d H:i:s') . "' WHERE `id`='" . $_SESSION['admhistoryid'] . "'");
}

function companylogos($a) {
    //$getlogo = mysql_fetch_array(mysql_query("SELECT `image` FROM `profile_area` WHERE `pid`='" . $a . "'"));
    global $db;
    $getlogo1 = $db->prepare("SELECT `image` FROM `profile_area` WHERE `pid`=?");
    $getlogo1->execute(array($a));
    $getlogo = $getlogo1->fetch(PDO::FETCH_ASSOC);
    if ($getlogo['image'] != '') {
        $res = $getlogo['image'];
    } else {
        $res = $sitename . 'data/profile/logo.png';
    }
    return $res;
}

function addprofile($tax,$title, $firstname, $lastname, $image, $cmpnyname, $recoveryemail, $phonenumber,$mail_option, $caddress, $abn, $ip,$bank_name,$branch_name,$account_name,$account_no,$ifsc_code,$swift_code,$branch_address, $id) {
    global $db;
    if ($id == '') {
        $resa = $db->prepare("INSERT INTO `manageprofile` (`tax`,`title`,`firstname`,`lastname`,`image`,`Company_name`,`recoveryemail`,`phonenumber`,`caddress`,`abn`,`ip`,`mail`,`bank_name`,`branch_name`,`account_name`,`account_no`,`ifsc_code`,`swift_code`,`branch_address`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $resa->execute(array($tax,$title, $firstname, $lastname, $image, $cmpnyname, $recoveryemail, $phonenumber, $caddress, $abn, $ip,$mail_option,$bank_name,$branch_name,$account_name,$account_no,$ifsc_code,$swift_code,$branch_address));
        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
    } else {
        
        $resa = $db->prepare("UPDATE `manageprofile` SET `tax`=?,`title`=?,`firstname`=?,`lastname`=?,`image`=?,`Company_name`=?,`recoveryemail`=?,`phonenumber`=?,`caddress`=?,`abn`=?,`ip`=?,`mail`=?,`bank_name`=?,`branch_name`=?,`account_name`=?,`account_no`=?,`ifsc_code`=?,`swift_code`=?,`branch_address`=? WHERE `pid`=?");
        $resa->execute(array($tax,$title, $firstname, $lastname, $image, $cmpnyname, $recoveryemail, $phonenumber, $caddress, $abn, $ip,$mail_option,$bank_name,$branch_name,$account_name,$account_no,$ifsc_code,$swift_code,$branch_address, $id));
        $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i> Successfully Updated</h4></div>';
    }

    return $res;
}

function getprofile($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `manageprofile` WHERE `pid`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}


function compress_image($destination_url, $quality) {

    $info = getimagesize($destination_url);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($destination_url);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($destination_url);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($destination_url);

    imagejpeg($image, $destination_url, $quality);
    return $destination_url;
}

?>