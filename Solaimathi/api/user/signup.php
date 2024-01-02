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
    !empty($data->usertype) && !empty($data->username) && !empty($data->email)
){
    
    if($data->usertype=='coach') { 
 $checkvaliduser = $db->prepare("SELECT * FROM `coach` WHERE `username`='".$data->username."' AND `email`='".$data->email."' ORDER BY `id` ASC");
$checkvaliduser->execute();
 $checknum = $checkvaliduser->rowCount();

if($checknum>0)
{

  http_response_code(200);
 
        // tell the user
        echo json_encode(array("success" => "false", "error" => "true","message" => "Account Already Exist")); 
 
}

else
{

if($data->password==$data->confirm_password) { 
$token=md5(uniqid(rand()));
$query = "INSERT INTO `coach` (`username`,`email`,`password`,`token`,`status`) VALUES ('".$data->username."','".$data->email."','".$data->password."','".$token."','1') ";
$stmt = $db->prepare($query);
$stmt->execute();
$lastid=$db->lastInsertId();

  http_response_code(200);

        // tell the user
 echo json_encode(array("success" => "true", "error" => "false","userid" => $lastid,"token" => $token,"message" => "Signup Successfully"));  
}
else
{
 http_response_code(200);
 
        // tell the user
        echo json_encode(array("success" => "false", "error" => "true","message" => "Password dose not match")); 
}

}
}




  if($data->usertype=='student') { 
 $checkvaliduser = $db->prepare("SELECT * FROM `student` WHERE `username`='".$data->username."' AND `email`='".$data->email."' ORDER BY `id` ASC");
$checkvaliduser->execute();
 $checknum = $checkvaliduser->rowCount();

if($checknum>0)
{

  http_response_code(200);
 
        // tell the user
        echo json_encode(array("success" => "false", "error" => "true","message" => "Account Already Exist")); 
 
}

else
{

if($data->password==$data->confirm_password) { 
$token=md5(uniqid(rand()));

$query = "INSERT INTO `student` (`device_key`,`username`,`email`,`password`,`token`,`status`,`parent_id`) VALUES ('".$data->device_key."','".$data->username."','".$data->email."','".$data->password."','".$token."','1','".$data->parent_id."') ";
$stmt = $db->prepare($query);
$stmt->execute();
$lastid11=$db->lastInsertId();

http_response_code(200);

        // tell the user
 echo json_encode(array("success" => "true", "error" => "false","userid" => $lastid11,"token" => $token,"message" => "Signup Successfully"));  
}
else
{
 http_response_code(200);
 
        // tell the user
        echo json_encode(array("success" => "false", "error" => "true","message" => "Password dose not match")); 
}

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