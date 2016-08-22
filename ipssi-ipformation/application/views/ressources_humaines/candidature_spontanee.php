		<div class='container well'>
			<h1 class="titrePage">Candidature</h1>
			<br/>
			<?php 
				if(isset($id))
					echo form_open_multipart('/ressources_humaines/candidater/'.$id, array('class' => 'form-horizontal'));
				else
					echo form_open_multipart('/ressources_humaines/candidater', array('class' => 'form-horizontal'));

					if(isset($erreur) && ($erreur != '')) 
						echo "<p class='alert alert-danger'>".$erreur."</p>";
					else if(isset($insertion_candidature_ok) && ($insertion_candidature_ok != ''))
						echo "<p class='alert alert-success'>".$insertion_candidature_ok."</p>";
				?>
				<!-- Sexe -->
				<?php echo form_error('sexe', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-4 control-label" for="sexe">Civilité * :</label>
					<div class="col-md-4">
						<select id="sexe" name="sexe" class="form-control">
						<?php
							echo "<option value=''>Choisissez votre civilité</option>";
							foreach($sexe as $s)
							{
								if((isset($_POST['sexe'])) && ($_POST['sexe'] == $s->id_sexe))
									echo "<option value='".$s->id_sexe."' selected='selected'>".$s->raccourci_sexe."</option>";
								else
									echo "<option value='".$s->id_sexe."'>".$s->raccourci_sexe."</option>";
							}
						?>
						</select>
					</div>
				</div>
				<!-- Nom -->
				<?php echo form_error('nom', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-4 control-label" for="nom">Nom * : </label>  
					<div class="col-md-4">
						<input id="nom" name="nom" type="text" placeholder="Nom" class="form-control input-md" value="<?php echo set_value('nom'); ?>">
					</div>
				</div>
				<!-- Prenom -->
				<?php echo form_error('prenom', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-4 control-label" for="prenom">Prénom * : </label>  
					<div class="col-md-4">
						<input id="prenom" name="prenom" type="text" placeholder="Prénom" class="form-control input-md" value="<?php echo set_value('prenom'); ?>">					
					</div>
				</div>
				<!-- Date Naissance -->
				<?php echo form_error('naissance', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-4 control-label" for="naissance">Date de Naissance * : </label>  
					<div class="col-md-4">
						<input id="naissance" name="naissance" type="text" placeholder="JJ/MM/AAAA" class="form-control input-md" value="<?php echo set_value('naissance'); ?>">					
					</div>
				</div>
				<!-- Adresse -->
				<?php echo form_error('adresse', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-4 control-label" for="adresse">Adresse * : </label>  
					<div class="col-md-4">
						<input id="adresse" name="adresse" type="text" placeholder="Adresse" class="form-control input-md" value="<?php echo set_value('adresse'); ?>">
					</div>
				</div>
				<!-- CP -->
				<?php echo form_error('cp', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-4 control-label" for="cp">Code Postal * : </label>  
					<div class="col-md-4">
						<input id="cp" name="cp" type="text" placeholder="Code Postal" class="form-control input-md" value="<?php echo set_value('cp'); ?>">
					</div>
				</div>
				<!-- Ville -->
				<?php echo form_error('ville', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-4 control-label" for="ville">Ville * :</label>  
					<div class="col-md-4">
						<input id="ville" name="ville" type="text" placeholder="Ville" class="form-control input-md" value="<?php echo set_value('ville'); ?>">
					</div>
				</div>
				<!-- Pays -->
				<?php echo form_error('pays', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-4 control-label" for="pays">Pays * : </label>  
					<div class="col-md-4">
						<input id="pays" name="pays" type="text" placeholder="Pays" class="form-control input-md" value="<?php echo set_value('pays'); ?>">
					</div>
				</div>
				<!-- Téléphone -->
				<?php echo form_error('telephone', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-4 control-label" for="telephone">Téléphone * : </label>  
					<div class="col-md-4">
						<input id="telephone" name="telephone" type="text" placeholder="Téléphone" class="form-control input-md" value="<?php echo set_value('telephone'); ?>">
					</div>
				</div>
				<!-- Email -->
				<?php echo form_error('mail', '<div class="alert alert-danger">', '</div>'); ?>
				<div class="form-group">
					<label class="col-md-4 control-label" for="mail">Email * : </label>  
					<div class="col-md-4">
						<input id="mail" name="mail" type="text" placeholder="Email" class="form-control input-md" value="<?php echo set_value('mail'); ?>">
					</div>
				</div>
				<!-- CV -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="cv">CV * : </label>  
					<div class="col-md-4">
						<input id="cv" name="cv" type="file" class="input-md" style="padding-top:5px">
					</div>
				</div>
				<!-- Motivation -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="motivation">Lettre de motivation : </label>  
					<div class="col-md-4">
						<input id="motivation" name="motivation" type="file" class="input-md" style="padding-top:5px">
					</div>
				</div>
				<!-- Button -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="valider"></label>
					<div class="col-md-4">
						<button id="valider" name="valider" class="btn btn-primary">Postuler</button>
					</div>
				</div>
				<p class="italique">* Champs obligatoires</p>
			</form>
		</div>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
	</body>
</html>