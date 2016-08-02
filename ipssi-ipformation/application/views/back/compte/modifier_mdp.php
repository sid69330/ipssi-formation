<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Modifier mon mot de passe</h1>
		</div>
	</div>

	<?php if(isset($mdp_premiere_connexion) && ($mdp_premiere_connexion != '')) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-info"><?php echo $mdp_premiere_connexion; ?></div>
			</div>
		</div>
	<?php endif; ?>
	<?php if(isset($success) && ($success != '')) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-success"><?php echo $success; ?></div>
			</div>
		</div>
	<?php endif; ?>
	<?php if(isset($erreur) && ($erreur != '')) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-danger"><?php echo $erreur; ?></div>
			</div>
		</div>
	<?php endif; ?>

	<div class="row">
		<div class="col-xs-12">
			<?php echo form_open('/ipssi/compte/modifier-mdp'); ?>
				<?php echo form_error('mdp_actuel', '<div class="alert alert-danger">', '</div>'); ?>
		  		<div class="form-group">
		    		<label for="passwordActuel">Mot de passe actuel</label>
		    		<input type="password" name="mdp_actuel" class="form-control" id="passwordActuel">
		  		</div><br/>
		  		<?php echo form_error('mdp1', '<div class="alert alert-danger">', '</div>'); ?>
		  		<div class="form-group">
		    		<label for="mdp1">Nouveau mot de passe *</label>
		    		<input type="password" class="form-control" id="mdp1" name="mdp1">
		  		</div>
		  		<?php echo form_error('mdp2', '<div class="alert alert-danger">', '</div>'); ?>
		  		<div class="form-group">
		    		<label for="mdp2">Ressaisir *</label>
		    		<input type="password" class="form-control" id="mdp2" name="mdp2">
		  		</div>
		  		<button type="submit" class="btn btn-primary btn-block">Modifier</button>
			<?php echo form_close(); ?>
			<p class="champsObligatoires">
				* Le mot de passe doit : <br/> 
				- Etre de longueur 8 minimum <br/>
				- Contenir au moins un caractère alphabétique + un chiffre + un caractère spécial <br/>
				- Etre différent du mot de passe actuel
			</p>
		</div>
	</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>