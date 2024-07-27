<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Blog Archive by Author Page Template
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


echo '<div class="cmsmasters_archive">' . "\n";


schule_author_box();


if (!have_posts()) : 
	echo '<h2>' . esc_html__('No posts found', 'schule') . '</h2>';
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

