<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Liste des candidatures</h1>
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

	<h2 class="sousTitrePageBack font16">Candidatures spontannées</h2>

	<?php if(count($candidatures_spontannees) > 0) : ?>
		
		<table class="table table-bordered table-stripped" id="listeNotesFraisPersonnelles">
			<thead>
				<tr>
					<th class="text-center">Sexe</th>
					<th class="text-center">Nom</th>
					<th class="text-center">Prénom</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($candidatures_spontannees as $c) : ?>
					<tr>
						<td><?php echo $c->sexe; ?></td>
						<td><?php echo $c->nom_candidature; ?></td>
						<td><?php echo $c->prenom_candidature; ?></td>
						<td class="center">
							<?php if(in_array('T', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/candidatures/detail/<?php echo $c->id_candidature; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/candidatures/cvtheque/<?php echo $c->id_candidature; ?>" title="CVThèque" class="btn btn-xs btn-default btn-valider">
									<i class="fa fa-folder" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/candidatures/supprimer/<?php echo $c->id_candidature; ?>" title="Supprimer" class="btn btn-xs btn-default btn-supprimer" onclick="return(confirm('Etes-vous sûre de vouloir supprimer ce poste à pourvoir ? Toute suppression est non reversible.'));">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('M', $droits) || in_array('P', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/candidatures/detail/<?php echo $c->id_candidature; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/candidatures/cvtheque/<?php echo $c->id_candidature; ?>" title="CVThèque" class="btn btn-xs btn-default btn-valider">
									<i class="fa fa-folder" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('V', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/candidatures/detail/<?php echo $p->id_poste; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
							<?php endif; ?>
						</td>


					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>

	<h2 class="sousTitrePageBack font16">Candidatures</h2>
	<?php if(count($candidatures) > 0) : ?>
		
		<table class="table table-bordered table-stripped" id="listeNotesFraisPersonnelles">
			<thead>
				<tr>
					<th class="text-center">Sexe</th>
					<th class="text-center">Nom</th>
					<th class="text-center">Prénom</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($candidatures as $c) : ?>
					<tr>
						<td><?php echo $c->sexe; ?></td>
						<td><?php echo $c->nom_candidature; ?></td>
						<td><?php echo $c->prenom_candidature; ?></td>
						<td class="center">
							<?php if(in_array('T', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/candidatures/detail/<?php echo $c->id_candidature; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/candidatures/cvtheque/<?php echo $c->id_candidature; ?>" title="CVThèque" class="btn btn-xs btn-default btn-valider">
									<i class="fa fa-folder" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/candidatures/supprimer/<?php echo $c->id_candidature; ?>" title="Supprimer" class="btn btn-xs btn-default btn-supprimer" onclick="return(confirm('Etes-vous sûre de vouloir supprimer ce poste à pourvoir ? Toute suppression est non reversible.'));">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('M', $droits) || in_array('P', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/candidatures/detail/<?php echo $c->id_candidature; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/candidatures/cvtheque/<?php echo $c->id_candidature; ?>" title="CVThèque" class="btn btn-xs btn-default btn-valider">
									<i class="fa fa-folder" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('V', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/candidatures/detail/<?php echo $p->id_poste; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
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