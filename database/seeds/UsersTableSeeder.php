<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /* database seeding using users factory */
    	// factory(App\User::class,50)->create();

    	DB::table('users')->insert([
    		'name' => str_random(10),
    		'email' => str_random(10) . '@gmail.com',
    		'password' => bcrypt('secret'),
    		'role_id' => 1
    	]);
    }
}
