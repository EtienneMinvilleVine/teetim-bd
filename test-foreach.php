<?php
// Tableau simple : position numerique
  $fruits = ["pamplemousse", "grenade", "kiwi"];
  //Parcourir ce tableau avec une boucle expressive
//   (foreach)
foreach($fruits as $unFruit) {
    echo "<p>$unFruit</p>";
    
    /** @var stdClass $_ */
}

  //Tableau "associatif" (ressemble a un projet) : position étiquettée
  $listeGroupe1 = [
    "e1052145" => "Marc Antoine",
    "e5896584" => "Helise Morin",
    "e2589654" => "Marie Curie"
  ];
  foreach($listeGroupe1 as $noDossier => $nomPersonne){
     echo "<p><b>$nomPersonne</b> (<i>$noDossier</i>)</p>";
  }
?>