<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate cenyter object
include_once '../objects/center.php';
  
$database = new Database();
$db = $database->getConnection();
  
$center = new Center($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->centerName) &&
    !empty($data->locationName) &&
    !empty($data->longitude) &&
    !empty($data->latitude) &&
    !empty($data->client_id)
){
  
    // set product property values
    $center->centerName = $data->centerName;
    $center->locationName = $data->locationName;
    $center->longitude = $data->longitude;
    $center->latitude = $data->latitude;
    $center->client_id = $data->client_id;
    $center->createdAt = date('Y-m-d H:i:s');
  
    // create the center for client
    if($center->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(["message" => "center was created."]);
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create a center."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(["message" => "Unable to create center. Data is incomplete."]);
}
?>