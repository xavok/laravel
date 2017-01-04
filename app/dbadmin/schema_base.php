<?php
$schema_base = array (
  'accounts' => 
  array (
    0 => 
    array (
      'name' => 'account_id',
      'foreign' => 'accounts',
      'length' => '11',
      'type' => 'int',
    ),
    1 => 
    array (
      'type' => 'varchar',
      'length' => '80',
      'short' => 1,
      'name' => 'name',
    ),
    2 => 
    array (
      'length' => '11',
      'name' => 'owner_id',
      'foreign' => 'owners',
      'type' => 'int',
    ),
  ),
  'users' => 
  array (
    0 => 
    array (
      'type' => 'int',
      'name' => 'user_id',
      'foreign' => 'users',
      'length' => '11',
    ),
    1 => 
    array (
      'type' => 'varchar',
      'length' => '80',
      'name' => 'email',
    ),
    2 => 
    array (
      'name' => 'password',
      'length' => '128',
      'type' => 'char',
      'hide' => 1,
    ),
    3 => 
    array (
      'type' => 'varchar',
      'length' => '40',
      'short' => 1,
      'name' => 'name_first',
    ),
    4 => 
    array (
      'length' => '40',
      'short' => 1,
      'name' => 'name_middle',
      'type' => 'varchar',
    ),
    5 => 
    array (
      'type' => 'varchar',
      'length' => '40',
      'short' => 1,
      'name' => 'name_last',
    ),
    6 => 
    array (
      'length' => '20',
      'name' => 'phone_primary',
      'type' => 'varchar',
    ),
    7 => 
    array (
      'length' => '10',
      'name' => 'zip_code',
      'type' => 'varchar',
    ),
    8 => 
    array (
      'type' => 'char',
      'name' => 'country',
      'length' => '2',
    ),
    9 => 
    array (
      'type' => 'int',
      'length' => '11',
      'name' => 'permission_id',
      'foreign' => 'permissions',
      '1to1' => 1,
    ),
    10 => 
    array (
      'foreign' => 'roles',
      'name' => 'role_id',
      'length' => '11',
      'type' => 'int',
      '1to1' => 1,
    ),
    11 => 
    array (
      'length' => '3',
      'name' => 'industry_id',
      'type' => 'int',
      'select' => 1,
    ),
    12 => 
    array (
      'type' => 'int',
      'length' => '3',
      'name' => 'occupation_id',
      'select' => 1,
    ),
    13 => 
    array (
      'name' => 'employment_status',
      'length' => '1',
      'type' => 'int',
    ),
    14 => 
    array (
      'length' => '1',
      'name' => 'searching_status',
      'type' => 'int',
    ),
    15 => 
    array (
      'name' => 'personality_status',
      'length' => '1',
      'type' => 'int',
    ),
    16 => 
    array (
      'type' => 'int',
      'length' => '1',
      'name' => 'education_status',
    ),
    17 => 
    array (
      'type' => 'int',
      'length' => '1',
      'name' => 'proficiency_status',
    ),
    18 => 
    array (
      'type' => 'int',
      'length' => '1',
      'name' => 'preference_status',
    ),
    19 => 
    array (
      'name' => 'system_status',
      'length' => '5',
      'type' => 'int',
    ),
    20 => 
    array (
      'length' => NULL,
      'name' => 'status_timestamp',
      'type' => 'timestamp',
    ),
  ),
  'roles' => 
  array (
    0 => 
    array (
      'foreign' => 'roles',
      'name' => 'role_id',
      'length' => '11',
      'type' => 'int',
    ),
    1 => 
    array (
      'type' => 'int',
      'length' => '11',
      'name' => 'user_id',
      'foreign' => 'users',
    ),
    2 => 
    array (
      'type' => 'int',
      'length' => '11',
      'name' => 'parent_role_id',
      'foreign' => 'parent_roles',
    ),
    3 => 
    array (
      'name' => 'name',
      'length' => '40',
      'short' => 1,
      'type' => 'varchar',
    ),
    4 => 
    array (
      'type' => 'int',
      'name' => 'permissions',
      'length' => '11',
    ),
  ),
  'permissions' => 
  array (
    0 => 
    array (
      'name' => 'permission_id',
      'foreign' => 'permissions',
      'length' => '11',
      'type' => 'int',
    ),
    1 => 
    array (
      'type' => 'int',
      'length' => '1',
      'name' => 'js',
    ),
    2 => 
    array (
      'type' => 'int',
      'name' => 'jp',
      'length' => '1',
    ),
    3 => 
    array (
      'name' => 'admin',
      'length' => '1',
      'type' => 'int',
    ),
    4 => 
    array (
      'name' => 'sales',
      'length' => '1',
      'type' => 'int',
    ),
  ),
    'contacts' => 
  array (
    0 => 
    array (
      'foreign' => 'contacts',
      'name' => 'contact_id',
      'length' => '11',
      'type' => 'int',
    ),
    1 => 
    array (
      'type' => 'int',
      'length' => '11',
      'name' => 'user_id',
      'foreign' => 'users',
    ),
    2 => 
    array (
      'type' => 'varchar',
      'length' => '80',
      'short' => 1,
      'name' => 'name',
    ),
    3 => 
    array (
      'name' => 'box',
      'length' => '20',
      'type' => 'varchar',
    ),
    4 => 
    array (
      'type' => 'varchar',
      'name' => 'street',
      'length' => '80',
    ),
    5 => 
    array (
      'type' => 'char',
      'name' => 'state',
      'length' => '2',
    ),
    6 => 
    array (
      'type' => 'char',
      'length' => '2',
      'name' => 'country',
    ),
    7 => 
    array (
      'length' => '10',
      'name' => 'zip',
      'type' => 'varchar',
    ),
    8 => 
    array (
      'type' => 'varchar',
      'name' => 'phone',
      'length' => '30',
    ),
    9 => 
    array (
      'name' => 'email',
      'length' => '80',
      'type' => 'varchar',
    ),
  ),

);


