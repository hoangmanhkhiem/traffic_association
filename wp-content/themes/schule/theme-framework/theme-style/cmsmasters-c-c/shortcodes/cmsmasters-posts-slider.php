<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.7
 * 
 * Content Composer Posts Slider Shortcode
 * Created by CMSMasters
 * 
 */


extract(shortcode_atts($new_atts, $atts));


$unique_id = $shortcode_id;


$this->posts_slider_atts = array(
	'cmsmasters_post_metadata' => 		$blog_metadata, 
	'cmsmasters_project_metadata' => 	$portfolio_metadata 
);


if (!isset($post_type) || $post_type == '') {
	$post_type = 'post';
}


$args = array( 
	'post_type' => 				$post_type,
	'orderby' => 				$orderby, 
	'order' => 					$order, 
	'posts_per_page' => 		$count, 
	'ignore_sticky_posts' => 	true 
);


if ($post_type == 'post' && $blog_categories != '') {
	$args['category_name'] = $blog_categories;
} elseif ($post_type == 'project' && $portfolio_categories != '') {
	$cat_array = explode(",", $portfolio_categories);
	
	$args['tax_query'] = array(
		array( 
			'taxonomy' => 	'pj-categs', 
			'field' => 		'slug', 
			'terms' => 		$cat_array 
		)
	);
}


$query = new WP_Query($args);

$amount_count = 0;
	
$amount = ($amount == '' ? 1 : $amount);

$pause = ($pause == '' ? 0 : $pause);

$autoplay = ($pause > 0 ? $pause * 1000 : 'false');


$out = "";


if ($query->have_posts()) : 
	
	$out .= "<div class=\"cmsmasters_posts_slider" . 
		(($post_type == 'post') ? ' cmsmasters_posts_slider_type_post' : ' cmsmasters_posts_slider_type_project') . 
		(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	"\" " . 
		(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	">
		<div" . 
			" id=\"cmsmasters_slider_" . esc_attr($unique_id) . "\"" . 
			" class=\"cmsmasters_owl_slider owl-carousel\"" . 
			" data-items=\"" . esc_attr($columns) . "\"" . 
			" data-single-item=\"false\"" . 
			" data-auto-play=\"" . esc_attr($autoplay) . "\"" . 
		">";
			
			
			if ($post_type == 'post') {
				$out .= '<div class="cmsmasters_owl_slider_item">';

					while ($query->have_posts()) : $query->the_post();

						if ($amount_count == $amount) {
							$out .= '</div><div class="cmsmasters_owl_slider_item">';
							
							$amount_count = 0;
						}
					
						$out .= cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/post-type/posts-slider/slider-post.php', $this->posts_slider_atts);

						$amount_count ++;
						
					endwhile;

				$out .= '</div>';
			}
			
			
			if ($post_type == 'project') {
				while ($query->have_posts()) : $query->the_post();
					
					$out .= '<div class="cmsmasters_owl_slider_item">' . 
						cmsmasters_composer_ob_load_template('theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/post-type/posts-slider/slider-project.php', $this->posts_slider_atts) . 
					'</div>';
					
				endwhile;
			}
			
			
		$out .= '</div>' . 
	'</div>';

endif;


wp_reset_postdata();


echo schule_return_content($out);
