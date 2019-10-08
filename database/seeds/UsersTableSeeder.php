<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->delete();

        $users = [
            ['name'=> 'Admin' , 'email' => 'admin@example.com', 'password' => bcrypt('12345678'), 'gr_id' => 1],
            ['name'=> 'Employees' , 'email' => 'employees@example.com', 'password' => bcrypt('12345678'), 'gr_id' => 2],
            ['name'=> 'Member' , 'email' => 'member@example.com', 'password' => bcrypt('12345678'), 'gr_id' => 3],

        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
