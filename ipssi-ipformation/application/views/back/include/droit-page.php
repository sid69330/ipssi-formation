<div class="row">
	<div class="col-xs-12">
		<?php if(in_array('T', $droits)) : ?>
			<p class="font11 italique center">Vous possédez tous les droits sur cette page</p>
		<?php elseif(in_array('M', $droits)) : ?>
			<p class="font11 italique center">Vous possédez le droit de modification et visualisation</p>
		<?php elseif(in_array('P', $droits)) : ?>
			<p class="font11 italique center">Vous possédez le droit de visualisation et modification personnelle</p>
		<?php elseif(in_array('V', $droits)) : ?>
			<p class="font11 italique center">Vous possédez le droit de visualisation N et N-</p>
		<?php endif; ?>
	</div>
</div><br/>