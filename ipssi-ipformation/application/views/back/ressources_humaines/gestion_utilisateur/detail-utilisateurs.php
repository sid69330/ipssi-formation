<div class="container">

	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Détail de l'utilisateur <?php echo $infos->nom_utilisateur.' '.$infos->prenom_utilisateur; ?></h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/ressources-humaines/collaborateurs" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
		</div>
	</div><br/>

	<div class="row">
		<div class="col-xs-12 col-md-4">
			<div class="bloc-tableau-bord">
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4 col-md-6 col-md-offset-3">
						<?php if($infos->photo_profil == '') : ?>
							<img src="/assets/images/profil/profil_defaut.png" class="img-responsive center-block" alt="">
						<?php else : ?>
							<img src="/assets/images/profil/<?php echo $infos->id_utilisateur; ?>/<?php echo $infos->photo_profil; ?>" class="img-responsive center-block" alt="">
						<?php endif; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 text-center font14" style="margin-top:10px">
						<?php echo $infos->nom_utilisateur.' '.$infos->prenom_utilisateur; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-8">
			<div class="bloc-tableau-bord">

				<div class="row">
					<div class="col-xs-12">
						<h2 class="titrePage center">Ses informations</h2>
					</div>
				</div>

				<table class="table table-bordered table-striped">
					<tr>
						<th>Identité</th>
						<td><?php echo $infos->raccourci_sexe.' '.$infos->nom_utilisateur.' '.$infos->prenom_utilisateur; ?></td>
					</tr>
					<tr>
						<th>Email</th>
						<td><?php echo $infos->mail_utilisateur; ?></td>
					</tr>
					<tr>
						<th>Téléphone</th>
						<td><?php echo $infos->telephone_utilisateur; ?></td>
					</tr>
					<tr>
						<th>Mot de passe</th>
						<?php if($infos->mdp_utilisateur_change == 1) : ?>
							<td>Fin de validité dans <span class="gras">0</span> jours</td>
						<?php else : ?>
							<td>Fin de validité dans <span class="gras"><?php echo $infos->validite_mdp; ?></span> jours</td>
						<?php endif; ?>
					</tr>
				</table>

				<div class="row">
					<div class="col-xs-12">
						<h3 class="titrePage center">Ses groupes</h3>
					</div>
				</div>

				<?php if(count($infos->groupes) > 0) : ?>
					<ul class="list-group">
						<?php foreach($infos->groupes as $g) : ?>
							<li class="list-group-item"><?php echo $g->libelle_groupe; ?></li>
						<?php endforeach; ?>
					</ul>
				<?php else : ?>
					<div class="alert alert-info">Vous n'appartenez à aucun groupe</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
	<?php if((in_array('T', $droits)) || (in_array('M', $droits)) || (in_array('P', $droits))) : ?>
		<br/><div class="row">
			<div class="col-xs-12">
				<a href="/ipssi/ressources-humaines/collaborateurs/modifier/<?php echo $infos->id_utilisateur; ?>" class="btn btn-block btn-primary btn-sm">Modifier</a>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>