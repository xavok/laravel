<?php
$schema_defs = array (
  'qualifications' => 
  array (
    0 => 
    array (
      'type' => 'int',
      'length' => '6',
      'name' => 'qualification_id',
      'foreign' => 'qualifications',
    ),
    1 => 
    array (
      'type' => 'varchar',
      'length' => '30',
      'short' => 1,
      'name' => 'qualification_name',
    ),
    2 => 
    array (
      'foreign' => 'industrys',
      'name' => 'occupation_id',
      'length' => '6',
      'type' => 'int',
      'select' => 1,
    ),
    3 => 
    array (
      'type' => 'text',
      'length' => NULL,
      'name' => 'qualification_description',
      'short' => 1,
    ),
  ),
  'job_categorys' => 
  array (
    0 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    1 => 
    array (
      'type' => 'varchar',
      'name' => 'category_name',
      'short' => 1,
      'length' => '30',
    ),
  ),

  'industrys' => 
  array (
    0 => 
    array (
      'length' => '6',
      'name' => 'industry_id',
      'foreign' => 'industrys',
      'type' => 'int',
    ),
    1 => 
    array (
      'short' => 1,
      'length' => '30',
      'name' => 'industry_name',
      'type' => 'varchar',
    ),
  ),
  'fields' =>
  array (
    0 => 
    array (
      'length' => '5',
      'name' => 'field_id',
      'foreign' => 'fields',
      'type' => 'int',
    ),
    1 => 
    array (
      'short' => 1,
      'length' => '40',
      'name' => 'field_name',
      'type' => 'varchar',
    ),
  ),
  
  'occupations' => 
  array (
    0 => 
    array (
      'length' => '5',
      'name' => 'occupation_id',
      'foreign' => 'occupations',
      'type' => 'int',
    ),
    1 => 
    array (
      'short' => 1,
      'length' => '40',
      'name' => 'occupation_name',
      'type' => 'varchar',
    ),
  ),
/*  'occupation_types' => 
  array (
    0 => 
    array (
      'length' => '6',
      'name' => 'occupation_type_id',
      'foreign' => 'occupation_types',
      'type' => 'int',
    ),
    1 =>
    array (
      'length' => '6',
      'name' => 'occupation_id',
      'foreign' => 'occupations',
      'type' => 'int',
      'select' => 1,
    ),
    2 => 
    array (
      'short' => 1,
      'length' => '40',
      'name' => 'occupation_subtype_name',
      'type' => 'varchar',
    ),
  ), // */
  'occupation_subtypes' => 
  array (
    0 => 
    array (
      'length' => '6',
      'name' => 'occupation_subtype_id',
      'foreign' => 'occupation_subtypes',
      'type' => 'int',
    ),
    1 =>
    array (
      'length' => '6',
      'name' => 'occupation_id',
      'foreign' => 'occupations',
      'type' => 'int',
      'select' => 1,
    ),
    2 => 
    array (
      'short' => 1,
      'length' => '40',
      'name' => 'occupation_subtype_name',
      'type' => 'varchar',
    ),
  ),

  'countrys' =>
  array (
  	0 =>
  	array (
  	  'name' => 'country_id',
  	  'length' => 3,
  	),
  	1 =>
  	array (
  	  'length' => 50,
  	  'name' => 'country_name',
  	  'short' => 1,
  	),
	2 =>
  	array (
  	  'length' => 2,
  	  'name' => 'country_code',
  	),
  ),
  'provinces' =>
  array (
  	0 =>
  	array (
  	  'name' => 'province_id',
  	  'length' => 5,
  	  'type' => 'int',
  	),
  	1 =>
  	array (
  	  'length' => 3,
  	  'name' => 'country_id',
  	  'select' => 1,
  	),
	2 =>
  	array (
  	  'length' => 50,
  	  'name' => 'province_name',
  	  'short' => 1,
  	),
  ),
  'citys' =>
  array (
  	0 =>
  	array (
  	  'name' => 'city_id',
  	  'length' => 8,
  	  'type' => 'int',
  	),
  	1 =>
  	array (
  	  'length' => 5,
  	  'name' => 'province_id',
  	  'select' => 1,
  	),
	2 =>
  	array (
  	  'length' => 50,
  	  'name' => 'city_name',
  	  'short' => 1,
  	),
  	3 =>
  	array (
  	  'length' => 10,
  	  'name' => 'lattitude',
  	),
  	4 =>
  	array (
  	  'length' => 10,
  	  'name' => 'longitude',
  	),
  ),
/*  'company_sizes' =>
  array (
  	0 =>
  	array (
  	  'name' => 'company_size_id',
  	  'length' => 2,
  	  'type' => 'int',
  	),
  	1 =>
  	array (
  	  'length' => 20,
  	  'name' => 'description',
  	  'short' => 1,
  	),
  ), // */
  'salarys' =>
  array (
  	0 =>
  	array (
  	  'name' => 'salary_id',
  	  'length' => 2,
  	  'type' => 'int',
  	),
  	1 =>
  	array (
  	  'length' => 20,
  	  'name' => 'description',
  	  'short' => 1,
  	),  	
  ),
  'workplaces' =>
  array (
  	0 =>
  	array (
  	  'name' => 'workplace_id',
  	  'length' => 2,
  	  'type' => 'int',
  	),
  	1 =>
  	array (
  	  'length' => 20,
  	  'name' => 'description',
  	  'short' => 1,
  	),  	
  ),
  'atmospheres' =>
  array (
  	0 =>
  	array (
  	  'name' => 'atmosphere_id',
  	  'length' => 2,
  	  'type' => 'int',
  	),
  	1 =>
  	array (
  	  'length' => 20,
  	  'name' => 'description',
  	  'short' => 1,
  	),  	
  ),
  'work_environments' =>
  array (
  	0 =>
  	array (
  	  'name' => 'work_environment_id',
  	  'length' => 2,
  	  'type' => 'int',
  	),
  	1 =>
  	array (
  	  'length' => 20,
  	  'name' => 'description',
  	  'short' => 1,
  	),  	
  ),
  'interactions' =>
  array (
  	0 =>
  	array (
  	  'name' => 'interaction_id',
  	  'length' => 2,
  	  'type' => 'int',
  	),
  	1 =>
  	array (
  	  'length' => 20,
  	  'name' => 'description',
  	  'short' => 1,
  	),  	
  ),
  'org_sizes' =>
  array (
  	0 =>
  	array (
  	  'name' => 'org_size_id',
  	  'length' => 2,
  	  'type' => 'int',
  	),
  	1 =>
  	array (
  	  'length' => 20,
  	  'name' => 'description',
  	  'short' => 1,
  	),  	
  ),
  'education_levels' =>
  array (
  	array (
  	  'name' => 'education_level_id',
  	  'length' => 2,
  	  'type' => 'int',
  	),
  	array (
  	  'length' => 40,
  	  'name' => 'description',
  	  'short' => 1,
  	),  	  
  ),
  'study_fields' =>
  array (
  	array (
  	  'name' => 'study_field_id',
  	  'length' => 2,
  	  'type' => 'int',
  	),
  	array (
  	  'length' => 40,
  	  'name' => 'description',
  	  'short' => 1,
  	),  	  
  ),
);

