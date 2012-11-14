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
 
class Frontpage extends CI_Controller {
 
	public function index() {
		
		$this -> load -> library('members');
		
		if( !$this -> members -> checkLoggedIn()) {
			
			redirect('/frontpage/login', 'refresh');
		
		} else {
			
			$this -> load -> view('template/header');
			$this -> load -> view('frontpage/index');
		}
	}
	
	public function login() {
		
		$this -> load -> library('members');
		
		if( !$this -> members -> checkLoggedIn()) {
			
			$data['inloggen'] = TRUE;
			$this -> load -> view('frontpage/login', $data);
			
		} else {
			
			redirect('/frontpage/index', 'refresh');
		}
	}
	
	public function inloggen() {
		
		$this -> load -> library('members');
		
		if( isset( $_POST['submit'] ) ) {
				
				$data['inloggen'] = FALSE;
			
				$this -> members -> username = $_POST['username'];
				$this -> members -> password = $_POST['password'];
				$this -> members -> loginUser();
				
				$this -> load -> view('frontpage/login', $data);
		
		} else {
			
			redirect('/frontpage/index', 'refresh');
		}
	}
	
	public function uitloggen() {
		
		$this -> load -> library('members');
		
		if( !$this -> members -> logout() ) {
			
			redirect('/frontpage/index', 'refresh');
		
		} else {
			
			$this -> load -> view('frontpage/loguit');
		}
	}
}
