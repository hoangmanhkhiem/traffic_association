<?php

// Prevent direct file access
defined( 'LS_ROOT_FILE' ) || exit;

class LS_Modules {

	protected $moduleList;

	public $uploadsDir;
	public $uploadsBaseDir;
	public $uploadsBaseURL;
	public $modulesDir;
	public $modulesURL;


	public function __construct() {

		$this->uploadsDir 		= wp_get_upload_dir();
		$this->uploadsBaseDir 	= $this->uploadsDir['basedir'];
		$this->uploadsBaseURL 	= $this->uploadsDir['baseurl'];
		$this->modulesDir 		= $this->uploadsBaseDir.'/layerslider/modules';
		$this->modulesURL 		= $this->uploadsBaseURL.'/layerslider/modules';

		$this->moduleList 		= LS_RemoteData::get('modules');

	}


	public function getModuleData( $handle ) {

		if( empty( $this->moduleList[ $handle ] ) ) {
			return false;
		}

		$moduleData = $this->moduleList[ $handle ];
		$moduleDir 	= $this->modulesDir.'/'.$moduleData['handle'];
		$needsDL 	= ! file_exists( $moduleDir ) || count( glob( "$moduleDir/*" ) ) === 0;

		$moduleData['baseURL'] 		= $this->modulesURL.'/'.$moduleData['handle'];
		$moduleData['installed'] 	= ! $needsDL;
		$moduleData['needsDL'] 		= $needsDL;

		return $moduleData;
	}


	public function getAllModuleData() {

		$modules = [];

		foreach( $this->moduleList as $moduleKey => $moduleData ) {
			$modules[ $moduleKey ] = $this->getModuleData( $moduleKey );
		}

		return $modules;
	}

}