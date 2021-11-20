<?php 
  require('./all_date.php');
  try {
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $read = new MongoDB\Driver\Query([], []);
    $all_users = $manager->executeQuery('Planning.users', $read);
    
    foreach($all_users as $user){
      $i=0;
      $user_date = [];
      foreach($all_date as $date){
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

      $result = $manager->executeBulkWrite('Planning.users', $updates);
    }

    header('Location: ./index.php');
  } 
  catch (MongoDB\Driver\ConnectionException $e) {
      echo $e->getMessage();
  } 
?>