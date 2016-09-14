<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Détail de la demande de congés</h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/ressources-humaines/liste-conges" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
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
		  		<li class="list-group-item"><strong>Type de congé</strong> : <?php echo $conge->type; ?></li>
		  		<li class="list-group-item"><strong>Etat</strong> : <?php echo $conge->etat; ?></li>
		  		<li class="list-group-item"><strong>Date de début</strong> : <?php echo $conge->date_debut; ?></li>
		  		<li class="list-group-item"><strong>Date de fin</strong> : <?php echo $conge->date_fin; ?></li>
		  		<li class="list-group-item"><strong>Nombre de jours</strong> : <?php echo $conge->nb_jour; ?></li>
		  		<li class="list-group-item"><strong>Date de la demande</strong> : <?php echo $conge->date_demande; ?></li>
			</ul>
		</div>
	</div>

	<?php if((in_array('T', $droits)) && ($conge->etat == 'En attente')) : ?>
		<div class="row" style="margin-bottom:3px">
			<div class="col-xs-12">
				<a href="/ipssi/ressources-humaines/liste-conges/valider/<?php echo $conge->id_conges; ?>" class="btn btn-block btn-success btn-sm">Valider</a>
			</div>
		</div>
	<?php endif; ?>
	<?php if((in_array('M', $droits)) && ($conge->etat == 'En attente')) : ?>
		<div class="row" style="margin-bottom:3px">
			<div class="col-xs-12">
				<a href="/ipssi/ressources-humaines/liste-conges/valider/<?php echo $conge->id_conges; ?>" class="btn btn-block btn-success btn-sm">Valider</a>
			</div>
		</div>
	<?php endif; ?>
	<?php if((in_array('T', $droits)) || (in_array('M', $droits)) || (in_array('P', $droits))) : ?>
		<div class="row" style="margin-bottom:3px">
			<div class="col-xs-12">
				<a href="/ipssi/ressources-humaines/liste-conges/modifier/<?php echo $conge->id_conges; ?>" class="btn btn-block btn-primary btn-sm">Modifier</a>
			</div>
		</div>
	<?php endif; ?>
	<?php if(in_array('T', $droits)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<a href="/ipssi/ressources-humaines/liste-conges/supprimer/<?php echo $conge->id_conges; ?>" class="btn btn-block btn-danger btn-sm" onclick="return(confirm('Etes-vous sûre de vouloir supprimer cette note de frais ? Toute suppression est non reversible.'));">Supprimer</a>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>