<?php

class AdicionalesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('adicionales')->delete();

		$a1 = new Adicional();
		$a1->nombre = 'Contadora';
		$a1->precio_mensual = 500;
		$a1->save();

		$a2 = new Adicional();
		$a2->nombre = 'Archivero';
		$a2->precio_mensual = 300;		
		$a2->save();

		$a3 = new Adicional();
		$a3->nombre = 'Locker';
		$a3->precio_mensual = 200;
		$a3->save();

		$a4 = new Adicional();
		$a4->nombre = '1 hora de asesoría al mes';
		$a4->precio_mensual = 500;
		$a4->save();

		$a5 = new Adicional();
		$a5->nombre = '4 horas de asesoría al mes';
		$a5->precio_mensual = 1200;
		$a5->save();
	}

}
