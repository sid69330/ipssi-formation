<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Détail de la candidature</h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/ressources-humaines/candidatures" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
		</div>
	</div><br/>

	<?php if(isset($success)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-success"><?php echo $success; ?></div>
			</div>
		</div>
	<?php endif; ?>

	<div class="row">
		<div class="col-xs-12">
			<ul class="list-group">
		  		<li class="list-group-item"><strong>Sexe</strong> : <?php echo $candidature->sexe; ?></li>
		  		<li class="list-group-item"><strong>Nom</strong> : <?php echo $candidature->nom_candidature; ?></li>
		  		<li class="list-group-item"><strong>Prénom</strong> : <?php echo $candidature->prenom_candidature; ?></li>
		  		<li class="list-group-item"><strong>Adresse</strong> : <?php echo $candidature->adresse_candidature; ?></li>
		  		<li class="list-group-item"><strong>CP</strong> : <?php echo $candidature->cp_candidature; ?></li>
		  		<li class="list-group-item"><strong>Ville</strong> : <?php echo $candidature->ville_candidature; ?></li>
		  		<li class="list-group-item"><strong>Pays</strong> : <?php echo $candidature->pays_candidature; ?></li>
		  		<li class="list-group-item"><strong>Email</strong> : <?php echo $candidature->email_candidature; ?></li>
		  		<li class="list-group-item"><strong>Téléphone</strong> : <?php echo $candidature->telephone_candidature; ?></li>
		  		<li class="list-group-item"><strong>Date de Naissance</strong> : <?php echo $candidature->date_naissance; ?></li>
				

		  		<?php if(count($poste)==1) : ?>
		  			<br/><h2 class="sousTitrePageBack font16">Poste : </h2>
		  			<li class="list-group-item"><strong>Titre poste</strong> : <?php echo $poste->titre_poste; ?></li>
		  			<li class="list-group-item"><strong>Accroche</strong> : <?php echo $poste->accroche_poste; ?></li>
		  			<li class="list-group-item"><strong>Entreprise</strong> : <?php echo $poste->entreprise_poste; ?></li>
		  			<li class="list-group-item"><strong>date_debut_poste</strong> : <?php echo $poste->date_debut_poste; ?></li>
		  		<?php endif; ?>
			</ul>
		</div>
	</div>
	<?php if(in_array('T', $droits)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<a href="/ipssi/ressources-humaines/offre-poste/supprimer/<?php echo $candidature->id_candidature; ?>" class="btn btn-block btn-danger btn-sm" onclick="return(confirm('Etes-vous sûre de vouloir supprimer cette candidature ? Toute suppression est non reversible.'));">Supprimer</a>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>