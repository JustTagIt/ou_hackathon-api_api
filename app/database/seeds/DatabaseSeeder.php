<?php

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();

		$this->call('BeaconTableSeeder');
		$this->command->info('Beacon table seeded!');

		$this->call('ContentTableSeeder');
		$this->command->info('Content table seeded!');
	}
}