<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Ajouter une note de Frais</h1>
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

	<?php echo form_open('/ipssi/ressources-humaines/note-frais/ajouter'); ?>

		<?php echo form_error('type_note_frais', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="type_note_frais">Type de note de frais *</label>
			<select id="type_note_frais" name="type_note_frais" class="form-control" onchange="affichageFormulaire(this.value);">
				<option value="0">-- Veuillez sélectionner un type de note de frais --</option>
				<?php foreach($type_note_frais as $t) : ?>
					<option value="<?php echo $t->id_type_note_frais ?>"><?php echo $t->libelle_type_note_frais ?></option>
				<?php endforeach; ?>
			</select>
		</div>


		<?php echo form_error('description', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea class="form-control" id="description" name="description" rows="5"><?php echo set_value('description'); ?></textarea>
		</div>
		<?php echo form_error('date_note', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="date_note">Date de la note de frais</label>
			<input type="text" class="form-control" id="date_note" placeholder="Date de la note de frais : dd-mm-yyyy" name="date_note" value="<?php echo set_value('date_note'); ?>">
		</div>
		<?php echo form_error('montant', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="montant">Montant</label>
			<input type="text" class="form-control" id="montant" placeholder="Montant (en €)" name="montant" value="<?php echo set_value('montant'); ?>">
		</div>

		<div id="AAfficher">
			<?php echo form_error('trajet', '<div class="alert alert-danger">', '</div>'); ?>
			<div class="form-group">
				<label for="trajet">Trajet concernant la note de frais</label>
				<input type="text" class="form-control" id="trajet" placeholder="Trajet" name="trajet" value="<?php echo set_value('trajet'); ?>">
			</div>
			<?php echo form_error('km_parcouru', '<div class="alert alert-danger">', '</div>'); ?>
			<div class="form-group">
				<label for="km_parcouru">Nombre de km parcourus</label>
				<input type="text" class="form-control" id="km_parcouru" placeholder="km Parcourus" name="trajet" value="<?php echo set_value('km_parcouru'); ?>">
			</div>
			<?php echo form_error('prix_km', '<div class="alert alert-danger">', '</div>'); ?>
			<div class="form-group">
				<label for="prix_km">Prix par km</label>
				<input type="text" class="form-control" id="prix_km" placeholder="Prix / km" name="trajet" value="<?php echo set_value('prix_km'); ?>">
			</div>
		</div>
		<div class="form-group">
			<button class="btn btn-primary btn-block">Ajouter</button>
		</div>

	<?php echo form_close(); ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
<script>
	$(function() {
		$("#date_note").datepicker({
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

	function affichageFormulaire(typeNoteFrais)
	{
		if(typeNoteFrais == 9)
			document.getElementById('AAfficher').style.display='block';
		else
			document.getElementById('AAfficher').style.display='none';
	}
	$(document).ready(function() {
		//var typeNoteFrais = $('#type_note_frais option:selected').val();
		$('#type_note_frais').trigger('change');
	});

</script>
</body>
</html>