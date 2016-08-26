<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Liste des notes de frais</h1>
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
			<a href="/ipssi/ressources-humaines/note-frais/ajouter" class="btn btn-block btn-primary btn-sm">Ajouter</a>
		</div>
	</div><br/>

	<?php if(count($notes_frais_personnelles) > 0) : ?>

		<h2 class="sousTitrePageBack font16">Liste de mes Notes de Frais</h2>
		
		<table class="table table-bordered table-stripped" id="listeNotesFraisPersonnelles">
			<thead>
				<tr>
					<th class="text-center">Type Note de Frais</th>
					<th class="text-center">Etat</th>
					<th class="text-center">Date</th>
					<th class="text-center">Montant</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($notes_frais_personnelles as $nf) : ?>
					<tr>
						<td><?php echo $nf->type; ?></td>
						<td><?php echo $nf->etat; ?></td>
						<td class="text-center">
							<?php echo $nf->date_note_frais; ?>
						</td>
						<td><?php echo $nf->montant_note_frais .' €'; ?></td>

						<td class="center">
							<?php if(in_array('T', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/note-frais/detail/<?php echo $nf->id_note_frais; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/note-frais/modifier/<?php echo $nf->id_note_frais; ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/note-frais/supprimer/<?php echo $nf->id_note_frais; ?>" title="Supprimer" class="btn btn-xs btn-default btn-supprimer" onclick="return(confirm('Etes-vous sûre de vouloir supprimer cette note de frais ? Toute suppression est non reversible.'));">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('M', $droits) || in_array('P', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/note-frais/detail/<?php echo $nf->id_note_frais; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/note-frais/modifier/<?php echo $nf->id_note_frais; ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('V', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/note-frais/detail/<?php echo $nf->id_note_frais; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
							<?php endif; ?>
						</td>


					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>



	<?php if(count($notes_frais_autres) > 0) : ?>

		<h2 class="sousTitrePageBack font16">Liste des Notes de Frais à valider</h2>
		
		<table class="table table-bordered table-stripped" id="listeNotesFraisPersonnelles">
			<thead>
				<tr>
					<th class="text-center">Utilisateur</th>
					<th class="text-center">Type Note de Frais</th>
					<th class="text-center">Etat</th>
					<th class="text-center">Date</th>
					<th class="text-center">Montant</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($notes_frais_autres as $nf) : ?>
					<tr>
						<td><?php echo $nf->nom_utilisateur.' '.$nf->prenom_utilisateur; ?></td>
						<td><?php echo $nf->type; ?></td>
						<td><?php echo $nf->etat; ?></td>
						<td class="text-center">
							<?php echo $nf->date_note_frais; ?>
						</td>
						<td><?php echo $nf->montant_note_frais . ' €'; ?></td>

						<td class="center">
							<?php if(in_array('T', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/note-frais/detail/<?php echo $nf->id_note_frais; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/note-frais/modifier/<?php echo $nf->id_note_frais; ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/note-frais/supprimer/<?php echo $nf->id_note_frais; ?>" title="Supprimer" class="btn btn-xs btn-default btn-supprimer" onclick="return(confirm('Etes-vous sûre de vouloir supprimer cette note de frais ? Toute suppression est non reversible.'));">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/note-frais/valider/<?php echo $nf->id_note_frais; ?>" title="Valider" class="btn btn-xs btn-default btn-valider">
									<i class="fa fa-check" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('M', $droits) || in_array('P', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/note-frais/detail/<?php echo $nf->id_note_frais; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/note-frais/modifier/<?php echo $nf->id_note_frais; ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/note-frais/valider/<?php echo $nf->id_note_frais; ?>" title="Valider" class="btn btn-xs btn-default btn-valider">
									<i class="fa fa-check" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('V', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/note-frais/detail/<?php echo $nf->id_note_frais; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
							<?php endif; ?>
						</td>


					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>

	<!--
		Tableau NOtes de frais de moi
		Tableau NOtes de frais de tous sauf moi SI DROIT OK
	-->

	

</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>