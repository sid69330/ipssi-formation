<div class="container">
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/compte/nav.php'); ?>

	<?php if(isset($erreur)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-danger"><?php echo $erreur; ?></div>
			</div>
		</div>
	<?php elseif(isset($success)) : ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-success"><?php echo $success; ?></div>
			</div>
		</div>
	<?php endif; ?>

	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Photo de profil actuelle</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-6 col-xs-offset-3 col-md-2 col-md-offset-5">
			<?php if($infos->photo_profil != '') : ?>
				<img src="/assets/images/profil/<?php echo $this->session->userdata('id'); ?>/<?php echo $infos->photo_profil; ?>" class="img-responsive center-block" alt=""/>
			<?php else : ?>
				<img src="/assets/images/profil/profil_defaut.png" class="img-responsive center-block" alt=""/>
			<?php endif; ?>
		</div>
	</div><br/>

	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Modifier ma photo de profil</h1>
		</div>
	</div><br/>
	<div class="row">
		<div class="col-xs-12">
			<?php echo form_open_multipart('/ipssi/compte/modifier-photo-profil'); ?>
				<div class="form-group center">
    				<label for="file">Photo *</label><br/>
    				<input type="file" name="file" id="file" style="display:inline-block"/>
  				</div>
		  		<button type="submit" class="btn btn-primary btn-block">Modifier</button>
			</form>
			<p class="champsObligatoires">
				- Maximum 1Mo <br/>
				- 250x150 minimum <br/>
				- Extensions autorisées : jpg, jpeg ou png
			</p>
		</div>
	</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>