<?php
/**
 * @package 	WordPress
 * @subpackage 	schule
 * @version 	1.0.1
 * 
 * LearnPress Content Composer Shortcodes
 * Created by CMSMasters
 * 
 */


function schule_learnpress_shortcodes($shortcodes) {
	$shortcodes[] = 'cmsmasters_learnpress';
	
	
	return $shortcodes;
}

add_filter('cmsmasters_custom_shortcodes_filter', 'schule_learnpress_shortcodes');


/**
 * LearnPress
 */
function cmsmasters_learnpress($atts, $content = null) {
	extract(shortcode_atts(array( 
		'shortcode_id' => 	'', 
		'orderby' => 		'', 
		'order' => 			'', 
		'categories' => 	'', 
		'count' => 			'', 
		'columns' => 		'', 
		'classes' => 		'' 
	), $atts));
	
	
	$unique_id = $shortcode_id;
	
	
	$out = '<div id="cmsmasters_learnpress_shortcode_' . $unique_id . '" class="cmsmasters_learnpress_shortcode' . 
	(($columns != '') ? ' cmsmasters_' . $columns : '') . 
	(($classes != '') ? ' ' . $classes : '') . 
	'">';
	
	
	$args = array( 
		'post_type' => 				'lp_course', 
		'orderby' => 				$orderby, 
		'order' => 					$order, 
		'posts_per_page' => 		$count 
	);
	
	if ($categories != '') {
		$cat_array = explode(",", $categories);
		
		$args['tax_query'] = array( 
			array( 
				'taxonomy' => 'course_category', 
				'field' => 'slug', 
				'terms' => $cat_array 
			)
		);
	}
	
	
	$query = new WP_Query($args);
	
	
	if ($query->have_posts()) : 
		while ($query->have_posts()) : $query->the_post();
	
		$course_id = get_the_ID();
		
		$course_duration = get_post_meta( $course_id, '_lp_duration', true );
		$term_list = get_the_term_list( $course_id, 'course_category', '', ', ', '' );

		$course = LP_Global::course();
		
		$out .= "<article id=\"lpr_course_post-" . $course_id . "\" class=\"lpr_course_post\">" . "\n" . 

			"<div class=\"cmsmasters_course_image_wrap\">" . 
				schule_thumb_rollover($course_id, 'cmsmasters-project-thumb', false, true, false, false, false, false, false, false, false) . "\n";
				
				
				if ( $price_html = $course->get_price_html() ) {
					$out .= "<div class=\"cmsmasters_course_price\">";
					
						if ( $course->get_origin_price() != $course->get_price() ) {
							$origin_price_html = $course->get_origin_price_html();
							
							$out .= "<span class=\"origin-price\">" . 
								$origin_price_html . 
							"</span>";
						}
						
						$out .= "<span class=\"price\">" . 
							$price_html . 
						"</span>";
						
					$out .= '</div>';
				} else {
					$out .= "<div class=\"cmsmasters_course_free\">" . esc_html__('Free', 'schule') . "</div>";
				}
				
			$out .= "</div>" . "\n" . 

			"<div class=\"lpr_course_inner\">" . "\n" . 
				"<header class=\"entry-header lpr_course_header\">
					<h4 class=\"entry-title lpr_course_title\"><a href=" . get_the_permalink( $course_id ) . ">" . get_the_title( $course_id ) . "</a></h4>
				</header>" . "\n";
				
				
				if ($term_list != '') {
					$out .= "<div class=\"entry-meta cmsmasters_cource_cat\">" . $term_list . "</div>";
				}
				
				
			$out .= "</div>" . "\n";
			
			if ( 
				class_exists( 'LP_Addon_Course_Review' ) || 
				$course_duration != '' 
			) {
				$out .= "<footer class=\"cmsmasters_course_footer\">" . "\n";

					if ( class_exists( 'LP_Addon_Course_Review' ) ) {
						$course_rate = learn_press_get_course_rate( $course_id );
						
						$out .= "<div class=\"review-stars-rated\">
							<div class=\"review-stars empty\"></div>
							<div class=\"review-stars filled\"  style=\"width:" . $course_rate*20 . "%;\"></div>
						</div>";
					}
					
					
					if ($course_duration != '') {
						$out .= "<div class=\"cmsmasters_cource_duration\">" . esc_html($course_duration) . "</div>";
					}
				
				$out .= "</footer>" . "\n";
			}
			
			
			$out .= "</article>" . "\n";
		
		
		endwhile;
	endif;
	
	
	wp_reset_postdata();
	
	
	$out .= '</div>';
	
	
	return $out;
}

