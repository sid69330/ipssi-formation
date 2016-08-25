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

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

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
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
	tinymce.init
	({ 
		selector:'textarea',
		plugins: 
		[
    		'advlist autolink lists link image charmap print preview anchor',
    		'visualblocks code',
    		'insertdatetime media table contextmenu paste'
  		],
  		convert_fonts_to_spans : false,
  		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code"
	});
	
</script>
</body>
</html>