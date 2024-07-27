<?php

class LS_TransitionPresets {

	public static function get() {

		// Import $presets
		include_once LS_ROOT_PATH.'/config/transition-presets.php';

		$customPresets = get_option('ls-transition-presets', '[]' );
		$customPresets = json_decode( $customPresets, true );
		$customPresets = ! empty( $customPresets ) ? $customPresets : [];

		foreach( $presets as $categoryKey => &$category ) {

			// Add "protected" key to the default presets
			foreach( $category as &$preset) { $preset['protected'] = true; }

			if( ! empty( $customPresets[ $categoryKey ] ) ) {
				$category = array_merge( $category, $customPresets[ $categoryKey ] );
			}
		}

		return $presets;

	}

	public static function save( $data ) {
		return update_option( 'ls-transition-presets', $data, false );
	}
}