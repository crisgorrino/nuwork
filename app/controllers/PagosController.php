<?php

class PagosController extends BaseController {

	public function showMetodos(){
		$total = 0;

		$productos = array();

		$usuario = Auth::user();

		$solicitud = Solicitud::find($usuario->solicitud_id)->toArray();

		// obtener el precio del paquete seleccionado
		$paquete_precio = Precio::where('paquete_id', '=', $solicitud['paquete_id'])
		->where('meses', '=', $solicitud['meses'])
		->where('espacios', '=', $solicitud['espacios'])
		->first()->toArray();
		$total += $paquete_precio['precio'];

		// obtener el nombre del paquete
		$paquete = Paquete::find($solicitud['paquete_id'])->toArray();
	
		// obtener el precio de los servicios extra
		$solicitud_extras = SolicitudFeature::where('solicitud_id', '=', $usuario->solicitud_id)->get()->toArray();
		foreach($solicitud_extras as $se){
			$adicional = Adicional::find($se['feature_id'])->toArray();
			$precio_de_adicional = $adicional['precio_mensual'] * $se['meses'] * $se['espacios'];
			$total += $precio_de_adicional;
		}

		return View::make('pagos')->with(array('total'=>$total,));
	}

	public function procesarPago(){
		$total = 0;

		$productos = array();

		$usuario = Auth::user();

		$solicitud = Solicitud::find($usuario->solicitud_id)->toArray();

		// obtener el precio del paquete seleccionado
		$paquete_precio = Precio::where('paquete_id', '=', $solicitud['paquete_id'])
		->where('meses', '=', $solicitud['meses'])
		->where('espacios', '=', $solicitud['espacios'])
		->first()->toArray();
		
		$total += $paquete_precio['precio'];

		// obtener el nombre del paquete
		$paquete = Paquete::find($solicitud['paquete_id'])->toArray();
		
		$productos['item_name'][0]	= $paquete['nombre'];
		$productos['item_code'][0] 	= $paquete['id'];
		$productos['item_price'][0] = $paquete_precio['precio'];
		$productos['item_qty'][0] 	= 1;

		// obtener el precio de los servicios extra
		$solicitud_extras = SolicitudFeature::where('solicitud_id', '=', $usuario->solicitud_id)->get()->toArray();
		$i = 1;
		foreach($solicitud_extras as $se){
			$adicional = Adicional::find($se['feature_id'])->toArray();
			$precio_de_adicional = $adicional['precio_mensual'] * $se['meses'] * $se['espacios'];
			$total += $precio_de_adicional;

			$productos['item_name'][$i] 	= $adicional['nombre'];
			$productos['item_code'][$i] 	= $adicional['id'];
			$productos['item_price'][$i] =  $precio_de_adicional;
			$productos['item_qty'][$i] 	= 1;
			$i++;
		}
		if(Input::get('metodo') == 'credito' || Input::get('metodo') == 'debito'){
			$paypal = new PayPalLib\ExpressCheckout();
			$paypal->doCheckout($productos, 0, $total * .16);
		}else{

			Mail::send( 'emails.ficha-pago', array('total' => $total), function($message) use($solicitud){
				$message->to($solicitud['correo'], 'Nuwork - Ficha de Pago')->subject('Nuwork - Ficha de Pago');
			});

			$usuario->status = 2;
			$usuario->save();

			return Redirect::to('ficha-pago');
		}
		return Response::make(Input::all());
	}

	public function preConfirmacion(){
		$paypal = new PayPalLib\PayPal();
		$detalles = $paypal->GetShippingDetails($_GET['token']);

		$total = 0;

		$productos = array();

		$usuario = Auth::user();

		$solicitud = Solicitud::find($usuario->solicitud_id)->toArray();

		// obtener el precio del paquete seleccionado
		$paquete_precio = Precio::where('paquete_id', '=', $solicitud['paquete_id'])
		->where('meses', '=', $solicitud['meses'])
		->where('espacios', '=', $solicitud['espacios'])
		->first()->toArray();
		$total += $paquete_precio['precio'];

		// obtener el nombre del paquete
		$paquete = Paquete::find($solicitud['paquete_id'])->toArray();
	
		// obtener el precio de los servicios extra
		$solicitud_extras = SolicitudFeature::where('solicitud_id', '=', $usuario->solicitud_id)->get()->toArray();
		$adicionales = array();
		foreach($solicitud_extras as $se){
			$adicional = Adicional::find($se['feature_id'])->toArray();
			$precio_de_adicional = $adicional['precio_mensual'] * $se['meses'] * $se['espacios'];
			
			$se['precio'] = $precio_de_adicional;
			$se['nombre'] = $adicional['nombre'];
			$adicionales[] = $se;

			$total += $precio_de_adicional;
		}

		return View::make('paypal')->with(array(
			'paquete'=>$paquete,
			'solicitud'=>$solicitud,
			'paquete_precio'=>$paquete_precio['precio'],
			'adicionales'=>$adicionales,
			'detalles'=>$detalles,
			'total'=>$total,
			'iva'=>$total * .16
		));
	}

	public function confirmacion(){
		$paypal = new PayPalLib\PayPal();

		$confirmar = $paypal->ConfirmPayment(Input::get('total'), Input::get('payerid'), 'MXN', Input::get('token'));

		if($confirmar['PAYMENTINFO_0_PAYMENTSTATUS'] == 'Completed' && $confirmar['ACK'] == 'Success'){
			// guardar los datos del pago en la  base de datos
			$paypal = new PayPalLib\PayPal();
			$detalles = $paypal->GetShippingDetails(Input::get('token'));
			
			$usuario = Auth::user();
			$orden = new Orden();
			$orden->usuario_id = $usuario->id;
			$orden->TOKEN = $detalles['TOKEN'];
			$orden->CHECKOUTSTATUS = $detalles['CHECKOUTSTATUS'];
			$orden->TIMESTAMP = $detalles['TIMESTAMP'];
			$orden->CORRELATIONID = $detalles['CORRELATIONID'];
			$orden->ACK = $detalles['ACK'];
			$orden->EMAIL = $detalles['EMAIL'];
			$orden->PAYERID = $detalles['PAYERID'];
			$orden->PAYERSTATUS = $detalles['PAYERSTATUS'];
			$orden->FIRSTNAME = $detalles['FIRSTNAME'];
			$orden->LASTNAME = $detalles['LASTNAME'];
			$orden->COUNTRYCODE = $detalles['COUNTRYCODE'];
			$orden->SHIPTONAME = $detalles['SHIPTONAME'];
			$orden->SHIPTOSTREET = $detalles['SHIPTOSTREET'];
			$orden->SHIPTOCITY = $detalles['SHIPTOCITY'];
			$orden->SHIPTOSTATE = $detalles['SHIPTOSTATE'];
			$orden->SHIPTOZIP = $detalles['SHIPTOZIP'];
			$orden->SHIPTOCOUNTRYCODE = $detalles['SHIPTOCOUNTRYCODE'];
			$orden->SHIPTOCOUNTRYNAME = $detalles['SHIPTOCOUNTRYNAME'];
			$orden->ADDRESSSTATUS = $detalles['ADDRESSSTATUS'];
			$orden->CURRENCYCODE = $detalles['CURRENCYCODE'];
			$orden->AMT = $detalles['AMT'];
			$orden->PAYMENTREQUEST_0_TRANSACTIONID = $detalles['PAYMENTREQUEST_0_TRANSACTIONID'];
			$orden->tipo_pago = 'Paypal';
			$orden->status = 1;

			$orden->save();

			// cambiar el status del usuario
			$usuario->status = 2;
			$usuario->save();


			// quitar stock
			$solicitud = Solicitud::where('id', '=', $usuario->solicitud_id)->first()->toArray();
			$stock = Stock::where('paquete_id', '=', $solicitud['paquete_id'])->first();
			$stock->stock -= $solicitud['espacios'];
			$stock->save();
			
			Auth::logout();
			return Redirect::to('pago-realizado');
		}else{
			Auth::logout();
			return Redirect::to('pago-fallo');
		}
	}
}
