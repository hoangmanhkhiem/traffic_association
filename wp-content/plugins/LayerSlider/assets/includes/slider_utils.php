<?php

// Prevent direct file access
defined( 'LS_ROOT_FILE' ) || exit;

function layerslider_builder_convert_numbers(&$item, $key) {
	if(is_numeric($item)) {
		$item = (float) $item;
	}
}

function ls_ordinal_number($number) {
    $ends = ['th','st','nd','rd','th','th','th','th','th','th'];
    $mod100 = $number % 100;
    return $number . ($mod100 >= 11 && $mod100 <= 13 ? 'th' :  $ends[$number % 10]);
}


function layerslider_check_unit($str, $key = '') {

	if( strstr($str, 'px') == false && strstr($str, '%') == false && strstr($str, 'em') == false && strstr($str, 'vw') == false ) {
		if( $key !== 'z-index' && $key !== 'font-weight' && $key !== 'opacity') {
			return $str.'px';
		}
	}

	return $str;
}

function ls_get_markup_image( $id, $attrs = [] ) {
	return wp_get_attachment_image( $id, 'full', false, $attrs );
}

function ls_lazy_loading_cb() {
	return false;
}

function ls_assets_cond( $data = [], $key = 0 ) {

	if( ! $GLOBALS['lsIsActivatedSite'] ) {

		if( ! empty( $data['isAsset'] ) ) {
			return false;
		}

		if( ! empty( $data[ $key ] ) && strpos( $data[ $key ], '/layerslider/assets/' ) !== false ) {
			return false;
		}
	}

	return true;

}

function ls_normalize_hide_layer_value( $value = false ) {
	if( $value === 'editor' || $value === 'all' ) {
		return $value;
	}

	$value = !! $value;

	return $value ? 'all' : false;
}