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

class directory_ {
	
	private $CI; // Codigniter	
	public $folderData = array();
	public $folderArray = array();
	public $strippedFolder = array();
	public $strippedFiles = array();

	/**
	 * Constructor
	 * 
	 */
	public function __construct() {
		
		$this -> CI =& get_instance();
		
	}
	
	/**
	 * __Get function
	 * 
	 */
	public function __get($name) {
		
		if( isset( $this -> folderData[$name]) ) {
			
			return $this -> folderData[$name];
		
		} elseif( isset( $this -> $name ) ) {
			
			return $this -> $name;
		}
	}
	
	/**
	 * __Set function
	 * 
	 */
	public function __set($name, $value) {
			
		$this -> folderData[$name] = $value;
	}
	
	/**
	 * __Isset function
	 */
	public function __isset($name) {
		
		if( isset($this -> folderData[$name]) ) {
			
			return true;
			
		} else if(isset($this -> $name)) {
			
			return true;
			
		} else {
			
			return false;
		}
	}
	
	/**
	 * Scan the needed folder 
	 * 
	 * @param string $path path to the folder
	 * @param string $folder the folder name
	 */
	public function scanFolder() {
			
		$this -> CI -> load -> helper('directory');
		
		if( empty($this -> folder) OR !is_dir($this -> path . $this -> folder ) ) {
			
			return false;
		
		} else {
			
			$this -> folderArray = directory_map($this -> path . $this -> folder, $this -> folderData['directorySettings']);
		}
	}
	
	public function copyToCorrectFolder($array = '') {

		if( empty( $array ) ) {
			
			$array = $this -> folderArray;
		}
				
		foreach($array as $key => $name ) {
			
			if( is_array($array[$key]) ) {
				
				$this -> countFiles = 0;
				$this -> countMusic = 0;
				$this -> countMovie = 0;
				$this -> countApp	= 0;
								
				foreach( $array[$key] as $id => $file ) {
					
					if( is_array( $array[$key][$id]) ) {
						
						foreach( $array[$key][$id] as $sId => $sFile ) {
						
							$this -> fileType($key . '/' . $id . '/' . $sFile);
						}
					
					} else {
						
						$this -> fileType($key . '/' . $file); 
						
					}
					
				}
				
				$this -> moveFolder($key);
			}
		}
	}
	
	public function fileType($file) {
		
		if( is_file( $this -> path . $this -> folder . $file) ) {
			
			$contentMime = mime_content_type($this -> path . $this -> folder . $file);
			
			$this -> CI -> config -> load('directory');
			
			if( in_array($contentMime, $this -> CI -> config -> item('musicMime') ) ) {
				
				$this -> countMusic++;
			
			} elseif( in_array($contentMime, $this -> CI -> config -> item('movieMime') ) ) {
				
				$this -> countMovie++;
			
			} elseif( in_array($contentMime, $this -> CI -> config -> item('appMime') ) ) {
				
				$this -> countApp++;
			
			}
		}
	}
	
	public function foldertype() {
		
		if( $this -> countMusic > $this -> countMovie or $this -> countMusic > $this -> countApp) {
			
			$type = 'music';
		
		} elseif( $this -> countMovie > $this -> countMusic or $this -> countMovie > $this -> countApp) {
			
			$type = 'movie';
		
		} elseif( $this -> countApp > $this -> countMusic or  $this -> countApp > $this -> countMovie ) {
			
			$type = 'app';
		
		} else {
			
			$type = 'unkown';
		}
		
		return $type;
		
	}
	
	public function moveFolder($folderArray) {
		
		$this -> CI -> config -> load('directory');
		
		$hdd = $this -> CI -> config -> item('hdd');
		
		$hdd = $hdd[$this -> foldertype()];
		
		$oldFolder = $this -> path . $this -> folder . $folderArray;
		
		$newFolder = $hdd . $folderArray;
		
		$this -> moveCommand($oldFolder, $newFolder);
		
		if( is_dir($newFolder) ) {
			
			$this -> deleteCommand($oldFolder);
		}
		
	}
	
	public function toDownloadHdd() {

		$this -> CI -> config -> load('directory');
		$nFolderPath = $this -> CI -> config -> item('complete');
		$newPath = $nFolderPath['path'];
		$newFolder = $nFolderPath['folder'];
		
		foreach($this -> folderArray as $key => $name ) {
			
			if( is_array($this -> folderArray[$key]) ) {
				
				if( is_dir($this -> path . $this -> folder . $key) ) {
					
					$this -> moveCommand($this -> path . $this -> folder . $key, $newPath . $newFolder . $this -> _replaceName($key) );	
				}
				
				if( is_dir($newPath . $newFolder . $this -> _replaceName($key) ) ) {
					
					$this -> deleteCommand($this -> path . $this -> folder . $key);
				}
			}
		}
	}
	
	private function moveCommand($oldFolder, $newFolder) {
		
		$command = 'mv "' . $oldFolder . '" "' . $newFolder . '"';
		exec($command);
	}

	private function deleteCommand($folder) {
		
		$command = 'rm -rf "'.$folder.'"';
		exec($command);
	}
	
	private function _replaceName($folderName) {
		
		return str_replace(' ', '_', $folderName);
	}
	
 	function mimeArray($url = 'http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types'){
    $s=array();
    foreach(@explode("\n",@file_get_contents($url))as $x)
        if(isset($x[0])&&$x[0]!=='#'&&preg_match_all('#([^\s]+)#',$x,$out)&&isset($out[1])&&($c=count($out[1]))>1)
            for($i=1;$i<$c;$i++)
                $s[]='&nbsp;&nbsp;&nbsp;\''.$out[1][$i].'\' => \''.$out[1][0].'\'';
    return @sort($s)?'$mime_types = array(<br />'.implode($s,',<br />').'<br />);':false;
	}
	
}