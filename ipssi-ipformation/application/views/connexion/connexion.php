		<div class='container well'>
			<h1 class="titrePage">Connexion à l'intranet</h1>
			<br/>
			<?php 

				echo form_open('/connexion', array('class' => 'form-horizontal'));
				
				if(isset($erreurConnexion)) 
					echo "<p class='alert alert-danger'>".$erreurConnexion."</p>";

				?>
				<!-- Identifiant -->
				<?php echo form_error('identifiant', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-4 control-label" for="nom">Identifiant : </label>  
					<div class="col-md-4">
						<input id="identifiant" name="identifiant" type="text" placeholder="Identifiant" class="form-control input-md" value="<?php echo set_value('identifiant'); ?>">
					</div>
				</div>
				<!-- mdp -->
				<?php echo form_error('mdp', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-4 control-label" for="mdp">Mot de Passe : </label>  
					<div class="col-md-4">
						<input id="mdp" name="mdp" type="password" placeholder="Mot de Passe" class="form-control input-md">					
					</div>
				</div>
				
				<!-- Button -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="connexion"></label>
					<div class="col-md-4">
						<button id="connexion" name="connexion" class="btn btn-primary">Connexion</button>
					</div>
				</div>
			</form>
		</div>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
	</body>
</html>