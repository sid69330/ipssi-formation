<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Liste des postes à pourvoir</h1>
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
			<a href="/ipssi/ressources-humaines/offre-poste/ajouter" class="btn btn-block btn-primary btn-sm">Ajouter</a>
		</div>
	</div><br/>

	<?php if(count($postes) > 0) : ?>
		
		<table class="table table-bordered table-stripped" id="listePostesAPourvoir">
			<thead>
				<tr>
					<th class="text-center">Type de Poste</th>
					<th class="text-center">Titre</th>
					<th class="text-center">Entreprise</th>
					<th class="text-center">Accroche</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($postes as $p) : ?>
					<tr>
						<td><?php echo $p->type; ?></td>
						<td><?php echo $p->titre_poste; ?></td>
						<td><?php echo $p->entreprise_poste; ?></td>
						<td><?php echo $p->accroche_poste; ?></td>

						<td class="center">
							<?php if(in_array('T', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/offre-poste/detail/<?php echo $p->id_poste; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/offre-poste/modifier/<?php echo $p->id_poste; ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/offre-poste/supprimer/<?php echo $p->id_poste; ?>" title="Supprimer" class="btn btn-xs btn-default btn-supprimer" onclick="return(confirm('Etes-vous sûre de vouloir supprimer ce poste à pourvoir ? Toute suppression est non reversible.'));">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('M', $droits) || in_array('P', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/offre-poste/detail/<?php echo $p->id_poste; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/ressources-humaines/offre-poste/modifier/<?php echo $p->id_poste; ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('V', $droits)) : ?>
								<a href="/ipssi/ressources-humaines/offre-poste/detail/<?php echo $p->id_poste; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
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