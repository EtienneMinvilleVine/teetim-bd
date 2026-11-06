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
$tri = (isset($_GET['tri'])) ? $_GET['tri'] : 'aleatoire';

// b) Passer la valeur de tri a la fonction
[$themes, $produits] = obtenirCatalogue($page, $langue, $tri);



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
					<?php foreach ($themes as $codeTheme => $nomTheme) : ?>
						<option value="<?= $codeTheme; ?>"><?= $nomTheme; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="tri">
				<label for="tri">Trier par : </label>
				<select name="tri" id="tri">
					<option <?= ($tri == 'aleatoire') ? 'selected' : ''; ?> value="aleatoire">Aleatoire</option>
					<option <?= ($tri == 'ventesDesc') ? 'selected' : ''; ?> value="ventesDesc">Meilleur vendeur</option>
					<option <?= ($tri == 'prixAsc') ? 'selected' : ''; ?> value="prixAsc">Prix / ascendant</option>
					<option <?= ($tri == 'prixDesc') ? 'selected' : ''; ?> value="prixDesc">Prix / descendant</option>
					<!-- Les deux options de tri alphabetique ne sont pas encore integrees -->
					<option <?= ($tri == 'nomAsc') ? 'selected' : ''; ?> value="nomAsc">Alpha / ascendant</option>
					<option <?= ($tri == 'nomDesc') ? 'selected' : ''; ?> value="nomDesc">Alpha / descendant</option>
					<option <?= ($tri == 'dacDesc') ? 'selected' : ''; ?> value="dacDesc">Nouveauté</option>
				</select>
			</div>
		</form>
	</article>
	<article class="principal">
		<!-- Gabarit -->
		<?php foreach ($produits as $prd) : ?>
			<div class="produit">
				<span class="image">
					<img src="images/produits/teeshirts/<?= $prd->id; ?>.webp" alt="<?= $prd->nom->$langue; ?>">
				</span>
				<span class="nom"><?= $prd->nom->$langue; ?></span>
				<span class="prix"><?= $formatteurMontants->formatCurrency($prd->prix, 'CAD'); ?></span>
				<span><?= $prd->ventes; ?></span>
				<span><?= $prd->dac; ?></span>
			</div>
		<?php endforeach; ?>
	</article>
</main>
<?php include('parties-communes/pied2page.php'); ?>