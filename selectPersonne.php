<?php
  try {
    
    // Connexion à MongoDB
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    //$manager = new MongoDB\Driver\Manager("mongodb+srv://noe:3010@cluster0.1wmwr.mongodb.net/test");
    // filtre
    $filter = [];
    $option = [];
    $read = new MongoDB\Driver\Query($filter, $option);
    $all_users = $manager->executeQuery('Planning.users', $read);
    $all_users2 = $manager->executeQuery('Planning.users', $read);
    $all_users3 = $manager->executeQuery('Planning.users', $read);

  } 
  catch (MongoDB\Driver\ConnectionException $e) {
    echo $e->getMessage();
  }
?>


<label for="personne-select"><?php echo "$date/2018" ?></label>
<select name="<?php echo "case$j" ?>" id="personne-select">
  <?php 
    $flag = 0;
    foreach ($all_users as $user) {
      foreach($user->taches as $tache){
        if($tache == "$date/2018"){
          $flag = $user->prenom;
        }
      }
    }
    if($flag){
      echo "<option value='$flag'>$flag</option>";
      foreach ($all_users2 as $user) {
        if($user->prenom != $flag)
          echo "<option value='$user->prenom'>$user->prenom</option>";
      }  
      echo "<option value=''>personne</option>";
    }
    else{
      echo "<option value=''>personne</option>";
      foreach ($all_users3 as $user) {
        echo "<option value='$user->prenom'>$user->prenom</option>";
      }  
    }
  ?>
</select>