<?php

/**
 * Created by PhpStorm.
 * User: Xavok
 * Date: 1/5/2017
 * Time: 7:39 PM
 */
use App\Models\Industries;
use Illuminate\Database\Seeder;

class IndustriesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('industries')->delete();
        Industries::create(array(
            'industry_name'    => 'Technology'
        ));
        Industries::create(array(
            'industry_name'    => 'Health Care'
        ));
        Industries::create(array(
            'industry_name'    => 'Insurance'
        ));
    }

}