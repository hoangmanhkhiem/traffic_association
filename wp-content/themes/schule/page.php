<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.1.0
 * 
 * Default Page Template
 * Created by CMSMasters
 * 
 */


get_header();


list($cmsmasters_layout) = schule_theme_page_layout_scheme();

if (is_singular('lp_course')) {
	$cmsmasters_lpr_course_title = get_post_meta(get_the_ID(), 'cmsmasters_lpr_course_title', true);

	$cmsmasters_lpr_course_image = get_post_meta(get_the_ID(), 'cmsmasters_lpr_course_image', true);
}

echo '<!-- Start Content -->' . "\n";


if ($cmsmasters_layout == 'r_sidebar') {
	echo '<div class="content entry">' . "\n\t";
} elseif ($cmsmasters_layout == 'l_sidebar') {
	echo '<div class="content entry fr">' . "\n\t";
} else {
	echo '<div class="middle_content entry">';
}


if (have_posts()) : the_post();
	$content_start = substr(ltrim(get_post_field('post_content', get_the_ID())), 0, 15);
	
	
	if (!is_singular('lp_course') && $cmsmasters_layout == 'fullwidth' && $content_start === '[cmsmasters_row') {
		echo '</div>' . 
		'</div>';
	}

	if (is_singular('lp_course')) {
		if ($cmsmasters_lpr_course_title == 'true') {
			the_title( '<h2 class="entry-title cmsmasters_course_title">', '</h2>' );
		}
		
		if ($cmsmasters_lpr_course_image == 'true' && has_post_thumbnail()) {
			schule_thumb(get_the_ID(), 'full', false, true, false, false, true, true, false);
		}
	}
	
	
	the_content();
	
	echo '<div class="cl"></div>';
	
	
	if ($cmsmasters_layout == 'fullwidth' && $content_start === '[cmsmasters_row') {
		echo '<div class="content_wrap ' . $cmsmasters_layout . '">' . "\n\n" . 
			'<div class="middle_content entry">';
	}
	
	
	wp_link_pages(array( 
		'before' => '<div class="subpage_nav">' . '<strong>' . esc_html__('Pages', 'schule') . ':</strong>', 
		'after' => '</div>' . "\n", 
		'link_before' => ' [ ', 
		'link_after' => ' ] ' 
	));
	
	
	comments_template();
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

