<?php

/**
 * Created by PhpStorm.
 * User: Xavok
 * Date: 1/5/2017
 * Time: 7:39 PM
 */
use App\Models\EducationLevel;
use App\Models\Qualifications;
use Illuminate\Database\Seeder;
use App\Models\Users;

class QualificationsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('qualifications')->delete();
        Qualifications::create(array(
            'name'    => 'Software'
        ));
        Qualifications::create(array(
            'name'    => 'Security'
        ));
        Qualifications::create(array(
            'name'    => 'Network'
        ));
        Qualifications::create(array(
            'name'    => 'Database'
        ));
        Qualifications::create(array(
            'name'    => 'System Administration'
        ));
        Qualifications::create(array(
            'name'    => 'Web Development'
        ));
    }

}