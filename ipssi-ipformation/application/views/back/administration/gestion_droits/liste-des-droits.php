<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="titrePage center">Gestion des droits</h1>
        </div>
    </div>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

    <?php if(count($droits_page) > 0) : ?>
    	<?php echo form_open(); ?>
	    	<table class="table table-striped table-bordered">
	    		<thead>
	    			<tr>
	    				<th>Groupe</th>
	    				<th>Sous-menu</th>
	    				<th>Droit</th>
	    			</tr>
	    		</thead>
	    		<tbody>
	    			<?php $i = 0; ?>
	    			<?php foreach($droits_page as $d) : ?>
		    			<tr>
		    				<td><?php echo $d->libelle_groupe; ?></td>
	    					<td><?php echo $d->libelle_sous_menu; ?></td>
	    					<td>
	    						<div class="row">
	    							<div class="col-xs-2 col-xs-offset-1">
	    								<input <?php if($d->code_droit == 'T') echo "checked"; ?> type="radio" name="droits[<?php echo $i; ?>]" value="<?php echo $d->id_groupe; ?>_<?php echo $d->id_sous_menu; ?>_1"> T
	    							</div>
	    							<div class="col-xs-2">
	    								<input <?php if($d->code_droit == 'M') echo "checked"; ?> type="radio" name="droits[<?php echo $i; ?>]" value="<?php echo $d->id_groupe; ?>_<?php echo $d->id_sous_menu; ?>_2"> M
	    							</div>
	    							<div class="col-xs-2">
	    								<input <?php if($d->code_droit == 'P') echo "checked"; ?> type="radio" name="droits[<?php echo $i; ?>]" value="<?php echo $d->id_groupe; ?>_<?php echo $d->id_sous_menu; ?>_3"> P
	    							</div>
	    							<div class="col-xs-2">
	    								<input <?php if($d->code_droit == 'V') echo "checked"; ?> type="radio" name="droits[<?php echo $i; ?>]" value="<?php echo $d->id_groupe; ?>_<?php echo $d->id_sous_menu; ?>_4"> V
	    							</div>
	    							<div class="col-xs-2">
	    								<input <?php if($d->code_droit == '') echo "checked"; ?> type="radio" name="droits[<?php echo $i; ?>]" value="<?php echo $d->id_groupe; ?>_<?php echo $d->id_sous_menu; ?>_null"> Aucun
	    							</div>
	    						<?php $i++; ?>    						
	    					</td>
		    			</tr>
	    			<?php endforeach; ?>
	    		</tbody>
	    	</table>
	    	<input type="submit" value="Modifier les droits" class="btn btn-block btn-primary"/>
	    <?php echo form_close(); ?>
	    <p class="champsObligatoires">
	    	<u>Légende</u> :<br/>
	    	T : Tous les droits<br/>
	    	M : Ajout, modification et visualisation N & N-<br/>
	    	P : Ajout, modification et visualisation personnelle<br/>
	    	V : Visualisation N & N-
	    </p>
    <?php endif; ?>

</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>