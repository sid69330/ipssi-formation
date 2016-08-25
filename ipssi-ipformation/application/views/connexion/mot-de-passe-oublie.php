<div class="container bloc">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage">Mot de passe oublié</h1>
		</div>
	</div>

	<?php if(isset($erreur)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class='alert alert-danger'><?php echo $erreur; ?></div>
			</div>
		</div>
	<?php elseif(isset($success) && ($success != '')) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class='alert alert-success'><?php echo $success; ?></div>
			</div>
		</div>
	<?php endif; ?>

	<?php echo form_open('/connexion/mot_de_passe_oublie', array('class' => 'form-horizontal')); ?>

		<?php echo form_error('identifiant', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label class="col-md-4 control-label" for="nom">Email : </label>  
			<div class="col-md-4">
				<input id="identifiant" name="identifiant" type="text" placeholder="Email" class="form-control input-md" value="<?php echo set_value('identifiant'); ?>">
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-4 control-label" for="reinitialiser"></label>
			<div class="col-md-4">
				<button id="reinitialiser" name="reinitialiser" class="btn btn-primary btn-block">Réinitialiser</button>
			</div>
		</div>

	</form>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>