<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $title; ?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/include_css.php'); ?>
	</head>
	<body>
	
		<nav class="navbar navbar-default">
			<div class="col-lg-12 entete">
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-7">
					<p class="entete-150"><a href="/" title="accueil"><img src="/assets/images/entete/logo_ipssi.png" alt="logo" class="entete-img-ipssi"/></a></p>
				</div>
				<div class="col-lg-2 visible-lg">
					<p class="entete-150"><a href="/" title="accueil"><img src="/assets/images/entete/logo.png" alt="logo" class="entete-img-ip"/></a></p>
				</div>
				<div class="col-lg-4 col-lg-offset-0 col-md-5 visible-lg visible-md">
					<p class="italique center entete-titre">L'institut Privée Supérieur des Systèmes d'Information</p>
				</div>
				<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-0 col-sm-1 col-sm-offset-3 col-xs-2 col-xs-offset-3 reseaux">
					<a class="btn btn-social-icon btn-facebook reseau"><i class="fa fa-facebook"></i></a><br/>
					<a class="btn btn-social-icon btn-linkedin reseau"><i class="fa fa-linkedin"></i></a><br/>					
					<a class="btn btn-social-icon btn-twitter reseau"><i class="fa fa-twitter"></i></a><br/>
				</div>
				<div class="col-lg-2 col-md-3 col-sm-4 entete-droite visible-lg visible-md visible-sm">				
					<div class="col-lg-12 col-md-12">
						<p id="cadre">
							<?php print($_SESSION['nom']. ' ' .$_SESSION['prenom']);?>
						</p>
					</div>
					<div class="col-lg-12 col-md-12">
						<br/><a href="/connexion" class="btn btn-primary btn-block">Déconnexion</a>
					</div>
				</div>
			</div>
		
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-haut-ipssi">
						<span class="sr-only">Toggle navigation</span>
						<span>Menu</span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="menu-haut-ipssi">
					<div class="col-xs-12">
						<ul class="nav navbar-nav">
							<div class="input-group visible-xs">
								<div class="row">
									<div class="col-xs-12">
										<br/><a href="/connexion" class="btn btn-primary btn-block">Déconnexion</a>
									</div>
								</div><hr/>			
							</div>
							
							
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Nous rejoindre<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="/ressources_humaines/candidater">CRA</a></li>
									<li><a href="/ressources_humaines/poste">Notes de Frais</a></li>
									<li><a href="/ressources_humaines/poste">Demande de congés</a></li>
									<li><a href="/ressources_humaines/poste">CVThèque</a></li>
									<li><a href="/ressources_humaines/poste">Offre de Poste</a></li>
									<li><a href="/ressources_humaines/poste">Candidatures</a></li>
									<li><a href="/ressources_humaines/poste">Collaborateurs</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Boîte à outils<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="/ressources_humaines/candidater">Certifications</a></li>
									<li><a href="/ressources_humaines/poste">Documents de Travail</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Paramétrages<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="/ressources_humaines/candidater">RH</a></li>
									<li><a href="/ressources_humaines/poste">CRM</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administration<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="/ressources_humaines/candidater">Gestion des Utilisateurs</a></li>
									<li><a href="/ressources_humaines/poste">Application</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</nav>