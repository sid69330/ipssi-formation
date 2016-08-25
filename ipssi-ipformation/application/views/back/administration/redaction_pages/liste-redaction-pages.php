<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="titrePage center">Liste des pages du Front</h1>
		</div>
	</div>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/back/include/droit-page.php'); ?>

	<?php if(count($pages) > 0) : ?>
		<table class="table table-bordered table-stripped" id="listePages">
			<thead>
				<tr>
					<th>Menu</th>
					<th>Sous-menu</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pages as $p) : ?>
					<tr>
						<td><?php echo $p->libelle_menu; ?></td>
						<td><?php echo $p->libelle_sous_menu; ?></td>
						<td class="center">
							<?php if(in_array('T', $droits)) : ?>
								<a href="/ipssi/administration/redaction-pages/detail/<?php echo mb_strtolower($p->url_menu); ?>/<?php echo mb_strtolower($p->url_sous_menu); ?>" title="Détail" class="btn btn-xs btn-default btn-detail"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<a href="/ipssi/administration/redaction-pages/modifier/<?php echo mb_strtolower($p->url_menu); ?>/<?php echo mb_strtolower($p->url_sous_menu); ?>" title="Modifier" class="btn btn-xs btn-default btn-modifier"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							<?php else : ?>
								<a href="/ipssi/administration/redaction-pages/detail/<?php echo mb_strtolower($p->url_menu); ?>/<?php echo mb_strtolower($p->url_sous_menu); ?>" title="Détail" class="btn btn-xs btn-default btn-detail"><i class="fa fa-eye" aria-hidden="true"></i></a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<div class="alert alert-info">Aucune pages à afficher.</div>
	<?php endif; ?>

</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
<script>
	$(document).ready(function() {
	    $('#listePages').DataTable( {
	    	"language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        	},
	        "order": false
	    });
	});
</script>
</body>
</html>