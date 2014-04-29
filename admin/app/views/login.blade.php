@extends('layout')
@section('content')
<!DOCTYPE html>
<!--Contact Bg-->
<section class="container pdd">
	<section class="">
		<form class="loginadmin-form" method="post">
			<h2 class="contact-head">Login: de Administración</h2>
			<p>Accesa a tu panel de control.</p>
			<img src="<?php echo asset('img/loginuser-bg.jpg') ?>" class="top">
			<div class="login top">
				<img src="<?php echo asset('img/logo.png') ?>">
				<div class="gray">
					<input name="user" type="text" placeholder="Usuario">
					<input name="password" type="password" placeholder="Password">
					<input type="submit" value="Sign In">
				</div>
			</div>
		</form>
	</section>
</section>
</html> 
@stop