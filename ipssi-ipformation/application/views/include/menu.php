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
				<?php if(!$this->session->has_userdata('id')) : ?>
					<div class="col-lg-2 col-md-3 col-sm-4 entete-droite visible-lg visible-md visible-sm">
						<div class="col-lg-12 col-md-12">
							<div class="input-group">
									<input type="text" class="form-control" placeholder="Rechercher">
									<span class="input-group-btn">
									<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
									</span>
							</div>
						</div>
						<div class="col-lg-12 col-md-12">
							<br/><a href="/connexion" class="btn btn-primary btn-block">Mon IPSSI</a>
						</div>
					</div>
				<?php else : ?>
					<div class="col-lg-2 col-md-3 col-sm-4 entete-droite visible-lg visible-md visible-sm">
						<div class="col-lg-12 col-md-12 center" style="color:white">
							<a href="/ipssi/compte" class="btnConfigCompteHeader"><i class="fa fa-cogs" aria-hidden="true"></i></a> <?php echo $this->session->userdata('nom').' '.$this->session->userdata('prenom'); ?>
						</div>
						<div class="col-lg-12 col-md-12">
							<a href="/ipssi" class="btn btn-primary btn-block" style="margin-top:12px">Mon IPSSI</a>
							<a href="/deconnexion" class="btn btn-danger btn-block">Déconnexion</a>
						</div>
					</div>
				<?php endif; ?>
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
									<div class="col-xs-9 col-xs-offset-1">
										<input type="text" class="form-control" placeholder="Rechercher"/>
									</div>
									<span class="input-group-btn">
										<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
									</span>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<br/><a href="/connexion" class="btn btn-primary btn-block">Mon IPSSI</a>
										<?php if($this->session->has_userdata('id')) : ?>
											<a href="/deconnexion" class="btn btn-danger btn-block">Déconnexion</a>
										<?php endif; ?>
									</div>
								</div><hr/>
							</div>
							<?php
								foreach ($menu as $m)
								{
									if ($m->nb_sous_menu() > 0)
									{
										echo '<li class="dropdown">';
										echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">' . $m->libelle_menu() . '<span class="caret"></span></a>';
										echo '<ul class="dropdown-menu" role="menu">';
										foreach ($m->sous_menus() as $sm) {
											echo '<li><a href="/page/' . $m->lien_menu() . '/' . $sm->url_sous_menu . '">' . $sm->libelle_sous_menu . '</a></li>';
										}
										echo '</ul>';
										echo '</li>';
									}
									else
									{
										if ($m->lien_menu() == '/')
											echo '<li><a href="/page/' . $m->lien_menu() . '">' . $m->libelle_menu() . '</a></li>';
										else
											echo '<li><a href="/">' . $m->libelle_menu() . '</a></li>';
									}
								}
							?>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Nous rejoindre<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="/ressources_humaines/candidater">Candidature Spontanée</a></li>
									<li><a href="/ressources_humaines/poste">Postes à pourvoir</a></li>
								</ul>
							</li>
							<li><a href="/espace_collaborateur">L'espace collaborateur</a></li>
							<li><a href="/contact">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>