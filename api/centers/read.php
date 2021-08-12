<?php

//neccessary headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//db  and object files
include_once '../config/database.php';
include_once '../objects/center.php';

//instantiate necessary  objects
$database = new Database();
$db = $database->getConnection();

$center = new Center($db);

//read centers
$stmt = $center->read();
$num = $stmt->rowCount();

//check if more than 0 record found

if($num>0){

    //center array
    $centers_arr = array();
    $centers_arr["records"] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $center_item = array(
            "id" => $id,
            "centerName"=>$centerName,
            "locationName"=> $locationName,
            "longitude"=> $longitude,
            "latitude"=> $latitude,
            "client_id"=> $client_id,
            "created_date"=> $createdAt

        );
        array_push($centers_arr["records"], $center_item);
    }
    //set response codes here
    http_response_code(200);
    echo json_encode($centers_arr);

}else{
    //not found
    http_response_code(404);

    echo json_encode(["message"=>"No centers found."]);
}
