<?php

class BeaconTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('beacons')->delete();

		// BeaconSeed
		Beacon::create(array(
				'beacon_id' => 'B9407F30-F5F8-466E-AFF9-25556B57FE6D'
			));
	}
}