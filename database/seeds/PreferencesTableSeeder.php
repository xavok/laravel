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
            'slug' => 'workplace',
            'description'    => 'Preference for your workspace'
        ));
        Preferences::create(array(
            'slug' => 'workenvironment',
            'description'    => 'Preference for your work environment'
        ));
        Preferences::create(array(
            'slug' => 'atmosphere',
            'description'    => 'Preference for your workspace atmosphere/noise level'
        ));
        Preferences::create(array(
            'slug' => 'interaction',
            'description'    => 'Preference for how you interact with your co-workers'
        ));
        Preferences::create(array(
            'slug' => 'microculture',
            'description'    => 'Preference for how well you know and socialize with your co-workers'
        ));
    }

}