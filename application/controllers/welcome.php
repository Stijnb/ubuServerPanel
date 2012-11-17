<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this -> load -> library('members');
		
		$this->load->view('welcome_message');
	}
	
	public function registreren() {
		
		$this->output->enable_profiler(TRUE);
		$this -> load -> library('members');
		
		$this -> members -> checkUserExist('', '');
		
		$this -> members -> username = 'Pieter-Jan';
		$this -> members -> password = 'quisoft1';
		$this -> members -> password_check = 'quisoft1';
		$this -> members -> email_adress = 'pieterjan.dewaele@telenet.be';
		
		$this -> members -> registerUser();
		
		echo $this -> members -> error_username;
		echo $this -> members -> error_password;
		echo $this -> members -> error_password_check;
		echo $this -> members -> error_email_adress;
		echo $this -> members -> error_database;
		
		if( !$this -> members -> error ) {
			
			echo 'false';
		
		} else {
			
			echo 'true';
		} 
	}
	
	public function dirtest() {
		
		$this -> load -> library('directory_');
		header( 'Content-Type: text/html; charset=UTF-8' );
		$this -> directory_ -> path = '/hdd/';
		$this -> directory_ -> folder = 'download/';
		$this -> directory_ -> directorySettings = 'False, TRUE';
		$this -> directory_ -> scanFolder();
		$this -> directory_ -> stripArray();
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */