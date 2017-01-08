<?php

/**
 * Created by PhpStorm.
 * User: Xavok
 * Date: 1/5/2017
 * Time: 7:39 PM
 */
use Illuminate\Database\Seeder;
use App\Models\Users;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        Users::create(array(
            'email'    => 'xavoking@gmail.com',
            'password' => Hash::make('tyughj'),
        ));
    }

}