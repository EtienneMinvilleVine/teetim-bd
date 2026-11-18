<?php
// Etape 1 : Obtenir une connexion a MySQL
$cnx = new mysqli('db', 'teetim', 'teetim', 'teetim');

// Etape 2 : Ecrire une requete (commande) SQL
$requeteProduits = "SELECT nom, prix FROM produit LIMIT 10";

// Etape 3 : Executer la commande sur la connexion MySQL
$resultat = $cnx->query($requeteProduits);

 // Etape 4 : dans le code HTML plus bas...
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Integration PHP/MySQL</title>
</head>

<body>
 <h2>Les 10 premiers produits (nom et prix)</h2>
 <ul>
    <?php
        while($unProduit = $resultat->fetch_assoc()):
    ?>
    <li><?= $unProduit['nom']; ?>(<?= $unProduit['prix'] ?>)</li>
    <?php
        endwhile;
    ?>
 </ul>
</body>

</html>