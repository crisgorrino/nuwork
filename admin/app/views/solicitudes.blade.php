@extends('layout')
@section('content')
<section class="cf" ng-app="app">
	<br><br><br><br><br><br>
	<h1>Solicitudes Realizadas</h1>
	<div ng-controller="Solicitudes">
		<table class="table table-striped">
			<thead>
				<th ng-click="order='id'; reverse=!reverse">Id</th>
				<th ng-click="order='paquete'; reverse=!reverse">Paquete</th>
				<th ng-click="order='meses'; reverse=!reverse">Meses</th>
				<th ng-click="order='espacios'; reverse=!reverse">Espacios</th>
				<th ng-click="order='nombre'; reverse=!reverse">Nombre</th>
				<th ng-click="order='apellidos'; reverse=!reverse">Apellidos</th>
				<th ng-click="order='titulo'; reverse=!reverse">Titulo</th>
				<th ng-click="order='facebook'; reverse=!reverse">Facebook</th>
				<th ng-click="order='correo'; reverse=!reverse">Correo</th>
				<th ng-click="order='celular'; reverse=!reverse">Celular</th>
				<th ng-click="order='proyecto'; reverse=!reverse">Proyecto/Empresa</th>
				<th ng-click="order='status'; reverse=!reverse">Status</th>
				<th ng-click="order='created_at'; reverse=!reverse">Fecha</th>
				<th></th>
			</thead>
			<tr ng-repeat="solicitud in solicitudes | startFrom:currentPage*pageSize | limitTo:pageSize">
				<td><% solicitud.id %></td>
				<td><% solicitud.paquete %></td>
				<td><% solicitud.meses %></td>
				<td><% solicitud.espacios %></td>
				<td><% solicitud.nombre %></td>
				<td><% solicitud.apellidos %></td>
				<td><% solicitud.titulo %></td>
				<td><a href="<% solicitud.facebook %>" target="__blank"><% solicitud.facebook %></a></td>
				<td><% solicitud.correo %></td>
				<td><% solicitud.celular %></td>
				<td><% solicitud.proyecto %></td>
				<td><% solicitud.status %></td>
				<td><% solicitud.created_at %></td>
				<td><a href="editar-solicitud/<%solicitud.id%>" class="btn btn-primary">Ver</a></td>
			</tr>

		</table>
		<div class="paginator">
			<button class="btn btn-primary" ng-disabled="currentPage==0" ng-click="currentPage=currentPage-1">Anterior</button>
			<% currentPage + 1%> / <% numberOfPages() %>
			<button class="btn btn-primary" ng-disabled="currentPage >= solicitudes.length/pageSize - 1" ng-click="currentPage=currentPage+1">Siguiente</button>
		</div>

	</div>
</section>
<script type="text/javascript" src="<?php echo asset('js/angular/SolicitudesController.js') ?>"></script>
<style type="text/css">
	th{
		cursor: pointer;
	}
</style>
@stop