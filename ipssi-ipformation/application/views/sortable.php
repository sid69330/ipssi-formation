<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Classement et ordre</title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
		<link rel="stylesheet" type="text/css" href="/assets/css/style_sortable.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
		
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="/assets/javascript/jquery.ui.touch-punch.min.js"></script>
	</head>
	<body>
		<div class='container'>
			<div class="panel panel-info">
				<div class="panel-heading text-center">
					<h1>Type de classement</h1>
				</div>
				<div class="panel-body" id="type_classement">
					<table class="table">
						<tbody>
							<tr>
								<td>
									<div class="radio">
										<label>
											<input type="radio" value="0" name="options_type_classement"><b>NORMAL</b>
										</label>
										<span class="help-block">Le classement se fera sans prise en compte du mail de l'expéditeur. </span>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="radio">
										<label>
											<input type="radio" value="1" name="options_type_classement"><b>SELON LE MAIL DE L'EXPEDITEUR</b>
										</label>
										<span class="help-block">
											Les pièces jointes seront classées dans le dossier paramétré pour l'expediteur du mail. L'onglet de paramétrage des mails et dossiers apparaîtra après validation.<br>
											NB: Si vous ne paramétrez pas le mail de l'expediteur, les fichiers joints ne seront pas pris en compte vous recevréz un mail d'alerte.
										</span>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel panel-success">
				<div class="panel-heading text-center">
					<h1>Classement et ordre</h1>
				</div>
				<div class="panel-body">
					<div id="messageClassement"></div>
					<h2>Tris seléctionnés</h2>
					<ul id="sortable">
						<?php
							$tab_selection = array();
							if(count($classement) > 0)
							{
								$i = 1;
								foreach($classement as $c)
								{
									array_push($tab_selection, $c->id_dossier);
									
									if($c->id_dossier != 5)
										echo '<li class="list-group-item"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span><input type="checkbox" checked="" name="" value="'.$c->id_dossier.'"/> '.$c->type_dossier.'<span class="badge">'.$i.'</span></li>';
									else
									{
										echo '<li class="list-group-item"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span><input type="checkbox" name="" checked="" value="5"/> ';
											echo 'DOSSIER DIVERS';
											echo '<input class="form-control input_dossier_divers" type="text" id="dossier_divers" placeholder="Créer un dossier de votre choix" name="dossier_divers" value="'.$c->type_dossier.'"/>';
										echo '<span class="badge">'.$i.'</span></li>';
									}
									$i++;
								}
							}
							else
								echo '<div class="alert alert-info" id="aucunTriSelect">Aucun tri seléctionné</div>';
						?>
					</ul>
					<h2>Choix du tri</h2>
					<ul id="nonSortable" class="list-group">
						<?php
							if(count($tab_selection) < 6)
							{
								if(!in_array(0, $tab_selection))
									echo '<li class="list-group-item"><input type="checkbox" name="" value="0"/> DOSSIER CLIENT</li>';
								if(!in_array(1, $tab_selection))
									echo '<li class="list-group-item"><input type="checkbox" name="" value="1"/> ANNEE</li>';
								if(!in_array(2, $tab_selection))
									echo '<li class="list-group-item"><input type="checkbox" name="" value="2"/> MOIS</li>';
								if(!in_array(3, $tab_selection))
									echo '<li class="list-group-item"><input type="checkbox" name="" value="3"/> JOUR</li>';
								if(!in_array(4, $tab_selection))
									echo '<li class="list-group-item"><input type="checkbox" name="" value="4"/> SUJET MAIL</li>';
								if(!in_array(5, $tab_selection))
								{
									echo '<li class="list-group-item"><input type="checkbox" name="" value="5"/>
										DOSSIER DIVERS
										<input class="form-control input_dossier_divers" type="text" id="dossier_divers" placeholder="Créer un dossier de votre choix" name="dossier_divers" value=""/>
									</li>';
								}
							}
						?>
					</ul>
					<button id="btn-save" class="btn btn-primary btn-block">Enregistrer</button>
				</div>
			</div>
		</div>
		<script>		
			$(function()
			{
				//Mise a jour des pastilles dans le bloc "Tris seléctionnés" à chaque fois qu'on change l'ordre en "drag and drop"
				$("#sortable").sortable({
					update : function() {
						miseAJourOrdre();
					}
				});
			});
			
			/*
				Evenement "click" sur un li présent dans le bloc "Choix du tri"
			*/
			$("#nonSortable").on("click", " input[type=checkbox]", function()
			{
				var id = $(this).val(); //Récupère l'identifiant du li
				//S'il s'agit du dossier "divers", je stocke la valeur du champ input
				if(id == 5)
					valDossierDivers = $("#dossier_divers").val();
				
				$("#aucunTriSelect").remove(); //Supprime le message dans "Tris seléctionnés"
				data = ($(this).parent()[0].outerHTML); //On récupère le bloc parent (tout le li)
				$("#sortable").append(data); //On l'écrit dans le bloc "Tris seléctionnés"
				$("#sortable li input[type=checkbox]").prop('checked', true); //On coche les checkbox du bloc "Tris seléctionnés"
				
				//--------------------
				$("#sortable li .glyphicon").remove();
				$("#sortable li").prepend('<span class="glyphicon glyphicon-sort" aria-hidden="true"></span>');
				//--------------------
				
				$(this).parent()[0].remove(); //On supprime le li du bloc "Choix du tri"
				
				//S'il s'agit du dossier "divers", je remets la valeur dans le champ input
				if(id == 5)
					$("#dossier_divers").val(valDossierDivers);
				
				//Vérifie s'il existe au moins 1 li dans "Choix du tri". Si 0 alors on affiche un message
				var length = $('#nonSortable li').length;
				if(length == 0)
					$("#nonSortable").append('<div class="alert alert-info" id="tousTriSelect">Tous les tris ont été sélectionnés</div>');
				
				miseAJourOrdre(); //Mise a jour des pastilles dans le bloc "Tris seléctionnés"
			});
			
			/*
				Evenement "click" sur un li présent dans le bloc "Tris seléctionnés"
			*/
			$("#sortable").on("click", "input[type=checkbox]", function()
			{
				var id = $(this).val(); //Récupère l'identifiant du li
				
				$("#tousTriSelect").remove(); //Supprime le message dans "Choix du tri"
				data = ($(this).parent()[0].outerHTML); //On récupère le bloc parent (tout le li)
				$("#nonSortable").append(data); //On l'écrit dans le bloc "Choix du tri"
				$("#nonSortable li input[type=checkbox]").prop('checked', false); //On décoche les checkbox du bloc "Choix du tri"
				
				//--------------------
				$("#nonSortable .glyphicon").remove();
				//--------------------
				
				$(this).parent()[0].remove(); //On supprime le li du bloc "Tris seléctionnés"
				
				//S'il s'agit du dossier "divers", je vide ce qu'il y a dans le champ input
				if(id == 5)
					$("#dossier_divers").val('');
				
				//Vérifie s'il existe au moins 1 li dans "Tris seléctionnés". Si 0 alors on affiche un message
				var length = $('#sortable li').length;
				if(length == 0)
					$("#sortable").append('<div class="alert alert-info" id="aucunTriSelect">Aucun tri seléctionné</div>');
				
				miseAJourOrdre(); //Mise a jour des pastilles dans le bloc "Tris seléctionnés"
			});
			
			/*
				Permet de mettre à jour les pastilles "badge" présentes dans le bloc "Tris seléctionnés"
			*/
			function miseAJourOrdre()
			{
				//On supprimes tous les badges des deux blocs
				$("#sortable li .badge").remove();
				$("#nonSortable li .badge").remove();
				var i = 1;
				//Boucle sur les li présents dans le bloc "Tris seléctionnés" et ajoute une pastille incrémentée avec la variable i
				$("#sortable li").each(function() {
					$(this).append('<span class="badge">'+i+'</span>');
					i++;
				});
			}
			
			/*
				Evenement "click" sur le bouton "Enregistrer"
			*/
			$("#btn-save").click(function() 
			{
				var divers = null;
				var name;
				var i = 0;
				var tab = [];
				var uid_config = 1; //Valeur à modifier avec ton PHP
				
				var type_classement = 0;
				if($('#type_classement input[type=radio][value=1]').is(':checked'))
					type_classement = 1;
				
				$("#sortable li").each(function() {
					id = $(this).find("input[type=checkbox]").val();
					tab[i] = id;
					
					if(id == 5)
						divers = $(this).find("input[type=text]").val();
					
					i++;
				});
				
				if((divers !== null) && (divers.trim() == ''))
					$("#messageClassement").html('<div class="alert alert-danger">Veuillez renseigner un nom pour le tri "DOSSIER DIVERS"</div>');
				else
				{
					$("#messageClassement").html('');
					
					var request = $.ajax({
						url: "/sortable/majOrdreBdd",
						method: "POST",
						data: { tab : tab, divers : divers, uid_config : uid_config, type_classement : type_classement },
						dataType: "html"
					});
					request.done(function(msg) {
						if(msg == 0)
							$("#messageClassement").html('<div class="alert alert-danger">Une erreur s\'est produite pendant l\'envoi des données.</div>');
						else
							$("#messageClassement").html('<div class="alert alert-success">'+msg+'</div>');
					});
					request.fail(function(jqXHR, textStatus) {
						$("#messageClassement").html('<div class="alert alert-danger">Request failed :'+textStatus+'</div>');
					});
				}
			});
		</script>
	</body>
</html>