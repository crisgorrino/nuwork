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

Route::post('adicionales', 'ReservarController@showCarrito');
	

Route::get('login', function(){
	return View::make('login');
});


Route::post('login', function(){
	if (Auth::attempt(array('id' => Input::get('id'), 'password' => Input::get('password'), 'status'=>1))){
	    return Redirect::intended('pago');
	}else{
		$errors = array('error'=>'Verifique su id y password');
	
		$usuario = Usuario::where('id', '=', Input::get('id'))->where('status', '==', 1)->exists();
		if(!$usuario){
			$errors = array('error'=>'El usuario relacionado con ésta solicitud ya pagó o su solicitud ha sido cancelada');	
		}
		return Redirect::to('login')->withErrors($errors);
	}
});

Route::group(array('before' => 'auth'), function(){	

	Route::get('pago', 'PagosController@showMetodos');	

	Route::post('pago', 'PagosController@procesarPago');

	Route::get('ficha-pago', function(){
		return View::make('ficha-pago');
	});

	Route::get('paypal', 'PagosController@preConfirmacion');

	Route::post('confirmar-pago','PagosController@confirmacion');

	Route::get('pago-realizado', function(){ return View::make('pago-realizado'); });

	Route::get('pago-fallo', function(){ return Response::make('fallo'); });

	Route::get('logout', function(){
		Auth::logout();
		return Redirect::to('login');
	});

});

Route::get('comprobante-pago', function(){ return View::make('comprobante-pago'); });

Route::get('save_selection', 'HomeController@saveSelection');

Route::get('sendmessage', 'MailController@sendMessage');

Route::post('sendmessage', 'MailController@sendMessage');

Route::get('reservar', function(){ return View::make('reservar'); });

Route::post('getPrecioMensual', 'ReservarController@getPrecios');

Route::post('getPaquetePrecioMensual', 'ReservarController@getPaquetePrecio');

Route::post('sendSolicitud', 'ReservarController@sendSolicitud');

Route::get('solicitud-realizada', function(){ return View::make('solicitud-realizada'); });

