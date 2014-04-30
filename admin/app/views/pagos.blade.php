@extends('layout')
@section('content')
<section class="cf" ng-app="app">
	<br><br><br><br><br><br>
	<h1>Pagos</h1>
	<div ng-controller="Pagos" ng-init="getPagos()">
		<div>
			<label>Status:</label>
			<select ng-model="search.status" ng-change="test(search.status)">
				<option value="">Todos</option>
				<option value="1">Pendiente</option>
				<option value="2">Pagado</option>
				<option value="3">Cancelado</option>
			</select>
		</div>
		<table class="table table-striped">
			<thead>
				<th>No. Orden</th>
				<th>Solicitud</th>
				<th>Fecha Venta</th>
				<th>Cliente</th>
				<th>Tipo de Pago</th>
				<th>Total de Venta</th>
				<th>Compte.</th>
				<th>Status</th>
			</thead>
			<tr ng-repeat="pago in pagos | orderBy:order:reverse | startFrom:currentPage*pageSize | limitTo:pageSize | filter:search">
				<td><% pago.id %></td>
				<td><a href="editar-solicitud/<% pago.solicitud.id %>" class="btn btn-primary">Ver</a></td>
				<td><% pago.created_at %></td>
				<td><% pago.solicitud.nombre + ' ' + pago.solicitud.apellidos %></td>
				<td><% pago.tipo_pago %></td>
				<td><% pago.AMT | currency %></td>
				<td><a href="<?php echo asset('img/comprobantes/') ?>/<% pago.comprobante %>" target="_blank" download="<% pago.comprobante %>"> <% pago.comprobante %></a></td>
				<td>
					<select class="form-control" ng-model="status[pago.id]" ng-change="changeStatus(pago.id, status[pago.id])">
						<option value="1">Pendiente</option>
						<option value="2">Pagado</option>
						<option value="3">Cancelado</option>
					</select>
				</td>
			</tr>
		</table>
		<div class="paginator">
			<button class="btn btn-default" ng-disabled="currentPage==0" ng-click="currentPage=currentPage-1">Anterior</button>
			<% currentPage + 1%> / <% numberOfPages() %>
			<button class="btn btn-default" ng-disabled="currentPage >= pagos.length/pageSize - 1" ng-click="currentPage=currentPage+1">Siguiente</button>
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


