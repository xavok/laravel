<?php

/**
 * Created by PhpStorm.
 * User: Xavok
 * Date: 1/5/2017
 * Time: 7:39 PM
 */
use App\Models\Industries;
use App\Models\Occupations;
use App\Models\PreferenceChoices;
use App\Models\Preferences;
use Illuminate\Database\Seeder;

class PreferenceChoicesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('preference_choices')->delete();
        //WorkPlace
        PreferenceChoices::create(array(
            'preference_id'    => 1,
            'rank' => 1,
            'description'    => 'Private office'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 1,
            'rank' => 2,
            'description'    => 'Walled office'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 1,
            'rank' => 3,
            'description'    => 'Private cubicles'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 1,
            'rank' => 4,
            'description'    => 'Closed cubicles'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 1,
            'rank' => 5,
            'description'    => 'Open cubicles'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 1,
            'rank' => 6,
            'description'    => 'Shared cubicles'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 1,
            'rank' => 7,
            'description'    => 'Shared desks'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 1,
            'rank' => 8,
            'description'    => 'Open tables'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 1,
            'rank' => 9,
            'description'    => 'Shared and open tables'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 1,
            'rank' => 10,
            'description'    => 'Open all space open, all sharing'
        ));

        /***********
         * Work Environment
        ***********/
        PreferenceChoices::create(array(
            'preference_id'    => 2,
            'rank' => 1,
            'description'    => 'Divided and permanent walled private space'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 2,
            'rank' => 2,
            'description'    => 'Walled spaces'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 2,
            'rank' => 3,
            'description'    => 'Divided spaces'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 2,
            'rank' => 4,
            'description'    => 'Some partitions'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 2,
            'rank' => 5,
            'description'    => 'Mix of open and closed'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 2,
            'rank' => 6,
            'description'    => 'Mostly open spaces with few private'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 2,
            'rank' => 7,
            'description'    => 'Large open spaces of various sizes'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 2,
            'rank' => 8,
            'description'    => 'Mix of large and smaller open spaces'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 2,
            'rank' => 9,
            'description'    => 'Mostly large open space'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 2,
            'rank' => 10,
            'description'    => 'A single very large and high open space, industrial like, no private spaces at all'
        ));


        /*************
         * Atmosphere*
         ************/
        PreferenceChoices::create(array(
            'preference_id'    => 3,
            'rank' => 1,
            'description'    => 'Court room like quiet ok'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 3,
            'rank' => 2,
            'description'    => 'Very quiet conversations, library like quiet ok'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 3,
            'rank' => 3,
            'description'    => 'Conversational noise level ok'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 3,
            'rank' => 4,
            'description'    => 'Less than normal ok'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 3,
            'rank' => 5,
            'description'    => 'Normal office level ok'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 3,
            'rank' => 6,
            'description'    => 'Above noise level ok'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 3,
            'rank' => 7,
            'description'    => 'Lots of conversations, some loud ok'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 3,
            'rank' => 8,
            'description'    => 'Very busy and talkative level ok'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 3,
            'rank' => 9,
            'description'    => 'Lots of activity and often loud level ok'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 3,
            'rank' => 10,
            'description'    => 'Wall street stock trader noise level ok'
        ));


        /*************
         * Interaction*
         ************/
        PreferenceChoices::create(array(
            'preference_id'    => 4,
            'rank' => 1,
            'description'    => 'No friendly interaction, strictly professional, and formal'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 4,
            'rank' => 2,
            'description'    => 'Little friendly interactions, mostly formal'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 4,
            'rank' => 3,
            'description'    => 'Some friendly interaction, but formal'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 4,
            'rank' => 4,
            'description'    => 'Less friendly, more professional'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 4,
            'rank' => 5,
            'description'    => 'Friendly but professional 50/50'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 4,
            'rank' => 6,
            'description'    => 'More friendly than professional'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 4,
            'rank' => 7,
            'description'    => 'Very friendly'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 4,
            'rank' => 8,
            'description'    => 'Mostly casual and friendly'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 4,
            'rank' => 9,
            'description'    => 'Little formality, very casual'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 4,
            'rank' => 10,
            'description'    => 'Very friendly casual environment, little to no formality'
        ));


        /*************
         * Microculture*
         ************/
        PreferenceChoices::create(array(
            'preference_id'    => 5,
            'rank' => 1,
            'description'    => 'I prefer to keep my work relationships strictly professional with no contact with my co-workers outside of work'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 5,
            'rank' => 2,
            'description'    => 'When I done with work I prefer not to see my co-workers'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 5,
            'rank' => 3,
            'description'    => 'I will only attend company events if forced to'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 5,
            'rank' => 4,
            'description'    => 'I prefer more professionalism, I will usually decline a after work social event but will attend company sponsored events'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 5,
            'rank' => 5,
            'description'    => 'I prefer a mix of friendliness and professionalism'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 5,
            'rank' => 6,
            'description'    => 'I somewhat know all of my co-workers and I’m somewhat friendly with all of them in the workplace'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 5,
            'rank' => 7,
            'description'    => 'I\'m sometimes run into my co-workers after work and I’m friendly with them'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 5,
            'rank' => 8,
            'description'    => 'I\'m friends with my co-workers and manager and we sometimes socialize after work'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 5,
            'rank' => 9,
            'description'    => 'I prefer to be friends with my manager and co-workers and we often plan to socialize after work'
        ));
        PreferenceChoices::create(array(
            'preference_id'    => 5,
            'rank' => 10,
            'description'    => 'I prefer to be very goods friends with my manager and co-workers, in and out of work'
        ));
    }

}