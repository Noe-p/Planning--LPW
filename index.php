<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com"> 
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:ital,wght@0,400;0,600;0,700;1,300&display=swap" rel="stylesheet">
  <title>Planning</title>
</head>

<body>
  <?php 
    require_once('./Model/Planning.php');
    $planning = new Planning();

    if(isset($_POST) && !empty($_POST)){
      $planning->setUsers();
    }
  ?>
  
  <nav>
    <p>Viencent RODRIGUEZ<br>Noé PHILIPPE</p>
    <h2>Mini-Projet Planning</h2>
    <p>Licence Projet Web et Mobile</p>
  </nav>

  <div class="main-page">
    <h1>Planning des corvées d'épluchage</h1>

    <form action="index.php" method="POST">
      <div>
        <label for="year-select">Année :</label>
        <select name="year" id="year-select">
          <option value="2018">2018</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
        </select>
      </div>

      <table>
        <tbody>
          <?php 
            $i=0;
            $j=0;//pour numéroter la case
            $nb_dates_ligne = 6;//Afficher le nombre de dates par lignes
            foreach($planning->getDates() as $date){
              $i++;
              if($i==1) 
                echo "<tr>";
              
              echo"<td>";
                require('./View/selectPersonne.php');
              echo"</td>";
              
              if($i==$nb_dates_ligne){
                 echo"</tr>"; 
                 $i=0;
              }
              $j++;
            }
          ?>
        </tbody>
      </table>

      <input type="submit" class="submit-btn" value="Valider le planning"> 
    </form>
    
    <div class="statistic">
      <h1>Statistique par ordre croissant</h1>

      <ul>
        <?php 
          foreach($planning->getUsers() as $user){
            echo "<li><span>".$user->prenom." :</span> ".count($user->taches)."</li>";
          }
        ?>
      </ul>
    </div>
  </div>
</body>

</html>