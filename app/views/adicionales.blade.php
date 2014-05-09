@extends('layout2')

@section('content')
<!--Contact Bg-->
<section class="container pdd2" ng-app="app" ng-controller="Adicionales">
	<section class="inner cf">
		<div class="adicionales">
			<img src="<?php echo asset('img/add1.png') ?>">	
			<h3>Contadora</h3>
			<ul>
				<li>$500.00 MXN + I.V.A. al mes</li>
				<li>Maneja tu contabilidad de manera correcta con nuestra contadora.</li>
			</ul>
			<a ng-class="{'saved' : adicional_1}" ng-click="adicional_1 = !adicional_1">Agregar</a>
		</div>

		<div class="adicionales">
			<img src="<?php echo asset('img/add2.png') ?>">
			<h3>Archivero</h3>
			<ul>
				<li>$300.00 MXN + I.V.A. al mes</li>
				<li>Guarda tus archivos de manera segura.</li>
			</ul>
			<a ng-class="{'saved' : adicional_2}" ng-click="adicional_2 = !adicional_2">Agregar</a>
		</div>

		<div class="adicionales">
			<img src="<?php echo asset('img/add3.png') ?>">
			<h3>Locker</h3>
			<ul>
				<li>$200.00 MXN + I.V.A. al mes</li>
				<li>Ten tu locker para tu mayor comodidad y seguridad de tus pertenencias.</li>
			</ul>
			<a ng-class="{'saved' : adicional_3}" ng-click="adicional_3 = !adicional_3">Agregar</a>
		</div>

		<div class="adicionales">
			<img src="<?php echo asset('img/add4.png') ?>">
			<h3>1 hora de asesoría al mes</h3>
			<ul>
				<li>$500.00 MXN + I.V.A. al mes</li>
				<li>Ten acceso a un mentor personal que da una a tus metas y estrategias de venta.</li>
			</ul>
			<a ng-class="{'saved' : adicional_4}" ng-click="adicional_4 = !adicional_4">Agregar</a>
		</div>

		<div class="adicionales">
			<img src="<?php echo asset('img/add4.png') ?>">
			<h3>4 horas de asesoría al mes</h3>
			<ul>
				<li>$1,200.00 MXN + I.V.A. al mes</li>
				<li>Ten acceso a un mentor personal que da una a tus metas y estrategias de venta.</li>
			</ul>
			<a ng-class="{'saved' : adicional_5}" ng-click="adicional_5 = !adicional_5">Agregar</a>
		</div>
	</section>
	<?php echo Form::open() ?>
		<input type="checkbox" name="adicionales[]" value="1" ng-model="adicional_1" style="display:none">
		<input type="checkbox" name="adicionales[]" value="2" ng-model="adicional_2" style="display:none">
		<input type="checkbox" name="adicionales[]" value="3" ng-model="adicional_3" style="display:none">
		<input type="checkbox" name="adicionales[]" value="4" ng-model="adicional_4" style="display:none">
		<input type="checkbox" name="adicionales[]" value="5" ng-model="adicional_5" style="display:none">
		<input type="submit" value="CONTINUAR" class="button">
	<?php echo Form::close() ?>
	
</section>
<script type="text/javascript" src="js/angular/AdicionalesController.js"></script>
@stop