<?php

class PreciosSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('precios')->delete();

		
		// Paquete 1
		$precio1_pq1 = new Precio();
		$precio1_pq1->meses = 1;
		$precio1_pq1->espacios = 1;
		$precio1_pq1->paquete_id = 1;
		$precio1_pq1->precio = 1700;
		$precio1_pq1->save();

		$precio2_pq1 = new Precio();
		$precio2_pq1->meses = 3;
		$precio2_pq1->espacios = 1;
		$precio2_pq1->paquete_id = 1;
		$precio2_pq1->precio = 4650;
		$precio2_pq1->save();

		$precio3_pq1 = new Precio();
		$precio3_pq1->meses = 1;
		$precio3_pq1->espacios = 2;
		$precio3_pq1->paquete_id = 1;
		$precio3_pq1->precio = 3200;
		$precio3_pq1->save();

		$precio4_pq1 = new Precio();
		$precio4_pq1->meses = 3;
		$precio4_pq1->espacios = 2;
		$precio4_pq1->paquete_id = 1;
		$precio4_pq1->precio = 9000;
		$precio4_pq1->save();

		$precio5_pq1 = new Precio();
		$precio5_pq1->meses = 1;
		$precio5_pq1->espacios = 3;
		$precio5_pq1->paquete_id = 1;
		$precio5_pq1->precio = 4700;
		$precio5_pq1->save();

		$precio6_pq1 = new Precio();
		$precio6_pq1->meses = 3;
		$precio6_pq1->espacios = 3;
		$precio6_pq1->paquete_id = 1;
		$precio6_pq1->precio = 12600;	
		$precio6_pq1->save();


		// Paquete 2
		$precio1_pq2 = new Precio();
		$precio1_pq2->meses = 1;
		$precio1_pq2->espacios = 1;
		$precio1_pq2->paquete_id = 2;
		$precio1_pq2->precio = 1900;
		$precio1_pq2->save();

		$precio2_pq2 = new Precio();
		$precio2_pq2->meses = 3;
		$precio2_pq2->espacios = 1;
		$precio2_pq2->paquete_id = 2;
		$precio2_pq2->precio = 5250;
		$precio2_pq2->save();

		$precio3_pq2 = new Precio();
		$precio3_pq2->meses = 1;
		$precio3_pq2->espacios = 2;
		$precio3_pq2->paquete_id = 2;
		$precio3_pq2->precio = 3600;
		$precio3_pq2->save();

		$precio4_pq2 = new Precio();
		$precio4_pq2->meses = 3;
		$precio4_pq2->espacios = 2;
		$precio4_pq2->paquete_id = 2;
		$precio4_pq2->precio = 10200;
		$precio4_pq2->save();

		$precio5_pq2 = new Precio();
		$precio5_pq2->meses = 1;
		$precio5_pq2->espacios = 3;
		$precio5_pq2->paquete_id = 2;
		$precio5_pq2->precio = 5300;
		$precio5_pq2->save();

		$precio6_pq2 = new Precio();
		$precio6_pq2->meses = 3;
		$precio6_pq2->espacios = 3;
		$precio6_pq2->paquete_id = 2;
		$precio6_pq2->precio = 14400;
		$precio6_pq2->save();

		// Paquete 3
		$precio1_pq3 = new Precio();
		$precio1_pq3->meses = 1;
		$precio1_pq3->espacios = 1;
		$precio1_pq3->paquete_id = 3;
		$precio1_pq3->precio = 4000;
		$precio1_pq3->save();

		$precio2_pq3 = new Precio();
		$precio2_pq3->meses = 3;
		$precio2_pq3->espacios = 1;
		$precio2_pq3->paquete_id = 3;
		$precio2_pq3->precio = 11700;
		$precio2_pq3->save();

		$precio3_pq3 = new Precio();
		$precio3_pq3->meses = 1;
		$precio3_pq3->espacios = 2;
		$precio3_pq3->paquete_id = 3;
		$precio3_pq3->precio = 4000;
		$precio3_pq3->save();

		$precio4_pq3 = new Precio();
		$precio4_pq3->meses = 3;
		$precio4_pq3->espacios = 2;
		$precio4_pq3->paquete_id = 3;
		$precio4_pq3->precio = 11700;
		$precio4_pq3->save();

		$precio5_pq3 = new Precio();
		$precio5_pq3->meses = 1;
		$precio5_pq3->espacios = 3;
		$precio5_pq3->paquete_id = 3;
		$precio5_pq3->precio = 5900;
		$precio5_pq3->save();

		$precio6_pq3 = new Precio();
		$precio6_pq3->meses = 3;
		$precio6_pq3->espacios = 3;
		$precio6_pq3->paquete_id = 3;
		$precio6_pq3->precio = 17100;				
		$precio6_pq3->save();
	}

}
