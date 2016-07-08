		<div class='container well'>
			<div class="row">
			
				<?php if(count($actualite) > 0) : ?>
					<div class="col-lg-2 col-md-2 col-sm-3 visible-lg visible-md visible-sm height-270">

						<?php $i = 0; ?>
						<?php foreach($actualite as $a) : ?>
							<div class="btnActualiteAccueil">
								<p class="lienBtnActualiteAccueil"><a data-target="#carousel-nav" data-slide-to="<?php echo $i; ?>">Actualité <?php echo ++$i; ?></a></p>
							</div>
						<?php endforeach; ?>

					</div>

					<div id="carousel-nav" class="carousel slide col-lg-10 col-md-10 col-sm-9" data-ride="carousel">
						<ol class="carousel-indicators">

							<?php $i = 0; ?>
							<?php foreach($actualite as $a) : ?>
								<?php if($i==0) : ?>
									<li data-target="#carousel-nav" data-slide-to="<?php echo $i; ?>" <?php if($i == 0) echo 'class="active"'; ?>></li>
								<?php endif; ?>
								<?php $i++; ?>
							<?php endforeach; ?>

						</ol>

						<div class="carousel-inner" role="listbox">
							<?php $i = 0; ?>
							<?php foreach($actualite as $a) : ?>
								<div class="item <?php if($i==0) echo 'active'; ?>">
									<div class="center">
										<a href="/actualite/detail/<?php echo $a->id_actualite; ?>">
											<img src="/assets/images/actualite/<?php echo $a->url_photo_actualite; ?>" alt="actualite <?php echo $i; ?>" class="imgActualiteAccueil"/>
										</a>
									</div>
									<div class="carousel-caption">
										<span class="titreImgActualiteAccueil"><?php echo $a->titre_actualite; ?></span>
									</div>
								</div>
								<?php $i++; ?>
							<?php endforeach; ?>
							<div>
								<a class="left carousel-control" href="#carousel-nav" role="button" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="right carousel-control" href="#carousel-nav" role="button" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
	</body>
</html>
