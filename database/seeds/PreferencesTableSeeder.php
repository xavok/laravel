<?php

/**
 * Created by PhpStorm.
 * User: Xavok
 * Date: 1/5/2017
 * Time: 7:39 PM
 */
use App\Models\Industries;
use App\Models\Occupations;
use App\Models\Preferences;
use Illuminate\Database\Seeder;

class PreferencesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('preferences')->delete();
        Preferences::create(array(
            'description'    => 'Preference for your workspace'
        ));
        Preferences::create(array(
            'description'    => 'Preference for your work environment'
        ));
        Preferences::create(array(
            'description'    => 'Preference for your workspace atmosphere/noise level'
        ));
        Preferences::create(array(
            'description'    => 'Preference for how you interact with your co-workers'
        ));
        Preferences::create(array(
            'description'    => 'Preference for how well you know and socialize with your co-workers'
        ));
    }

}