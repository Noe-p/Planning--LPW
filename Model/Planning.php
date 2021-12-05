<?php
class Planning
{
  private $db;
  private $dates;

  public function __construct($db)
  {
    try {
      require_once('./Model/dates.php'); //Contient un tableau de dates

      $this->dates = $all_date;
      $this->db = $db;
    } catch (MongoDB\Driver\ConnectionException $e) {
      echo $e->getMessage();
    }
  }

  //Récupérer tous les utilisateurs
  public function getUsers()
  {
    try {
      $res = $this->db->find();
    } catch (MongoDB\Driver\ConnectionException $e) {
      echo $e->getMessage();
    }
    return $res;
  }

  //Retourne Le nombre de taches dans l'ordre croissant : 
  public function getNbTaches($year)
  {
    try {
      $res = $this->db->aggregate([
        [
          '$project' => [
            'prenom' => '$prenom',
            'count' => ['$size' => '$taches' . $year]
          ]
        ],
        ['$sort' => ['count' => -1]],
      ]);
    } catch (MongoDB\Driver\ConnectionException $e) {
      echo $e->getMessage();
    }
    return $res;
  }

  //Récuperer le tableau de dates
  public function getDates()
  {
    return $this->dates;
  }

  //Mettre à jour l'utilisateur
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
        $this->db->updateOne(
          ['prenom' => $user->prenom],
          ['$set' => ['taches' . $year => $user_date]],
        );
      }
    } catch (MongoDB\Driver\ConnectionException $e) {
      echo $e->getMessage();
    }
  }
}