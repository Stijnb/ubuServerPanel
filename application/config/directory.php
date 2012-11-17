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
 
$config['musicMime'] = array(   'audio/basic',
								'audio/mid',
								'audio/mid',
								'audio/mpeg',
								'audio/x-aiff',
								'audio/x-aiff',
								'audio/x-aiff',
								'audio/x-mpegurl',
								'audio/x-pn-realaudio',
								'audio/x-pn-realaudio',
								'audio/x-wav',
								'audio/mp4');

$config['movieMime'] = array(	'video/mpeg',
								'video/quicktime',
								'video/quicktime',
								'video/x-la-asf',
								'video/x-la-asf',
								'video/x-ms-asf',
								'video/x-ms-asf',
								'video/x-ms-asf',
								'video/x-msvideo',	
								'video/x-sgi-movie',
								'video/mp4');

$config['appMime'] = array(		'application/zip',
								'application/x-tar',
								'application/x-gtar',
								'application/x-gzip',
								'application/x-compressed',
								'application/octet-stream',
								'application/x-iso9660-image',
								'application/x-apple-diskimage',
								'application/x-rar-compressed');
								
$config['hdd'] = array(	'music' => '/hdd/music/',
						'movie' => '/hdd/movie/',
						'app'	=> '/hdd/app/');
						
$config['complete'] = array( 'path' => '/hdd/',
							 'folder' => 'download/');
