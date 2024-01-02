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
    !empty($data->usertype) && !empty($data->username) && !empty($data->password)
){
    
    if($data->usertype=='coach') { 
 $checkvaliduser = $db->prepare("SELECT * FROM `coach` WHERE `username`='".$data->username."' AND `password`='".$data->password."' ORDER BY `id` ASC");
$checkvaliduser->execute();
 $checknum = $checkvaliduser->rowCount();

if($checknum>0)
{
  $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC);
 if($row['status']=='1') {
$token=md5(uniqid(rand()));
  $query = "UPDATE `coach` SET
                    token='".$token."' WHERE id='".$row['id']."'";
$stmt = $db->prepare($query);
$stmt->execute();


  http_response_code(200);

        // tell the user
 echo json_encode(array("success" => "true", "error" => "false","userid" => $row['id'],"token" => $token,"message" => "Login Successfully"));     
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




   if($data->usertype=='student') { 
 $checkvaliduser1 = $db->prepare("SELECT * FROM `student` WHERE `username`='".$data->username."' AND `password`='".$data->password."' ORDER BY `id` ASC");
$checkvaliduser1->execute();
 $checknum1 = $checkvaliduser1->rowCount();

if($checknum1>0)
{
  $row1 = $checkvaliduser1->fetch(PDO::FETCH_ASSOC);
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
                    `token`='".$token."',device_key='".$data->device_key."' WHERE id='".$row1['id']."'";
$stmt1 = $db->prepare($query1);
$stmt1->execute();


  http_response_code(200);

        // tell the user
 echo json_encode(array("success" => "true", "error" => "false","userid" => $row1['id'],"reg_status"=>$reg_status,"token" => $token,"message" => "Login Successfully"));     
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



}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to create user. Data is incomplete."));
}
?>