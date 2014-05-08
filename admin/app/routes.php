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

	Route::post('pagos', function(){
		if(Input::has('status')){
			Session::put('status', Input::get('status'));
		}
		if(Input::has('tipo_pago')){
			Session::put('tipo_pago',Input::get('tipo_pago'));
		}
		
		Session::put('nombre', Input::get('nombre'));
		
		Session::put('apellidos', Input::get('apellidos'));

		Session::put('desde', Input::get('desde'));

		Session::put('hasta', Input::get('hasta'));
		
		return Redirect::to('pagos');
	});

	Route::get('getPagos', function(){
		$pagos = array();
		
		$ordenes = Orden::orderBy('id', 'DESC')->get()->toArray();
		foreach($ordenes as $orden){
			$usuario = Usuario::find($orden['usuario_id'])->toArray();
			$solicitud = Solicitud::find($usuario['solicitud_id'])->toArray();
			$orden['solicitud'] = $solicitud;

			$pagos[] = $orden;
		}

		// filtar resultados
		$result = array();
		
		// filtrar por status
		if(Session::get('status') != '0'){
			foreach($pagos as $pago){
				if($pago['status'] == Session::get('status')){
					$result[] = $pago;
				}	
			}
		}else{
			$result = $pagos;
		}

		// filtrar por tipo de pago
		if(Session::get('tipo_pago') != '0' ){
			$tmp = array();
			foreach($result as $pago){
				if($pago['tipo_pago'] == Session::get('tipo_pago')){
					$tmp[] = $pago;
				}
			}
			$result = $tmp;
		}

		// filtrar por nombre
		if( Session::get('nombre') != '' ) {
			$tmp = array();
			foreach($result as $pago){
				if(strtolower($pago['solicitud']['nombre'])  == strtolower(Session::get('nombre'))){
					$tmp[] = $pago;
				}
			}
			$result = $tmp;
		}

		// filtrar por appellidos
		if(Session::get('apellidos') != ''){
			$tmp = array();
			foreach($result as $pago){
				if( strtolower($pago['solicitud']['apellidos']) == strtolower(Session::get('apellidos')) ){
					$tmp[] = $pago;
				}
			}
			$result = $tmp;
		}

		//filtrar por fecha
		if(Session::get('desde') != '' && Session::get('hasta') != ''){
			$tmp = array();
			foreach ($result as $pago) {
				$created_date = strtotime($pago['created_at']);
				if( $created_date >= strtotime(Session::get('desde')) &&
					 $created_date <= strtotime(Session::get('hasta').' +1 day') ){
					$tmp[] = $pago;
				}
			}
			$result = $tmp;
		}else{
			if(Session::get('desde') != ''){
				$tmp = array();
				foreach ($result as $pago) {
					$created_date = strtotime($pago['created_at']);
					if( $created_date >= strtotime(Session::get('desde'))  ){
						$tmp[] = $pago;
					}
				}
				$result = $tmp;
			}

			if(Session::get('hasta') != ''){
				$tmp = array();
				foreach ($result as $pago) {
					$created_date = strtotime($pago['created_at']);
					if( $created_date <= strtotime(Session::get('hasta'))  ){
						$tmp[] = $pago;
					}
				}
				$result = $tmp;	
			}
		}
		
		
		return Response::json($result);
	});

	// Restar stock del paquete seleccionado
	Route::put('getPaqueteStock', function(){
		if( Orden::find(Input::get('orden_id'))->exists() ){

			$orden 		= Orden::where('id', '=', Input::get('orden_id'))->first()->toArray();
			$usuario 	= Usuario::where('id', '=', $orden['usuario_id'])->first()->toArray();
			$solicitud 	= Solicitud::where('id', '=', $usuario['solicitud_id'])->first()->toArray();
			$stock 		= Stock::where('paquete_id', '=', $solicitud['paquete_id'])->first()->toArray();

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

		$orden = Orden::where('id', '=', Input::get('orden_id'));
		$orden->update(array('status'=>Input::get('status')));

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

