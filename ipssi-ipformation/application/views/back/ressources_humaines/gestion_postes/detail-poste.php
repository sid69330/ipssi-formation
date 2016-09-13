<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Détail de la note de frais</h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/ressources-humaines/offre-poste" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
		</div>
	</div><br/>

	<?php if(isset($success)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-success"><?php echo $success; ?></div>
			</div>
		</div>
	<?php endif; ?>

	<div class="row">
		<div class="col-xs-12">
			<ul class="list-group">
		  		<li class="list-group-item"><strong>Type de poste</strong> : <?php echo $poste->type; ?></li>
		  		<li class="list-group-item"><strong>Titre</strong> : <?php echo $poste->titre_poste; ?></li>
		  		<li class="list-group-item"><strong>Entreprise</strong> : <?php echo $poste->entreprise_poste; ?></li>
		  		<li class="list-group-item"><strong>Accroche</strong> : <?php echo $poste->accroche_poste; ?></li>
		  		<li class="list-group-item"><strong>Description</strong> : <?php echo nl2br($poste->description); ?></li>		  		
		  		<li class="list-group-item"><strong>Niveau d'exprience</strong> : <?php echo $poste->niveau_experience .'€'; ?></li>
		  		<li class="list-group-item"><strong>Date de début contrat</strong> : <?php echo $poste->date_debut_poste; ?></li>
		  		<li class="list-group-item"><strong>Rémunération</strong> : <?php echo $poste->remuneration_poste .'€'; ?></li>
			</ul>
		</div>
	</div>

	<?php if((in_array('T', $droits)) || (in_array('M', $droits)) || (in_array('P', $droits))) : ?>
		<div class="row" style="margin-bottom:3px">
			<div class="col-xs-12">
				<a href="/ipssi/ressources-humaines/offre-poste/modifier/<?php echo $poste->id_poste; ?>" class="btn btn-block btn-primary btn-sm">Modifier</a>
			</div>
		</div>
	<?php endif; ?>
	<?php if(in_array('T', $droits)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<a href="/ipssi/ressources-humaines/offre-poste/supprimer/<?php echo $poste->id_poste; ?>" class="btn btn-block btn-danger btn-sm" onclick="return(confirm('Etes-vous sûre de vouloir supprimer ce poste à pourvoir ? Toute suppression est non reversible.'));">Supprimer</a>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>