<div class="col-lg-3">
	<div class="row">
		<div class="col-lg-11 well">
			<p class='sous-titre_menu_gauche'>Sous-menu</p>
			<ul class="list-group">
			<?php
				foreach($sous_sous_menu as $ssm)
				{
					echo '<a href="#" class="list-group-item">'.$ssm->libelle_sous_sous_menu.'</a>';
				}
			?>
			</ul>
		</div>
	</div>
</div>