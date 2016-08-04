<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Liste des utilisateurs</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<?php if(in_array('T', $droits)) : ?>
				<p class="font11 italique center">Vous possédez tous les droits sur cette page</p>
			<?php elseif(in_array('M', $droits)) : ?>
				<p class="font11 italique center">Vous possédez le droit de modification et visualisation N et N-</p>
			<?php elseif(in_array('P', $droits)) : ?>
				<p class="font11 italique center">Vous possédez le droit de visualisation et modification personnelle</p>
			<?php elseif(in_array('V', $droits)) : ?>
				<p class="font11 italique center">Vous possédez le droit de visualisation N et N-</p>
			<?php endif; ?>
		</div>
	</div><br/>

	<?php if(count($utilisateurs) > 0) : ?>
		<table class="table table-bordered table-stripped" id="listeUtilisateur">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($utilisateurs as $u) : ?>
					<tr>
						<td><?php echo $u->nom_utilisateur; ?></td>
						<td><?php echo $u->prenom_utilisateur; ?></td>
						<td class="center">
							<?php if(in_array('T', $droits)) : ?>
								<a href="/ipssi/administration/gestion-utilisateurs/detail/<?php echo $u->id_utilisateur; ?>" title="Détail" class="btn btn-xs btn-default btn-detail"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<a href="#" title="Modifier" class="btn btn-xs btn-default btn-modifier"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								<a href="#" title="Supprimer" class="btn btn-xs btn-default btn-supprimer"><i class="fa fa-trash" aria-hidden="true"></i></a>
							<?php elseif(in_array('M', $droits) || in_array('P', $droits)) : ?>
								<a href="/ipssi/administration/gestion-utilisateurs/detail/<?php echo $u->id_utilisateur; ?>" title="Détail" class="btn btn-xs btn-default btn-detail"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<a href="#" title="Modifier" class="btn btn-xs btn-default btn-modifier"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							<?php elseif(in_array('V', $droits)) : ?>
								<a href="/ipssi/administration/gestion-utilisateurs/detail/<?php echo $u->id_utilisateur; ?>" title="Détail" class="btn btn-xs btn-default btn-detail"><i class="fa fa-eye" aria-hidden="true"></i></a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<div class="alert alert-info">Aucun utilisateur à afficher</div>
	<?php endif; ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
<script>
	$(document).ready(function() {
	    $('#listeUtilisateur').DataTable( {
	    	"language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        	},
	        "order": false
	    });
	});
	</script>
</body>
</html>