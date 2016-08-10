		<div class='container'>
			<div class="row">
				<div class="col-xs-12">
					<h1 class="titrePage center">Contact</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<?php echo form_open('/contact', array('class'=>'form-horizontal')); ?>
						<?php 
							if(isset($erreur) && ($erreur != '')) 
								echo "<p class='alert alert-danger'>".$erreur."</p>";
							else if(isset($contact_message_envoye_ok) && ($contact_message_envoye_ok != ''))
								echo "<p class='alert alert-success'>".$contact_message_envoye_ok."</p>";
						?>
						<div class="panel panel-default"><br/>
							<div class="panel-body">					
								<!-- Contact Type -->
								<?php echo form_error('contact_type', '<div class="alert alert-danger">', '</div>'); ?>
								<div class="form-group">
									<label class="col-md-4 control-label" for="contact_type">Type de contact * :</label>
									<div class="col-md-4">
										<select id="contact_type" name="contact_type" class="form-control" onchange="ContactType(this.value)">
										<?php
											echo "<option value=''>Choisir un type de contact</option>";
											foreach($contact_type as $c)
											{
												echo "<option value='".$c->id_contact_type."'>".$c->libelle_contact_type."</option>";
											}
										?>
										</select>
									</div>
								</div>
								<!-- Contact Demande -->
								<?php echo form_error('contact_demande', '<div class="alert alert-danger">', '</div>'); ?>
								<div class="form-group">
									<label class="col-md-4 control-label" for="contact_demande">Sujet de la demande * :</label>
									<div class="col-md-4">
										<select id="contact_demande" name="contact_demande" class="form-control">
										<?php
											echo "<option value=''>Choisir un sujet</option>";
											foreach($contact_demande as $c)
											{
												echo "<option value='".$c->id_contact_demande."'>".$c->libelle_contact_demande."</option>";
											}
										?>
										</select>
									</div>
								</div>
								<!-- Sexe -->
								<?php echo form_error('sexe', '<div class="alert alert-danger">', '</div>'); ?>
								<div class="form-group">
									<label class="col-md-4 control-label" for="sexe">Civilité * :</label>
									<div class="col-md-4">
										<select id="sexe" name="sexe" class="form-control">
										<?php
											echo "<option value=''>Choisir une civilité</option>";
											foreach($sexe as $s)
											{
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
										<input id="nom" name="nom" type="text" placeholder="Nom" class="form-control input-md">
									</div>
								</div>
								<!-- Prenom -->
								<?php echo form_error('prenom', '<div class="alert alert-danger">', '</div>'); ?>
								<div class="form-group">
									<label class="col-md-4 control-label" for="prenom">Prénom * : </label>  
									<div class="col-md-4">
										<input id="prenom" name="prenom" type="text" placeholder="Prénom" class="form-control input-md">
									</div>
								</div>
								<!-- Societe -->
								<?php echo form_error('societe', '<div class="alert alert-danger">', '</div>'); ?>
								<div class="form-group">
									<label class="col-md-4 control-label" for="societe">Société : </label>  
									<div class="col-md-4">
										<input id="societe" name="societe" type="text" placeholder="Société" class="form-control input-md">
									</div>
								</div>
								<!-- Fonction -->
								<?php echo form_error('fonction', '<div class="alert alert-danger">', '</div>'); ?>
								<div class="form-group">
									<label class="col-md-4 control-label" for="fonction">Fonction : </label>  
									<div class="col-md-4">
										<input id="fonction" name="fonction" type="text" placeholder="Fonction" class="form-control input-md">
									</div>
								</div>
								<!-- Mail-->
								<?php echo form_error('mail', '<div class="alert alert-danger">', '</div>'); ?>
								<div class="form-group">
									<label class="col-md-4 control-label" for="mail">Mail * : </label>  
									<div class="col-md-4">
										<input id="mail" name="mail" type="text" placeholder="Mail" class="form-control input-md">
									</div>
								</div>
								<!-- Téléphone -->
								<?php echo form_error('telephone', '<div class="alert alert-danger">', '</div>'); ?>
								<div class="form-group">
									<label class="col-md-4 control-label" for="telephone">Téléphone : </label>  
									<div class="col-md-4">
										<input id="telephone" name="telephone" type="text" placeholder="Téléphone" class="form-control input-md">
									</div>
								</div>
								<!-- Message -->
								<?php echo form_error('message', '<div class="alert alert-danger">', '</div>'); ?>
								<div class="form-group">
									<label class="col-md-4 control-label" for="message">Message * : </label>
									<div class="col-md-4">                     
										<textarea class="form-control" id="message" name="message"></textarea>
									</div>
								</div>
								<!-- Envoyer -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="envoyer"></label>
									<div class="col-md-4">
										<button id="envoyer" name="envoyer" class="btn btn-primary">Envoyer</button>
									</div>	
								</div>
								<p class="italique">* Champs obligatoires</p>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">	
					<div class="panel panel-default">
						<div class="panel-heading gras"><span class ="color">Informations</span></div>
						<div class="panel-body">
						<?php
							foreach($adresse as $a)
							{
								echo "<span class='gras'> ".$a->libelle_adresse."</span><br/>";
								echo $a->adresse_adresse."<br/>";
								if (!empty($a->supplement_adresse)) { echo $a->supplement_adresse."<br/>"; }
								echo $a->code_postal_adresse."<br/>";
								echo $a->ville_adresse."<br/>";
								echo $a->pays_adresse."<br/>";
								if (!empty($a->telephone_adresse)) { echo "Tél : ".$a->telephone_adresse."<br/>"; }
								if (!empty($a->fax_adresse)) { echo "Fax : ".$a->fax_adresse."<br/>"; }
								echo "<br/>";
							}
						?>
						</div>
					</div>
				</div>
				<div class="col-md-7">	
					<div class="panel panel-default">
						<div class="panel-heading gras"><span class ="color">Accès</span></div>
						<div class="panel-body">
							<div class="col-lg-12" id="map_canvas" style="width:500px; height:500px;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="/assets/javascript/javascript.js"></script>	
	</body>
</html>