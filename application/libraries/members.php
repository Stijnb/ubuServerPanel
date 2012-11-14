<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * UbuServerPanel
 *
 * An Server panel for one linux server
 *
 * @package		UbuServerPanel
 * @author		Bourdeaux stijn
 * @copyright	Copyright (c) 2012 Bourdeaux Stijn
 * @since		Version 1.0
 * @filesource
 */

class Members {
	
	private $CI; // Codigniter
	public $userData = array(); //Userdata Array
	public $errorData = array(); //Error Array
	
	/**
	 * Constructor
	 * 
	 */
	public function __construct() {
		
		$this -> CI =& get_instance();
		
		$this -> CI -> config -> load('members');
		
		$this -> CI -> load -> model('members/select', 'mbSelect');
		$this -> CI -> load -> model('members/insert', 'mbInsert');
		$this -> CI -> load -> model('members/update', 'mbUpdate');
	}
	
	/**
	 * __Get function
	 * 
	 */
	public function __get($name) {
		
		if( isset($this -> userData['user_'.$name]) ) {
				
			return $this -> userData['user_'.$name];
			
		} else if( isset($this -> userData[$name]) ) {
		
			return $this -> userData[$name];
			
		} else if(isset($this -> $name)) {
			
			return $this -> $name;
		}
	}
	
	/**
	 * __Set function
	 * 
	 */
	public function __set($name, $value) {
		
		if( $name == 'username' ) {
			
			$this -> userData['username'] = $value; 
		
		} else {
			
			$this -> userData[$name] = $value;
		} 
	}
	
	/**
	 * __Isset function
	 */
	public function __isset($name) {
		
		if( isset($this -> userData['user_'.$name]) ) {
			
			return true;
			
		} else if( isset($this -> userData[$name]) ) {
			
			return true;
			
		} else if(isset($this -> $name)) {
			
			return true;
			
		} else {
			return false;
		}
	}
	
	/**
	 * Check if the user is loggedin
	 * 
	 */
	public function checkLoggedIn() {
		
		$loginKey = $this -> CI -> session -> userdata('Login_Key');
		$loginUsername = $this -> CI -> session -> userdata('Login_Username');
		
		if( !$loginKey OR !$loginUsername ) {
			echo '1';
			$this -> CI -> session -> sess_destroy();
			return false;
		
		} else {
			
			if( !$this -> CI -> mbSelect -> checkLoginKey($loginKey, $loginUsername) ) {
				
				$this -> CI -> session -> sess_destroy();
				return false;
				echo '2';
			
			} else {
				
				return true;
			}
		}
	}
	
	/**
	 * Log the user out
	 * 
	 */
	public function logout() {
		
		$this -> CI -> session -> sess_destroy();
		
		$loginKey		= $this -> CI -> session -> userdata('Login_Key');
		$loginUsername 	= $this -> CI -> session -> userdata('Login_Username');
		
		if( !$loginKey AND !$loginUsername ) {
			
			return true;
		
		} else {
			
			return false;
		}
	}
	/**
	 * Login the user
	 */
	public function loginUser() {
		
		$this -> error = FALSE;
		
		// Load config
		$loginArray = $this -> CI -> config -> item('loginCheck');
		$configDbArray = $this -> CI -> config -> item('loginDb');
		
		// Check on empty fields
		foreach( $loginArray as $field ) {
			
			$checkEmpty = trim( $this -> userData[$field] );
			
			if( empty( $checkEmpty ) ) {
				
				$this -> userData['error_'.$field] = 'U bent '.$field.' vergeten intevullen';
				$this -> error = TRUE;
			}
		}
		
		if( !$this -> error ) {
			
			$this -> password = $this -> encryptPassword($this -> password);
		}
		
		if( !$this -> error ) {
			
			foreach( $configDbArray as $fieldName => $dbName ) {
				
				$dbArray[$dbName] = $this -> userData[$fieldName];
			}
			
			if( !$this -> CI -> mbSelect -> loginUser($dbArray) ) {
				
				$this -> error_username = 'De gegevens die u hebt ingevuld kloppen niet';
				$this -> error = TRUE;
			
			} else {
				
				$key = $this -> generateSessionKey();
				
				$this -> CI -> session -> set_userdata('Login_Key', $key);
				$this -> CI -> session -> set_userdata('Login_Username', $this -> username);
				
				$dbArray = array(	'username' => $this -> username,
									'key'	   => $key);
									
				$this -> CI -> mbInsert -> setLoginKey($dbArray);
				
				$this -> error = FALSE;
			}
		}
	}
	/**
	 * Check if there a user exist with the same username or email
	 * 
	 */
	public function checkUserExist($userName, $mail ) {
		
		$userName = addslashes($userName);
		$mail	  = addslashes($mail);
		
		$dbArray  = array(	'username' => $userName,
							'email'	   => $mail);
							
		if( !$this -> CI -> mbSelect -> checkUserExist($dbArray) ) {
			
			$this -> errorData['error_username'] = 'Er bestaad al een gebruiker met dit email adres of gebruikersnaam';
			$this -> error_email_adress = TRUE;
			$this -> error = TRUE;
		
		} else {
			
			$this -> error = FALSE;
		}	
	}
	
	/** 
	 * Register the user in the database
	 * 
	 */
	public function registerUser() {
		
		$configRArray = $this -> CI -> config -> item('registerCheck');
		
		$this -> error = FALSE;
		
		// Check if somthing empty
		foreach( $configRArray as $field ) {
			
			$checkEmpty = trim( $this -> userData[$field] );

			if(  empty( $checkEmpty ) ) {
				
				$this -> errorData['error_'.$field] =  'U hebt '. $field .' niet ingevuld!<br />';
				$this -> error = TRUE;
			}			
		}
		
		// Check the passwords
		if( $this -> error == FALSE ) {

			if( !$this -> checkPassword() ) {
				
				$this -> error = TRUE;
			}
		}
		
		// Check e-mail
		if( $this -> error == FALSE ) {
			
			if( $this -> error_email_adress ) {
				
				$this -> error = TRUE;
			}
		}
		
		// Make the user in the database
		if( $this -> error == FALSE ) {

			$configDbArray = $this -> CI -> config -> item('registerDb');
			
			foreach( $configDbArray as $fieldName => $dbName ) {
				
				$dbArray[$dbName] = addslashes( $this -> userData[$fieldName] );
			}
			
			if( !$this -> CI -> mbInsert -> user($dbArray) ) {
				
				$this -> errorData['error_database'] = 'De gebruiker kon niet worden aangemaakt in de database.<br />';
				$this -> error = TRUE;
				
			}
		}
		
	}

	/**
	 * Get The members out of the database
	 * 
	 */
	public function memberList() {
		
		$this -> memberListConfig = $this -> CI -> config -> item('memberlist');
		
		$db = '';
		foreach($this -> memberListConfig as $name => $dbName) {
			
			$db .= $dbName.',';
		}
		
		return $this -> CI -> mbSelect -> memberList($db);
	}
	
	/**
	 * Delete the user by id
	 * 
	 */
	public function deleteUser() {
		
		return $this -> CI -> mbUpdate -> deleteUser($this -> id);
	}
	
	/**
	 * Get user data by user id
	 * 
	 */
	public function getUserById() {
		
		$this -> changeUserConfig = $this -> CI -> config -> item('changeUser');
		
		return $this -> CI -> mbSelect -> getUserById($this -> id);
	}
	
	public function changeUserById() {
		
		$this -> error = false;
		
		foreach($this -> changeUserConfig as $name => $dbName ) {
			
			if( empty($this -> userData[$dbName]) ) {
				
				$this -> errorData[$dbName] = 'U hebt '.$name.' niet ingevuld.';
				$this -> error = true;
			}
		}
		
		if( !$this -> error ) {
			
			foreach( $this -> changeUserConfig as $name => $dbName ) {
				
				$dbArray[$dbName] = addslashes( $this -> userData[$dbName]);
			}
			
			if( !$this -> CI -> mbUpdate -> changeUserById($this -> id, $dbArray) ) {
				
				$this -> errorData['database'] = 'De gebruiker kon niet worden bewerkt';
				$this -> error = true;
			}
		}
		
	}
	/**
	 * Check the password of the register function
	 * 
	 */
	private function checkPassword() {
		
		if( strlen($this -> password) < 8 ) {
			
			$this -> error_password = 'Uw wachtwoord moet minstens 8 tekensbevatten.<br />';
			return false;
			
		} else {
			
			$this -> password = $this -> encryptPassword($this -> password);
			$this -> password_check = $this -> encryptPassword($this -> password_check);
			
			if( $this -> password == $this -> password_check ) {
				
				return true;
			
			} else {
				
				$this -> error_password = 'De wachtwoorden kommen niet overeen.<br />';
				return false;
			}
		}
	}
	
	/**
	 * check if the email adress is correct
	 * 
	 */
	private function checkEmail() {
		
		$this -> CI -> load -> helper('email');
		
		if( !valid_email($this -> email_adress) ) {
			
			$this -> error_email_adress = 'Uw e-mail adress is niet correct';
			return false;
		
		} else {
			
			return true;
		}
	}
	
	/**
	 * Password Encryption
	 * 
	 * @param string $password The password
	 */
	private function encryptPassword($password) {
		
		$salt = '2aD3hj4j8IKNnbgd46QSsgh37';
		$salt = md5($salt);
		
		return hash('sha512', $password.$salt);
	 }

	
	private function generateSessionKey() {
		
		$salt = '3ds1k4p9pds5j5knJDSndsQa34uD';
		$salt = md5($salt);
		
		$key = $_SERVER['REMOTE_ADDR'] . $this -> username . date('r') . rand(1890, 9999999);
		
		return hash('sha256', $key.$salt); 
	}
}	
