<?php
echo "<label for='personne-select'>$date/$year</label>";
$user_exist = 0;
foreach ($planning->getUsers() as $user) {
  $tachesYear = 'taches' . $year;
  foreach ($user->$tachesYear as $tache) { //On vérifie si un user est déjà selectionné pour cette date
    if ($tache == $date . "/" . $year) {
      $user_exist = $user->prenom; //S'il existe on l'enregistre dans un variable
    }
  }
}
if ($user_exist) { //On l'affiche en premier dans le select
  echo "<select class='$user_exist' name='case$j' id='personne-select'>
        <option class='test' value='$user_exist'>$user_exist</option>";
  foreach ($planning->getUsers() as $user) { //puis on affiche les users restant
    if ($user->prenom != $user_exist) {
      echo "<option value='$user->prenom'>$user->prenom</option>";
    }
  }
  echo "<option value=''>personne</option>"; //Sans oublier option 'personne' à la fin
} else { //S'il n'y a pas encore d'users pour cette date
  echo "<select name='case$j' id='personne-select'>
        <option value=''>personne</option>"; //On affiche personne puis on affiche les uers dans le select
  foreach ($planning->getUsers() as $user) {
    echo "<option value='$user->prenom'>$user->prenom</option>";
  }
}
echo "</select>";