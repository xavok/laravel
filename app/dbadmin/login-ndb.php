<?php
/*
provides user login/validation
changed to operate without writing to the database.  Loses session key ability.

set $_usecookie true (less secure) or include loginstring() in URLs to preserve session.

CGI parameters:
to login:
	u	:	user.id to match
	p	:	password
to use session key:
	login	:	session key

table user:
id		: unique
user_name	: string, unique;
password	: char(60); // hashed password, not kept in memory longer than needed

sqlite:
create table users(
id integer primary key autoincrement,
user_name text unique,
password text
);

*/
// needed for php < 5.5
if (!function_exists("password_hash"))
{
	require_once("password_compat/lib/password.php");
}

class login
{
	public $database;	// a dbAccess object connected to a database with user table
	public $sessiontime;
	public $sessionexpires;
	public $usecookie;
	private $session;
	public $permissions;
	
	public $user, $errors;
	// 86400 = seconds in a day
	function __construct($db, $_sessiontime = 86400, $_usecookie = false)
	{
		$this->database = $db;
		$this->sessiontime = $_sessiontime;
		$this->sessionexpires = 0;
		$this->usecookie = $_usecookie;
		$this->errors = array();
	}

	public function request($var, $default)
	{
		if (isset($_REQUEST[$var]))
		{
			return $_REQUEST[$var];
		}
		if (isset($_COOKIE[$var]))
		{
			return $_COOKIE[$var];
		}
		return $default;
	}

	// returns a hash of a password valid for login validation
	public function hash($password)
	{
		return password_hash($password, PASSWORD_DEFAULT,
			array(
				//'salt'=>$this->salt
				//'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
			));
	}

	public function validatehash($password, $hashed)
	{
		//print ("$password, $hashed\n");
		return (password_verify($this->request('p', ''), $hashed)); //$fetch['fetch'][0]['password']));

	}

	// generate a secure hash based on login parameters
	private function codeSession($uid, $passwd, $time)
	{
		//echo "$passwd.$uid.$time<br />";
		return password_hash($passwd.$uid.$time, PASSWORD_DEFAULT, array());
	}

	private function validateSession($passwd, $uid, $time, $session)
	{
		//echo "$passwd.$uid.$time<br />$session<br />";
		return password_verify($passwd.$uid.$time, $session);
	}

	// validate by login, session key parameter, or (if enabled) cookie.
	// returns user array containing session key or false
	// refresh: reset session timeout
	public function login($refresh = false)
	{
		//print_r($_REQUEST);
		if ($this->request('logout',''))
		{
			setcookie('login', '', time());
			//echo ('logging off');
			return;
		}
		$this->user = false;
		$u = $this->request('u', '');
		if ($u)	// user ID supplied
		{
			$fetch = $this->database->fetchall('users',
				array(
					//'user_name'=>$u
					'email'=>$u
				)
			);
			if ((count($fetch['fetch']) == 1) &&
				//(password_verify($this->request('p', ''), $fetch['fetch'][0]['password'])) )
				$this->validatehash($this->request('p', ''), $fetch['fetch'][0]['password']))
			{
				$this->user = $fetch['fetch'][0];
				$this->sessionexpires = time()+$this->sessiontime;
				$session = $this->codeSession($fetch['fetch'][0]['user_id'], $fetch['fetch'][0]['password'], $this->sessionexpires);
				//print_r($this->user); echo "<br><br>\n\n";
				unset($this->user['password']);
				$this->session = $session;
				//$this->user['session_key'] = $session;
			//	$nowtime = time();
			//	$expires = $nowtime + $this->sessiontime;
				if ($this->usecookie)
				{
					setcookie('login', $this->fullsession(), $this->sessionexpires);
				}
				$this->user['session_expires'] = $this->sessiontime;
				header( 'Location: index.php' );
			}
			//print_r ($fetch);
			$this->user = false;
			return false;
		}
		// no user login supplied, attempt session key
		//echo $this->request('login', ''), "<br>";
		//print_r($_REQUEST);
		//print_r($_COOKIE);
		$session = explode(':', $this->request('login', ''));
		if (count($session) > 1)
		{
			//print_r($session);
			//$fetch = $this->database->fetchall('users', array('id'=>$session[0])); //, 'session_key'=>$session[1]));
			$fetch = $this->database->fetch('users', $session[0]);
			//print_r ($fetch);
			if ((isset($fetch['fetch'])) && (count ($fetch['fetch']) >= 1))
			{
				//print_r ($fetch);
				//$this->user = $fetch['fetch'][0];
				$this->user = $fetch['fetch'];
				$nowtime = time();
				//echo $session[1],'<br />'.$nowtime.'<br />';
				if (($session[1] > $nowtime) &&
					($this->validateSession($fetch['fetch']['password'], $session[0], $session[1], $session[2])))
				{
					//$this->session = $this->user['session_key'];
					$this->user['session_expires'] = $session[1]-$nowtime;
					unset($this->user['password']);
					return $this->user;
				}
			}
			if ($fetch['errors'])
			{
				$this->errors = $fetch['errors'];
			}
			else
			{
				//echo "expired session";
				return false;
			}
		}

		return false;
	}
	
	function logout()
	{
		if ($this->user)
		{
			$this->sessionexpires = 0;
			setcookie('login', '', $this->sessionexpires);
		}
	}

	function fullsession()
	{
		return $this->user['user_id'].':'.$this->sessionexpires.':'.$this->session;
	}

	// a string to be included in URL parameters to maintain session
	public function loginstring()
	{
		return 'login='.urlencode($this->fullsession());
	}

	// properties to include in a form or other request not using GET parameters
	public function loginparams()
	{
		return array('login'=>urlencode($this->fullsession()));
	}

	// output session value as a hidden form field.
	public function formlogin()
	{
	?>
		<input type="hidden" name="login" value="<?php echo urlencode($this->fullsession()) ?>" />
	<?php
	}

	// create a new user.  Takes user_name and password from CGI params if not set.
	// caller is expected to have filled all required application specific fields.
	public function newuser($user)
	{
		if (!isset($user['user_name']))
		{
	//		$user['user_name'] = $this->request('u', '');
		}
		if (!isset($user['password']))
		{
			$user['password'] = $this->request('p', '');
		}
		$user['password'] = $this->hash($user['password']);
		unset($user['user_id']);	// safety
		//print_r($user);
		return $this->database->insert_array($user, 'users');
	}

	// verify that logged in user has selected priviledges
	public function require_priviledge($priv)
	{
		if (!$this->user)
		{
			return false;
		}
		if (!is_array($priv))
		{
			$priv = array($priv);
		}
		if (!$this->permissions)
		{
			$this->permissions = $this->database->fetchall('permissions', array('permission_id'=>$this->user['permission_id']));
		}
		if (!$this->permissions)
		{
			return false;
		}
		//print_r($this->permissions);
		foreach ($priv as $p)
		{
			if (!$this->permissions['fetch'][0][$p])
			{
				return false;
			}
		}

		return (true);
	}
}
?>
