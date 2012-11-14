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
 
/**
 * Register check
 * 
 * The register input fields that not must be empty
 */
$config['registerCheck'] = array(	'username',
									'password',
									'password_check',
									'email_adress');

/**
 * Register database
 * 
 * Where the input fields must be putted in the database
 */
$config['registerDb'] = array(	'username'	=> 'username',
								'password'	=> 'password',
								'email_adress' => 'email');
								
$config['loginCheck'] = array(	'username',
								'password');

$config['loginDb'] = array(	'username'	=> 'username',
							'password'	=> 'password');
							
$config['memberlist'] = array(	'ID' => 'ID',
								'Gebruikersnaam' => 'username',
								'E-mail Adres' => 'email');
								
$config['changeUser'] = array(	'Gebruikersnaam' => 'username',
								'E-mail Adres' => 'email');
