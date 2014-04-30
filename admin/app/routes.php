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
			$orden['solicitud'] = $solicitud;

			$pagos[] = $orden;
		}
		return Response::json($pagos);
	});

	// Restar stock del paquete seleccionado
	Route::put('getPaqueteStock', function(){
		if( Orden::find(Input::get('orden_id'))->exists() ){
			$orden = Orden::where('id', '=', Input::get('orden_id'))->first()->toArray();
			$usuario = Usuario::where('id', '=', $orden['usuario_id'])->first()->toArray();
			$solicitud = Solicitud::where('id', '=', $usuario['solicitud_id'])->first()->toArray();
			$stock = Stock::where('paquete_id', '=', $solicitud['paquete_id'])->first()->toArray();

			$needed_stock = $solicitud['espacios'];
			$actual_stock = $stock['stock'];

			// verificar haya espacios disponibles
			if($needed_stock <= $actual_stock){
				$sufficient = true;

				// actualizar el stock
				$new_stock = Stock::where('paquete_id', '=', $solicitud['paquete_id']);
				$new_stock->update(array( 'stock'=>($actual_stock - $needed_stock) ));

				// actualizar el status de la orden
				$orden = Orden::where('id', '=', Input::get('orden_id'))
					->update(array('status'=>Input::get('status')));
			}else{
				$sufficient = false;
			}
		}else{
			Response::json(array('error'=>'Orden no encotrada'));
		}
		return Response::json(array(
			'sufficient'=>$sufficient,
			'needed_stock'=>$needed_stock,
			'actual_stock'=>$actual_stock - $needed_stock
		));
	});
	
	// Restaurar stock
	Route::post('restoreStock', function(){
		$orden = Orden::where('id', '=', Input::get('orden_id'))->first()->toArray();
		$usuario = Usuario::where('id', '=', $orden['usuario_id'])->first()->toArray();
		$solicitud = Solicitud::where('id', '=', $usuario['solicitud_id'])->first()->toArray();
		$stock = Stock::where('paquete_id', '=', $solicitud['paquete_id'])->first()->toArray();

		$restored_stock = $solicitud['espacios'];
		$actual_stock = $stock['stock'];

		$new_stock = Stock::where('paquete_id', '=', $solicitud['paquete_id']);
		$new_stock->update(array( 'stock'=>($restored_stock+$actual_stock) ));

		return Response::json(array( 'actual_stock'=> $actual_stock + $restored_stock ));
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

