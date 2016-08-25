<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Liste des actualités</h1>
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

	<?php if(in_array('T', $droits)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<a href="/ipssi/actualites/gestion-actualites/ajouter" class="btn btn-block btn-primary btn-sm">Ajouter</a>
			</div>
		</div><br/>
	<?php endif; ?>

	<?php if(count($actualites) > 0) : ?>

		<table class="table table-bordered table-stripped" id="listeActualites">
			<thead>
				<tr>
					<th>Ajouté par</th>
					<th>Titre</th>
					<th>Ajouté le</th>
					<th>Fin validité *</th>
					<th>Actif *</th>
					<th>Présence</th>
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
							<?php if($a->date_validite_actualite != '') : ?>
								<?php echo $a->date_validite_actualite; ?>
							<?php else : ?>
								Aucune
							<?php endif; ?>
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
								<a href="/ipssi/actualites/gestion-actualites/detail/<?php echo $a->id_actualite; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/actualites/gestion-actualites/modifier/<?php echo $a->id_actualite; ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/actualites/gestion-actualites/supprimer/<?php echo $a->id_actualite; ?>" title="Supprimer" class="btn btn-xs btn-default btn-supprimer" onclick="return(confirm('Etes-vous sûre de vouloir supprimer cette actualité ? Toute suppression est non reversible.'));">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('M', $droits) || in_array('P', $droits)) : ?>
								<a href="/ipssi/actualites/gestion-actualites/detail/<?php echo $a->id_actualite; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a href="/ipssi/actualites/gestion-actualites/modifier/<?php echo $a->id_actualite; ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
							<?php elseif(in_array('V', $droits)) : ?>
								<a href="/ipssi/actualites/gestion-actualites/detail/<?php echo $a->id_actualite; ?>" title="Détail" class="btn btn-xs btn-default btn-detail">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<p class="champsObligatoires">* Une actualité est visible si "Fin validité" et "Actif" sont verts.</p>
		<div class="row">
			<div class="col-xs-12">
				<p><a href="/ipssi/actualites/gestion-actualites/export"><img src="/assets/images/icone/csv.png" class="center-block" alt="" style="margin-bottom:0"/></a></p>
				<p class="text-center font11 italique"><a href="/ipssi/actualites/gestion-actualites/export" style="color:black">Exporter</a></p>
			</div>
		</div>
	<?php else : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-info">Aucune actualité à afficher.</div>
			</div>
		</div>
	<?php endif; ?>

</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
<script>
	$(document).ready(function() {
	    $('#listeActualites').DataTable( {
	    	"language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        	},
	        "order": false
	    });
	});
</script>
</body>
</html>