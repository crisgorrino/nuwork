<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Por esa razón ofrecemos un espacio de trabajo donde los emprendedores puedan trabajar y retroalimentar/validar sus ideas de manera colaborativa para reducir el riesgo de fracaso, todo esto a un precio accesible.">
	<meta name="keywords" content="">
	<meta name="author" content="Biteweb">
	<!--open graph tags-->
	<meta content="" name="description">
	<meta property="og:site_name" content="NuWork: Coworking Space" name="application-name">
	<meta property="og:title" content="Innovación pura. Entrarás con una idea, saldrás con un negocio." name="application-name">
	<meta property="og:description" content="Forma parte de Nuwork. Tu propio escritorio ubicado a un costado de la zona financiera de Guadalajara." name="application-name">
	<meta property="og:url" content="http://www.nuwork.mx/" name="application-name">
	<meta property="og:image" content="<?php echo asset('img/logo.png') ?>" name="application-name">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="<?php echo asset('favicon.ico') ?>" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo asset('css/style.css') ?>" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo asset('css/slideshow.css') ?>" type="text/css" media="all"><!--Estilos para el js de Cycle2-->
	<link rel="stylesheet" href="<?php echo asset('css/normalize.css') ?>" type="text/css" media="all"><!--Estilos para resetear estilos CSS-->
	<link rel="stylesheet" href="<?php echo asset('css/bootstrap.min.css') ?>" type="text/css" media="all">
	<title>NuWork - Coworking Space</title>

	<script src="<?php echo asset('js/jquery.js') ?>" type="text/javascript"></script>
	<script src="<?php echo asset('js/modernizr.js') ?>" type="text/javascript"></script><!--JS para apoyar en buscadores obsoletos-->
	<script src="<?php echo asset('js/jquery.cycle2.min.js') ?>" type="text/javascript"></script><!--JS de Cycle2 SlideShow-->
	<script src="<?php echo asset('js/scrolld.min.js') ?>" type="text/javascript"></script><!--Scrolling Smoth-->
	<script src="<?php echo asset('js/scrolld.min.js') ?>" type="text/javascript"></script><!--JS que permite quitar los prefijos de efectos CSS como -webkit, -moz (no todos) -->
	<script src="<?php echo asset('js/angular/angular.min.js') ?>"></script>

	<!-- JQuery UI -->
	<script type="text/javascript" src="<?php echo asset('jqueryui/js/jquery-ui-1.10.4.custom.min.js') ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo asset('jqueryui/css/flick/jquery-ui-1.10.4.custom.min.css') ?>">
</head>

<body>

	<!--Header-->
	<header>
		<section class="inner">
			<a class="left logo" href="<?php echo url('/') ?>"><img src="<?php echo asset('img/logo.png') ?>"  alt="NuWork - Coworking Space"></a>
			<p class="slogan left">Sketch<br>your business</p>
			<nav class="main-menu">
				<ul class="left">
					<?php if(Auth::check()): ?>
					<li><a class="" href="<?php echo url('/') ?>">Stocks</a></li>
					<li><a class="" href="<?php echo url('pagos') ?>">Pagos</a></li>
					<li><a class="" href="<?php echo url('solicitudes') ?>">Solicitudes</a></li>
					<li><a href="<?php echo url('logout') ?>">Salir</a></li>
					<?php endif; ?>
				</ul>
				<a href=""><span class="icon-facebook"></span></a>
				<a href=""><span class="icon-twitter"></span></a>
				<a href=""><span class="icon-linkedin"></span></a>
			</nav>
		</section>
	</header>
	<!-- end Header  -->

	@yield('content')

	<!--footer-->
	<footer>
		<section class="inner">
			<a href="index.php"><img src="<?php echo asset('img/logo-w.png') ?>" class="inline"></a>
			<p class="inline">Mar mediterráneo 1255 int. 2, col. Country Club, Guadalajara Jalisco.  tel. (044) 33 1325 0788<br><a href="mailto:ventas@nuwork.mx">ventas@nuwork.mx</a></p>
		</section>
	</footer>
</body>
</html> 