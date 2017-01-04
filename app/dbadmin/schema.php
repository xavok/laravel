<?php

$schema = array (
);

$schema_tables = array();

function mergein($subschema)
{
	global $schema, $schema_tables;
	global ${$subschema};

	include ($subschema.'.php');
	$sc = ${$subschema};
//	print_r ($sc);
	foreach ($sc as $table=>$dat)
	{
		$schema[$table] = $dat;
		$schema_tables = array();
	}
}

mergein('schema_base');
mergein('schema_jobs');
mergein('schema_seeker');
mergein('schema_defs');

$schema_tables = array_merge($schema_tables, array(
//	'seeker_qualifications'=>array(),
//	'job_locations'=>array(),
//	'jobs'=>array(),
//	'job_categorys'=>array(),
//	'seeker_profiles'=>array(),
//	'accounts'=>array(),
//	'job_qualifications'=>array(),
//	'seeker_preferences'=>array(),
//	'job_provider_profiles'=>array(),
	'users'=>array('nonew'=>1),
//	'qualifications'=>array(),
//	'job_profiles'=>array('nonew'=>1),
//	'contacts'=>array(),
//	'roles'=>array(),
	'permissions'=>array('nonew'=>1),
//	'industrys'=>array(),
//	'occupations'=>array(),
));

foreach ($schema as $table=>$spec)
{
	$schema_tables[$table]['referals'] = array();
}

$revschema = array();
foreach ($schema as $table=>$spec)
{
	$revschema[$table] = array();
	foreach ($spec as $field)
	{
		$name = $field['name'];
		$revschema[$table][$name] = $field;
		if (strstr($name, '_id'))
		{
			$schema_tables[$database->deref($name)]['referals'][] = $table;
		}
	}
}

