<?php

class Center {

    //db conn & table name

    private $conn;
    private $table_name = "centers";

    //properties
    public $id;
    public $centerName;
    public $locationName;
    public $longitude;
    public $latitude;
    public $client_id;
    public $createdAt;

    //constructor with $db as database connection
public function __construct($db)
{
    $this->conn = $db;
    
}

//read  centers 

function read()
{

    $query = "SELECT *  FROM " . $this->table_name . " ORDER BY createdAt DESC";

    //prepare query sts=mt
    $stmt = $this->conn->prepare($query);

    //execute
    $stmt->execute();
    return $stmt;
}



//create center for client
function create(){
    //query to insert record
    $query = "INSERT INTO 
             ". $this->table_name . "
             SET
             centerName=:centerName,
             locationName=:locationName,
             longitude=:longitude,
             latitude=:latitude,
             client_id=:client_id,
             createdAt=:createdAt";

             // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->centerName=htmlspecialchars(strip_tags($this->centerName));
    $this->locationName=htmlspecialchars(strip_tags($this->locationName));
    $this->longitude=htmlspecialchars(strip_tags($this->longitude));
    $this->latitude=htmlspecialchars(strip_tags($this->latitude));
    $this->client_id=htmlspecialchars(strip_tags($this->client_id));
    $this->createdAt=htmlspecialchars(strip_tags($this->createdAt));

    //bind values

    // bind values
    $stmt->bindParam(":centerName", $this->centerName);
    $stmt->bindParam(":locationName", $this->locationName);
    $stmt->bindParam(":longitude", $this->longitude);
    $stmt->bindParam(":latitude", $this->latitude);
    $stmt->bindParam(":client_id", $this->client_id);
    $stmt->bindParam(":createdAt", $this->createdAt);
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
  
}


 
}