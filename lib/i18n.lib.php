<?php

/**********Librairie des fonctions utiles a l'i18n***************** */

/**
 * Obtient la liste des codes de langues disponibles sur le site.
 * @return array Tableau des codes de langues
 */

function obtenirLanguesDisponibles()
{
    $languesDispo = [];
    $contenuI18n = scandir('i18n');
    for ($i = 0; $i < count($contenuI18n); $i++) {
        $fichier = $contenuI18n[$i];
        if ($fichier != '.' && $fichier != '..') {
            $languesDispo[] = substr($fichier, 0, 2);
        }
    }
    return $languesDispo;
}
/**
 * Determine la langue active du site.
 * @param array $languesPermises Tableau des codes ISO639-1 des langues disponibles.
 * @return string Code de la langue en 2 lettres.
 */
function determinerLangue($languesPermises)
{
    $langue = 'fr';

    if (isset($_COOKIE['choixLangue']) && in_array($_COOKIE['choixLangue'], $languesPermises)) {
        $langue = $_COOKIE['choixLangue'];
    }

    if (isset($_GET['lan']) &&  in_array($_GET['lan'], $languesPermises)) {
        $langue = $_GET['lan'];
        setcookie('choixLangue', $langue, time() + 30 * 24 * 3600);
    }
    return $langue;
}
/**
 * Retourne les textes statiques de la page designee dans la langue indiquee
 * @param string $codeLangue Code de la langue active.
 * @param string $nomPage Nom de la page requise.
 * @return array Tableau des textes statiques organises par section (chaque section dans un objet)
 */
function obtenirTextesStatiques($codeLangue, $nomPage)
{
    $textes = json_decode(file_get_contents("i18n/" . $codeLangue . ".json"));
    return [$textes->entete,  $textes->pp, $textes->$nomPage];
}

/**
 * Obtient le code de direction d'ecriture de la langue indiquee par le code a deux lettres.
 * @param string $codeLangue Code de la langue en 2 lettres.
 * @return string Valeur de l'attribut DIR HTML ("rtl" ou "ltr")
 */
function obtenirDirectionTexte($codeLangue) {

return in_array ($codeLangue, ["ar", "he", "fa", "ur", "dv", "ps", "ku"])
	? 'rtl' : 'ltr';
}
// A finir...
function formaterMontant($codeLangue, $montant){

//return $montantFormate;
}
