@extends('layout')

@section('content')

<section class="container cf" ng-app="app">
	<br><br><br>
	<section class="container cf pack" ng-controller="Stock">

		<section class="inner">
		
			<p class="iva">Stock de Paquetes</p>	
			<div class="precios">
				<h3>Gold label</h3>
				<img src="<?php echo asset('img/nuwork-tmb.jpg') ?>">
				<ul>
					<li>1 escritorio en área en comun</li>
					<li>Llamadas locales e nacionales</li>
					<li>Internet de alta velocidad</li>
					<li>Acceso a sala de juntas</li>
					<li>Horario de 8:00 a 21:00 hrs.</li>
					<li>Café</li>
					<li>Stock: <input class="input-stock" type="text" ng-model="stock[1]"  ng-pattern="/^\d+$/"></li>
					<li><a ng-click="saveStock(1)">Actualizar</a></li>
				</ul>
			</div>


			<div class="precios">
				<h3>Diamond label</h3>
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
					<li>Stock:<input class="input-stock" type="text" ng-model="stock[2]" ng-pattern="/^\d+$/"></li>
					<li><a ng-click="saveStock(2)">Actualizar</a></li>
				</ul>
			</div>
			
			<div class="precios">
				<h3>Privado</h3>
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
					<li>Stock: <input class="input-stock" type="text" ng-model="stock[3]" ng-pattern="/^\d+$/"></li>
					<li><a ng-click="saveStock(3)">Actualizar</a></li>
				</ul>
			</div>

		</section>
	</section>
</section>
<script type="text/javascript" src="<?php echo asset('js/angular/StocksController.js') ?>"></script>
<style type="text/css">
.precios{
	min-width: 200px;
}
.input-stock{
	width: 100px;
	text-align: center;
}
.ng-invalid {
	color:white;
	background: red;
}
</style>
@stop
