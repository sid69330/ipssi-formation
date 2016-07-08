		<div class='container'>
			<div class="row">
				<div class="col-lg-12 well">
				
					<h1 class="titrePage">Saisie du contenu</h1>
					
					<form class="form-horizontal">
					
						<br/>
						<div class="form-group">
							<label class="col-md-4 control-label" for="menuSaisie">Choisir un menu</label>
							<div class="col-md-4">
								<select id="menuSaisie" name="menuSaisie" class="form-control">
									<option value="0">Choisir un menu</option>
									<?php
										foreach($menu as $m)
										{
											echo '<option value="'.$m->id_menu().'">'.$m->libelle_menu().'</option>';
										}
									?>
								</select>
								
							</div>
						</div>
						<span id="retourMenuSaisie"></span>
					
					</form>
				</div>
			</div>
		</div>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
		<script>
			$("#menuSaisie").change(function() {
				var menuSaisie = $("#menuSaisie").val();
				
				if(menuSaisie != 0)
				{
					var request = $.ajax({
						url: "/ajax/recupSousMenu",
						method: "POST",
						data: { menuSaisie : menuSaisie, <?php echo $this->security->get_csrf_token_name(); ?> : <?php echo "'".$this->security->get_csrf_hash()."'"; ?>},
						dataType: "html"
					});
					request.done(function(retour) {
						if(retour != null)
							$("#retourMenuSaisie").html(retour);
						else
						{
							$("#retourMenuSaisie").html('');
						}
					});
					request.fail(function( jqXHR, textStatus ) {
						alert( "Request failed: " + textStatus );
					});
				}
				else
				{
					$("#retourMenuSaisie").html('');
				}
			});
		</script>
	</body>
</html>