<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class HallSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            $faker = Faker\Factory::create();

            $limit = 22;//50
            $limit1 = 10;//100
            $limit2 = 8;//150
            $limit3 = 1;//750
            $limit4 = 3;//250
            $limit5 = 5;//200
            
            $limit = 50;
            $size = 0;
            
            for ($i = 0; $i < $limit; $i++) {
                   if($i >= 0 && $i < 22){
                        $size = 50;
                    }
                    if($i >= 22 && $i < 32)
                        $size = 100;
                    if($i >= 32 && $i < 40)
                        $size = 150;
                    if($i >= 40 && $i < 42)
                        $size = 750;
                    if($i >= 42 && $i < 45)
                        $size = 250;
                    if($i >= 45 && $i < $limit)
                        $size = 200;
                   
                DB::table('halls')->insert([ //,
                    'hall_name' => $faker->unique()->secondaryAddress,
                    'hall_capacity' => $size,    
                ]);
		// $this->call('UserTableSeeder');
            }
            
	}

}
