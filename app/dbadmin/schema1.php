<?php
$schema = array (
  'accounts' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
      'hide' => 1,
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'Industry' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
      'hide' => 1,
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'contacts' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
      'hide' => 1,
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'job_profile' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
      'hide' => 1,
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'roles' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
      'hide' => 1,
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'job_category' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'skillz' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'job_provider_profile' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'seeker_preferences' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'seeker_qualifications' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'jobs' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'permissions' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'users' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'seeker_profile' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'job_qualifications' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
  'job_location' => 
  array (
    0 => 
    array (
      'name' => 'user_id',
      'type' => 'int',
      'length' => '11',
      'foreign' => 'users',
    ),
    1 => 
    array (
      'length' => '80',
      'name' => 'email',
      'type' => 'varchar',
    ),
    2 => 
    array (
      'length' => '128',
      'name' => 'password',
      'type' => 'char',
    ),
    3 => 
    array (
      'short' => 1,
      'length' => '40',
      'type' => 'varchar',
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
      'name' => 'name_middle',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'name' => 'name_last',
      'short' => 1,
      'length' => '40',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'name' => 'zip_code',
      'type' => 'varchar',
      'length' => '10',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'length' => '11',
      'foreign' => 'permissions',
      'name' => 'permission_id',
      'type' => 'int',
    ),
    10 => 
    array (
      'type' => 'int',
      'name' => 'role_id',
      'length' => '11',
      'foreign' => 'roles',
    ),
    11 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'industry',
    ),
    12 => 
    array (
      'length' => '3',
      'type' => 'int',
      'name' => 'occupation',
    ),
    13 => 
    array (
      'type' => 'int',
      'name' => 'employment_status',
      'length' => '1',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'length' => '1',
      'name' => 'personality_status',
      'type' => 'int',
    ),
    16 => 
    array (
      'length' => '1',
      'name' => 'education_status',
      'type' => 'int',
    ),
    17 => 
    array (
      'length' => '1',
      'type' => 'int',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'name' => 'preference_status',
      'type' => 'int',
      'length' => '1',
    ),
    19 => 
    array (
      'type' => 'int',
      'name' => 'system_status',
      'length' => '5',
    ),
    20 => 
    array (
      'type' => 'timestamp',
      'name' => 'status_timestamp',
      'length' => NULL,
    ),
    21 => 
    array (
      'type' => 'int',
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
    ),
    22 => 
    array (
      'foreign' => 'contacts',
      'length' => '11',
      'type' => 'int',
      'name' => 'contact_id',
    ),
    23 => 
    array (
      'name' => 'industry_id',
      'type' => 'int',
      'length' => '6',
      'foreign' => 'industrys',
    ),
    24 => 
    array (
      'foreign' => 'jobs',
      'length' => '6',
      'name' => 'job_id',
      'type' => 'int',
    ),
    25 => 
    array (
      'type' => 'int',
      'name' => 'category_id',
      'foreign' => 'categorys',
      'length' => '6',
    ),
    26 => 
    array (
      'foreign' => 'job_locations',
      'length' => '6',
      'type' => 'int',
      'name' => 'job_location_id',
    ),
    27 => 
    array (
      'type' => 'int',
      'name' => 'job_profile_id',
      'length' => '6',
      'foreign' => 'job_profiles',
    ),
    28 => 
    array (
      'name' => 'permission_id',
      'type' => 'int',
      'foreign' => 'permissions',
      'length' => '11',
    ),
    29 => 
    array (
      'length' => '11',
      'foreign' => 'roles',
      'type' => 'int',
      'name' => 'role_id',
    ),
    30 => 
    array (
      'name' => 'seeker_preference_id',
      'type' => 'int',
      'foreign' => 'seeker_preferences',
      'length' => '12',
    ),
    31 => 
    array (
      'length' => '11',
      'foreign' => 'profiles',
      'name' => 'profile_id',
      'type' => 'int',
    ),
    32 => 
    array (
      'name' => 'seeker_qualification_id',
      'type' => 'int',
      'length' => '12',
      'foreign' => 'seeker_qualifications',
    ),
    33 => 
    array (
      'type' => 'int',
      'name' => 'skill_id',
      'foreign' => 'skills',
      'length' => '6',
    ),
    34 => 
    array (
      'foreign' => 'users',
      'length' => '11',
      'name' => 'user_id',
      'type' => 'int',
    ),
  ),
);

$revschema = array();
foreach ($schema as $table=>$spec)
{
	$revschema[$table] = array();
	foreach ($spec as $field)
	{
		$revschema[$table][$field['name']] = $field;
	}
}
//print_r($revschema);
