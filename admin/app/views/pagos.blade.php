@extends('layout')
@section('content')
<section class="cf" ng-app="app">
	<br><br><br><br><br><br>
	<h1>Pagos</h1>
	<div ng-controller="Pagos" ng-init="getPagos()">
		<div id="frm-filter">
			{{ Form::open(array('class'=>"form-inline")) }}
				<div class="form-group">
					<label>Status:</label>
					<select class="form-control" name="status">
						<option value="0" <?php echo Session::get('status') == '0' ? 'selected' : ''  ?>>Todos</option>
						<option value="1" <?php echo Session::get('status') == '1' ? 'selected' : ''  ?> >
							Pendiente
						</option>
						<option value="2" <?php echo Session::get('status') == '2' ? 'selected' : ''  ?>>
							Pagado
						</option>
						<option value="3" <?php echo Session::get('status') == '3' ? 'selected' : ''  ?>>
							Cancelado
						</option>
					</select>
				</div>
				<div class="form-group">
					<label>Tipo de Pago: </label>
					<select class="form-control" name="tipo_pago">
						<option value="0">Todos</option>
						<option value="Paypal" <?php echo Session::get('tipo_pago') == 'Paypal' ? 'selected' : '' ?> >Paypal</option>
						<option value="Deposito" <?php echo Session::get('tipo_pago') == 'Deposito' ? 'selected' : '' ?> >Deposito</option>
					</select>
				</div>
				<div class="form-group">
					<label>Nombre:</label>
					<input type="text" value="<?php echo Session::get('nombre') ?>" class="form-control" name="nombre">
				</div>
				<div class="form-group">
					<label>Apellidos:</label>
					<input type="text" value="<?php echo Session::get('apellidos') ?>" class="form-control" name="apellidos">
				</div>
				<div class="form-group">
					<label>Desde:</label>
					<input type="text" value="<?php echo Session::get('desde') ?>" class="form-control datepicker" name="desde">
				</div>
				<div class="form-group">
					<label>Hasta:</label>
					<input type="text" value="<?php echo Session::get('hasta') ?>" class="form-control datepicker" name="hasta">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="Buscar">	
				</div>
			{{ Form::close() }}
			{{ Form::open(array('class'=>"form-inline", 
								'style'=>'width: 80px; float: right; margin-top: -30px; margin-right: 35px;')) }}
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Reset">
				</div>
			{{ Form::close() }}
		</div>
		<table class="table table-striped">
			<thead>
				<th>No. Orden</th>
				<th>Solicitud</th>
				<th>Fecha Venta</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Tipo de Pago</th>
				<th>Total de Venta</th>
				<th>Compte.</th>
				<th>Status</th>
			</thead>
			<tr ng-repeat="pago in pagos | startFrom:currentPage*pageSize | limitTo:pageSize">
				<td><% pago.id %></td>
				<td><a href="editar-solicitud/<% pago.solicitud.id %>" class="btn btn-primary">Ver</a></td>
				<td><% pago.created_at %></td>
				<td><% pago.solicitud.nombre %></td>
				<td><% pago.solicitud.apellidos %></td>
				<td><% pago.tipo_pago %></td>
				<td><% pago.AMT | currency %></td>
				<td>
					<a href="<?php echo asset('img/comprobantes/') ?>/<% pago.comprobante %>" target="_blank" download="<% pago.comprobante %>"><% pago.comprobante ? 'Descargar' : '' %></a>
				</td>
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
			<button class="btn btn-primary" ng-disabled="currentPage==0" ng-click="currentPage=currentPage-1">Anterior</button>
			<% currentPage + 1%> / <% numberOfPages() %>
			<button class="btn btn-primary" ng-disabled="currentPage >= pagos.length/pageSize - 1" ng-click="currentPage=currentPage+1">Siguiente</button>
		</div>
		<div id="dialog-confirm" title="Sin espacios">
			<p>
				<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>No hay suficientes espacios para éste paquete
			</p>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?php echo asset('js/pagos.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('js/angular/PagosController.js') ?>"></script>
<style type="text/css">
	th{
		cursor: pointer;
	}
	#frm-filter{
		text-align: center;
		width: 95%;
		margin: 0 auto;
		padding-bottom: 20px;
	}
</style>

<script type="text/javascript">
	$('.datepicker').datepicker();
</script>
@stop


