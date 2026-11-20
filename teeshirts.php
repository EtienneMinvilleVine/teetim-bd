<?php

/** 
 * @var stdClass $_ : raccourci pour la section texte de cette page. 
 * @var string $langue Code de la langue active.
 * */
// Librairie du catalogue de produits.
include('lib/catalogue.lib.php');
// Définir la variable $page pour indiquer la page affichée.
$page = 'teeshirts';

// Inclure la partie de haut de la page.
include('parties-communes/entete.php');

// Gerer l'interactivite de filtre et de tri.
// a) Capturer la saisie de l'utilisateur
$tri = $_GET['tri'] ?? 'RAND()';
$filtre = (isset($_GET['filtre'])) ? $_GET['filtre'] : 'tous';

// b) Passer la valeur de tri a la fonction
$themes = obtenirThemes();
// print_r($themes);
$produits = obtenirProduits(1, $tri, $filtre);




// Formatteur des montants d'argent
$formatteurMontants = new NumberFormatter($langue, NumberFormatter::CURRENCY);

?>
<main class="page-produits page-teeshirts">
	<article class="amorce">
		<h1><?= $_->titrePage ?></h1>
		<form class="controle">
			<div class="filtre">
				<label for="filtre">Filtrer par thème : </label>
				<select name="filtre" id="filtre">
					<option value="tous">Tous les produits</option>
					<!--Gabarit option theme-->
					<?php foreach ($themes as $unTheme) : ?>
						<option <?= ($filtre===$unTheme->id) ? ' selected ' : ''; ?>
							value="<?= $unTheme->id;?>"
							>
							<?=  $unTheme->nom; ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="tri">
				<label for="tri">Trier par : </label>
				<select name="tri" id="tri">
					<option <?= ($tri == 'RAND()') ? 'selected' : ''; ?> value="RAND()">Aleatoire</option>
					<option <?= ($tri == 'ventes DESC') ? 'selected' : ''; ?> value="ventes DESC">Meilleur vendeur</option>
					<option <?= ($tri == 'prix ASC') ? 'selected' : ''; ?> value="prix ASC">Prix / ascendant</option>
					<option <?= ($tri == 'prix DESC') ? 'selected' : ''; ?> value="prix DESC">Prix / descendant</option>
					<!-- Les deux options de tri alphabetique ne sont pas encore integrees -->
					<option <?= ($tri == 'nom ASC') ? 'selected' : ''; ?> value="nom ASC">Alpha / ascendant</option>
					<option <?= ($tri == 'nom DESC') ? 'selected' : ''; ?> value="nom DESC">Alpha / descendant</option>
					<option <?= ($tri == 'dac DESC') ? 'selected' : ''; ?> value="dac DESC">Nouveauté</option>
				</select>
			</div>
		</form>
	</article>
	<article class="principal">
		<!-- Gabarit -->
		<?php foreach ($produits as $prd) : ?>
			<div class="produit">
				<span class="image">
					<img src="images/produits/teeshirts/<?= $prd->fichier_image; ?>" alt="<?= $prd->fichier_image;?>">
				</span>
				<span class="nom"><?= $prd->nom; ?></span>
				<span class="prix"><?= $formatteurMontants->formatCurrency($prd->prix, 'CAD'); ?></span>
				<span><?= $prd->ventes; ?></span>
				<span><?= $prd->dac; ?></span>
			</div>
		<?php endforeach; ?>
	</article>
</main>
<?php include('parties-communes/pied2page.php'); ?>