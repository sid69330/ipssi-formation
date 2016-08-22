<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Mon compte</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-md-4">
			<div class="bloc-tableau-bord">
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4 col-md-6 col-md-offset-3">
						<?php if($infos->photo_profil == '') : ?>
							<img src="/assets/images/profil/profil_defaut.png" class="img-responsive center-block" alt="">
						<?php else : ?>
							<img src="/assets/images/profil/<?php echo $this->session->userdata('id'); ?>/<?php echo $infos->photo_profil; ?>" class="img-responsive center-block" alt="">
						<?php endif; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 text-center font14" style="margin-top:10px">
						<?php echo $this->session->userdata('nom').' '.$this->session->userdata('prenom'); ?>
					</div>
				</div><br/>
				<div class="row">
					<div class="col-xs-12">
						<a href="/ipssi/compte/modifier-photo-profil" class="btn btn-primary btn-sm btn-block">Modifier</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-8">
			<div class="bloc-tableau-bord">

				<div class="row">
					<div class="col-xs-12">
						<h2 class="titrePage center">Mes informations</h2>
					</div>
				</div>

				<table class="table table-bordered table-striped">
					<tr>
						<th>Identité</th>
						<td colspan="2"><?php echo $infos->raccourci_sexe.' '.$this->session->userdata('nom').' '.$this->session->userdata('prenom'); ?></td>
					</tr>
					<tr>
						<th>Email</th>
						<td colspan="2"><?php echo $infos->mail_utilisateur; ?></td>
					</tr>
					<tr>
						<th>Téléphone</th>
						<td colspan="2"><?php echo $infos->telephone_utilisateur; ?></td>
					</tr>
					<tr>
						<th>Mot de passe</th>

						<?php if($infos->mdp_utilisateur_change == 1) : ?>
							<td>Fin de validité dans <span class="gras">0</span> jours</td>
						<?php else : ?>
							<td>Fin de validité dans <span class="gras"><?php echo $infos->validite_mdp; ?></span> jours</td>
						<?php endif; ?>

						<td><a href="/ipssi/compte/modifier-mdp" class="btn btn-block btn-xs btn-primary">Modifier</a></td>
					</tr>
				</table>

				<div class="row">
					<div class="col-xs-12">
						<a href="/ipssi/compte/modifier-infos" class="btn btn-block btn-primary btn-sm">Modifier</a>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12">
						<h3 class="titrePage center">Mes groupes</h3>
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
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>