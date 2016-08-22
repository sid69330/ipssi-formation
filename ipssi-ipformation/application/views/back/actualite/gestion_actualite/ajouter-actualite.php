<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Ajouter une actualité</h1>
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
	</div>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/actualites/gestion-actualites/" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
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

	<?php echo form_open_multipart('/ipssi/actualites/gestion-actualites/ajouter'); ?>

		<?php echo form_error('titre', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="titre">Titre *</label>
			<input type="text" class="form-control" id="titre" placeholder="Titre" name="titre" value="<?php echo set_value('titre'); ?>">
		</div>
		<?php echo form_error('texte', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="texte">Texte *</label>
			<textarea class="form-control" id="texte" name="texte" rows="5"><?php echo set_value('texte'); ?></textarea>
		</div>
		<?php echo form_error('date_validite', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label for="date_validite">Date de fin de validité <sup>(1)</sup></label>
			<input type="text" class="form-control" id="date_validite" placeholder="Date fin validité : dd-mm-yyyy" name="date_validite" value="<?php echo set_value('date_validite'); ?>">
		</div>
		<?php echo form_error('actif', '<div class="alert alert-danger">', '</div>'); ?>
		<label for="actif">Actif *</label>
		<select class="form-control form-group" name="actif" id="actif">
  			<option value="1" <?php if(isset($_POST['actif']) && ($_POST['actif'] == 1)) echo 'selected="selected"'; ?>>Actif</option>
  			<option value="0" <?php if(isset($_POST['actif']) && ($_POST['actif'] == 0)) echo 'selected="selected"'; ?>>Inactif</option>
		</select>
		<?php echo form_error('front', '<div class="alert alert-danger">', '</div>'); ?>
		<label for="front">Front *</label>
		<select class="form-control form-group" name="front" id="front">
  			<option value="1" <?php if(isset($_POST['front']) && ($_POST['front'] == 1)) echo 'selected="selected"'; ?>>Oui</option>
  			<option value="0" <?php if(isset($_POST['front']) && ($_POST['front'] == 0)) echo 'selected="selected"'; ?>>Non</option>
		</select>

		<div class="form-group">
			<label for="fichier">Photographie * <sup>(2)</sup></label>
			<input type="file" id="fichier" name="fichier" value="<?php echo set_value('fichier'); ?>">
		</div>
		
		<div class="form-group">
			<button class="btn btn-primary btn-block">Ajouter</button>
		</div>
		<p class="champsObligatoires">
			* Champs obligatoires<br/>
			<sup>(1)</sup> Permet de rendre automatiquement inactive l'actualité à la date renseignée.<br/>
			<sup>(2)</sup> Taille maximale de 2Mo, format 900x250px minimum, extensions : jpeg, jpg, png
		</p>

	<?php echo form_close(); ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
<script>
	$(function() {
		$("#date_validite").datepicker({
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