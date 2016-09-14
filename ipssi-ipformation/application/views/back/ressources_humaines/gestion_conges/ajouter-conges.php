<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Ajouter une demande de congés</h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/ressources-humaines/note-frais/" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
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

	<?php echo form_open('/ipssi/ressources-humaines/liste-conges/ajouter'); ?>

		<?php echo form_error('type_conges', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="type_conges">Type de la demande de congé *</label>
			<select id="type_conges" name="type_conges" class="form-control" onchange="affichageFormulaire(this.value);">
				<option value="0" selected>-- Veuillez sélectionner un type de demande --</option>
				<?php foreach($type_conges as $t) : ?>
					<option value="<?php echo $t->id_type_conges ?>"><?php echo $t->libelle; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		
		<?php echo form_error('date_debut', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="date_debut">Date de début de la demande</label>
			<input type="text" class="form-control" id="date_debut" placeholder="Date de début de la demande : dd-mm-yyyy" name="date_debut" value="<?php echo set_value('date_debut',''); ?>">
		</div>

		<?php echo form_error('date_fin', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="date_fin">Date de fin de la demande</label>
			<input type="text" class="form-control" id="date_fin" placeholder="Date de fin de la demande : dd-mm-yyyy" name="date_fin" value="<?php echo set_value('date_fin', ''); ?>">
		</div>

		<?php echo form_error('nb_jour', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="nb_jour">Nombre de jours</label>
			<input type="text" class="form-control" id="nb_jour" placeholder="Nombre de jours" name="nb_jour" value="<?php echo set_value('nb_jour', ''); ?>">
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

	$(function() {
		$("#date_fin").datepicker({
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