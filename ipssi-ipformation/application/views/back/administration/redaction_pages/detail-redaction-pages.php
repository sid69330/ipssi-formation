<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">
				Page Front : <?php echo $libelle_menu; ?>
				<?php if($libelle_sous_menu != '') : ?>
					- <?php echo $libelle_sous_menu; ?> 
				<?php endif; ?>
			</h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/administration/redaction-pages" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
		</div>
	</div><br/>

	<div class="row">
		<div class="col-xs-12">
			<h2 class="titrePage">Aperçu de la page</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<?php if($page->texte_page_contenu != '') : ?>
				<?php echo nl2br($page->texte_page_contenu); ?>
			<?php else : ?>
				<div class="alert alert-info">Cette page ne possède aucun contenu.</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if(in_array('T', $droits) || in_array('M', $droits) || in_array('P', $droits)) : ?>
		<div class="row">
			<div class="col-xs-12">
			<a href="/ipssi/administration/redaction-pages/modifier/<?php echo $page->url_menu; ?>/<?php echo $page->url_sous_menu; ?>" class="btn btn-primary btn-block">Modifier</a>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>