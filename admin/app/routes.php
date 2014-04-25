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
	foreach($adicionales['adicionales'] as $a){
		$adicional = Adicional::find($a)->toArray();
		$adicionales_info[] = $adicional;
	}

	$paquete = Paquete::find(Session::get('paquete_id'))->toArray();

	$espacios = Session::get('espacios');
	
	$meses = Session::get('meses');

	return View::make('reservar')->with(array('adicionales'=>$adicionales_info, 'paquete'=>$paquete, 'espacios'=>$espacios, 'meses'=>$meses));
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


