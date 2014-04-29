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


Route::group(array('before' => 'auth'), function(){

	Route::get('/', function(){
		// obtener el stock de los paquetes
		return View::make('home');	
	});

	Route::get('logout', function(){
		Auth::logout();
		return Redirect::to('login');
	});

	Route::get('getStocks', function(){
		$stocks = Stock::all()->toArray();
		return Response::json($stocks);
	});

	Route::put('saveStock', function(){
		$stock = Stock::where( 'paquete_id','=',Input::get('paquete_id') )->first();
		$stock->stock = Input::get('stock');
		$stock->save();
		return Response::json($stock);
	});

	Route::get('solicitudes', function(){
		return View::make('solicitudes');
	});

	Route::get('getSolicitudes', 'SolicitudesController@getSolicitudes');


	Route::get('editar-solicitud/{id}', 'SolicitudesController@getEditSolicitud');


	Route::get('getSolicitudEstatus', 'SolicitudesController@getSolicitudesEstatus');


	Route::put('updateSolicitudEstatus', 'SolicitudesController@putSolicitudEstatus');


	Route::get('pagos', function(){
		return View::make('pagos');
	});

	Route::get('getPagos', function(){
		$pagos = array();
		
		$ordenes = Orden::all()->toArray();
		foreach($ordenes as $orden){
			$usuario = Usuario::find($orden['usuario_id'])->toArray();
			$solicitud = Solicitud::find($usuario['solicitud_id'])->toArray();
		}
		return Response::json($ordenes);
	});

});


Route::get('login', function(){
	return View::make('login');
});

Route::post('login', function(){
	if ( Auth::attempt(array('username' => Input::get('user'), 'password' => Input::get('password'))) ){
	    return Redirect::to('/');
	}else{
		return Redirect::to('login');
	}
});


