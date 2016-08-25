<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Détail de la note de frais</h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/ressources-humaines/note-frais" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
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
		  		<li class="list-group-item"><strong>Utilisateur</strong> : <?php echo $notes_frais->nom_utilisateur.' '.$notes_frais->prenom_utilisateur; ?></li>
		  		<li class="list-group-item"><strong>Type de Note</strong> : <?php echo $notes_frais->type; ?></li>
		  		<li class="list-group-item"><strong>Date</strong> : <?php echo $notes_frais->date_note_frais; ?></li>
		  		<li class="list-group-item"><strong>Description</strong> : <?php echo nl2br($notes_frais->description_note_frais); ?></li>		  		
		  		<li class="list-group-item"><strong>Montant</strong> : <?php echo $notes_frais->montant_note_frais; ?></li>
		  		<?php if($notes_frais->trajet_note_frais <> null) : ?>
		  			<li class="list-group-item"><strong>Trajet</strong> : <?php echo $notes_frais->trajet_note_frais; ?></li>
		  		<?php endif; ?>
		  		<?php if($notes_frais->km_parcouru_note_frais <> null) : ?>
		  		<li class="list-group-item"><strong>nbr Km parcouru</strong> : <?php echo $notes_frais->km_parcouru_note_frais; ?></li>
		  		<?php endif; ?>
		  		<li class="list-group-item"><strong>Etat</strong> : <?php echo $notes_frais->etat; ?></li>
		  		<?php if($notes_frais->paiement <> null) : ?>
		  		<li class="list-group-item"><strong>Type de Paiement</strong> : <?php echo $notes_frais->paiement; ?></li>
		  		<?php endif; ?>
			</ul>
		</div>
	</div>

	<?php if((in_array('T', $droits)) && ($notes_frais->etat == 'En attente')) : ?>
		<div class="row" style="margin-bottom:3px">
			<div class="col-xs-12">
				<a href="/ipssi/ressources-humaines/note-frais/valider/<?php echo $notes_frais->id_note_frais; ?>" class="btn btn-block btn-success btn-sm">Valider</a>
			</div>
		</div>
	<?php endif; ?>
	<?php if((in_array('M', $droits)) && ($notes_frais->id_utilisateur <> $id_utilisateur_connecte) && ($notes_frais->etat == 'En attente')) : ?>
		<div class="row" style="margin-bottom:3px">
			<div class="col-xs-12">
				<a href="/ipssi/ressources-humaines/note-frais/valider/<?php echo $notes_frais->id_note_frais; ?>" class="btn btn-block btn-success btn-sm">Valider</a>
			</div>
		</div>
	<?php endif; ?>
	<?php if((in_array('T', $droits)) || (in_array('M', $droits)) || (in_array('P', $droits))) : ?>
		<div class="row" style="margin-bottom:3px">
			<div class="col-xs-12">
				<a href="/ipssi/ressources-humaines/note-frais/modifier/<?php echo $notes_frais->id_note_frais; ?>" class="btn btn-block btn-primary btn-sm">Modifier</a>
			</div>
		</div>
	<?php endif; ?>
	<?php if(in_array('T', $droits)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<a href="/ipssi/ressources-humaines/note-frais/supprimer/<?php echo $notes_frais->id_note_frais; ?>" class="btn btn-block btn-danger btn-sm" onclick="return(confirm('Etes-vous sûre de vouloir supprimer cette note de frais ? Toute suppression est non reversible.'));">Supprimer</a>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>