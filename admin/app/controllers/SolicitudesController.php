<?php

class SolicitudesController extends BaseController {
	
	// Obtener todas las solicitudes registradas
	public function getSolicitudes(){
		$solicitudes = Solicitud::all()->toArray();
		$s = array();
		foreach($solicitudes as $solicitud){
			$paquete = Paquete::find($solicitud['paquete_id'])->toArray();
			$solicitud_status = SolicitudStatus::find($solicitud['status'])->toArray();

			$solicitud['paquete'] = $paquete['nombre'];
			$solicitud['status'] = $solicitud_status['descripcion'];
			$s[] = $solicitud;
		}
		return Response::json($s);
	}

	public function getEditSolicitud($id){
		$solicitud = Solicitud::find($id)->toArray();

		$paquete = Paquete::find($solicitud['paquete_id'])->toArray();

		// Obtener los servicios adicionales
		$ad = SolicitudAdicionales::where('solicitud_id', '=', $solicitud['id'])->get()->toArray();

		$adicionales = array();
		foreach($ad as $adicional){
			$a = Adicional::find($adicional['feature_id'])->toArray();	
			$adicional['nombre'] = $a['nombre'];
			$adicionales[] = $adicional;
		}

		$solicitud['paquete'] = $paquete['nombre'];

		return View::make('editar_solicitud')->with(array('solicitud'=>$solicitud, 'adicionales'=>$adicionales));
	}

	public function getSolicitudesEstatus(){
		$solicitud_estatus = SolicitudStatus::all();
		return Response::json($solicitud_estatus);
	}

	public function putSolicitudEstatus(){
		try{
			$solicitud = Solicitud::find(Input::get('solicitud_id'));
			$solicitud->status = Input::get('status');
			$solicitud->save();

			if(Input::get('status') == 2){
				$usuario = Usuario::where('solicitud_id', '=', $solicitud->id)->first();
				$rnd_string = new RandomString();
				$password = $rnd_string->generateRandomString(5);
				$usuario->password = Hash::make($password);
				Mail::send('emails.sendClientPass', array('solicitud'=>$solicitud, 'usuario'=>$usuario, 'password'=>$password), 
					function($message) use($solicitud){
					 $message->to($solicitud->correo, $solicitud->nombre)->subject('¡Bienvenido a Nuwork!');
				});
				$usuario->status = 1;
				$usuario->save();
			}
			return Response::make('Solicitud actualizada');
		}catch(Exeption $e){
			return Response::json($e);
		}	
	}
}
