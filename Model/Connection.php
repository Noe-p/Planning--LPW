<?php
class Connection
{
  private $db;

  public function __construct()
  {
    require './vendor/autoload.php';

    $client = new MongoDB\Client("mongodb+srv://noe:3010@cluster0.1wmwr.mongodb.net/test");
    //$client = new MongoDB\Client("mongodb://localhost:27017");
    $this->db = $client->Planning->users;
  }

  public function getDb()
  {
    return $this->db;
  }
}