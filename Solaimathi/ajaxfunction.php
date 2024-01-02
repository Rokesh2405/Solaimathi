<?php

include 'config/config.inc.php';
//Checking login

if ($_REQUEST['cusid'] != '') {
global $db;
$customer_id=$_REQUEST['cusid'];
$type=$_REQUEST['vehicle_type'];



$querylink3 = $db->prepare("SELECT * FROM customer WHERE id='".$customer_id."' AND vehicle_type='".$type."'");
$querylink3->execute(array());
$link33 = $querylink3->fetch(PDO::FETCH_ASSOC);

$querylink2 = $db->prepare("SELECT COUNT(*) AS `totdays` , SUM(`amount`) AS `totamount` FROM installment WHERE customerid='".$customer_id."' AND type='".$type."' ");
$querylink2->execute(array());
$link22 = $querylink2->fetch(PDO::FETCH_ASSOC);
 $balcamt=$link33['loan_amount']-($link22['totamount']+$_REQUEST['amount']);
 $balcdays=$link33['due_amt_per_month']-($link22['totdays']+$_REQUEST['incval']);
echo $balcamt.'#'.$balcdays;
exit;
}

if ($_REQUEST['searchkey'] != '') {
global $db;

$query1 = $db->prepare("SELECT * FROM `customer` WHERE (`name` LIKE '%".$_REQUEST['searchkey']."%') OR (`mobileno`='".$_REQUEST['searchkey']."') AND `vehicle_type`='".$_REQUEST['vehicle_type']."'");
$query1->execute(array());
$query = $query1->fetch(PDO::FETCH_ASSOC);
echo $query['name'].'#'.$query['id'];
exit;
}

if ($_REQUEST['action'] == 'blocklist') {
    $districtid = $_REQUEST['districtid'];
    
$query1 = $db->prepare("SELECT * FROM `blocks` WHERE district_code = ?");
$query1->execute(array($districtid));
while ($query = $query1->fetch(PDO::FETCH_ASSOC)) {

// echo $query['block_name'];
// print_r($query);

echo json_encode($query);
}
}

// process 2
//
if ($_REQUEST['vehicletype'] != '') {
    ?>
   <option value="">Select </option>
        <?php

        $query1 = $db->prepare("SELECT * FROM `bike` WHERE vehicle_type = ?");
$query1->execute(array($_REQUEST['vehicletype']));
while ($cate = $query1->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $cate['id']; ?>"><?php echo $cate['bike_name']; ?></option>
    <?php } }
if ($_REQUEST['vehiclename'] != '') {
    ?>
   <option value="">Select </option>
        <?php

        $query1 = $db->prepare("SELECT * FROM `model` WHERE bike_name = ?");
$query1->execute(array($_REQUEST['vehiclename']));
while ($cate = $query1->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $cate['id']; ?>"><?php echo $cate['model_name']; ?></option>
    <?php } }
  if ($_REQUEST['supervisor'] != '') {
    ?>
   <option value="">Select </option>
        <?php
 
   $query2 = $db->prepare("SELECT * FROM `manager` WHERE supervisor = ? ");
$query2->execute(array($_REQUEST['supervisor']));
while ($cate2 = $query2->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $cate2['id']; ?>"><?php echo $cate2['name']; ?></option>
    
    <?php
} } if ($_REQUEST['block1'] != '') {
    ?>
   <option value="">Select </option>
        <?php
        
        $query1 = $db->prepare("SELECT * FROM `village` WHERE block_code = ? GROUP BY `panchayat_code`");
$query1->execute(array($_REQUEST['block1']));
while ($cate = $query1->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $cate['panchayat_code']; ?>"><?php echo $cate['panchayat_name']; ?></option>
    <?php } ?>
  
    <?php
} if ($_REQUEST['block11'] != '') {
    ?>
  
  
        <?php
        
        $query1 = $db->prepare("SELECT * FROM `village` WHERE district_code=? AND block_code = ? GROUP BY `panchayat_code`");
$query1->execute(array($_REQUEST['district'],$_REQUEST['block11']));
while ($cate = $query1->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $cate['panchayat_code']; ?>"><?php echo $cate['panchayat_name']; ?></option>
    <?php } ?>
  
    <?php
}  if ($_REQUEST['block'] != '') {
    ?>
   <option value="">Select </option>
        <?php
        
        $query1 = $db->prepare("SELECT * FROM `village` WHERE panchayat_code = ? GROUP BY `panchayat_code`");
$query1->execute(array($_REQUEST['block']));
while ($cate = $query1->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $cate['panchayat_code']; ?>"><?php echo $cate['panchayat_name']; ?></option>
    <?php } ?>
  
    <?php
}
