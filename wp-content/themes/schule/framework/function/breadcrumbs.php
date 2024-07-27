<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Breadcrumbs Function
 * Created by CMSMasters
 * 
 */


function schule_breadcrumbs($sep_text = ' / ') {
	global $post;
	
	
	$homeLink = esc_url(home_url('/'));
	
	$homeText = esc_attr__('Home', 'schule');
	
	$sep = "\n\t" . '<span class="breadcrumbs_sep">' . esc_html($sep_text) . '</span>' . "\n\t";
	
	
	$year_format = get_the_time('Y');
	
	$month_format = get_the_time('F');
	
	$month_number_format = get_the_time('n');
	
	$day_format = get_the_time('d');
	
	$day_full_format = get_the_time('l');
	
	
	$url_year = get_year_link($year_format);
	
	$url_month = get_month_link($year_format, $month_number_format);
	
	
	echo '<a href="' . esc_url($homeLink) . '" class="cms_home">' . esc_html($homeText) . '</a>' . $sep;
	
	
	if (CMSMASTERS_LEARNPRESS && learn_press_is_courses()) {
		echo '<span>' . cmsmasters_title(get_the_ID(), false) . '</span>';
	} elseif (is_single()) {
		$category = get_the_category();
		
		$num_cat = count($category);
		
		
		if ($num_cat < 1) {
			echo '<span>' . cmsmasters_title(get_the_ID(), false) . '</span>';
		} else if ($num_cat >= 1) {
			echo get_category_parents($category[0], true, $sep) . ' <span>' . cmsmasters_title(get_the_ID(), false) . '</span>';
		}
	} elseif (is_category()) {
		global $cat;
		
		
		$multiple_cats = get_category_parents($cat, true, $sep);
		
		
		if (is_string($multiple_cats)) {
			$multiple_cats_array = explode($sep, $multiple_cats);
		} else {
			$category = get_queried_object();
			
			$multiple_cats_array = array($category->name);
		}
		
		$multiple_cats_array = array_diff($multiple_cats_array, array(''));
		
		$multiple_cats_num = count($multiple_cats_array);
		
		foreach ($multiple_cats_array as $single_cat) {
			if ($single_cat !== end($multiple_cats_array)) {
				echo wp_kses(stripslashes($single_cat), 'post');
				
				echo wp_kses_post($sep);
			} else {
				echo '<span>' . single_cat_title('', false) . '</span>';
			}
		}
	} elseif (is_tag()) {
		echo '<span>' . single_tag_title('', false) . '</span>';
	} elseif (is_day()) {
		echo '<a href="' . esc_url($url_year) . '">' . esc_html($year_format) . '</a>' . 
			$sep . 
			'<a href="' . esc_url($url_month) . '">' . esc_html($month_format) . '</a>' . 
			$sep . 
			'<span>' . esc_html($day_format) . ' (' . esc_html($day_full_format) . ')</span>';
	} elseif (is_month()) {
		echo '<a href="' . esc_url($url_year) . '">' . esc_html($year_format) . '</a>' . $sep . '<span>' . esc_html($month_format) . '</span>';
	} elseif (is_year()) {
		echo '<span>' . esc_html($year_format) . '</span>';
	} elseif (is_search()) {
		echo '<span>' . esc_html__('Search results for', 'schule') . ": '" . esc_html(get_search_query()) . "'</span>";
	} elseif (is_page() && !$post->post_parent) {
		echo '<span>' . cmsmasters_title(get_the_ID(), false) . '</span>';
	} elseif (is_page() && $post->post_parent) {
		$post_array = get_post_ancestors($post);
		
		
		krsort($post_array);
		
		
		foreach ($post_array as $key => $postid) {
			$post_ids = get_post($postid);
			
			$title = $post_ids->post_title;
			
			
			echo '<a href="' . esc_url(get_permalink($post_ids)) . '">' . esc_html($title) . '</a>' . $sep;
		}
		
		
		echo '<span>' . cmsmasters_title(get_the_ID(), false) . '</span>';
	} elseif (is_author()) {
		echo '<span>' . esc_html(get_the_author()) . '</span>';
	} elseif (is_tax('post_format')) {
		if (is_tax('post_format', 'post-format-gallery')) {
			echo '<span>' . esc_html_x('Galleries', 'post format archive title', 'schule') . '</span>';
		} elseif (is_tax('post_format', 'post-format-image')) {
			echo '<span>' . esc_html_x('Images', 'post format archive title', 'schule') . '</span>';
		} elseif (is_tax('post_format', 'post-format-video')) {
			echo '<span>' . esc_html_x('Videos', 'post format archive title', 'schule') . '</span>';
		} elseif (is_tax('post_format', 'post-format-audio')) {
			echo '<span>' . esc_html_x('Audio', 'post format archive title', 'schule') . '</span>';
		}
	} elseif (is_post_type_archive()) {
		echo '<span>' . esc_html(post_type_archive_title('', false)) . '</span>';
	} elseif (is_tax()) {
		echo '<span>' . esc_html(single_term_title('', false)) . '</span>';
	} else {
		echo '<span>' . esc_html__('No breadcrumbs', 'schule') . '</span>';
	}
}

