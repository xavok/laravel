<?php

/**
 * Created by PhpStorm.
 * User: Xavok
 * Date: 1/5/2017
 * Time: 7:39 PM
 */
use App\Models\Industries;
use App\Models\Occupations;
use Illuminate\Database\Seeder;

class OccupationsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('occupations')->delete();
        Occupations::create(array(
            'occupation_name'    => 'Front end'
        ));
        Occupations::create(array(
            'occupation_name'    => 'Middleware'
        ));
        Occupations::create(array(
            'occupation_name'    => 'Back end'
        ));
    }

}