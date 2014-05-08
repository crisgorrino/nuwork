@extends('layout')
@section('content')
<section class="container cf pdd2" ng-app="app">
	<div id="cont">
		<h1>Tu solicitud ha sido realizada</h1>	
		<br>
		<h3>Nuestro equipo de ventas está procesando tu solicitud y se pondrán en contacto contigo cuanto antes.</h3>
		<img alt="" src="<?php echo asset('img/nuworkbg.jpg') ?>">
	</div>
</section>
<style type="text/css">
	h1{text-align: center;}
	h3{text-align: center;}

	#cont{height: 500px; text-align: center;}
	img{margin-top: 40px;}
</style>
@stop