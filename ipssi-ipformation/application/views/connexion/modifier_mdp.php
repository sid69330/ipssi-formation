<div class="container bloc">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage">Réinitialisation du mot de passe</h1>
		</div>
	</div>

	<?php if(isset($erreur)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-danger"><?php echo $erreur; ?></div>
			</div>
		</div>
	<?php endif; ?>

	<?php echo form_open('/connexion/modifier_mdp/'.$cle, array('class' => 'form-horizontal')); ?>

		<?php echo form_error('mdp1', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label class="col-md-4 control-label" for="mdp1">Mot de Passe : </label>  
			<div class="col-md-4">
				<input id="mdp1" name="mdp1" type="password" placeholder="Mot de passe" class="form-control input-md">					
			</div>
		</div>

		<?php echo form_error('mdp2', '<div class="alert alert-danger">', '</div>'); ?>
		<div class="form-group">
			<label class="col-md-4 control-label" for="mdp1">Ressaisir : </label>  
			<div class="col-md-4">
				<input id="mdp2" name="mdp2" type="password" placeholder="Ressaisir" class="form-control input-md">					
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-4 control-label" for="reinit"></label>
			<div class="col-md-4">
				<button id="reinit" name="reinit" class="btn btn-primary btn-block">Réinitialiser</button>
			</div>
		</div>

	</form>
	<p class="champsObligatoires">
		* Le mot de passe doit : <br/> 
		- Etre de longueur 8 minimum <br/>
		- Contenir au moins un caractère alphabétique + un chiffre + un caractère spécial <br/>
		- Etre différent du mot de passe actuel
	</p>

</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>