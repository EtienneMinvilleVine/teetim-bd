<?php

/******************Librairie de code pour gerer le catalogue des produits */
/**
 * Retourne les themes et les produits de la categorie demandee.
 * @param string $categorie Categorie de produits (ex: teeshirts, casquettes, etc.).
 * @param string $codeLangue Code en deux lettres de la langue d'affichage.
 * @param string $critereTri Valeur du critere de tri selectionne par l'utilisateur.
 * @return array Tableau contenant les deux tableaux des themes et des produits.
 */
function obtenirCatalogue($categorie, $codeLangue, $critereTri)
{
	$catalogue = json_decode(file_get_contents("data/$categorie.json"));

	$themes = [];
	$produits = [];

	foreach ($catalogue as $codeTheme => $detailTheme) {
		$themes[$codeTheme] = $detailTheme->theme->$codeLangue;
		//Tableau des produits
		$produits = array_merge($produits, $detailTheme->produits);
	}

	// Trier le tableau $produits avant de le retourner
	// Utiliser comme fonction de comparaison la fonction nommee suivant la variable $critereTri.
	if (function_exists($critereTri)) {
		usort($produits, $critereTri);
	} else {
		shuffle($produits);
	}
	return [$themes, $produits];
}

/**
 * Fonction de comparaison des prix descendants des produits.
 * @param stdClass $prd1 Objet correspondant au premier produit a comparer.
 * @param stdClass $prd2 Objet correspondant au deuxieme produit a comparer.
 * @return int Nombre entier positif, negatif, ou 0 selon la comparaison.
 */
function prixDesc($prd1, $prd2)
{
	return $prd2->prix - $prd1->prix;
}

// Prix asc
/**
 * Fonction de comparaison des prix ascendants des produits.
 * @param stdClass $prd1 Objet correspondant au premier produit a comparer.
 * @param stdClass $prd2 Objet correspondant au deuxieme produit a comparer.
 * @return int Nombre entier positif, negatif, ou 0 selon la comparaison.
 */
function prixAsc($prd1, $prd2)
{
	return $prd1->prix - $prd2->prix;
}
// Nom desc

// Ventes desc
/**
 * Fonction de comparaison des chiffres de vente en ordre descendant des produits.
 * @param stdClass $prd1 Objet correspondant au premier produit a comparer.
 * @param stdClass $prd2 Objet correspondant au deuxieme produit a comparer.
 * @return int Nombre entier positif, negatif, ou 0 selon la comparaison.
 */
function ventesDesc($prd1, $prd2)
{
	return $prd2->prix - $prd1->ventes;
}
// DAC desc
/**
 * Fonction de comparaison des dates d'ajout au catalogue en ordre descendant des produits.
 * @param stdClass $prd1 Objet correspondant au premier produit a comparer.
 * @param stdClass $prd2 Objet correspondant au deuxieme produit a comparer.
 * @return int Nombre entier positif, negatif, ou 0 selon la comparaison.
 */
function dacDesc($prd1, $prd2)
{
	// return 100 * $prd2->prix - 100 * $prd1->prix;
	if ($prd2->dac > $prd1->dac) {
		return 1;
	} else if ($prd2->dac < $prd1->dac) {
		return -1;
	} else {
		return;
	}
}
