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
	protected $_oldPath;
	protected $_newPath;
	protected $_oldDirectory;
	protected $_newDirectory;
	public $scannedDirFolders = array();
	public $scannedDirFiles	 = array();

	
	/**
	 * Constructor
	 * 
	 */
	public function __construct() {
		
		$this -> CI =& get_instance();
		
		$this -> scannedDirFolders = array();
		$this -> scannedDirFiles	= array();
	}
	
	/**
	 * Set the old path to the directory
	 * 
	 * @param string $oldPath the old path
	 * 
	 */
	public function setOldPath($path) {
		
		if( is_dir( $path ) ) {
			
			$this -> _oldPath = $path;
			
		} else {
		
			$this -> createHeader('Directory Class - Booting');
			$this -> createLogLine('Oldpath: ' . $path . ' - Kon niet worden gevonden op de server');
			exit();
		} 
	}
	
	/**
	 * Set the new path to the directory
	 * 
	 * @param string $newPath the new path
	 * 
	 */
	public function setNewPath($path) {
		
		if( is_dir( $path ) ) {
			
			$this -> _newPath = $path;
			
		} else {
		
			$this -> createHeader('Directory Class - Booting');
			$this -> createLogLine('Newpath: ' . $path . ' - Kon niet worden gevonden op de server');
			exit();
		} 
	}
	
	/**
	 * Set the old directory
	 * 
	 * @param string $oldDirecotyr the old dir
	 * 
	 */
	public function setOldDirectory($directory) {
		
		if( is_dir( $this -> _oldPath . $directory ) ) {
			
			$this -> _oldDirectory = $directory;
			
		} else {
		
			$this -> createHeader('Directory Class - Booting');
			$this -> createLogLine('OldDirectory: ' . $directory . ' - Kon niet worden gevonden op de server');
			exit();
		} 
	}
	
	/**
	 * Set the old directory
	 * 
	 * @param string $oldDirecotyr the old dir
	 * 
	 */
	public function setNewDirectory($directory) {
		
		if( is_dir( $this -> _newPath . $directory ) ) {
			
			$this -> _newDirectory = $directory;
			
		} else {
		
			$this -> createHeader('Directory Class - Booting');
			$this -> createLogLine('NewDirectory: ' . $directory . ' - Kon niet worden gevonden op de server');
			exit();
		} 
	}

	/**
	 * Scan a directory
	 * 
	 * @param string $dir the older that must be scanned
	 */
	public function scanDir($dir = '' ) {
		
		// Create log header
		$this -> createHeader('Directory Class - ScanDir');
		
		// CHeck if $dir is empty
		if( empty( $dir ) ) {
			
			$dir = $this -> oldDirPath();
		}
		
		// scan the dir
		$aScannedDir = scandir( $dir );
		
		// check if the folder that must scanned a folder is
		if( !$aScannedDir ) {
			
			//log
			$this -> createLogLine('Kon de map niet scannen - Map: ' . $dir);
		
		} else {
			
			//log
			$this -> createLogLine('Scannen... - Map: ' . $dir);
			
			//Fecht the folder trap
			$this -> _fetchScanDir( $aScannedDir, $dir );
			
		}
	}
	
	
	/**
	 * Move a scanned folder to a new place
	 * 
	 * @param string $oldDir the old folder 
	 * @param string $newDir the new folder
	 */
	public function moveDir($oldDir = '', $newDir = '') {	
		
		// Create log header
		$this -> createHeader('Directory Class - moveDir');
		
		if( empty( $oldDir ) ) {
			
			$oldDir = $this -> oldDirPath();
		}
		
		if( empty( $newDir ) ) {
			
			$newDir = $this -> newDirPath();
		}
		
		$scannedDir = $this -> scanDir($oldDir);
		
		// Create log header
		$this -> createHeader('Directory Class - moveDir');
		
		foreach( $this -> scannedDirFolders as $key => $folder ) {
			
			$newFolderName = $this -> _replaceName( $folder );
			
			$oldPath = $this -> oldDirPath() . $folder;
			$newPath = $this -> newDirPath() . $newFolderName;
			
			$command = 'mv "' . $oldPath . '" "'. $newPath .'"';
			
			$this -> _runCommand($command);
			
			$this -> createLogLine('Kopieeren van '. $oldPath . ' naar ' . $newPath);
			$this -> createLogLine('Commandline output:'. $this -> _shellOutput);
			$this -> createLogLine('Commandline result:'. $this -> _shellResult);
			
			$command = 'rm -rf "' . $oldPath . '"';
			
			$this -> _runCommand($command);
			
			$this -> createLogLine('Kopieeren van '. $oldPath . ' naar ' . $newPath);
			$this -> createLogLine('Commandline output:'. $this -> _shellOutput);
			$this -> createLogLine('Commandline result:'. $this -> _shellResult);
		}
		
		
	}
	
	/**
	 * Run a command in the shell
	 * 
	 * @param string $command the shell command
	 */
	private function _runCommand($command) {
		
		exec($command, $this -> _shellOutput, $this -> _shellResult);
	}
	
	/**
	 * Fetch the scanned array
	 * 
	 * @param array $array folder array
	 * @param string $dir the path to the scanned folder
	 */
	private function _fetchScanDir( $array, $dir ) {
		
		//Count
		$dCount = 0;
		$fCount = 0;
		
		// Foreach the array
		foreach( $array as $key => $name ) {
			
			// Delete soms not needed folders
			if( $name == '.' or $name == '..' ) {
				
				//Nothing
				
			} else {
				
				// Check if it is a folder of a file
				if( is_dir( $dir . $name ) ) {
					
					// Add to folder array
					$this -> scannedDirFolders[$dCount] = $name;
					$dCount++;
					
					$this -> createLogLine('Gescande map word toegevoed aan array - Map: ' . $dir . $name);
				
				} else {
					
					// Add to file array
					$this -> scannedDirFiles[$fCount] = $name;
					$fCount++;
					
					$this -> createLogLine('Gescande bestand word toegevoed aan array - Bestand: ' . $dir . $name);
				}
			}
		}
	}
	
	/**
	 * New dir path
	 */
	public function newDirPath() {
		
		return $this -> _newPath . $this -> _newDirectory;
	}
	
	/**
	 * Old dir path
	 */	
	public function oldDirPath() {
		
		return $this -> _oldPath . $this -> _oldDirectory;
	}
	
	private function _replaceName($folderName) {
		
		return str_replace(' ', '_', $folderName);
	}
	
	private function createLogLine($test) {
		
	}
	
	private function createHeader($test) {
		
	}
}