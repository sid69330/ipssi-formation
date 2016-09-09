<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Valider une note de Frais</h1>
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

	<?php echo form_open('/ipssi/ressources-humaines/note-frais/valider/'.$note_frais->id_note_frais); ?>

		<div class="form-group">
			<label >Utilisateur</label>
			<P><?php echo $note_frais->nom_utilisateur.' '.$note_frais->prenom_utilisateur; ?></p>
		</div>

		<?php echo form_error('type_note_frais', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="type_note_frais">Type de note de frais *</label>
			<p><?php echo(set_value('type_note_frais', $note_frais->type) ); ?>
		</div>

		<div class="form-group">
			<label for="description">Description</label>
			<p><?php echo set_value('description', $note_frais->description_note_frais); ?></p>
		</div>
		<div class="form-group">
			<label for="date_note">Date de la note de frais</label>
			<p><?php echo set_value('date_note', $note_frais->date_note_frais); ?></p>
		</div>
		<div class="form-group">
			<label for="montant">Montant</label>
			<p><?php echo set_value('montant', $note_frais->montant_note_frais); ?></p>
		</div>
		<?php if(set_value('trajet', $note_frais->trajet_note_frais)) : ?>
			<div class="form-group">
				<label for="trajet">Trajet concernant la note de frais</label>
				<p><?php echo set_value('trajet', $note_frais->trajet_note_frais); ?></p>
			</div>
		<?php endif; ?>
		<?php if(set_value('km_parcouru', $note_frais->km_parcouru_note_frais)) : ?>
			<div class="form-group">
				<label for="km_parcouru">Nombre de km parcourus</label>
				<p><?php echo set_value('km_parcouru', $note_frais->km_parcouru_note_frais); ?></p>
			</div>
		<?php endif; ?>
		<?php if(set_value('prix_km', $note_frais->montant_km_note_frais)) : ?>
			<div class="form-group">
				<label for="prix_km">Prix par km</label>
				<p><?php echo set_value('prix_km', $note_frais->montant_km_note_frais); ?></p>
			</div>
		<?php endif; ?>


		<?php echo form_error('etat_note_frais', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="etat_note_frais">Etat de la note de frais *</label>
			<select id="etat_note_frais" name="etat_note_frais" class="form-control" onchange="affichageFormulaire(this.value);">
				<?php foreach($etat_note_frais as $t) : ?>
					<?php if(set_value('etat_note_frais', $note_frais->id_etat) == $t->id_etat) : ?>
						<option value="<?php echo $t->id_etat; ?>" selected><?php echo $t->libelle_etat; ?></option>
					<?php else :?>
						<option value="<?php echo $t->id_etat; ?>"><?php echo $t->libelle_etat; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="type_paiement">Type de paiement</label>
			<select id="type_paiement" name="type_paiement" class="form-control">
				<option value="0">-- Veuillez sélecionner un mode de paiement --</option>
				<?php foreach($paiement_note_frais as $t) : ?>
					<?php if(set_value('type_paiement', $note_frais->id_type_paiement_note_frais) == $t->id_type_paiement_note_frais) : ?>
						<option value="<?php echo $t->id_type_paiement_note_frais; ?>" selected><?php echo $t->paiement; ?></option>
					<?php else :?>
						<option value="<?php echo $t->id_type_paiement_note_frais; ?>"><?php echo $t->paiement; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>

		<div id="AAfficher">
			<?php echo form_error('motif_refus', '<div class="alert alert-danger">', '</div>'); ?>
			<div class="form-group">
				<label for="motif_refus">Motif du refus</label>
				<textarea class="form-control" id="motif_refus" name="motif_refus" rows="5"><?php echo set_value('motif_refus', $note_frais->motif_refus); ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<button class="btn btn-primary btn-block">Valider</button>
		</div>

	<?php echo form_close(); ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
<script>
	function affichageFormulaire(etat_note_frais)
	{
		if(etat_note_frais == 3)
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