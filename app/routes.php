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
		Auth::logout();
		return View::make('ficha-pago');
	});

	Route::get('paypal', 'PagosController@preConfirmacion');

	Route::post('confirmar-pago','PagosController@confirmacion');

	Route::get('logout', function(){
		Auth::logout();
		return Redirect::to('login');
	});
});

Route::get('pago-realizado', function(){ return View::make('pago-realizado'); });

Route::get('pago-fallo', function(){ return Response::make('fallo'); });

Route::get('comprobante-pago', function(){ return View::make('comprobante-pago'); });

Route::post('comprobante-pago', function(){
	if( Solicitud::where('id', '=', Input::get('solicitud_id'))->where('correo', '=', Input::get('correo'))->exists() ){

		$solicitud =Solicitud::where('id', '=', Input::get('solicitud_id'))->where('correo', '=', Input::get('correo'))->first()->toArray();

		// calcular el total
		$paquete_precio = Precio::where('paquete_id','=',$solicitud['paquete_id'])->where('meses', '=',$solicitud['meses'])->where( 'espacios','=',$solicitud['espacios'])->first()->toArray();
		$total = $paquete_precio['precio'];

		$extras = SolicitudFeature::where('solicitud_id', '=', $solicitud['id'])->get()->toArray();
		foreach ($extras as $extra) {
			$adicional = Adicional::where('id','=',$extra['feature_id'])->first()->toArray();
			$precio_de_extra = $adicional['precio_mensual'] * $extra['meses'] * $extra['espacios'];
			$total += $precio_de_extra;
		}

		if (Input::hasFile('comprobante')) {

			$file            = Input::file('comprobante');
			$destinationPath = base_path().'/admin/public/img/comprobantes/';
			$filename        = str_random(6) . '.' . $file->getClientOriginalExtension();
			$uploadSuccess   = $file->move($destinationPath, $filename);

			$usuario = Usuario::where('solicitud_id', '=', Input::get('solicitud_id'))->first()->toArray();

			if(Orden::where('usuario_id', '=', $usuario['id'])->exists()){
				$orden = Orden::where('usuario_id', '=', $usuario['id'])->first()->toArray();
				
				if(file_exists($destinationPath.$orden['comprobante'])){
					unlink($destinationPath.$orden['comprobante']);	
				}
				
				$orden->comprobante = $filename;
			}else{
				$orden = new Orden();
				$orden->usuario_id = $usuario['id'];
				$orden->AMT = $total + ($total * .16);
				$orden->status = 1;
				$orden->tipo_pago = 'Deposito';
				$orden->comprobante = $filename;
				$orden->save();
			}
			
		}

		return Redirect::to('comprobante-enviado');
	}else{
		echo 'No existe';
	}
	
});

Route::get('comprobante-enviado', function(){
	return View::make('comprobante-enviado');
});

Route::get('save_selection', 'HomeController@saveSelection');

Route::get('sendmessage', 'MailController@sendMessage');

Route::post('sendmessage', 'MailController@sendMessage');

Route::get('reservar', function(){ return View::make('reservar'); });

Route::post('getPrecioMensual', 'ReservarController@getPrecios');

Route::post('getPaquetePrecioMensual', 'ReservarController@getPaquetePrecio');

Route::post('sendSolicitud', 'ReservarController@sendSolicitud');

Route::get('solicitud-realizada', function(){ return View::make('solicitud-realizada'); });

