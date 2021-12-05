<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:ital,wght@0,400;0,600;0,700;1,300&display=swap"
    rel="stylesheet">
  <title>Planning</title>
</head>

<body>
  <?php
  session_start();

  require_once('./Model/Connection.php');
  require_once('./Model/Planning.php');
  require_once('./Model/UserManager.php');

  $connection = new Connection();
  $planning = new Planning($connection->getDb());
  $userManager = new UserManager($connection->getDb());

  //Déconnexion
  if (isset($_GET['logout']) && !empty($_GET['logout'])) {
    $userManager->logout();
  }

  //Connexion
  if (isset($_GET['login']) && !empty($_GET['login'])) {
    $userManager->login($_POST['email'], $_POST['password']);
  }

  //Récupérer la Date
  if (isset($_GET['year']) && !empty($_GET['year'])) {
    $year = $_GET['year'];
  } else {
    $year = '2018';
  }

  //Mettre à jour le(s) utilisateur(s)
  if (isset($_GET['setUser']) && !empty($_GET['setUser'])) {
    $planning->setUsers($year);
  }

  ?>

  <nav>
    <p>Viencent RODRIGUEZ<br>Noé PHILIPPE</p>
    <h2>Mini-Projet Planning</h2>
    <?php
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
      echo "<a href='index.php?logout=1'>Déconnexion</a>";
    } else {
      echo "<a href='index.php?logout=0'>Connexion</a>";
    }
    ?>
  </nav>

  <div class="main-page">
    <?php
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
      require_once('./View/planning.php');
    } else {
      require_once('./View/login.php');
    }
    ?>
  </div>

  <footer>
    <p>Licence professionnelle Projet Web et Mobile à Sorbonne Université 2018/2019</p>
  </footer>
</body>

</html>