<?php

class AdminUsersSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('admin_users')->delete();

		$a1 = new AdminUser();
		$a1->username = 'admin';
		$a1->password = Hash::make('123456');
		$a1->email = 'portela828@gmail.com';
		$a1->save();
	}

}
