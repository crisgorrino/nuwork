<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){
	return View::make('home');
});


Route::get('adicionales', function(){
	return View::make('adicionales');
});

Route::post('adicionales', function(){
	
	$adicionales = Input::all();
	$adicionales_info = array();

	if(!empty($adicionales['adicionales'])){
		foreach($adicionales['adicionales'] as $a){
			$adicional = Adicional::find($a)->toArray();
			$adicionales_info[] = $adicional;
		}	
	}	

	$paquete = Paquete::find(Session::get('paquete_id'))->toArray();

	$espacios = Session::get('espacios');
	
	$meses = Session::get('meses');

	Session::put('adicionales', $adicionales_info);

	return View::make('reservar')->with(array('paquete'=>$paquete, 'espacios'=>$espacios, 'meses'=>$meses));
});

Route::get('login', function(){
	return View::make('login');
});

Route::get('comprobante-pago', function(){
	return View::make('comprobante-pago');
});

Route::get('save_selection', 'HomeController@saveSelection');

Route::get('sendmessage', 'MailController@sendMessage');

Route::post('sendmessage', 'MailController@sendMessage');

Route::get('reservar', function(){
	return View::make('reservar');
});


Route::post('getPrecioMensual', 'ReservarController@getPrecios');

Route::post('getPaquetePrecioMensual', 'ReservarController@getPaquetePrecio');


Route::post('sendSolicitud', function(){

	$validator = Validator::make(Input::all(),
		array(
			'nombre'	=>'required',
			'correo'	=>'required|email',
			'apellidos'	=>'required',
			'titulo'	=>'required',
			'celular'	=>'required',
			'proyecto'	=>'required',
			'que_hacer'	=>'required'
			)
		);

	if($validator->fails()){
		return Redirect::back();
	}

	$solicitud = new Solicitud();
	$solicitud->paquete_id = Input::get('paquete_id');
	$solicitud->meses = Input::get('meses');
	$solicitud->espacios = Input::get('espacios');
	$solicitud->nombre = Input::get('nombre');
	$solicitud->apellidos = Input::get('apellidos');
	$solicitud->titulo = Input::get('titulo');
	$solicitud->facebook = Input::get('facebook');
	$solicitud->correo = Input::get('correo');
	$solicitud->celular = Input::get('celular');
	$solicitud->proyecto = Input::get('proyecto');
	$solicitud->que_hacer = Input::get('que_hacer');
	$solicitud->save();

	$adicionales = array();
	foreach(Input::get('adicionales') as $id_adicional){
		$a = new SolicitudFeature();
		$a->solicitud_id = $solicitud->id;
		$a->feature_id = $id_adicional;
		$a->meses = Input::get('meses_'.$id_adicional);
		$a->espacios = Input::get('espacios_'.$id_adicional);
		$a->save();

		$feature = Adicional::where('id', '=', $a->feature_id)->first()->toArray();
		$feature['meses'] = Input::get('meses_'.$id_adicional);
		$feature['espacios'] = Input::get('espacios_'.$id_adicional);
		$adicionales[] = $feature;
	}

	$paquete = Paquete::find($solicitud->paquete_id);

	Mail::send( 'emails.solicitud-mail', array('datos'=>Input::all(), 'paquete'=>$paquete, 'adicionales'=>$adicionales), function($message)
	{
		$message->to('portela828@gmail.com', 'Nuwork - Nueva Solicitud')->subject('Welcome!');
	});
	
	return Redirect::to('solicitud-realizada');
});

Route::get('solicitud-realizada', function(){
	return View::make('solicitud-realizada');
});

