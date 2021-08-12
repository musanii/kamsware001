<?php

class Product {

    //db conn & table name

    private $conn;
    private $table_name = "products";

    //properties
    public $id;
    public $name;
    public $description;
    public $quantity;
    public $client_id;

    //constructor with $db as database connection
public function __construct($db)
{
    $this->conn = $db;
    
}

//read  clients 

function read()
{

    $query = "SELECT *  FROM " . $this->table_name . " ORDER BY createdAt DESC";

    //prepare query sts=mt
    $stmt = $this->conn->prepare($query);

    //execute
    $stmt->execute();
    return $stmt;
}



//create client
function create(){
    //query to insert record
    $query = "INSERT INTO 
             ". $this->table_name . "
             SET
             firstName=:firstName,
             lastName=:lastName,
             dateOfBirth=:dateOfBirth,
             idNumber=:idNumber,
             phoneNumber=:phoneNumber,
             createdAt=:createdAt";

             // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->firstName=htmlspecialchars(strip_tags($this->firstName));
    $this->lastName=htmlspecialchars(strip_tags($this->lastName));
    $this->dateOfBirth=htmlspecialchars(strip_tags($this->dateOfBirth));
    $this->idNumber=htmlspecialchars(strip_tags($this->idNumber));
    $this->phoneNumber=htmlspecialchars(strip_tags($this->phoneNumber));
    $this->createdAt=htmlspecialchars(strip_tags($this->createdAt));

    //bind values

    // bind values
    $stmt->bindParam(":firstName", $this->firstName);
    $stmt->bindParam(":lastName", $this->lastName);
    $stmt->bindParam(":dateOfBirth", $this->dateOfBirth);
    $stmt->bindParam(":idNumber", $this->idNumber);
    $stmt->bindParam(":phoneNumber", $this->phoneNumber);
    $stmt->bindParam(":createdAt", $this->createdAt);
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
  
}


 
}