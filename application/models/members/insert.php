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
 
class Insert extends CI_Model {
		
	function __construct() {
		
        // Call the Model constructor
        parent::__construct();
    }
	
	public function user($array) {
		
		return $this -> db -> insert('Members', $array);
	}
	
	public function setLoginKey($array) {
		
		return $this -> db -> insert('Login_Sessions', $array);
	}
}
