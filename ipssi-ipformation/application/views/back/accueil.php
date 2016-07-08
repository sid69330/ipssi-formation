<div class='container'>
    <div class="row">
        <div class="col-xs-12 col-md-6 bloc-tableau-bord">
            Widget 1
        </div>
        <div class="col-xs-12 col-md-6 bloc-tableau-bord">
            Widget 2
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6 bloc-tableau-bord">
            <p class="sousTitrePageBack font16">Dernières actualités</p>

            <?php if(count($actualites) > 0) : ?>
                <table class="table table-bordered table striped">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date ajout</th>
                            <th>Etat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($actualites as $a) : ?>
                            <tr>
                                <td><?php echo $a->titre_actualite; ?></td>
                                <td><?php echo $a->date_actualite; ?></td>
                                <td><?php echo $a->etat; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <div class="row">
                <div class="col-xs-12">
                    <a href="/ipssi/actualites/liste-actualites" class="btn btn-info btn-block">Gestion des actualités</a>
                </div>
            </div>



        </div>
        <div class="col-xs-12 col-md-6 bloc-tableau-bord">
            Liste des mails
        </div>
    </div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/footer.php'); ?>
</body>
</html>
