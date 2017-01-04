<?php
$schema_jobs = array (
  'jobs' => 
  array (
    0 => 
    array (
      'length' => '6',
      'foreign' => 'jobs',
      'name' => 'job_id',
      'type' => 'int',
    ),
    1 => 
    array (
      'type' => 'int',
      'name' => 'compensation',
      'length' => '10',
    ),
    2 => 
    array (
      'type' => 'varchar',
      'length' => '30',
      'short' => 1,
      'name' => 'job_name',
    ),
    3 => 
    array (
      'type' => 'text',
      'name' => 'job_description',
      'length' => NULL,
      'short' => 1,
    ),
    4 => 
    array (
      'length' => '6',
      'name' => 'industry_id',
      'foreign' => 'industrys',
      'type' => 'int',
      'select' => 1,
    ),
    5 => 
    array (
      'name' => 'job_type',
      'length' => '30',
      'type' => 'varchar',
    ),
    6 => 
    array (
      'length' => '6',
      'foreign' => 'compensation_types',
      'name' => 'compensation_type_id',
      'type' => 'int',
      'select' => 1,
    ),
    7 => 
    array (
      'type' => 'varchar',
      'length' => '20',
      'name' => 'job_class',
    ),
    8 => 
    array (
      'type' => 'int',
      'length' => '6',
      'name' => 'job_location_id',
      'select' => 1,
    ),
  ),
  'job_locations' => 
  array (
    0 => 
    array (
      'type' => 'int',
      'short' => 1,
      'length' => '6',
      'name' => 'job_location_id',
    ),
    1 => 
    array (
      'type' => 'varchar',
      'name' => 'jl_address1',
      'length' => '30',
    ),
    2 => 
    array (
      'type' => 'varchar',
      'name' => 'jl_address2',
      'length' => '30',
    ),
    3 => 
    array (
      'type' => 'varchar',
      'name' => 'jl_city',
      'length' => '30',
    ),
    4 => 
    array (
      'type' => 'varchar',
      'length' => '30',
      'name' => 'jl_state',
    ),
    5 => 
    array (
      'name' => 'jl_country',
      'length' => '2',
      'type' => 'varchar',
    ),
    6 => 
    array (
      'type' => 'int',
      'name' => 'jl_zipcode',
      'length' => '9',
    ),
  ),
  'job_profiles' => 
  array (
    0 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'short' => 1,
    ),
    1 => 
    array (
      'type' => 'int',
      'length' => '6',
      'name' => 'job_id',
      'foreign' => 'jobs',
    ),
/*    2 => 
    array (
      'foreign' => 'job_locations',
      'name' => 'job_location_id',
      'length' => '6',
      'type' => 'int',
      '1to1' => 1,
    ),
    3 => 
    array (
      'length' => '2',
      'name' => 'job_years_of_exp',
      'type' => 'int',
    ),
    4 => 
    array (
      'type' => 'int',
      'length' => '7',
      'name' => 'job_min_pay',
    ),
    5 => 
    array (
      'name' => 'job_max_pay',
      'length' => '10',
      'type' => 'int',
    ),
    6 => 
    array (
      'length' => NULL,
      'name' => 'job_due',
      'type' => 'timestamp',
    ),
    7 => 
    array (
      'name' => 'job_principals_only',
      'length' => '1',
      'type' => 'int',
    ),
    8 => 
    array (
      'type' => 'int',
      'length' => '6',
      'foreign' => 'job_providers',
      'name' => 'job_provider_id',
    ), // */
    array (
		'name' => 'job_provider_id',
		'length' => 13,
	),
	array (
		'name' => 'zipcode',
		'length' => 10,
	),
	array (
		'name' => 'country_id',
		'length' => 2,
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
  ),
  'job_qualifications' => 
  array (
    0 => 
    array (
      'length' => '12',
      'foreign' => 'job_qualifications',
      'name' => 'job_qualification_id',
      'type' => 'int',
    ),
    1 => 
    array (
      'type' => 'int',
      'foreign' => 'profiles',
      'name' => 'job_profile_id',
      'length' => '11',
    ),
    2 => 
    array (
      'type' => 'int',
      'length' => '6',
      'foreign' => 'qualifications',
      'name' => 'qualification_id',
      'select' => 1,
    ),
    3 => 
    array (
      'type' => 'int',
      'length' => '2',
      'name' => 'qualification_rank',
    ),
  ),
  'job_preferences' => 
  array (
    0 => 
    array (
      'length' => '12',
      'name' => 'job_preference_id',
      'foreign' => 'job_preferences',
      'type' => 'int',
      'short' => 1,
    ),
    1 => 
    array (
      'type' => 'int',
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'job_profile_id',
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
/*    array (
    	'name' => 'city_2_id',
    	'length' => 10,
    	'select' => 1,
    ),
    array (
    	'name' => 'city_3_id',
    	'length' => 10,
    	'select' => 1,
    ), */
    array (
    	'name' => 'org_size_1_id',
    	'length' => 2,
    	'select' => 1,
    ),
/*    array (
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
    ), */
  ),
    'job_provider_profiles' => 
  array (
    0 => 
    array (
      'type' => 'int',
      'length' => '11',
      'name' => 'job_provider_profile_id',
      'foreign' => 'profiles',
    ),
    1 => 
    array (
      'type' => 'int',
      'name' => 'user_id',
      'foreign' => 'users',
      'length' => '11',
    ),
    2 => 
    array (
      'type' => 'varchar',
      'length' => '10',
      'name' => 'zipcode',
    ),
    3 => 
    array (
      'name' => 'country',
      'length' => '2',
      'type' => 'char',
    ),
    4 => 
    array (
      'type' => 'int',
      'length' => '3',
      'name' => 'size',
    ),
    5 => 
    array (
      'type' => 'char',
      'length' => '4',
      'name' => 'company_personality',
    ),
    6 => 
    array (
      'foreign' => 'industrys',
      'name' => 'industry_id',
      'length' => '5',
      'type' => 'int',
      'select' => 1,
    ),
  ),
    'job_profile_educations' =>
  array (
  	array (
      'name' => 'job_profile_education_id',
      'length' => 12,
    ),
    array (
      'name' => 'job_profile_id',
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
  'job_industry_experiences' =>
  array (
  	array (
      'name' => 'job_industry_experience_id',
      'length' => 12,
    ),
    array (
      'name' => 'job_profile_id',
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
  'job_occupation_experiences' =>
  array (
  	array (
      'name' => 'job_occupation_experience_id',
      'length' => 12,
    ),
    array (
      'name' => 'job_profile_id',
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

