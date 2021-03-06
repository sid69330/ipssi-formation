<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Ajouter un nouvel utilisateur</h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/ressources-humaines/collaborateurs" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
		</div>
	</div><br/>

	<?php if(isset($success) && ($success != '')) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-success"><?php echo $success; ?></div>
			</div>
		</div>
	<?php elseif(isset($erreur) && ($erreur != '')) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-danger"><?php echo $erreur; ?></div>
			</div>
		</div>
	<?php endif; ?>

	<?php echo form_open('/ipssi/ressources-humaines/collaborateurs/ajouter'); ?>

		<?php echo form_error('sexe', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="sexe">Sexe *</label>
			<select class="form-control" name="sexe" id="sexe">
				<?php foreach($sexes as $s) : ?>
					<option value="<?php echo $s->id_sexe; ?>" <?php if(isset($_POST['sexe']) && ($_POST['sexe'] == $s->id_sexe)) echo "selected='selected'"; ?>><?php echo $s->raccourci_sexe; ?>
				<?php endforeach; ?>
			</select>
		</div>
		<?php echo form_error('nom', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="nom">Nom *</label>
			<input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" value="<?php echo set_value('nom'); ?>">
		</div>
		<?php echo form_error('prenom', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="prenom">Prénom *</label>
			<input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom" value="<?php echo set_value('prenom'); ?>">
		</div>
		<?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="email">Email *</label>
			<input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>">
		</div>
		<?php echo form_error('tel', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="tel">Téléphone</label>
			<input type="text" class="form-control" id="tel" placeholder="Téléphone" name="tel" value="<?php echo set_value('tel'); ?>">
		</div>
		<?php echo form_error('entreprise', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="entreprise">Entreprise</label>
			<input type="text" class="form-control" id="entreprise" placeholder="Entreprise" name="entreprise" value="<?php echo set_value('entreprise'); ?>">
		</div>

		<div class="row">
			<div class="col-xs-12">
				<h2 class="titrePage center">Choix des groupes</h2>
			</div>
		</div>
		<?php foreach($groupes as $g) : ?>
			<div class="checkbox">
  				<label>
    				<input type="checkbox" value="<?php echo $g->id_groupe; ?>" name="groupes[]" <?php if(isset($_POST['groupes']) && (in_array($g->id_groupe, $_POST['groupes']))) echo 'checked="checked"'; ?>>
    				<?php echo $g->libelle_groupe; ?>
  				</label>
			</div>
		<?php endforeach; ?><br/>

		<div class="form-group">
			<button class="btn btn-primary btn-block">Ajouter</button>
		</div>

	<?php echo form_close(); ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>