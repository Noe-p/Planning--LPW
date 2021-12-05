 <h1>Planning des corvées d'épluchage</h1>

 <!-- Selection de l'année :  -->
 <form class="form_year">
   <label for="year-select">Année :</label>
   <select onchange="document.location.href='index.php?year='+this.value" name="year" id="year-select">
     <?php
      $years = ['2018', '2019', '2020', '2021'];
      echo "<option value='$year'>$year</option>";
      foreach ($years as $y) {
        if ($y != $year) {
          echo "<option value='$y'>$y</option>";
        }
      }
      ?>
   </select>
 </form>

 <!-- Repartition des taches : -->
 <?php echo "<form class='form_date' action='index.php?year=$year&setUser=1' method='POST'>"; ?>
 <table>
   <tbody>
     <?php
      $i = 0;
      $j = 0; //pour numéroter la case
      $nb_dates_ligne = 4; //Nombre de dates par lignes
      foreach ($planning->getDates() as $date) {
        $i++;
        if ($i == 1) {
          echo "<tr>";
        }
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
      foreach ($planning->getNbTaches($year) as $user) {
        echo "<li><span>" . $user->prenom . " :</span> " . $user->count . "</li>";
      }
      ?>
   </ul>


 </div>