<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Modifier un poste à pourvoir</h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/ressources-humaines/offre-poste/" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
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

	<?php echo form_open('/ipssi/ressources-humaines/offre-poste/modifier/'.$poste->id_poste); ?>

		<?php echo form_error('type_poste', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="type_poste">Type de poste *</label>
			<select id="type_poste" name="type_poste" class="form-control">
				<option value="0">-- Veuillez sélectionner un type de poste --</option>
				<?php foreach($type_poste as $t) : ?>
					<?php if(set_value('type_poste', $poste->id_type_poste) == $t->id_type_poste) : ?>
						<option value="<?php echo $t->id_type_poste; ?>" selected="selected"><?php echo $t->libelle; ?></option>
				<?php else :?>
					<option value="<?php echo $t->id_type_poste; ?>"><?php echo $t->libelle; ?></option>
			<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>

		<?php echo form_error('titre', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="titre">Titre du poste</label>
			<input type="text" class="form-control" id="titre" placeholder="titre" name="titre" value="<?php echo set_value('titre', $poste->titre_poste); ?>">
		</div>

		<?php echo form_error('accroche', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="accroche">Accroche du poste</label>
			<input type="text" class="form-control" id="accroche" placeholder="accroche" name="accroche" value="<?php echo set_value('accroche', $poste->accroche_poste); ?>">
		</div>

		<?php echo form_error('entreprise', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="entreprise">Entreprise</label>
			<input type="text" class="form-control" id="entreprise" placeholder="entreprise" name="entreprise" value="<?php echo set_value('entreprise', $poste->entreprise_poste); ?>">
		</div>



		<?php echo form_error('description', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea class="form-control" id="description" name="description" rows="5"><?php echo set_value('description', $poste->description); ?></textarea>
		</div>

		<?php echo form_error('date_debut_poste', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="date_debut_poste">Date du début du contrat</label>
			<input type="text" class="form-control" id="date_debut_poste" placeholder="Date du début du poste : dd-mm-yyyy" name="date_debut_poste" value="<?php echo set_value('date_debut_poste', $poste->date_debut_poste); ?>">
		</div>

		<?php echo form_error('remuneration', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="remuneration">Rémunération</label>
			<input type="text" class="form-control" id="remuneration" placeholder="Remuneration (en €/an)" name="remuneration" value="<?php echo set_value('remuneration', $poste->remuneration_poste); ?>">
		</div>

		<?php echo form_error('niveau', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="niveau">Niveau d'expérience</label>
			<input type="text" class="form-control" id="niveau" placeholder="niveau" name="niveau" value="<?php echo set_value('entreprise', $poste->niveau_experience); ?>">
		</div>

		
		<div class="form-group">
			<button class="btn btn-primary btn-block">Modifier</button>
		</div>

	<?php echo form_close(); ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
<script>
	$(function() {
		$("#date_debut_poste").datepicker({
			altField: "#datepicker",
			closeText: 'Fermer',
			prevText: 'Précédent',
			nextText: 'Suivant',
			currentText: 'Aujourd\'hui',
			monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
			monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
			dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
			dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
			dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
			weekHeader: 'Sem.',
			dateFormat: 'dd-mm-yy',
			firstDay : 1
		});
	});

</script>
</body>
</html>