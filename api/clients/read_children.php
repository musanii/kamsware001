<?php

//neccessary headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//db  and object files
include_once '../config/database.php';
include_once '../objects/client.php';

//instantiate necessary  objects
$database = new Database();
$db = $database->getConnection();

$client = new Client($db);

//read clients 
$stmt = $client->readChildren();
$num = $stmt->rowCount();

//check if more than 0 record found

if($num>0){

    //clients array
    $clients_arr = array();
    $clients_arr["records"] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $client_item = array(
            "id" => $id,
            "firstName"=>$firstName,
            "lastName"=> $lastName,
            "dateOfBirth"=> $dateOfBirth,
            "idNumber"=> $idNumber,
            
            "phoneNumber"=> $phoneNumber,
            "centerLocation"=>[
                "centerName" => $centerName,
                "locationName"=>$locationName,
                "longitude"=> $longitude,
                "latitude"=> $latitude
            ],

            "productName"=>$name,
            "description"=>$description,
            "quantity"=>$quantity

        );
        array_push($clients_arr["records"], $client_item);
    }
    //set response codes here
    http_response_code(200);
    echo json_encode($clients_arr);

}else{
    //not found
    http_response_code(404);

    echo json_encode(["message"=>"No clients and associated records found."]);
}
