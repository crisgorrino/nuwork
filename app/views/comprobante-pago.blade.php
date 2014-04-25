@extends('layout')
@section('content')
<section class="container cf pdd">
	<section class="inner pdd">
		<h2 class="carga">Carga de comprobante de pago</h2>
		<form class="pago-form gray cf">
		<p>Ingresa el nombre de usuario y la contraseña generados en tu comprobante de pago.</p>
			<input type="text" placeholder="E-mail">
			<input type="text" placeholder="No. orden">
			<label>Selecciona tu archivo:</label><input type="file" class="right">
			<input type="button" value="Enviar comprobante">
		</form>
	</section>
</section>
@stop