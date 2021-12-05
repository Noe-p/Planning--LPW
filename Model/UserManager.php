<?php
class UserManager
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  //Connexion
  public function login($email, $password)
  {
    $res = $this->db->find([
      'email' => "$email",
      'password' => "$password",
    ]);

    foreach ($res as $user) {
      if ($user->email) {
        $_SESSION['user'] = $user->prenom;
      }
    }
  }

  //Déconnexion : 
  public function logout()
  {
    unset($_SESSION['user']);
  }
}