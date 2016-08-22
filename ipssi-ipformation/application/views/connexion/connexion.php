<div class="container bloc">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage">Connexion à l'intranet</h1>
		</div>
	</div>
	<?php echo form_open('/connexion', array('class' => 'form-horizontal')); ?>
		
		<?php if(isset($erreurConnexion)) : ?>
			<p class='alert alert-danger'><?php echo $erreurConnexion; ?></p>
		<?php endif; ?>

		<?php echo form_error('identifiant', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label class="col-md-4 control-label" for="nom">Identifiant : </label>  
			<div class="col-md-4">
				<input id="identifiant" name="identifiant" type="text" placeholder="Identifiant" class="form-control input-md" value="<?php echo set_value('identifiant'); ?>">
			</div>
		</div>

		<?php echo form_error('mdp', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label class="col-md-4 control-label" for="mdp">Mot de Passe : </label>  
			<div class="col-md-4">
				<input id="mdp" name="mdp" type="password" placeholder="Mot de Passe" class="form-control input-md">					
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-4 control-label" for="connexion"></label>
			<div class="col-md-4">
				<button id="connexion" name="connexion" class="btn btn-primary btn-block">Connexion</button>
			</div>
		</div>
	</form>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>