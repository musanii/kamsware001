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
             name=:name,
             description=:description,
             quantity=:quantity,
             client_id=:client_id,
             createdAt=:createdAt";

             // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->quantity=htmlspecialchars(strip_tags($this->quantity));
    $this->client_id=htmlspecialchars(strip_tags($this->client_id));
    $this->createdAt=htmlspecialchars(strip_tags($this->createdAt));

    //bind values

    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":quantity", $this->quantity);
    $stmt->bindParam(":client_id", $this->client_id);
    $stmt->bindParam(":createdAt", $this->createdAt);
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
  
}


 
}