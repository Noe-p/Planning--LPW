<?php
class Planning{
  private $db; 
  private $dates;

  public function __construct(){
    try{
      require_once('./Model/all_date.php');//Contient un tableau de dates
      $this->dates = $all_date;
      $this->db = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    }
    catch (MongoDB\Driver\ConnectionException $e) {
      echo $e->getMessage();
    }
  }

  //Récupérer tous les utilisateurs
  public function getUsers(){
    try{
      $read = new MongoDB\Driver\Query([], []);
      $all_users = $this->db->executeQuery('Planning.users', $read);
    }
    catch (MongoDB\Driver\ConnectionException $e) {
      echo $e->getMessage();
    }
    return $all_users;
  }

  //Récupérer le tableau de dates
  public function getDates(){
    return $this->dates;
  }

  //Mettre à jour la base de données
  public function setUsers(){
    try {
      foreach($this->getUsers() as $user){
        $i=0;
        $user_date = [];
        foreach($this->dates as $date){
          if($_POST["case$i"] == $user->prenom){
            $user_date[] = "$date/".$_POST['year'];
          }
        $i++;
        }

        $updates = new MongoDB\Driver\BulkWrite();
        $updates->update(
          ['prenom' => $user->prenom], 
          ['$set' => ['taches' => $user_date]],
          ['multi' => true, 'upsert' => true]
        );

        $this->db->executeBulkWrite('Planning.users', $updates);
      }
    } 
    catch (MongoDB\Driver\ConnectionException $e) {
        echo $e->getMessage();
    } 
  }
}

?>