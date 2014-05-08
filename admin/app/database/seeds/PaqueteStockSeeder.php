<?php

class PaqueteStockSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('paquete_stock')->delete();

		$stock_p1 = new Stock();
		$stock_p1->paquete_id = 1;
		$stock_p1->stock = rand(10,20);
		$stock_p1->save();


		$stock_p2 = new Stock();
		$stock_p2->paquete_id = 2;
		$stock_p2->stock = rand(10,20);
		$stock_p2->save();
		
		$stock_p3 = new Stock();
		$stock_p3->paquete_id = 3;
		$stock_p3->stock = rand(10,20);
		$stock_p3->save();
	}

}
