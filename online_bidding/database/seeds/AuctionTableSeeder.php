<?php

use Illuminate\Database\Seeder;

class AuctionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('auction')->insert([
            'user_id' => '1',
			'itemname' => 'Gatorade',
			'minbid' => '0.50',
			'currentbid' => '0.50',
			'currentbidder' => NULL,
			'buyout' => '5.00',
			'description' => '1 250ml bottle.Quench your thirst! Seller is user1',
			'itemlocation' => 'Burnaby',
			'itemimage' => 'gatorade.png',
			'date' => '10/08/2017 00:00:00',
			'created_at' => '2017-08-07 12:12:12',
			'updated_at' => '2017-08-07 12:12:12',
        ]);
		
		DB::table('auction')->insert([
            'user_id' => '1',
			'itemname' => 'Big Mac Sauce',
			'minbid' => '1.00',
			'currentbid' => '2.59',
			'currentbidder' => 'user2',
			'buyout' => '10.00',
			'description' => 'Sauce for your burger. Seller is user1',
			'itemlocation' => 'Vancouver',
			'itemimage' => 'bigmacsauce.png',
			'date' => '08/08/2017 00:00:00',
			'created_at' => '2017-08-07 12:12:12',
			'updated_at' => '2017-08-07 12:12:12',
        ]);
		
		DB::table('auction')->insert([
            'user_id' => '2',
			'itemname' => 'Monstercat Plushie',
			'minbid' => '1.00',
			'currentbid' => '5.00',
			'currentbidder' => 'user3',
			'buyout' => '12.00',
			'description' => 'Monstercat plushie! Seller is user1',
			'itemlocation' => '380 railway st, vancouver',
			'itemimage' => 'plushie.png',
			'date' => '08/16/2017 00:00:00',
			'created_at' => '2017-08-07 12:12:12',
			'updated_at' => '2017-08-07 12:12:12',
        ]);
	}
}
