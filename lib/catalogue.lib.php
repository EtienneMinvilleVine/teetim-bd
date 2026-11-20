<?php

/******************Librairie de code pour gerer le catalogue des produits */

/**
 * Retourne les themes.
 * @return array Tableau contenant des objets representant les themes.
 */
function obtenirThemes(){
	$cnx = new mysqli('db', 'teetim', 'teetim', 'teetim');
	$resultat = $cnx->query("SELECT id, nom FROM theme");
	// return $resultat->fetch_all(MYSQLI_ASSOC);

	$themes = [];
	while($uneLigne = $resultat->fetch_object()){
		$themes[] = $uneLigne;
	}
	return $themes;
}
/**
 * Retourne les themes et les produits de la categorie demandee.
 * @param string $categorie Categorie de produits (ex: teeshirts, casquettes, etc.).
 * @param string $codeLangue Code en deux lettres de la langue d'affichage.
 * @param string $critereTri Valeur du critere de tri selectionne par l'utilisateur.
 * @param string $critereFiltre Valeur du critere de tri selectionne par l'utilisateur.
 * @return array Tableau contenant des objets qui representent les produits.
 */
function obtenirProduits($categorie, $critereTri, $critereFiltre)
{
	$cnx = new mysqli('db', 'teetim', 'teetim', 'teetim');
	$clauseWhere = ($critereFiltre==="tous") ? "" : "WHERE thm_id=$critereFiltre";
	$sql = "SELECT * FROM produit $clauseWhere ORDER BY $critereTri";
	$resultat = $cnx->query($sql);
	$produits = []; 
	while($prod = $resultat-> fetch_object()) {
		$produits[] = $prod;
	}
	return $produits;
}


