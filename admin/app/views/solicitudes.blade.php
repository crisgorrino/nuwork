@extends('layout')
@section('content')
<section class="cf" ng-app="app" ng-controller="Solicitudes">
	<br><br><br><br><br><br>
	<h1>Solicitudes Realizadas</h1>

	<!-- Filtros -->
	<div id="frm-filter">
		{{ Form::open(array('class'=>"form-inline")) }}
		<div class="form-group">
			<label>Status:</label>
			<select class="form-control" name="status_id">
				<option value="0">Todos</option>
				@foreach($solicitudes_estatus as $status)
					@if (Session::get('solicitudes_status_id') == $status['id'])
						<option value="{{$status['id']}}" selected="">{{ $status['descripcion'] }}</option>	
					@else
						<option value="{{$status['id']}}">{{ $status['descripcion'] }}</option>	
					@endif					
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Paquetes:</label>
			<select class="form-control" name="paquete_id">
				<option>Todos</option>
				@foreach ($paquetes as $paquete)
					@if ($paquete['id'] == Session::get('solicitudes_paquete_id'))
						<option value="{{$paquete['id']}}" selected="">{{$paquete['nombre']}}</option>
					@else
						<option value="{{$paquete['id']}}">{{$paquete['nombre']}}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Nombre:</label>
			<input type="text" value="<?php echo Session::get('solicitudes_nombre') ?>" class="form-control" name="nombre">
		</div>
		<div class="form-group">
			<label>Apellidos:</label>
			<input type="text" value="<?php echo Session::get('solicitudes_apellidos') ?>" class="form-control" name="apellidos">
		</div>
		<div class="form-group">
			<label>Desde:</label>
			<input type="text" value="<?php echo Session::get('solicitudes_desde') ?>" class="form-control datepicker" name="desde">
		</div>
		<div class="form-group">
			<label>Hasta:</label>
			<input type="text" value="<?php echo Session::get('solicitudes_hasta') ?>" class="form-control datepicker" name="hasta">
		</div>
		<div class="form-group">
			<input type="submit" id="buscar" class="btn btn-success" value="Buscar">	
		</div>
		{{ Form::close() }}
		{{ Form::open(array('class'=>"form-inline", 
		'style'=>'width: 80px; float: right; margin-top: -30px; margin-right: 35px;')) }}
		<div class="form-group">
			<input type="submit" class="btn btn-default" value="Reset">
		</div>
		{{ Form::close() }}
	</div>
	<!-- End Filtros -->


	<div>
		<table class="table table-striped">
			<thead>
				<th>Id</th>
				<th>Paquete</th>
				<th>Meses</th>
				<th>Espacios</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Titulo</th>
				<th>Facebook</th>
				<th>Correo</th>
				<th>Celular</th>
				<th>Proyecto/Empresa</th>
				<th>Status</th>
				<th>Fecha</th>
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
<script type="text/javascript">
	$('.datepicker').datepicker();
</script>
@stop