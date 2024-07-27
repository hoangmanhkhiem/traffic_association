<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Search Page Template
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


echo '<div class="cmsmasters_search">' . "\n";


if (!have_posts()) : 
	$cmsmasters_option = schule_get_global_options();

	$heading_alignment = $cmsmasters_option['schule' . '_heading_alignment'];

	echo '<div class="cmsmasters_search_zero' . ($heading_alignment =='center' ? ' tac' : ($heading_alignment =='right' ? ' tar fr' : '')) . '">' . 
		'<h4>' . esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'schule') . '</h4>' . 
		'<br />';
		
		get_search_form();
		
	echo '</div>';
else : 
	while (have_posts()) : the_post();
		
		get_template_part('theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/template/archive');
		
	endwhile;
	
	
	echo cmsmasters_pagination();
endif;


echo '</div>' . "\n" . 
'</div>' . "\n" . 
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

