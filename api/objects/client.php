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
 
}