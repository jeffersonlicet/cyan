<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="Sistema de ruta Los Teques - SA">
	<meta name="author" content="Jefferson Licet">
	<link rel="apple-touch-icon" sizes="57x57" href="<?= URL::to('/'); ?>/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= URL::to('/'); ?>/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= URL::to('/'); ?>/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= URL::to('/'); ?>/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= URL::to('/'); ?>/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= URL::to('/'); ?>/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= URL::to('/'); ?>/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= URL::to('/'); ?>/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= URL::to('/'); ?>/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= URL::to('/'); ?>/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= URL::to('/'); ?>/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= URL::to('/'); ?>/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= URL::to('/'); ?>/img/favicon-16x16.png">
    <link rel="manifest" href="<?= URL::to('/'); ?>/img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= URL::to('/'); ?>/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

	<title>Sistema de rutas: LT-SA</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
	<link href="<?= URL::to('/'); ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= URL::to('/'); ?>/css/bootstrap-material-design.min.css" rel="stylesheet">
	<link href="<?= URL::to('/'); ?>/css/ripples.min.css" rel="stylesheet">
	<link href="<?= URL::to('/'); ?>/css/app.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56940433-10"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-56940433-10');
	</script>
	</head>
	<body>
	
	<div id="splash">
		<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
			<circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
		</svg>
	</div>

	<div id="app" style="display:none">
		<div class="navbar app-navbar box-shadow--3dp">
			<div class="container-fluid">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle app-toggler" data-toggle="collapse" data-target=".navbar-inverse-collapse">
						<i class="material-icons">menu</i>
					</button>
					<a class="navbar-brand" href="<?= URL::to('/'); ?>">Rutas LT-SA &nbsp;&nbsp;&nbsp;<span class="label label-info"><?= Carbon\Carbon::now()->format('g:i:s A'); ?></span></a>
				</div>

				<div class="navbar-collapse collapse navbar-inverse-collapse">
					<ul class="nav navbar-nav">
						<li><a href="<?= URL::to('/'); ?>">Rutas</a></li>
						<li><a href="<?= URL::to('/user/create'); ?>">Registrarme</a></li>
                        <li class="active"><a href="javascript:void(0)">Status</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-body">
						<?php if(!$user) : ?>
                        <h2>Usuario no encontrado</h2><h3>El usuario solicitado no se encuentra inscrito en el sistema.</h3>
                        <?php else : ?>
                        <div class="list-group">
                             <div class="list-group-item">
                                <div class="row-action-primary">
                                        <i class="material-icons">person</i>
                                    </div>
                                    <div class="row-content">
                                        <h4 class="list-group-item-heading"><?= $user->first_name; ?> <?= $user->last_name; ?></h4>
                                        <span class="label label-primary"><?= $user->nick_name; ?></span> <span class="label label-<?= $user->user_status == 1 ? 'primary' : 'danger'; ?>"><?= $user->user_status == 1 ? 'Cuenta activada' : 'Cuanta no activada'; ?></span>
                                    </div>
                                </div>
                            <div class="list-group-separator"></div>
                            <?php if(count($user->tickets) > 0) : ?>
                                <h3>Estás anotado en  <?= count($user->tickets); ?>  <?= count($user->tickets) == 1 ? 'ruta' : 'rutas'; ?>:</h3>
                                <?php foreach($user->tickets as $ticket): ?>
                                    <div class="panel-body app-cursor-pointer" style="border:1px solid #ccc;border-radius:5px;" onclick="location.href='<?= URL::to('/route/'.$ticket->route->route_id.'/'); ?>'">
                                        <div class="list-group-item">
                                            <div class="row-content">
                                                <h2 class="list-group-item-heading app-item-header"><?= $ticket->route->route_name; ?> - <?= $ticket->route->departure_at->format('g:i A'); ?></h2>
                                                <span class="label <?= $ticket->route->is_open ? 'label-primary' : 'label-default' ?>"><?= $ticket->route->is_open ? 'Abierta' : 'Abre en '. $ticket->route->open_time ?></span>
												<span class="label <?= $ticket->route->is_open ? 'label-warning' : 'displayN' ?> <?= $ticket->route->gone ? 'displayN' : '' ?>">El bus se va en <?= $ticket->route->departure_time ?></span>
                                               	<span class="label <?= $ticket->route->is_open ? 'label-warning' : 'displayN' ?> <?= $ticket->route->gone ? '' : 'displayN' ?>">El bus se ha ido</span>
											    <span class="label <?= $ticket->route->is_open ? 'label-danger' : 'displayN' ?>">Hay <?= count($ticket->route->tickets).( count($ticket->route->tickets) == 1 ? ' persona' : ' personas') ?> </span>
                                            </div>	
                                        </div>
                                    </div> <br />
                                <?php endforeach; ?>
                            <?php elseif($user->user_status == 1): ?>
                                <p>No estás anotado en ningún bus.</p>
                            <?php else: ?>
                                <p>Puedes solicitar la activación de tu cuenta escribiendo a hello@sprkly.net</p>
                            <?php endif; ?>
                        </div>    

                        <?php endif; ?>	
					</div>
				</div>
            </div>
		</div>
	</div>
	<div class="modal" id="modal-message">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="app-modal-title"></h4>
				</div>
				<div class="modal-body">
					<p id="app-modal-body"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
				</div>
			</div>
		</div>
	</div>
	<footer class="footer">
        <p>Patrocinado por: <a href="http://getselfy.net" target="_blank"><img width="36" height="36" src="<?= URL::to('/'); ?>/img/Selfy.png"> <b>Selfy</b></a></p>
    </footer>
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript">
		var APP_URL = <?= json_encode(URL::to('/')); ?>
	</script>
	<script src="<?= URL::to('/'); ?>/js/jquery-3.2.1.min.js?v=4"></script>
	<script src="<?= URL::to('/'); ?>/js/bootstrap.min.js?v=4"></script>
	<script src="<?= URL::to('/'); ?>/js/ripples.min.js?v=4"></script>
	<script src="<?= URL::to('/'); ?>/js/material.min.js?v=4"></script>
	<script src="<?= URL::to('/'); ?>/js/app.js?v=4"></script>
	</body>
</html>