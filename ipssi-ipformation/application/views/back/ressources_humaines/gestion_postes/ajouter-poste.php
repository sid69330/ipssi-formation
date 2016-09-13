<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Ajouter une note de Frais</h1>
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

	<?php echo form_open('/ipssi/ressources-humaines/offre-poste/ajouter'); ?>

		<?php echo form_error('type_poste', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="type_poste">Type de poste *</label>
			<select id="type_poste" name="type_poste" class="form-control">
				<option value="0">-- Veuillez sélectionner un type de poste --</option>
				<?php foreach($type_poste as $t) : ?>
					<option value="<?php echo $t->id_type_poste; ?>"><?php echo $t->libelle; ?></option>
				<?php endforeach; ?>
			</select>
		</div>


		<?php echo form_error('titre', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="titre">Titre du poste</label>
			<input type="text" class="form-control" id="titre" placeholder="Titre" name="titre" value="<?php echo set_value('titre'); ?>">
		</div>
		<?php echo form_error('accroche', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="accroche">Accroche</label>
			<input type="text" class="form-control" id="accroche" placeholder="Accroche" name="accroche" value="<?php echo set_value('accroche'); ?>">
		</div>

		<?php echo form_error('entreprise', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="entreprise">Entreprise</label>
			<input type="text" class="form-control" id="entreprise" placeholder="Entreprise" name="entreprise" value="<?php echo set_value('entreprise'); ?>">
		</div>

		<?php echo form_error('description', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea class="form-control" id="description" name="description" rows="5"><?php echo set_value('description'); ?></textarea>
		</div>

		<?php echo form_error('date_debut', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="date_debut">Date de début de contrat</label>
			<input type="text" class="form-control" id="date_debut" placeholder="Date de début de contrat (format : DD-MM-YYYY)" name="date_debut" value="<?php echo set_value('date_debut'); ?>">
		</div>

		<?php echo form_error('remuneration', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="remuneration">Rémunération</label>
			<input type="text" class="form-control" id="remuneration" placeholder="Rémunération" name="remuneration" value="<?php echo set_value('remuneration'); ?>">
		</div>

		<?php echo form_error('niveau', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="niveau">Niveau d'expérience</label>
			<input type="text" class="form-control" id="niveau" placeholder="Niveau d'expérience" name="niveau" value="<?php echo set_value('niveau'); ?>">
		</div>


		<div class="form-group">
			<button class="btn btn-primary btn-block">Ajouter</button>
		</div>

	<?php echo form_close(); ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
<script>
	$(function() {
		$("#date_debut").datepicker({
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