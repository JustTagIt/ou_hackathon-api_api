<?php

class ContentTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('beacon_content')->delete();

		// BeaconContentSeed
		Content::create(array(
				'beacon_id' => 'B9407F30-F5F8-466E-AFF9-25556B57FE6D',
				'content' => 'This is a test message from an iBeacon'
			));
	}
}