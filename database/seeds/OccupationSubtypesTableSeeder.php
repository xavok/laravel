<?php

/**
 * Created by PhpStorm.
 * User: Xavok
 * Date: 1/5/2017
 * Time: 7:39 PM
 */
use App\Models\Industries;
use App\Models\OccupationSubtypes;
use Illuminate\Database\Seeder;

class OccupationSubtypesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('occupation_subtypes')->delete();
        OccupationSubtypes::create(array(
            'occupation_id' => 3,
            'occupation_subtype_name'    => 'PHP'
        ));
        OccupationSubtypes::create(array(
            'occupation_id' => 1,
            'occupation_subtype_name'    => 'Java'
        ));
        OccupationSubtypes::create(array(
            'occupation_id' => 2,
            'occupation_subtype_name'    => 'Ruby on rails'
        ));
    }

}