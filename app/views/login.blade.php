@extends('layout')
@section('content')
<section class="container pdd">
	<section class="inner cf">
		<?php echo Form::open(array('class'=>'loginuser-form')) ?>
			<h2 class="contact-head">Convierte tu negocio en una gran empresa</h2>
			<p>Trabaja en coworking con nosotros.</p>
			<img src="<?php echo asset('img/loginuser-bg.jpg') ?>" class="top">
			<div class="login top">
				<img src="<?php echo asset('img/logo.png') ?>">
				<div class="error"><label class="label-warning">{{$errors->first()}}</label></div>	
				<div class="gray">
					<?php echo Form::text('id', '', array('placeholder'=>'No. de Id.')) ?>
					<?php echo Form::password('password', array('placeholder'=>'Password')) ?>
					<?php echo Form::submit('Sign In') ?>
				</div>
			</div>
		<?php echo Form::close() ?>
	</section>
	
</section>

<style type="text/css">
	.error{
		color: red;
		text-align: center;
	}
</style>
@stop