<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Liste des demandes de congés</h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<?php if(isset($success)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-success"><?php echo $success; ?></div>
			</div>
		</div>
	<?php endif; ?>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/ressources-humaines/liste-conges/ajouter" class="btn btn-block btn-primary btn-sm">Ajouter</a>
		</div>
	</div><br/>

	<?php if(count($congesPersonnels) > 0) : ?>

		<h2 class="sousTitrePageBack font16">Liste de mes Demandes de congés</h2>
		
		<table class="table table-bordered table-stripped" id="listeNotesFraisPersonnelles">
			<thead>
				<tr>
					<th class="text-center">Type de demande</th>
					<th class="text-center">Date de début</th>
					<th class="text-center">Date de fin</th>
					<th class="text-center">Nombre de jours</th>
					<th class="text-center">Etat</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($congesPersonnels as $c) : ?>
					<tr>
						<td><?php echo $c->type; ?></td>
						<td><?php echo $c->date_debut; ?></td>
						<td><?php echo $c->date_fin; ?></td>
						<td><?php echo $c->nb_jour; ?></td>
						<td><?php echo $c->etat; ?></td>

						<td class="center">
							<?php if(in_array('T', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/liste-conges/detail/<?php echo $c->id_conges; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/liste-conges/modifier/<?php echo $c->id_conges; ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
								<?php if($c->id_etat == 1) : ?>
									<a href="/ipssi/ressources-humaines/liste-conges/supprimer/<?php echo $c->id_conges; ?>" title="Supprimer" class="btn btn-xs btn-default btn-supprimer" onclick="return(confirm('Etes-vous sûre de vouloir supprimer cette note de frais ? Toute suppression est non reversible.'));">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</a>
								<?php endif; ?>
							<?php elseif(in_array('M', $droits) || in_array('P', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/liste-conges/detail/<?php echo $c->id_conges; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/liste-conges/modifier/<?php echo  $c->id_conges; ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('V', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/liste-conges/detail/<?php echo  $c->id_conges; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
							<?php endif; ?>
						</td>


					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>	

	<?php if(count($conges) > 0) : ?>

		<h2 class="sousTitrePageBack font16">Liste des Demandes de congés</h2>
		
		<table class="table table-bordered table-stripped" id="listeNotesFraisPersonnelles">
			<thead>
				<tr>
					<th class="text-center">Type de demande</th>
					<th class="text-center">Date de début</th>
					<th class="text-center">Date de fin</th>
					<th class="text-center">Nombre de jours</th>
					<th class="text-center">Etat</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($conges as $c) : ?>
					<tr>
						<td><?php echo $c->type; ?></td>
						<td><?php echo $c->date_debut; ?></td>
						<td><?php echo $c->date_fin; ?></td>
						<td><?php echo $c->nb_jour; ?></td>
						<td><?php echo $c->etat; ?></td>

						<td class="center">
							<?php if(in_array('T', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/liste-conges/detail/<?php echo $c->id_conges; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/liste-conges/valider/<?php echo $c->id_conges; ?>" title="Valider" class="btn btn-xs btn-default btn-default btn-valider">
									<i class="fa fa-check" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('M', $droits) || in_array('P', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/liste-conges/detail/<?php echo $c->id_conges; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/liste-conges/valider/<?php echo $c->id_conges; ?>" title="Valider" class="btn btn-xs btn-default btn-default btn-valider">
									<i class="fa fa-check" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('V', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/liste-conges/detail/<?php echo  $c->id_conges; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
							<?php endif; ?>
						</td>


					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>

</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>