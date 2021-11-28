<?php
class Planning
{
  private $db;
  private $dates;

  public function __construct()
  {
    try {
      require_once('./Model/dates.php'); //Contient un tableau de dates
      $this->dates = $all_date;
      //$this->db = new MongoDB\Driver\Manager("mongodb+srv://noe:3010@cluster0.1wmwr.mongodb.net/test");
      $this->db = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    } catch (MongoDB\Driver\ConnectionException $e) {
      echo $e->getMessage();
    }
  }

  //Récupérer tous les utilisateurs
  public function getUsers()
  {
    try {
      $read = new MongoDB\Driver\Query([], []);
      $all_users = $this->db->executeQuery('Planning.users', $read);
    } catch (MongoDB\Driver\ConnectionException $e) {
      echo $e->getMessage();
    }
    return $all_users;
  }

  public function getNbTaches($year)
  {
    $all_users = $this->getUsers();

    $nb_taches = array();
    foreach ($all_users as $user) {
      $taches_year = "taches" . $year;
      $nb_taches["$user->prenom"] = count($user->$taches_year);
    }

    asort($nb_taches);
    return $nb_taches;
  }

  //Récupérer le tableau de dates
  public function getDates()
  {
    return $this->dates;
  }

  //Mettre à jour la base de données
  public function setUsers($year)
  {
    try {
      foreach ($this->getUsers() as $user) {
        $i = 0;
        $user_date = [];
        foreach ($this->dates as $date) { //On regarde dans chaque case s'il y a un nom
          if ($_POST["case$i"] == $user->prenom) { //Si le nom corespond à l'user
            $user_date[] = $date . "/" . $year; //on enregistre la date dans un tableau 
          }
          $i++;
        }

        $updates = new MongoDB\Driver\BulkWrite();
        $updates->update(
          ['prenom' => $user->prenom],
          ['$set' => ['taches' . $year => $user_date]],
          ['multi' => true, 'upsert' => true]
        );

        $this->db->executeBulkWrite('Planning.users', $updates);
      }
    } catch (MongoDB\Driver\ConnectionException $e) {
      echo $e->getMessage();
    }
  }
}