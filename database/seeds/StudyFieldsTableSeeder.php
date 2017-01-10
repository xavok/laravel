<?php

/**
 * Created by PhpStorm.
 * User: Xavok
 * Date: 1/5/2017
 * Time: 7:39 PM
 */
use App\Models\EducationLevel;
use App\Models\StudyField;
use Illuminate\Database\Seeder;
use App\Models\Users;

class StudyFieldsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('study_fields')->delete();
        StudyField::create(array(
            'name'    => 'Computer Science'
        ));

    }

}