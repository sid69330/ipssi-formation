<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Valider une demande de congés</h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/ressources-humaines/liste-conges/" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
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

	<?php echo form_open('/ipssi/ressources-humaines/liste-conges/valider/'.$conge->id_conges); ?>

		<div class="row">
			<div class="col-xs-12">
				<ul class="list-group">
			  		<li class="list-group-item"><strong>Type de congé</strong> : <?php echo $conge->type; ?></li>
			  		<li class="list-group-item"><strong>Etat</strong> : <?php echo $conge->etat; ?></li>
			  		<li class="list-group-item"><strong>Date de début</strong> : <?php echo $conge->date_debut; ?></li>
			  		<li class="list-group-item"><strong>Date de fin</strong> : <?php echo $conge->date_fin; ?></li>
			  		<li class="list-group-item"><strong>Nombre de jours</strong> : <?php echo $conge->nb_jour; ?></li>
			  		<li class="list-group-item"><strong>Date de la demande</strong> : <?php echo $conge->date_demande; ?></li>
				</ul>
			</div>
		</div>

		<div class="form-group">
			<label for="etat">Etat de la demande *</label>
			<select id="etat" name="etat" class="form-control" onchange="affichageFormulaire(this.value);">
				<option value="0">-- Veuillez sélectionner un type de demande --</option>
				<?php foreach($etat as $t) : ?>
					<?php if(set_value('etat', $conge->id_etat) == $t->id_etat) : ?>
						<option value="<?php echo $t->id_etat ?>" selected><?php echo $t->libelle_etat ?></option>
				<?php else :?>
					<option value="<?php echo $t->id_etat ?>"><?php echo $t->libelle_etat ?></option>
			<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>


		<div class="form-group">
			<button class="btn btn-primary btn-block">Valider</button>
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

</script>
</body>
</html>