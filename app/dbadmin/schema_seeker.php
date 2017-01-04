<?php
$schema_seeker = array (
  'seeker_profiles' => 
  array (
    0 => 
    array (
      'length' => '11',
      'name' => 'seeker_profile_id',
      'foreign' => 'profiles',
      'type' => 'int',
      'short' => 1, 
    ),
    1 => 
    array (
      'type' => 'int',
      'foreign' => 'users',
      'name' => 'user_id',
      'length' => '11',
      'short' => 1,
    ),
    2 => 
    array (
      'length' => '10',
      'name' => 'zipcode',
      'type' => 'varchar',
    ),
    3 => 
    array (
      'name' => 'country',
      'length' => '2',
      'type' => 'char',
    ),
   	array (
		'name' => 'personality1',
		'length' => 2,
	),
	array (
		'name' => 'personality2',
		'length' => 2,
	),
	array (
		'name' => 'personality3',
		'length' => 2,
	),
	array (
		'name' => 'personality4',
		'length' => 2,
	),
	array (
		'name' => 'EQ',
		'length' => 2,
	),
	array (
		'name' => 'cognitive',
		'length' => 2,
	),
	array (
		'name' => 'updated_on',
		'hide' => 1,
	),
	array (
		'name' => 'matched_on',
		'hide' => 1,
	),
  ),

  'seeker_qualifications' => 
  array (
    0 => 
    array (
      'type' => 'int',
      'name' => 'seeker_qualification_id',
      'foreign' => 'seeker_qualifications',
      'length' => '12',
    ),
    1 => 
    array (
      'type' => 'int',
      'foreign' => 'profiles',
      'name' => 'seeker_profile_id',
      'length' => '11',
    ),
    2 => 
    array (
      'foreign' => 'qualifications',
      'name' => 'qualification_id',
      'length' => '6',
      'type' => 'int',
      'select' => 1,
    ),
    3 => 
    array (
      'length' => '2',
      'name' => 'qualification_rank',
      'type' => 'int',
    ),
  ),

  'seeker_preferences' => 
  array (
    0 => 
    array (
      'length' => '12',
      'name' => 'seeker_preference_id',
      'foreign' => 'seeker_preferences',
      'type' => 'int',
      'short' => 1,
    ),
    1 => 
    array (
      'type' => 'int',
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'seeker_profile_id',
      'short' => 1, 
    ),
    array (
      'foreign' => 'fields',
      'name' => 'field_id',
      'length' => '5',
      'type' => 'int',
      'select' => 1,
    ),
    array (
    	'name' => 'industry_1_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'industry_2_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'industry_3_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'occupation_1_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'occupation_2_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'occupation_3_id',
    	'length' => 3,
    	'select' => 1,
    ),
    array (
    	'name' => 'occupation_subtype_1_id',
    	'length' => 10,
    	'select' => 1,
    ),
    array (
    	'name' => 'occupation_subtype_2_id',
    	'length' => 10,
    	'select' => 1,
    ),
    array (
    	'name' => 'occupation_subtype_3_id',
    	'length' => 10,
    	'select' => 1,
    ),

    array (
    	'name' => 'salary_1_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'salary_2_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'salary_3_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'workplace_1_id',
    	'length' => 2,
    	//'select' => 1,
    	'range' => array(1,10),
    ),
    array (
    	'name' => 'workplace_2_id',
    	'length' => 2,
    	//'select' => 1,
    	'range' => array(1,10),
    ),
    array (
    	'name' => 'workplace_3_id',
    	'length' => 2,
    	//'select' => 1,
    	'range' => array(1,10),
    ),
    array (
    	'name' => 'atmosphere_1_id',
    	'length' => 2,
    	//'select' => 1,
		'range' => array(1,10),
    ),
    array (
    	'name' => 'atmosphere_2_id',
    	'length' => 2,
    	//'select' => 1,
		'range' => array(1,10),
    ),
    array (
    	'name' => 'atmosphere_3_id',
    	'length' => 2,
    	//'select' => 1,
		'range' => array(1,10),
    ),
    array (
    	'name' => 'work_environment_1_id',
    	'length' => 2,
    	//'select' => 1,
		'range' => array(1,10),
    ),
    array (
    	'name' => 'work_environment_2_id',
    	'length' => 2,
    	//'select' => 1,
		'range' => array(1,10),
    ),
    array (
    	'name' => 'work_environment_3_id',
    	'length' => 2,
    	//'select' => 1,
		'range' => array(1,10),
    ),
    array (
    	'name' => 'interaction_1_id',
    	'length' => 2,
    	//'select' => 1,
		'range' => array(1,10),
    ),
    array (
    	'name' => 'interaction_2_id',
    	'length' => 2,
    	//'select' => 1,
		'range' => array(1,10),
    ),
    array (
    	'name' => 'interaction_3_id',
    	'length' => 2,
    	//'select' => 1,
		'range' => array(1,10),
    ),
    array (
    	'name' => 'microculture_1_id',
    	'length' => 2,
		'range' => array(1,10),
    ),
    array (
    	'name' => 'microculture_2_id',
    	'length' => 2,
		'range' => array(1,10),
    ),
    array (
    	'name' => 'microculture_3_id',
    	'length' => 2,
		'range' => array(1,10),
    ),
    array (
    	'name' => 'city_1_id',
    	'length' => 10,
    	'select' => 1,
    ),
    array (
    	'name' => 'city_2_id',
    	'length' => 10,
    	'select' => 1,
    ),
    array (
    	'name' => 'city_3_id',
    	'length' => 10,
    	'select' => 1,
    ),
    array (
    	'name' => 'org_size_1_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'org_size_2_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'org_size_3_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'org_size_4_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'org_size_5_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'org_size_6_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'charity_1_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'charityy_2_id',
    	'length' => 2,
    	'select' => 1,
    ),
    array (
    	'name' => 'charity_3_id',
    	'length' => 2,
    	'select' => 1,
    ),

  ),
  'seeker_profile_educations' =>
  array (
  	array (
      'name' => 'seeker_profile_education_id',
      'length' => 12,
    ),
    array (
      'name' => 'seeker_profile_id',
      'length' => 12,
    ),
  	array (
      'name' => 'school',
      'length' => 30,
    ),
    array (
      'name' => 'education_level_id',
      'length' => 2,
      'select' => 1,
    ),
    array (
      'name' => 'study_field_id',
      'length' => 3,
      'select' => 1,
    ),
  	array (
      'name' => 'graduation',
      'length' => 12,
    ),    
  ),
  'seeker_industry_experiences' =>
  array (
  	array (
      'name' => 'seeker_industry_experience_id',
      'length' => 12,
    ),
    array (
      'name' => 'seeker_profile_id',
      'length' => 12,
    ),
    array (
      'name' => 'industry_id',
      'length' => 5,
      'select' => 1,
    ),
    array (
      'name' => 'years',
      'length' => 5,
    ),
  ),
  'seeker_occupation_experiences' =>
  array (
  	array (
      'name' => 'seeker_occupation_experience_id',
      'length' => 12,
    ),
    array (
      'name' => 'seeker_profile_id',
      'length' => 12,
    ),
    array (
      'name' => 'occupation_subtype_id',
      'length' => 5,
      'select' => 1,
    ),
    array (
      'name' => 'years',
      'length' => 5,
    ),
  ),
);

