		<div class='container well'>
				<h1 class="titrePage">Postes à pourvoir</h1>
				<a href="/ressources_humaines/candidater" class="btn btn-block btn-primary">Candidature spontanée</a><br/>
				<?php
					foreach($postes as $p)
					{
				?>
						<div class="panel panel-default">
							<div class="panel-heading gras"><?php echo $p->titre_poste; ?></div>
							<div class="panel-body">
							
							<?php
								echo $p->accroche_poste;
								echo '<a href="/ressources_humaines/detail_poste/'.$p->id_poste.'" class="btn btn-primary float-right">+ d\'infos</a>'
							?>
							</div>
						</div>	
				<?php
					}
				
				?>
		</div>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
	</body>
</html>
