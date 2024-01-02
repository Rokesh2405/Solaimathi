<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

// get database connection
include_once '../config/database.php';

 
// instantiate product object
include_once '../objects/form.php';
include_once '../objects/functions.php';

$database = new Database();
$db = $database->getConnection();
 
$form = new Form($db);
 
// get posted data

$data = json_decode(file_get_contents("php://input"));


// make sure data is not empty
if(
    !empty($data->userid) && !empty($data->token)
){
  

$checkvaliduser1 = $db->prepare("SELECT * FROM `student` WHERE `id`='".$data->userid."' AND `token`='".$data->token."' ORDER BY `id` ASC");
$checkvaliduser1->execute();
 $checknum1 = $checkvaliduser1->rowCount();

if($checknum1>0)
{
  $row1 = $checkvaliduser1->fetch(PDO::FETCH_ASSOC);


  //parent details
$parents = $db->prepare("SELECT * FROM `student` WHERE `id`='".$row1['parent_id']."' ORDER BY `id` ASC");
$parents->execute();
$parentsnum = $parents->rowCount();
if($parentsnum>0){
  $parentsfetch = $parents->fetch(PDO::FETCH_ASSOC);

 if($parentsfetch['status']=='1') {

 $checkapply1 = $db->prepare("SELECT * FROM `acedemy_student` WHERE `student`='".$parentsfetch['id']."' ORDER BY `id` ASC");
$checkapply1->execute();
 $applynum1 = $checkapply1->rowCount();
if($applynum1>0){
$reg_status1=1;
}
else
{
$reg_status1=0;
}

$userid1=$parentsfetch['id'];
$token1=$parentsfetch['token'];
}
}
else
{
$reg_status1='';
 $userid1='';
 $token1=''; 
}
  //parent details

 if($row1['status']=='1') {
$token=md5(uniqid(rand()));


 $checkapply = $db->prepare("SELECT * FROM `acedemy_student` WHERE `student`='".$row1['id']."' ORDER BY `id` ASC");
$checkapply->execute();
 $applynum = $checkapply->rowCount();
if($applynum>0){
$reg_status=1;
}
else
{
$reg_status=0;
}


  $query1 = "UPDATE `student` SET
                    `token`='".$token."' WHERE id='".$row1['id']."'";
$stmt1 = $db->prepare($query1);
$stmt1->execute();


  http_response_code(200);

        // tell the user
 echo json_encode(array("success" => "true", "error" => "false","parent_userid" => $userid1,"parent_reg_status"=>$reg_status1,"parent_token" => $token1,"userid" => $row1['id'],"reg_status"=>$reg_status,"token" => $token,"message" => "Login Successfully"));     
 }
 else{
    http_response_code(200);

        // tell the user
 echo json_encode(array("success" => "false", "error" => "true","message" => "Your Account is Deactivated by Admin"));     
 
 }
 
}

else
{
  http_response_code(200);
 
        // tell the user
        echo json_encode(array("success" => "false", "error" => "true","message" => "Invalid Details"));  
}


}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to create user. Data is incomplete."));
}
?>