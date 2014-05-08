@extends('layout')
@section('content')

<section class="" ng-app="app">
	<br><br><br><br><br>
	<h1>Solicitud No. {{$solicitud['id']}}</h1>
	<div ng-controller="Solicitud" ng-init="solicitud_id={{$solicitud['id']}}">
		<fieldset>
			<legend>Datos Generales</legend>
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
					
					<th>Fecha</th>
					<th>Status</th>
				</thead>
				<tr>
					<td><?php echo $solicitud['id'] ?></td>
					<td><?php echo $solicitud['paquete'] ?></td>
					<td><?php echo $solicitud['meses'] ?></td>
					<td><?php echo $solicitud['espacios'] ?></td>
					<td><?php echo $solicitud['nombre'] ?></td>
					<td><?php echo $solicitud['apellidos'] ?></td>
					<td><?php echo $solicitud['titulo'] ?></td>
					<td><a href="{{$solicitud['facebook']}}" target="__blank"><?php echo $solicitud['facebook'] ?></a></td>
					<td><?php echo $solicitud['correo'] ?></td>
					<td><?php echo $solicitud['celular'] ?></td>
					<td><?php echo $solicitud['proyecto'] ?></td>
					
					<td><?php echo $solicitud['created_at'] ?></td>
					<td ng-init="status={{$solicitud['status']}}">
						<select class="form-control" ng-change="updateStatus()" ng-model="status" ng-options="option.id as option.descripcion for option in options">
							
						</select>
					</td>
					
				</tr>
			</table>
			<table class="table table-striped">
				<thead>
					<th>¿Por qué quiere entrar?</th>
				</thead>
				<tr>
					<td>
						<textarea class="form-control que_hacer" disabled="disabled">
							<?php echo $solicitud['que_hacer'] ?>
						</textarea>
					</td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Servicios Adicionales</legend>
			<?php if(!empty($adicionales)): ?>
				<table class="table table-striped">
					<thead>
						<th>Adicional</th>
						<th>Meses</th>
						<th>Espacios</th>
					</thead>
					<?php foreach($adicionales as $adicional): ?>
						<tr>
							<td>{{$adicional['nombre']}}</td>
							<td>{{$adicional['meses']}}</td>
							<td>{{$adicional['espacios']}}</td>
						</tr>
					<?php endforeach; ?>
				</table>
			<?php else: ?>
				No se solicito ningún servicio adicional para esta solicitud
				<br><br>
			<?php endif;?>
		</fieldset>
	</div>
</section>
<script type="text/javascript" src="<?php echo asset('js/angular/SolicitudesController.js') ?>"></script>
@stop