@extends('layout')
@section('content')
<section class="cf" ng-app="app">
	<br><br><br><br><br><br>
	<h1>Pagos</h1>
	<div ng-controller="Pagos">
		<table class="table table-striped">
			<thead>
				<th>Id</th>
				<th>Solicitud ID</th>
				<th>Fecha Venta</th>
				<th>Cliente</th>
				<th>Tipo de Pago</th>
				<th>No. Orden</th>
				<th>Total de Venta</th>
				<th>Compte.</th>
			</thead>
		</table>
		<div class="paginator">
			<button class="btn btn-default" ng-disabled="currentPage==0" ng-click="currentPage=currentPage-1">Anterior</button>
			<% currentPage + 1%> / <% numberOfPages() %>
			<button class="btn btn-default" ng-disabled="currentPage >= solicitudes.length/pageSize - 1" ng-click="currentPage=currentPage+1">Siguiente</button>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?php echo asset('js/angular/PagosController.js') ?>"></script>
<style type="text/css">
	th{
		cursor: pointer;
	}
</style>
@stop

