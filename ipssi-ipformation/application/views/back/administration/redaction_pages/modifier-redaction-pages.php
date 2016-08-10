<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">
				Modification de la page Front : <?php echo $libelle_menu; ?>
				<?php if($libelle_sous_menu != '') : ?>
					- <?php echo $libelle_sous_menu; ?> 
				<?php endif; ?>
			</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<?php if(in_array('T', $droits)) : ?>
				<p class="font11 italique center">Vous possédez tous les droits sur cette page</p>
			<?php else : ?>
				<p class="font11 italique center">Vous possédez le droit de visualisation</p>
			<?php endif; ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<a href="/ipssi/administration/redaction-pages" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Retour</a>
		</div>
	</div><br/>

	<?php if(isset($success) && ($success != '')) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-success"><?php echo $success; ?></div>
			</div>
		</div>
	<?php endif; ?>

	<?php echo form_open('/ipssi/administration/redaction-pages/modifier/'.$page->url_menu.'/'.$page->url_sous_menu); ?>
		
		<?php echo form_error('contenu', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<textarea class="form-control" rows="20" name="contenu"><?php echo set_value('contenu', $page->texte_page_contenu); ?></textarea>
		</div>
		<button class="btn btn-primary btn-block">Modifier</button>

	<?php echo form_close(); ?>

</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>