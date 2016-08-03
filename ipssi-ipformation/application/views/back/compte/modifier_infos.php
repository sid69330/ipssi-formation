<div class="container">
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/compte/nav.php'); ?>
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Modifier mes informations personnelles</h1>
		</div>
	</div>

	<?php if($success != '') : ?>
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
	
	<?php echo form_open('/ipssi/compte/modifier-infos'); ?>

  		<?php echo form_error('tel', '<div class="alert alert-danger">', '</div>'); ?>
  		<div class="form-group">
    		<label for="tel">Téléphone</label>
    		<input type="text" class="form-control" id="tel" name="tel" value="<?php echo set_value('tel'); ?>">
  		</div>

  		<button type="submit" class="btn btn-primary btn-block">Modifier</button>

	<?php echo form_close(); ?>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>