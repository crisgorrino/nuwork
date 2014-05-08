@extends('layout')
@section('content')
<section class="container cf pdd">
	<section class="inner pdd">
		<h2 class="carga">Carga de comprobante de pago</h2>
		<form class="pago-form gray cf" enctype="multipart/form-data" method="post" id="frm_carga_comprobante">
		<p>Ingresa el nombre de usuario y la contraseña generados en tu comprobante de pago.</p>
			<input name="correo" type="text" placeholder="E-mail">
			<input name="solicitud_id" type="text" placeholder="No. solicitud">
			<label>Selecciona tu archivo:</label><input name="comprobante" type="file" class="right">
			<input type="button" value="Enviar comprobante" onclick="$('#frm_carga_comprobante').submit()">
		</form>
	</section>
</section>
@stop