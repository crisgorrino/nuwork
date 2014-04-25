@extends('layout')
@section('content')
<section class="container pdd">
	<section class="inner cf">
		<form class="loginuser-form">
			<h2 class="contact-head">Convierte tu negocio en una gran empresa</h2>
			<p>Trabaja en coworking con nosotros.</p>
			<img src="<?php echo asset('img/loginuser-bg.jpg') ?>" class="top">
			<div class="login top">
				<img src="<?php echo asset('img/logo.png') ?>">
				<div class="gray">
					<input type="text" placeholder="No. de Id.">
					<input type="password" placeholder="Password">
					<input type="submit" value="Sign In">
				</div>
			</div>
		</form>
	</section>
</section>
@stop