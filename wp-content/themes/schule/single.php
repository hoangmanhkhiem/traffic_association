<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.1.7
 * 
 * Single Post Template
 * Created by CMSMasters
 * 
 */


get_header();


list($cmsmasters_layout) = schule_theme_page_layout_scheme();


echo '<!-- Start Content -->' . "\n";


if ($cmsmasters_layout == 'r_sidebar') {
	echo '<div class="content entry">' . "\n\t";
} elseif ($cmsmasters_layout == 'l_sidebar') {
	echo '<div class="content entry fr">' . "\n\t";
} else {
	echo '<div class="middle_content entry">';
}


if (have_posts()) : the_post();
	echo '<div class="blog opened-article">';

	if ( 'tribe_event_series' === get_post_type( get_the_ID() ) ) {
		the_content();
	} else {
		get_template_part('theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/post-type/blog/post-single');
	}
	
	echo '</div>';
endif;


echo '</div>' . "\n" . 
'<!-- Finish Content -->' . "\n\n";


if ($cmsmasters_layout == 'r_sidebar') {
	echo "\n" . '<!-- Start Sidebar -->' . "\n" . 
	'<div class="sidebar">' . "\n";
	
	
	get_sidebar();
	
	
	echo "\n" . '</div>' . "\n" . 
	'<!-- Finish Sidebar -->' . "\n";
} elseif ($cmsmasters_layout == 'l_sidebar') {
	echo "\n" . '<!-- Start Sidebar -->' . "\n" . 
	'<div class="sidebar fl">' . "\n";
	
	
	get_sidebar();
	
	
	echo "\n" . '</div>' . "\n" . 
	'<!-- Finish Sidebar -->' . "\n";
}


get_footer();

