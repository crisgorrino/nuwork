<?php

class PaquetesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('paquetes')->delete();

		$paquete1 = new Paquete();
		$paquete1->nombre = 'Gold label';
		$paquete1->precio_mensual = 1700;
		$paquete1->save();


		$paquete2 = new Paquete();
		$paquete2->nombre = 'Diamond label';
		$paquete2->precio_mensual = 1900;
		$paquete2->save();
		
		$paquete3 = new Paquete();
		$paquete3->nombre = 'Privado';
		$paquete3->precio_mensual = 4000;
		$paquete3->save();
	}

}
