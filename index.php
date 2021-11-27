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
  require_once('./Model/Planning.php');
  $planning = new Planning();

  if (isset($_GET['year']) && !empty($_GET['year']))
    $year = $_GET['year'];
  else
    $year = '2018';

  if (isset($_POST) && !empty($_POST)) {
    $planning->setUsers($year);
  }
  ?>

  <nav>
    <p>Viencent RODRIGUEZ<br>Noé PHILIPPE</p>
    <h2>Mini-Projet Planning</h2>
    <p>Licence Projet Web et Mobile</p>
  </nav>

  <div class="main-page">
    <h1>Planning des corvées d'épluchage</h1>

    <form class="form_year">
      <label for="year-select">Année :</label>
      <select onchange="document.location.href='index.php?year='+this.value" name="year" id="year-select">
        <?php
        $years = ['2018', '2019', '2020', '2021'];
        echo "<option value='$year'>$year</option>";
        foreach ($years as $y) {
          if ($y != $year) {
            echo "<option class='option' value='$y'>$y</option>";
          }
        }
        ?>
      </select>
    </form>

    <?php echo "<form class='form_date' action='index.php?year=$year' method='POST'>"; ?>
    <table>
      <tbody>
        <?php
        $i = 0;
        $j = 0; //pour numéroter la case
        $nb_dates_ligne = 6; //Afficher le nombre de dates par lignes
        foreach ($planning->getDates() as $date) {
          $i++;
          if ($i == 1)
            echo "<tr>";

          echo "<td>";
          require('./View/selectPersonne.php');
          echo "</td>";

          if ($i == $nb_dates_ligne) {
            echo "</tr>";
            $i = 0;
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
        foreach (array_reverse($planning->getNbTaches($year)) as $key => $user) {
          echo "<li>$key : $user</li>";
        }
        ?>
      </ul>
    </div>
  </div>
</body>

</html>