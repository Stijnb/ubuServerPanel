<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * UbuServerPanel
 *
 * An Server panel for one linux server
 *
 * @package		UbuServerPanel
 * @author		Bourdeaux stijn
 * @copyright	Copyright (c) 2012 Bourdeaux Stijn
 * @filesource
 */
 
class Gebruikers extends CI_Controller {
	
	public function index() {
		
		$this -> load -> library('members');
		
		if( !$this -> members -> checkLoggedIn()) {
			
			redirect('/frontpage/login', 'refresh');
		
		} else {
			
			$data['classCount'] = 1;
			$this -> load -> view('template/header');
			$this -> load -> view('gebruikers/gebruikerslijst', $data);
		}
	}
	
	public function aanmaken() {
		
		$this->output->enable_profiler(TRUE);
		$this -> load -> library('members');
		
		if( !$this -> members -> checkLoggedIn()) {
			
			redirect('/frontpage/login', 'refresh');
		
		} else {
			
			if( isset( $_POST['aanmaken'] ) ) {
				
				$this -> members -> username = $_POST['username'];
				$this -> members -> password = $_POST['password'];
				$this -> members -> password_check = $_POST['password_check'];
				$this -> members -> email_adress = $_POST['email_adress'];
				
				$this -> members -> checkUserExist($this -> members -> username, $this -> members -> email_adress);
				
				if( !$this -> members -> error ) {
					
					$this -> members -> registerUser();
				}
		
		
				$data['aanmaken'] = true;
			
			} else {
				
				$data['aanmaken'] = false;
			}
			
			$this -> load -> view('template/header');
			$this -> load -> view('gebruikers/aanmaken', $data);
		}
	}

	public function verwijderen($id) {
		
		$this->output->enable_profiler(TRUE);
		$this -> load -> library('members');
		
		if( !$this -> members -> checkLoggedIn()) {
			
			redirect('/frontpage/login', 'refresh');
		
		} else {
			
			$this -> members -> id = $id;
			
			if( !$this -> members -> deleteUser() ) {
				
				$this -> load -> view('template/header');
				$this -> load -> view('gebruikers/verwijderen');
			
			} else {
				
				redirect('/gebruikers/index', 'refresh');
			}
		}
	}
	
	public function aanpassen($id) {
		
		$this->output->enable_profiler(TRUE);
		$this -> load -> library('members');
		
		if( !$this -> members -> checkLoggedIn()) {
			
			redirect('/frontpage/login', 'refresh');
		
		} else {
			
			$this -> members -> id = $id;
			
			$data['query'] 		= $this -> members -> getUserById();
			$data['classCount'] = 1;
			
			if( isset($_POST['aanpassen']) ) {
				
				$this -> members -> username = $_POST['username'];
				$this -> members -> email = $_POST['email'];
				
				$this -> members -> changeUserById();
				$data['form'] = 'send';
			
			} else {
				
				$data['form'] = 'nosend';
			}
			
			$this -> load -> view('template/header');
			$this -> load -> view('gebruikers/aanpassen', $data);
		}
	}
}
	