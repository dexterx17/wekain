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
        DB::table('users')->insert([
            'id'=>666,
            'name'=>'tester',
            'email'=>'test@test.com',
            'password'=>bcrypt('12345')
        ]);
        factory(App\User::class,10)->create();
    }
}
