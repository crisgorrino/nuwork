@extends('layout')

@section('content')
<section class="inner bg">
	<h1>Innovación pura. Entrarás con una idea, saldrás con un negocio.</h1>
	<p>Forma parte de Nuwork. Tu propio escritorio ubicado a un costado de la zona<br>financiera de Guadalajara.</p>
	<p>Desde <span>$1,700.00</span> MXN. más IVA</p>
	<a id="reservacionesBtn" href="index.php?target=reservaciones">Solicitar</a>
</section>
<!--SlideShow-->
<section class="slideshow">
	<div class="cycle-slideshow" data-cycle-fx="fadeout" data-cycle-speed=1500 data-cycle-timeout=4000 data-cycle-next="#next" data-cycle-manual-fx="fadeout"  data-cycle-manual-speed="200">
		<!-- empty element for pager links -->
		<div class="cycle-pager"></div>
		<img src="img/slide1.jpg">
		<img src="img/slide2.jpg">
		<img src="img/slide3.jpg">
	</div>
</section>
<section class="container cf">
	<div class="rojo1 cf">
		<div class="bgdes1">
			<h2>Sólo necesitas traer tu laptop</h2>
			<p>Disfruta de todos los beneficios de una oficina tradicional: Escritorio, internet de alta velocidad, línea de teléfono compartida para llamadas locales y nacionales y por supuesto el mejor café de la zona.</p>
		</div>
	</div>
	<div class="rojo2 cf">
		<div class="bgdes3">
			<h2>Retroalimenta tu idea de manera contínua</h2>
			<p>Plasma tu negocio sobre las paredes y déjalo disponible para todos. Te deslumbrará la retro que obtendrás al trabajar de manera colaborativa.</p>	</div>
		</div>
		<div class="rojo3 cf">
			<div class="bgdes3">
				<h2>Construye y aterriza tu modelo de negocio con metodologías de validación</h2>
				<p>Ten acceso a mentores expertos en el tema para desarrollar un producto o servicio que tus clientes estarán dispuestos a pagarte por el.</p>
			</div>
		</div>
	</section>
	<section class="container nuwork">
		<p>Nuwork sabe que los emprendedores tienen como principal problema: <strong>El miedo al fracaso y los altos costos fijos</strong>. Por esa razón ofrecemos un espacio de trabajo donde los emprendedores puedan trabajar y retroalimentar/validar sus ideas de manera <strong>colaborativa</strong> para <strong>reducir el riesgo de fracaso</strong>, todo esto a un precio <strong>accesible.</strong></p>
		<a id="reservaciones2"></a>
	</section>
	<section class="container cf pack" ng-app="app">

		<section class="inner" ng-controller="HomeController">
			<?php echo Form::open() ?>
			<h3>Reserva tu espacio de trabajo colaborativo</h3><a id="reservaciones"></a>
			<h4>¿Qué necesitas?</h4>
			<p>Indica tus requerimientos para visualizar los paquetes disponibles para ti</p>
			<div class="filtro">
				<span class="filtro-title">No. de espacios:</span>
				<?php echo Form::select('espacios', array(1=>1,2=>2, 3=>3), NULL, array('class'=>'seleccionar', 'ng-model'=>'espacios', 'ng-change'=>'getPrecioMensual()'))?>
			</div>
			<div class="filtro">
				<span class="filtro-title">Tiempo requerido:</span>
				<?php echo Form::select('meses', array(1=>'1 mes', 3=>'3 meses'), NULL, array('class'=>'seleccionar', 'ng-model'=>'meses','ng-change'=>'getPrecioMensual()'))?>
			</div>
			<p class="iva">Precios sin IVA inclu&iacute;do</p>
			
			<div class="precios">
				<h3>Gold label</h3>
				<p><% precio_mensual_1 | currency:"$" %> MXN/ 1 mes</p>
				<img src="<?php echo asset('img/nuwork-tmb.jpg') ?>">
				<ul>
					<li>1 escritorio en área en comun</li>
					<li>Llamadas locales e nacionales</li>
					<li>Internet de alta velocidad</li>
					<li>Acceso a sala de juntas</li>
					<li>Horario de 8:00 a 21:00 hrs.</li>
					<li>Café</li>
					<li><a href="save_selection?espacios=<% espacios %>&meses=<% meses %>&paquete_id=1">Solicitar</a></li>
				</ul>
			</div>


			<div class="precios">
				<h3>Diamond label</h3>
				<p><% precio_mensual_2 | currency:"$" %> MXN/ 1 mes</p>
				<img src="<?php echo asset('img/nuwork-tmb.jpg') ?>">
				<ul>
					<li>1 escritorio FIJO</li>
					<li>Llamadas locales e nacionales</li>
					<li>Internet de alta velocidad</li>
					<li>Acceso a sala de juntas</li>
					<li>Horario de 8:00 a 21:00 hrs.</li>
					<li>Café</li>
					<li>Archivero</li>
					<li>Locker</li>
					<li><a href="save_selection?espacios=<% espacios %>&meses=<% meses %>&paquete_id=2">Solicitar</a></li>
				</ul>
			</div>
			
			<div class="precios">
				<h3>Privado</h3>
				<p><% precio_mensual_3 | currency:"$" %> MXN/ 1 mes</p>
				<img src="<?php echo asset('img/nuwork-tmb.jpg') ?>">
				<ul>
					<li>1 escritorio FIJO</li>
					<li>Llamadas locales e nacionales</li>
					<li>Internet de alta velocidad</li>
					<li>Acceso a sala de juntas</li>
					<li>Horario de 8:00 a 21:00 hrs.</li>
					<li>Café</li>
					<li>Archivero</li>
					<li>Locker</li>
					<li>Divisi&oacute;n con mampara</li>
					<li><a href="save_selection?espacios=<% espacios %>&meses=<% meses %>&paquete_id=3">Solicitar</a></li>
				</ul>
			</div>


			<p class="iva">No se requiere realizar un pago para reservar.</p>
			<a id="contacto2"></a>
			<?php echo Form::close() ?>
		</section>
	</section>
	<section class="container gray">
		<?php echo Form::open(array('class'=>'contact-form cf', 'action'=>'MailController@sendMessage')) ?>
			<h3><a id="contacto">¡Contáctanos!</a></h3>
			<p>Tu opinión es muy importante para nosotros. Déjanos tu mensaje y enseguida nos comunicaremos contigo</p>
			<div class="contact">
				<?php echo Form::text('nombre', '', array('placeholder'=>'Nombre y Apellido')) ?>
				<?php echo Form::text('email', '', array('placeholder'=>'E-mail')) ?>
				<?php echo Form::text('telefono', '', array('placeholder'=>'Teléfono')) ?>
				<?php echo Form::text('ciudad', '', array('placeholder'=>'Ciudad')) ?>
				<?php echo Form::text('medio', '', array('placeholder'=>'¿Cómo te enteraste de nosotros')) ?>
			</div>
			<div class="contact">
				<?php echo Form::textarea('mensaje', '', array('placeholder'=>'Mensaje')); ?>
				<?php echo Form::submit('Enviar') ?>
			</div>
			<div class="contact">
				<ul>
					<li>Mar mediterráneo 1255 int. 2 Col. Country Club, Guadalajara Jal.</li>
					<li><a href="mailto:ventas@nuwork.mx">ventas@nuwork.mx</a></li>
					<li>Tel. (044) 331 325 0788</li>
				</ul>
			</div>
		<?php echo Form::close() ?>
	</section>
	<section class="container cf">
		<a id="mapa"></a>
		<iframe class="map" width='100%' height='600px' src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d933.0548652634651!2d-103.3746269300593!3d20.701311015043633!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428ae30de3edc8b%3A0xee075e763534baa0!2sNuWork!5e0!3m2!1ses!2smx!4v1398356345638" width="600" height="450" frameborder="0" style="border:0"></iframe>
	</section>
	<script src="<?php echo asset('js/angular/HomeController.js') ?>"></script>
	@stop
