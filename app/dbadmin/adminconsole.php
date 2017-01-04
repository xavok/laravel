<?php
require_once('config.php');
include ('header.php');
if (!$login->require_priviledge('admin'))
{
?>
<div class="fullwidth">
This interface requires admin priveledges.
</div>
<?php
	exit();
}

require_once('schema.php');

$table = param('table', '');	// currently selected table
$start = param('start', 0);		// current browse position
$index = param('index', 0);		// index of selected record
$search = param('search', '');
$searchname = param('sn', '');	// field to search on
$searchval = param('sv', '');	// value to search for
$seak = param('seak', '');		// seak records referring to ...
$new = param('new', '');		// add record or form for same
$linkto = param('linkto', '');
$newrec = param('newrec', '');	// create a record linked to current record

function ifset($array, $index)
{
	return isset($array[$index])?$array[$index]:'';
}

// URL parameters preserving state, unless overridden
function stateparams($vals = array())
{
	global $table, $start, $index;
	if (!isset($vals['table']))
	{
		$vals['table'] = $table;
		if (!isset($vals['start']))
		{
			$vals['start'] = $start;
			if (!isset($vals['index']))
			{
				$vals['index'] = $index;
			}
		}
	}
	//print_r($vals);
	$params = array();
	foreach ($vals as $k=>$v)
	{
		$params[] = $k.'='.urlencode($v);
	}
	//print_r($params);
	return join('&', $params);
}

// read a form based on schema and mask
function readform($table, $mask = array(), $fill=false)
{
	global $schema;
	$fields = $schema[$table];
	$data = array();
	
	foreach ($fields as $field)
	{
		foreach ($mask as $test)
		{
			if (isset($field[$test]))
			{
				continue;
			}
		}
		$val = param($field['name']);
		if ($fill || (!isset($data[$field['name']]) && $val))
			$data[$field['name']] = $val;
	}
	return ($data);
}

function do_search($table, $start)
{
	global $schema, $database;
	$criteria = readform($table, array('hide'));
	//echo "fetching from $table $start<br />";
	$list = $database->fetchlike($table, $criteria, SELECTLENGTH, $start);
	$list = $list['fetch'];
	//print_r($list);
	$tt = $database->singular($table);
	$criteria['search'] = 1;
	$criteria['start'] = ($start-SELECTLENGTH > 0)?$start-SELECTLENGTH:0;
?>
	Search Results<br />
	<div class="listrow">
		<a href="?<?= stateparams($criteria) ?>">Back</a>
	</div>
	<br />
<?php
	$criteria['start'] = $start;
	foreach($list as $row)
	{
?>
	<div class="listrow"><a href="?<?= stateparams($criteria) ?>&index=<?= $row[$tt.'_id'] ?>">
<?php
		foreach($schema[$table] as $spec)
		{
			if (isset($spec['short']))
			{
				echo $row[$spec['name']],' ';
			}
		}
?> </a></div> <?php
	}
	$criteria['start'] = (count($list) >= SELECTLENGTH)?$start+SELECTLENGTH:$start;
?>
	<br />
	<div class="listrow">
		<a href="?<?= stateparams($criteria) ?>">Foreward</a>
	</div>
<?php	
}

function do_seak($seak)
{
	global $schema, $database, $table, $index;
	// safety filter $seak
	preg_match('#(\w+)#', $seak, $match);
	$seak = $match[1];
	$criteria = array($seak => $index);
	$list = $database->fetchall($table, $criteria, SELECTLENGTH);
	$list = $list['fetch'];
	//print_r($list);
	$tt = $database->basename($seak);
?>	Referrals from <?= $seak ?><br />	<?php
	foreach($list as $row)
	{
//		print_r($row);
		$index = $row[$database->singular($table).'_id'];
?>
	<div class="listrow"><a href="?<?= stateparams(array('table'=>$table, 'index'=>$index)) ?>">
<?php
		echo $row[$seak], ' ';
		foreach($schema[$table] as $spec)
		{
			if (isset($spec['short']))
			{
				echo $row[$spec['name']],' ';
			}
		}
?> </a></div> <?php
	}
	if (count($list) == 0)
	{
		global $new, $defaults;
		$new = 1;
		$defaults = $criteria;
		//print_r($defaults);
?>	New Record >>>	<?php
	}
?>
	<br />
<?php
}
	
function list_tables($selected)
{
	global $schema;
	foreach ($schema as $table=>$def)
	{
?>
	<div class="listrow<?= ($table==$selected)?' rowselected':'' ?>" >
		<a href="?table=<?= $table ?>" ><?= $table ?></a>
	</div>
<?php
	}
}

function list_browse($table, $start)
{
	global $schema, $schema_tables, $database, $index;
	//echo "fetching from $table $start<br />";
	$list = $database->fetchall($table, array(), SELECTLENGTH, $start);
	$list = $list['fetch'];
	//print_r($list);
	$tt = $database->singular($table);
?>
	<div class="listrow">
		<a href="?<?= stateparams(array('start'=>($start-SELECTLENGTH > 0)?$start-SELECTLENGTH:0)); ?>">Back</a>
	</div>
	<br />
<?php
	//print_r($list);
	foreach($list as $row)
	{
?>
	<div class="listrow <?= ($index==$row[$tt.'_id'])?'rowselected':'' ?>">
		<a href="?<?= stateparams(array('start'=>$start, 'index'=>$row[$tt.'_id'])) ?>">
<?php
		foreach($schema[$table] as $spec)
		{
			if (isset($spec['short']))
			{
				echo $row[$spec['name']],' ';
			}
		}
?>		</a>
	</div>
<?php
	}
?>
	<br />
	<div class="listrow">
		<a href="?<?= stateparams(array('start'=> (count($list) >= SELECTLENGTH)?$start+SELECTLENGTH:$start)) ?>">Foreward</a>
	</div>
	<br />
<?php
	if (!isset($schema_tables[$table]['nonew']))
	{
?>
	<div class="listrow">
		<a href="?<?= stateparams(); ?>&new=1" >New Record</a>
	</div>
<?php
	}
}

// display a record fetched by view or new
function display_record($table, $record)
{
	global $schema, $revschema, $database;
	
	foreach($record as $name=>$value)//($schema[$table] as $spec)
	{
		$rec = $revschema[$table][$name];
		//print_r($revschema[$table][$name]);
		if (isset($revschema[$table][$name]['hide']))
		{
			//echo 'hide';
			continue;
		}
		//print_r($revschema[$table][$name]);
?>
	<div class="recordrow">
		<?= $name ?> => <?= $value ?>
<?php
		// a link
		if (strstr($name, '_id'))
		{
			$inputmade = 0;
			$newtable = $database->deref($name);
			if (preg_match('#\_\d#', $newtable))
			{
				$newtable = substr($newtable, 0, -3).'s';
				//echo "$ntsingle<br />";
			}
			if (($value || isset($revschema[$table][$name]['select'])) && ($newtable != $table))
			{
?>
	<a href="?<?= stateparams(array('table'=>$newtable, 'index'=>$value)); ?>">View</a>
<?php	
			}
			// present a select box for this value
			if (isset($revschema[$table][$name]['range']))
			{
				$range = $revschema[$table][$name]['range'];
?>
	select:
	<select name="<?= $name ?>" >
<?php
				for ($option = $range[0]; $option <= $range[1]; $option++)
				{
?>
		<option value="<?= $option ?>" <?= $option==$value?'selected=selected':'' ?>><?= $option ?></option>
<?php
				}
?>
	</select>
<?php
				$inputmade = 1;
			}
			else if (isset($revschema[$table][$name]['select']))
			{
				$ntsingle = $database->singular($newtable);
				//echo "$ntsingle<br />";
				if (preg_match('#\_\d#', $ntsingle))
				{
					$ntsingle = substr($ntsingle, 0, -2);
					//echo "$ntsingle<br />";
				}
?>
	select:
	<select name="<?= $name ?>" >
<?php
				$options = $database->fetchall($newtable, array());
				$options = $options['fetch'];
				//print_r($options);
				foreach ($options as $option)
				{
?>
		<option value="<?= $option[$ntsingle.'_id'] ?>" <?= $option[$ntsingle.'_id']==$value?'selected=selected':'' ?>><?= ifset($option,$ntsingle.'_name'); ?><?= ifset($option,'description'); ?></option>
<?php
				}
?>
	</select>
<?php
				$inputmade = 1;
			}
			//echo $revschema[$table][$name]['1to1'];
			if (isset($revschema[$table][$name]['1to1']) && (!$value))
			{
?>
	<a href="?<?= stateparams(); ?>&newrec=<?= $name ?>">Create Record</a>
<?php
			}
			if ($value && !$inputmade)
			{
?>
	<input type="hidden" name="<?= $name ?>" value="<?= $value ?>" />
<?php
			}
		}
		// not a link
		else
		{
?>	<input name="<?= $name ?>" value="<?= $value ?>" size="<?= $rec['length'] ?>" />	<?php
		}
?>
	</div>
<?php
	}
?>	<input type="submit" value="submit" /><br />
	find Referrals:<br />
<?php
	global $schema_tables;
	foreach ($schema_tables[$table]['referals'] as $referral)
	{
		if ($referral != $table)
		{
?>	<a href="?<?= stateparams(array('table'=>$referral, 'seak'=>$database->singular($table).'_id', 'index'=>$record[$database->singular($table).'_id'])); ?>" ><?= $referral ?></a>
	<a href="?<?= stateparams(array('table'=>$referral, 'linkto'=>$database->singular($table).'_id', 'index'=>$record[$database->singular($table).'_id'])); ?>&new=1" >(New referral)</a><br />
<?php
		}
	}
}

function new_record($table)
{
	global $schema, $schema_tables, $database, $defaults;
	global $linkto, $index;
	if ($linkto)
	{
		$defaults[$linkto] = $index;
		echo "$linkto => $index<br />";
	}

	if (isset($schema_tables[$table]['nonew']))
	{
		echo "cannot create new $table through this console";
		return;
	}
	
	if (param('add', ''))
	{
		$record = readform($table, array('hide'), 1);
		//print_r($record);
		$database->insert_array($record, $table);
	}
	else
	{
		$record = array();
		foreach ($schema[$table] as $row)
		{
			$record[$row['name']] = isset($defaults[$row['name']])?$defaults[$row['name']]:'';
			//echo $row['name'],' ',$record[$row['name']], '<br />';
		}
	}
?>
	<form action="?<?= stateparams(); ?>&new=1&add=1" method="post">
<?php
//	print_r($record);
	display_record($table, $record);
?>
	</form>
<?php
}

function show_record($table, $index)
{
	global $schema, $revschema, $database, $start;
	$key = $database->singular($table).'_id';
	if (param('update', ''))
	{
		$record = readform($table, array('hide'), 0);
		//print_r($record);
		$database->update_array($record, $table, $key);
	}
	//$record = $database->fetchall($table, array($table.'_id'=>$index));
	$record = $database->fetch($table, $index);
	if (count($record['fetch']) == 0)
	{
		return;
	}
	$record = $record['fetch']; //[0];
	//print_r($revschema[$table]);
?>
	<form action="?<?= stateparams(); ?>&update=1" method="post">
		<input type="hidden" name="<?= $key ?>" value="<?= $record[$key] ?>" />
<?php
	display_record($table, $record);
?>
	</form>
<?php
}

function show_search($table)
{
	global $schema;
	if (!$table)
	{
		return;
	}
	if (!isset($schema[$table]))
	{
		echo "missing table $table";
		return;
	}
?>
	
<?php
	
	foreach($schema[$table] as $rec)
	{
		if (isset($rec['hide']))	{	continue;	}
?>	<div class="searchfield">
		<?php	echo $rec['name'];?>
		<input name="<?= $rec['name']; ?>" value="<?= (param($rec['name'], '')) ?>" size="<?= $rec['length'] ?>" />
	</div>
<?php
	}
?>

<?php
}

if ($newrec)
{
	// validate request
	$from = $database->fetch($table, $index);
	$from = $from['fetch'];
	if (isset($from[$newrec]) && ($from[$newrec] == 0))
	{
		$new = $database->insert_array(array(), $database->deref($newrec));
		//print_r($new);
		$database->update_array(array($database->singular($table).'_id'=>$index, $newrec=>$new['id']),
			$table, $database->singular($table).'_id'
		);
	}
}
?>
<div class="fullwide">
	<div class="leftbar">
		<?php	list_tables($table);	?>
	</div>
	<div class="leftbar">
		<?php	if ($search)
			{	do_search($table, $start);	}
			else if ($seak)
			{	do_seak($seak);	}
			else
			{	list_browse($table, $start);	}
		?>
	</div>
	<div class="selectedrecord">
		<?php	if ($new)
			{	new_record($table);	}
			else
			{	show_record($table, $index);	}	?>
	</div>

</div>
<div class="bottombar">
	<form method="post" action="?<?= stateparams(); ?>">
		<div class="bottombarin">
			Search in table <?= $table ?><br />
			<? show_search($table);	?>
			<div class="break" >
				<input type="submit" value="search" name="search" />
			</div>
		</div>		
	</form>
</div>
<div class="break" />
<?php
include('footer.php');
