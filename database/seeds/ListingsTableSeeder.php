<?php

use Illuminate\Database\Seeder;

class ListingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


		DB::table('listings')->insert([
        	'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        	'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
			'category_id' => '1',
			'title' => 'DirecTV',
        	'description' => '$100 refer a friend',
			'email' => 'joe@yahoo.com'
    	]);

		DB::table('listings')->insert([
        	'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        	'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
			'category_id' => '2',
			'title' => 'Gap',
        	'description' => '$75 refer a friend',
			'email' => 'moe@yahoo.com'
    	]);
		
		DB::table('listings')->insert([
        	'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        	'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
			'category_id' => '3',
			'title' => 'T-Mobile',
        	'description' => '$50 refer a friend',
			'email' => 'dave@yahoo.com'
    	]);

		DB::table('listings')->insert([
        	'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        	'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
			'category_id' => '4',
			'title' => 'Gardender',
        	'description' => '$100 refer a friend',
			'email' => 'mark@yahoo.com'
    	]);

		DB::table('listings')->insert([
        	'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        	'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
			'category_id' => '5',
			'title' => 'Google',
        	'description' => '$1000 refer an employee',
			'email' => 'ben@yahoo.com'
    	]);

		DB::table('listings')->insert([
        	'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        	'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
			'category_id' => '6',
			'title' => 'Hot Dog Shack',
        	'description' => 'Buy 1 get 1 deal!',
			'email' => 'dave@yahoo.com'
    	]);
    }
}
