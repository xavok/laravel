<?php

function param($p, $d='')
{
	return isset($_REQUEST[$p])?$_REQUEST[$p]:$d;
}

//require_once('db_info.php');
class dbAccess
{
	public $database;
	
	function __construct($db, $username, $password, $options)
	{
		$this->database = new PDO($db, $username, $password, $options);
		//$this->database -> exec("SET CHARACTER SET utf8");
	}

	function singular($name)
	{
		return substr($name, 0, strlen($name)-1);
	}
	
	function deref($name)
	{
		return substr($name, 0, strlen($name)-3).'s';
	}
	
	function basename($name)
	{
		return substr($name, 0, strlen($name)-3);
	}	
	
	function readform($fields, $data = array())
	{
		foreach ($fields as $field)
		{
			$val = param($field);
			if (!isset($data[$field]) && $val)
				$data[$field] = $val;
		}
		return ($data);
	}

	function insert_form($fields, $table, $xtra=array())
	{
		//print_r($xtra);
		$data = readform($fields, $xtra);
		// insert data
		$qsl1 = array();
		$qsl2 = array();
		foreach ($data as $k=>$v)
		{
			$qsl1[] = $k;
			$qsl2[]	= ":$k";
		}
		//echo "INSERT INTO $table (".implode(',',$qsl1).") VALUES (".implode(',',$qsl2).")";
		$sth = $this->database->prepare("INSERT INTO $table (".implode(',',$qsl1).") VALUES (".implode(',',$qsl2).")");
		if(!$sth)
		{
			echo $database->errorInfo(), '<br />';
			return array('error'=>$database->errorInfo());
		}
		$sth->execute($data);
		$id = $this->database->lastInsertId();
		$data['id'] = $id;
		//$data['_query'] = "INSERT INTO $table (".implode(',',$qsl1).") VALUES (".implode(',',$qsl2).")";
		return ($data);
	//print_r($data);
	}

	function update_form($fields, $table, $key, $index, $xtra = array())
	{
		$data = readform($fields, $xtra);
		// insert data
		$qsl1 = array();
		foreach ($data as $k=>$v)
		{
			$qsl1[] = $k."=:$k";
		}
		//print_r($data);
		//print_r($fields);
		//echo "UPDATE $table set ".implode(',',$qsl1)." WHERE $key='".$data[$key]."'";
		$sth = $this->database->prepare("UPDATE $table set ".implode(',',$qsl1)." WHERE $key=:key");
		if(!$sth)
		{
			return array('error'=>$this->database->errorInfo());
		}
		$success = $sth->execute($data);
		$data['_success'] = $sth->rowCount();
		//$data['_query'] = "UPDATE $table set ".implode(',',$qsl1)." WHERE $key='".$data[$key]."'";
	//print_r($data);
		return ($data);
	}

	function insert_array($data, $table)
	{
		// insert data
		$qsl1 = array();
		$qsl2 = array();
		$qsl3 = array();
		$qsl4 = array();
		foreach ($data as $k=>$v)
		{
			$qsl1[] = $k;
			$qsl2[]	= ":$k";
			$qsl3[] = "'$v'";
		//	$data[$k] = utf8_encode($v);	// braindead handling of unicode
		//	$qsl4[] = '?';
		}
		//echo "INSERT INTO $table (".implode(',',$qsl1).") VALUES (".implode(',',$qsl3).")";
		$sth = $this->database->prepare("INSERT INTO $table (".implode(',',$qsl1).") VALUES (".implode(',',$qsl2).")");
		//$sth = $this->database->prepare("INSERT INTO $table (".implode(',',$qsl1).") VALUES (".implode(',',$qsl4).")");
		$sth->execute($data);
		//$sth->execute($qsl3);
		//print_r ($this->database->errorInfo());
		//print_r($data);	echo "<br />\n";
		//print_r($sth->errorInfo());	echo "<br />\n";
		if(!$sth)
		{
			echo $this->database->errorInfo();
			return array('error'=>$this->database->errorInfo());
		}
		$id = $this->database->lastInsertId();
		$data['id'] = $id;
		//$data['_query'] = "INSERT INTO $table (".implode(',',$qsl1).") VALUES (".implode(',',$qsl2).")";
		//print_r($data);
		return ($data);
	}

	function update_array($data, $table, $key)
	{
		//print_r($data);	echo "<br><br>\n\n";
		// insert data
		$qsl2 = array();
		foreach ($data as $k=>$v)
		{
			$qsl1[] = $k."=:$k";
			$qsl2[] = $k."=$v";
		}
		#echo "UPDATE $table set ".implode(',',$qsl2)." WHERE $key='".$data[$key]."'";
		$sth = $this->database->prepare("UPDATE $table set ".implode(',',$qsl1)." WHERE $key='".$data[$key]."'");
		if(!$sth)
		{
			return array('error'=>array(
				$this->database->errorInfo(),
				$sth->errorInfo()
				));
		}
		$success = $sth->execute($data);
		$data['_success'] = $sth->rowCount();

		//$data['_query'] = "UPDATE $table set ".implode(',',$qsl1)." WHERE $key='".$data[$key]."'";
		return ($data);
	//print_r($data);
	}

	function fetch($table, $id)
	{
		$errors = array();
		if (!$id)
		{	$errors['id'] = 'missing id to query for fetch';	$data=array();	}
		else
		{
			$tt = $this->singular($table); //substr($table, 0, strlen($table)-1);
			//echo "SELECT * FROM $table WHERE ".$tt."_id='$id' <br />";
			$sth = $this->database->prepare("SELECT * FROM $table WHERE ".$tt."_id='$id' ");
			$sth->execute();
			//echo $this->database->errorInfo();
			if(!$sth)
			{
				return array('errors'=>$this->database->errorInfo());
			}
			if(!($data = $sth->fetchAll(PDO::FETCH_ASSOC)))
			{
				$errors[] = 'Invalid record ID or database error';
				$errors[] = $this->database->errorInfo();
				return array('fetch'=>array(), 'errors'=>$errors);
			}
		}
		if (count($data) > 0)
		{
			//print_r($data);
			return array('fetch'=>$data[0], 'errors'=>$errors);
		}
		else
		{
			return array('fetch'=>array(), 'errors'=>$errors);
		}
	}

	function fetchall($table, $chkfields = array(), $limit = '', $offset = '')
	{
		$errors = array();
		$data = array();
		$check = '';
		if (count($chkfields))
			$check = ' WHERE 1=1';
		foreach ($chkfields as $k=>$v)
		{
			//echo $k."=>".is_numeric($k)."<br />\n";
			if (!is_numeric($k))
				$check .= " AND $k = :$k";
			else
				$check .= " AND $v";
		}
		if ($limit > 0)	$limit = 'limit '.(1*$limit);
		if ($offset !== '')	$offset = 'offset '.(1*$offset);
	//	global $user;
		$qs = "SELECT * FROM $table $check $limit $offset";
		//echo $qs,'<br />';
		$sth = $this->database->prepare($qs);
		$e = $this->database->errorInfo();
		if(!$sth) // || $e[0])
		{	$errors[] = $e;
			$errors[] = $qs;
			print_r($errors);
			return array('errors'=>$errors);
		}
		$success = $sth->execute($chkfields);
		$data = $sth->fetchAll(PDO::FETCH_ASSOC);
		if (count($data)==0)
		{
			$errors[] = 'Invalid record ID or database error';
		}
	//	$data[0]['_query'] = "SELECT * FROM $table $check";
		return array('fetch'=>$data, 'errors'=>$errors, 'query'=>$qs);
	}
	
	// like fetchall, but search wildcard friendly
	function fetchlike($table, $chkfields = array(), $limit = '', $offset = '')
	{
		$errors = array();
		$data = array();
		$check = '';
		if (count($chkfields))
			$check = ' WHERE 1=1';
		foreach ($chkfields as $k=>$v)
		{
			//echo $k."=>".is_numeric($k)."<br />\n";
			if (!is_numeric($k))
				$check .= " AND $k like :$k";
			else
				$check .= " AND $v";
		}
		if ($limit > 0)	$limit = 'limit '.(1*$limit);
		if ($offset !== '')	$offset = 'offset '.(1*$offset);
	//	global $user;
		$qs = "SELECT * FROM $table $check $limit $offset";
		//echo $qs,'<br />';
		$sth = $this->database->prepare($qs);
		if(!$sth)
		{	$errors[] = $this->database->errorInfo();
			$errors[] = $qs;
			return array('errors'=>$errors);
		}
		$success = $sth->execute($chkfields);
		$data = $sth->fetchAll(PDO::FETCH_ASSOC);
		if (count($data)==0)
		{
			$errors[] = 'Invalid record ID or database error';
		}
	//	$data[0]['_query'] = "SELECT * FROM $table $check";
		return array('fetch'=>$data, 'errors'=>$errors, 'query'=>$qs);
	}
}
?>
