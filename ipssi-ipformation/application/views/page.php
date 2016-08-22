		<div class='container'>
			<div class="row">
				<?php if(count($sous_sous_menu) > 1)
				{
					include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/sous_sous_menu.php');
					
					echo '<div class="col-lg-9">';
				}
				else
					echo '<div class="col-lg-12">';
				?>
				<?php 
					echo nl2br($infosPage->texte_page_contenu);
				?>
				</div>
			</div>
		</div>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
	</body>
</html>