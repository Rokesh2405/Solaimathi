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
    !empty($data->otp) && !empty($data->email) && !empty($data->usertype) 
)
{
        if($data->usertype=='coach') {
$checkvaliduser = $db->prepare("SELECT * FROM `coach` WHERE `email`='".$data->email."' AND `otp`='".$data->otp."' ORDER BY `id` ASC");
$checkvaliduser->execute();
$checknum = $checkvaliduser->rowCount();

if($checknum>0)
{  
    
$row = $checkvaliduser->fetch(PDO::FETCH_ASSOC);

if($data->newpassword == $data->confirmpassword) 
{

$query = "UPDATE `coach` SET `password`='".$data->newpassword."' WHERE `email`='".$data->email."' AND `otp`='".$data->otp."' ";
$stmt = $db->prepare($query);
$stmt->execute();
http_response_code(200);

        // tell the user
 echo json_encode(array("success" => "true", "error" => "false","message" => "Password Changed Successfully",
"userid" => $row['id'],
"token" => $row['token']
)); 
}
 
// tell the user data is incomplete
else{

http_response_code(200);
        // tell the user
echo json_encode(array("success" => "true", "error" => "false","message" => "Password did not same"));   
}

}
 
// tell the user data is incomplete
else{

http_response_code(200);
        // tell the user
echo json_encode(array("success" => "true", "error" => "false","message" => "Invalid Details."));   
}
}



        if($data->usertype=='student') {
$checkvaliduser = $db->prepare("SELECT * FROM `student` WHERE `email`='".$data->email."' AND `otp`='".$data->otp."' ORDER BY `id` ASC");
$checkvaliduser->execute();
$checknum = $checkvaliduser->rowCount();

if($checknum>0)
{  
    
$row = $checkvaliduser->fetch(PDO::FETCH_ASSOC);

if($data->newpassword == $data->confirmpassword) 
{

$query = "UPDATE `student` SET `password`='".$data->newpassword."' WHERE `email`='".$data->email."' AND `otp`='".$data->otp."' ";
$stmt = $db->prepare($query);
$stmt->execute();
http_response_code(200);

        // tell the user
 echo json_encode(array("success" => "true", "error" => "false","message" => "Password Changed Successfully",
"userid" => $row['id'],
"token" => $row['token']
)); 
}
 
// tell the user data is incomplete
else{

http_response_code(200);
        // tell the user
echo json_encode(array("success" => "false", "error" => "true","message" => "Password did not same"));   
}

}
 
// tell the user data is incomplete
else{

http_response_code(200);
        // tell the user
echo json_encode(array("success" => "false", "error" => "true","message" => "Invalid Details."));   
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