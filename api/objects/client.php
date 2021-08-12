<?php

class Client {

    //db conn & table name

    private $conn;
    private $table_name = "clients";

    //properties
    public $id;
    public $firstName;
    public $lastName;
    public $dateOfBirth;
    public $idNumber;
    public $phoneNumber;

    //constructor with $db as database connection
public function __construct($db)
{
    $this->conn = $db;
    
}

//read  clients 

function read(){

    $query = "SELECT *  FROM " . $this->table_name . " ORDER BY createdAt DESC";

    //prepare query sts=mt
    $stmt = $this->conn->prepare($query);

    //execute
    $stmt->execute();
    return $stmt;
}
 
}