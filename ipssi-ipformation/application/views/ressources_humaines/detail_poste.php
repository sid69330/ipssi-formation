		<div class='container well'>
			<h1 class="titrePage"><?php echo $detail->titre_poste; ?></h1>
			<div class="list-group">
				<div  class="list-group-item">
					<h4 class="list-group-item-heading">Description</h4><br/>
					<p class="list-group-item-text"><?php echo nl2br($detail->description); ?></p>
				</div>
			</div>
			<ul class="list-group">
				<li class="list-group-item">Entreprise : <span class="badge"><?php echo $detail->entreprise_poste; ?></span></li>
				<li class="list-group-item">Niveau recquis : <span class="badge"><?php echo $detail->niveau_experience; ?></span></li>
				<li class="list-group-item">Date de début : <span class="badge"><?php echo $detail->date_debut_poste; ?></span></li>
				<li class="list-group-item">Rémunération : <span class="badge"><?php echo $detail->remuneration_poste. ' €/mois'; ?></span></li>
				<li class="list-group-item">Type de poste : <span class="badge"><?php echo $detail->type_poste; ?></span></li>
			</ul>
			<br/>
			<a href="/ressources_humaines/poste" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Retour</a>
			<a href="/ressources_humaines/candidater/<?php echo $detail->id_poste; ?>" class="btn btn-primary float-right"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Postuler</a>
		</div>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
	</body>
</html>
