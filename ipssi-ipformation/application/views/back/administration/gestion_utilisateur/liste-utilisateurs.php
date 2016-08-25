<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Liste des utilisateurs</h1>
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
				<a href="/ipssi/administration/gestion-utilisateurs/ajouter" class="btn btn-block btn-primary btn-sm">Ajouter</a>
			</div>
		</div><br/>
	<?php endif; ?>

	<?php if(count($utilisateurs) > 0) : ?>
		<table class="table table-bordered table-stripped" id="listeUtilisateur">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Etat</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($utilisateurs as $u) : ?>
					<tr>
						<td><?php echo $u->nom_utilisateur; ?></td>
						<td><?php echo $u->prenom_utilisateur; ?></td>
						<td class="text-center">
							<?php if($u->supprime == 0) : ?>
								Actif
							<?php else : ?>
								Inactif
							<?php endif; ?>
						</td>
						<td class="center">
							<?php if(in_array('T', $droits)) : ?>
								<a href="/ipssi/administration/gestion-utilisateurs/detail/<?php echo $u->id_utilisateur; ?>" title="Détail" class="btn btn-xs btn-default btn-detail"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<a href="/ipssi/administration/gestion-utilisateurs/modifier/<?php echo $u->id_utilisateur; ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

								<?php if($this->session->userdata('id') != $u->id_utilisateur) : ?>
									<a href="/ipssi/administration/gestion-utilisateurs/supprimer/<?php echo $u->id_utilisateur; ?>" title="Supprimer" class="btn btn-xs btn-default btn-supprimer" <?php if($u->supprime == 1) echo "disabled='disabled'"; ?> onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet utilisateur ?'));">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</a>
								<?php endif; ?>
							<?php elseif(in_array('M', $droits) || in_array('P', $droits)) : ?>
								<a href="/ipssi/administration/gestion-utilisateurs/detail/<?php echo $u->id_utilisateur; ?>" title="Détail" class="btn btn-xs btn-default btn-detail"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<a href="/ipssi/administration/gestion-utilisateurs/modifier/<?php echo $u->id_utilisateur; ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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