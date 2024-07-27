<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.0.0
 * 
 * CMSMasters Donations Form Abstract Class
 * Created by CMSMasters
 * 
 */


abstract class Cmsmasters_Donations_Form {
	protected static $fields;
	
	protected static $action;
	
	protected static $errors = array();
	
	
	public static function add_error($error) {
		self::$errors[] = $error;
	}
	
	
	public static function show_errors() {
		foreach (self::$errors as $error) {
			echo '<div class="cmsmasters-donations-error">' . $error . '</div>';
		}
	}
	
	
	public static function get_action() {
		return self::$action;
	}
	
	
	public static function priority_cmp($a, $b) {
		if ($a['priority'] == $b['priority']) {
			return 0;
		}
		
		
		return ($a['priority'] < $b['priority']) ? -1 : 1;
	}
	
	
	public static function get_fields($key) {
		if (empty(self::$fields[$key])) {
			return array();
		}
		
		
		$fields = self::$fields[$key];
		
		
		uasort($fields, __CLASS__ . '::priority_cmp');
		
		
		return $fields;
	}
}

