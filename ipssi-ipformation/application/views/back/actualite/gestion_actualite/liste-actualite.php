<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Liste des actualités</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<?php if(in_array('T', $droits)) : ?>
				<p class="font11 italique center">Vous possédez tous les droits sur cette page</p>
			<?php elseif(in_array('M', $droits)) : ?>
				<p class="font11 italique center">Vous possédez le droit de modification et visualisation</p>
			<?php elseif(in_array('P', $droits)) : ?>
				<p class="font11 italique center">Vous possédez le droit de visualisation et modification personnelle</p>
			<?php elseif(in_array('V', $droits)) : ?>
				<p class="font11 italique center">Vous possédez le droit de visualisation N et N-</p>
			<?php endif; ?>
		</div>
	</div><br/>

	<?php if(isset($success)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-success"><?php echo $success; ?></div>
			</div>
		</div>
	<?php endif; ?>

	<?php if(in_array('T', $droits)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<a href="/ipssi/actualites/gestion-actualites/ajouter" class="btn btn-block btn-primary btn-sm">Ajouter</a>
			</div>
		</div><br/>
	<?php endif; ?>

	<?php if(count($actualites) > 0) : ?>
		<table class="table table-bordered table-stripped" id="listeActualite">
			<thead>
				<tr>
					<th>Ajouté par</th>
					<th>Titre</th>
					<th>Ajouté le</th>
					<th>Fin validité *</th>
					<th>Actif *</th>
					<th>Front</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($actualites as $a) : ?>
					<tr>
						<td><?php echo $a->nom_utilisateur.' '.$a->prenom_utilisateur; ?></td>
						<td><?php echo $a->titre_actualite; ?></td>
						<td class="text-center">
							<?php echo $a->date_actualite; ?>
						</td>
						<?php if($a->valide == 0) : ?>
							<td class="center bg-danger">
						<?php else : ?>
							<td class="center bg-success">
						<?php endif; ?>
							<?php echo $a->date_validite_actualite; ?>
						</td>
						<?php if($a->actif_actualite == 0) : ?>
							<td class="center bg-danger">
						<?php else : ?>
							<td class="center bg-success">
						<?php endif; ?>
							<?php if($a->actif_actualite == 1) : ?>
								Actif
							<?php else : ?>
								Inactif
							<?php endif; ?>
						</td>
						<td class="center">
							<?php if($a->front == 1) : ?>
								Front
							<?php else : ?>
								Back
							<?php endif; ?>
						</td>
						<td class="center">
							<?php if(in_array('T', $droits)) : ?>
								<a href="#" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="#" title="Modifier" class="btn btn-xs btn-default btn-modifier">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
								<a href="#" title="Supprimer" class="btn btn-xs btn-default btn-supprimer" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet utilisateur ?'));">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('M', $droits) || in_array('P', $droits)) : ?>
								<a href="#" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="#" title="Modifier" class="btn btn-xs btn-default btn-modifier">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('V', $droits)) : ?>
								<a href="#" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<p class="champsObligatoires">* Une actualité est visible si "Fin validité" et "Actif" sont verts.</p>
	<?php endif; ?>

</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>