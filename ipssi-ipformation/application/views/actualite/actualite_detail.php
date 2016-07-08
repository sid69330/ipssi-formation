		<div class='container well'>
			<h1 class="titrePage">Actualité - <?php echo $actualite->titre_actualite; ?></h1>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3 col-xs-12">
					<img src="/assets/images/actualite/<?php echo $actualite->url_photo_actualite; ?>" alt="detail_actualite" class="img-responsive"/>
				</div>
			</div><br/>
			<div class="row">
				<div class="col-xs-12">
					<?php echo $actualite->texte_actualite; ?>
				</div>
			</div><br/>
			<a href="/" class="btn btn-primary">
				<span class="fa fa-chevron-left" aria-hidden="true"></span>
				Retour
			</a>
		</div>
	</body>
</html>