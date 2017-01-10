<?php

/**
 * Created by PhpStorm.
 * User: Xavok
 * Date: 1/5/2017
 * Time: 7:39 PM
 */
use App\Models\EducationLevel;
use Illuminate\Database\Seeder;
use App\Models\Users;

class EducationLevelTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('education_levels')->delete();
        EducationLevel::create(array(
            'name'    => 'Cert'
        ));
        EducationLevel::create(array(
            'name'    => 'High School'
        ));
        EducationLevel::create(array(
            'name'    => 'Associates Degree'
        ));
        EducationLevel::create(array(
            'name'    => 'Bachelor\'s Degree'
        ));
        EducationLevel::create(array(
            'name'    => 'Masters Degree'
        ));
        EducationLevel::create(array(
            'name'    => 'PhD/MD/etc.'
        ));
    }

}