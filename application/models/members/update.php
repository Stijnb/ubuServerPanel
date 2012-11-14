<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * UbuServerPanel
 *
 * An Server panel for one linux server
 *
 * @package		UbuServerPanel
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2012 Bourdeaux Stijn
 * @since		Version 1.0
 * @filesource
 */
 
class Update extends CI_Model {
		
	function __construct() {
		
        // Call the Model constructor
        parent::__construct();
    }
	
	public function deleteUser($id) {
		
		$id = addslashes($id);
		
		$this -> db -> where('ID', $id);
		return $this -> db -> delete('Members');
	}
	
	public function changeUserById($id, $array) {
		
		$id = addslashes($id);
		
		$this -> db -> where('ID', $id);
		return $this -> db -> update('Members', $array);
		
	}
}
