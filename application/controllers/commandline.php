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
 
class Commandline extends CI_Controller {
	
	public function downloadToFolder($password) {
		
		if( empty($password) or $password != 'password') {
			
			exit;
		
		} else {
			
			$this -> load -> library('directory_');
			header( 'Content-Type: text/html; charset=UTF-8' );
			$this -> directory_ -> path = '/hdd/';
			$this -> directory_ -> folder = 'download/';
			$this -> directory_ -> directorySettings = 'False, TRUE';
			$this -> directory_ -> scanFolder();
			$this -> directory_ -> stripArray();
		} 
	}
}
