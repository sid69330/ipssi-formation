<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Détail de l'actualité</h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/actualites/gestion-actualites" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
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
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
			<img src="/assets/images/actualite/<?php echo $infos->url_photo_actualite; ?>" alt="" class="img-responsive center-block"/>
		</div>
	</div>
	<br/><div class="row">
		<div class="col-xs-12">
			<ul class="list-group">
		  		<li class="list-group-item"><strong>Publication</strong> : le <?php echo $infos->date_actualite; ?> par <?php echo $infos->nom_utilisateur.' '.$infos->prenom_utilisateur; ?></li>
		  		<li class="list-group-item"><strong>Titre</strong> : <?php echo $infos->titre_actualite; ?></li>
		  		<li class="list-group-item"><strong>Actualité</strong> : <?php echo nl2br($infos->texte_actualite); ?></li>
		  		
		  		<?php if($infos->actif_actualite == 0) : ?>
		  			<li class="list-group-item"><strong>Etat</strong> : <span style="color:red">Inactive</span></li>
		  		<?php else : ?>
		  			<li class="list-group-item"><strong>Etat</strong> : <span style="color:green">Active</span></li>
		  		<?php endif; ?>

		  		<?php if($infos->front == 0) : ?>
		  			<li class="list-group-item"><strong>Présence</strong> : Back</li>
		  		<?php else : ?>
		  			<li class="list-group-item"><strong>Présence</strong> : Front</li>
		  		<?php endif; ?>
		  		
		  		<li class="list-group-item"><strong>Date validité</strong> : 
			  		<?php if($infos->date_validite_actualite != '') : ?>
			  			<?php echo $infos->date_validite_actualite; ?>
			  		<?php else : ?>
			  			Aucune date de fin de validité
			  		<?php endif; ?>
		  		</li>
			</ul>
		</div>
	</div>

	<?php if((in_array('T', $droits)) || (in_array('M', $droits)) || (in_array('P', $droits))) : ?>
		<br/><div class="row" style="margin-bottom:3px">
			<div class="col-xs-12">
				<a href="/ipssi/actualites/gestion-actualites/modifier/<?php echo $a->id_actualite; ?>" class="btn btn-block btn-primary btn-sm">Modifier</a>
			</div>
		</div>
	<?php endif; ?>
	<?php if(in_array('T', $droits)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<a href="/ipssi/actualites/gestion-actualites/supprimer/<?php echo $infos->id_actualite; ?>" class="btn btn-block btn-danger btn-sm" onclick="return(confirm('Etes-vous sûre de vouloir supprimer cette actualité ? Toute suppression est non reversible.'));">Supprimer</a>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>