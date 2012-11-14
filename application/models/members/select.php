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
 
class Select extends CI_Model {
		
	function __construct() {
		
        // Call the Model constructor
        parent::__construct();
    }
	
	public function checkUserExist($array) {
		
		$this -> db -> select('ID');
		$this -> db -> from('Members');
		$this -> db -> where($array);
		$this -> db -> limit('1');
		if( $this -> db -> count_all_results() != 0 ) {
			
			return false;
			
		} else {
			
			return true;
		}
	}
	
	public function loginUser($array) {
		
		$this -> db -> select('ID');
		$this -> db -> from('Members');
		$this -> db -> where($array);
		$this -> db -> limit('1');
		
		if( $this -> db -> count_all_results() == 0 ) {	
			
			return false;
			
		} else {
			
			return true;
		}
	}
	
	public function checkLoginKey($loginKey, $username) {
		
		$loginKey = addslashes($loginKey);
		$username = addslashes($username);
		
		$this -> db -> select('ID');
		$this -> db -> from('Login_Sessions');
		$this -> db -> where('username', $username);
		$this -> db -> where('key', $loginKey);
		$this -> db -> limit(1);
		
		if( $this -> db -> count_all_results() == 0 ) {	
			
			return false;
			
		} else {
			
			return true;
		}
		
	}
	
	public function memberList($db) {
		
		$this -> db -> select($db);
		$this -> db -> from('Members');
		$this -> db -> order_by('ID', "asc");
		
		return $this -> db -> get(); 
	}
	
	public function getUserById($id) {
		
		$this -> db -> select('*');
		$this -> db -> from('Members');
		$this -> db -> where('ID', $id);
		$this -> db -> limit('1');
		
		return $this -> db -> get();
	}
}
